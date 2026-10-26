<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use DB;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        try {

            $user = DB::transaction(function () use ($request) {

                /*
                |--------------------------------------------------------------------------
                | Determine Role
                |--------------------------------------------------------------------------
                |
                | role 1 = Admin
                | role 3 = Employee
                |
                | If no admin exists, new user becomes admin.
                | Otherwise new user becomes employee.
                |
                */

                $adminExists = User::where('role', 0)->exists();

                $role = $adminExists ? 3 : 0;


                /*
                |--------------------------------------------------------------------------
                | Create User
                |--------------------------------------------------------------------------
                */

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $role,
                ]);


                /*
                |--------------------------------------------------------------------------
                | Split Name
                |--------------------------------------------------------------------------
                */

                $nameParts = explode(' ', trim($request->name), 2);

                $firstName = $nameParts[0];
                $lastName = $nameParts[1] ?? null;


                /*
                |--------------------------------------------------------------------------
                | Generate Employee Code
                |--------------------------------------------------------------------------
                */

                do {

                    $employeeCode =
                        'EMP-' .
                        now()->format('Y') .
                        '-' .
                        random_int(1000, 9999);

                } while (
                    DB::table('employees')
                        ->where('employee_code', $employeeCode)
                        ->exists()
                );


                /*
                |--------------------------------------------------------------------------
                | Create Employee
                |--------------------------------------------------------------------------
                */

                DB::table('employees')->insert([

                    'user_id' => $user->id,

                    'employee_code' => $employeeCode,

                    'first_name' => $firstName,

                    'last_name' => $lastName,

                    'email' => $request->email,

                    'hire_date' => now(),

                    'status' => 'active',

                    'created_at' => now(),

                    'updated_at' => now(),
                ]);


                return $user;
            });


            /*
            |--------------------------------------------------------------------------
            | Login
            |--------------------------------------------------------------------------
            */

            Auth::login($user);

            return redirect()->route('dashboard');


        } catch (\Exception $e) {

            // Temporary: show the real database error
            dd($e->getMessage());
        }
    }


}