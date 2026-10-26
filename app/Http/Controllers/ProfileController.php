<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        $editEmp = DB::table('employees')
            ->where('user_id', $user->id)
            ->first();

       $allPositions = DB::table('positions')->get();
        return view('profile.edit', [
            'user' => $user,
            'editEmp' => $editEmp,
            'allPositions' => $allPositions,
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
         $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateEmployee(Request $request): RedirectResponse
    {
        $user = $request->user();

        $employee = DB::table('employees')
            ->where('user_id', $user->id)
            ->first();

        if (!$employee) {
            return Redirect::route('profile.edit')
                ->with('error', 'Employee record not found.');
        }

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', 'in:male,female,other'],
            'date_of_birth' => ['nullable', 'date'],
            'hire_date' => ['nullable', 'date'],
            'position_id' => ['required', 'exists:positions,id'],
            'status' => ['required', 'in:active,inactive,terminated'],
            'address' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $updateData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'hire_date' => $request->hire_date,
            'position_id' => $request->position_id,
            'status' => $request->status,
            'address' => $request->address,
            'updated_at' => now(),
        ];

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            $photoName = time() . '_' . $photo->getClientOriginalName();

            $photo->move(
                public_path('uploads/employees'),
                $photoName
            );

            $updateData['photo'] = 'uploads/employees/' . $photoName;
        }

        DB::table('employees')
            ->where('id', $employee->id)
            ->update($updateData);

        return Redirect::route('profile.edit')
            ->with('status', 'employee-updated');
    }

}
