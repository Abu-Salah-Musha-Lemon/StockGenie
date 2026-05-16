<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    {{-- Main Content --}}
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Basic Profile & Password --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white shadow rounded-lg p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Employee Extra Info --}}
            @if(Auth::user()->role == 1)
                @php
                    $id = Auth::user()->id;
                    $editEmp = DB::table('employees')->where('user_id', $id)->first();
                @endphp

                @if ($editEmp)
                    <div class="bg-white shadow rounded-lg p-6">
                        <header class="mb-6 border-b pb-4">
                            <h2 class="text-lg font-semibold text-gray-900">
                                {{ __('Additional Profile Information') }}
                            </h2>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ __("Update your employee details below.") }}
                            </p>
                        </header>

<form method="POST"
      action="{{ route('admin.employees.update', $editEmp->id) }}"
      enctype="multipart/form-data"
      class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    @csrf
    @method('PATCH')

    {{-- First Name --}}
    <div>
        <x-input-label for="first_name" value="First Name" />
        <x-text-input id="first_name" name="first_name"
            value="{{ old('first_name', $editEmp->first_name) }}"
            class="mt-1 block w-full" />
    </div>

    {{-- Last Name --}}
    <div>
        <x-input-label for="last_name" value="Last Name" />
        <x-text-input id="last_name" name="last_name"
            value="{{ old('last_name', $editEmp->last_name) }}"
            class="mt-1 block w-full" />
    </div>

    {{-- Phone --}}
    <div>
        <x-input-label for="phone_number" value="Phone Number" />
        <x-text-input id="phone_number" name="phone_number"
            value="{{ old('phone_number', $editEmp->phone_number) }}"
            class="mt-1 block w-full" />
    </div>

    {{-- Gender --}}
    <div>
        <x-input-label for="gender" value="Gender" />
        <select name="gender" class="mt-1 block w-full border-gray-300 rounded-md">
            <option value="">Select</option>
            <option value="male" {{ $editEmp->gender=='male'?'selected':'' }}>Male</option>
            <option value="female" {{ $editEmp->gender=='female'?'selected':'' }}>Female</option>
            <option value="other" {{ $editEmp->gender=='other'?'selected':'' }}>Other</option>
        </select>
    </div>

    {{-- Date of Birth --}}
    <div>
        <x-input-label for="date_of_birth" value="Date of Birth" />
        <input type="date" name="date_of_birth"
            value="{{ old('date_of_birth', $editEmp->date_of_birth) }}"
            class="mt-1 block w-full border-gray-300 rounded-md">
    </div>

    {{-- Hire Date --}}
    <div>
        <x-input-label for="hire_date" value="Hire Date" />
        <input type="date" name="hire_date"
            value="{{ old('hire_date', $editEmp->hire_date) }}"
            class="mt-1 block w-full border-gray-300 rounded-md">
    </div>

    {{-- Position --}}
    <div>
        <x-input-label for="position" value="Position" />
        <x-text-input name="position"
            value="{{ old('position', $editEmp->position) }}"
            class="mt-1 block w-full" />
    </div>

    {{-- Status --}}
    <div>
        <x-input-label for="status" value="Status" />
        <select name="status" class="mt-1 block w-full border-gray-300 rounded-md">
            <option value="active" {{ $editEmp->status=='active'?'selected':'' }}>Active</option>
            <option value="inactive" {{ $editEmp->status=='inactive'?'selected':'' }}>Inactive</option>
            <option value="terminated" {{ $editEmp->status=='terminated'?'selected':'' }}>Terminated</option>
        </select>
    </div>

    {{-- Address --}}
    <div class="sm:col-span-2">
        <x-input-label for="address" value="Address" />
        <textarea name="address" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('address', $editEmp->address) }}</textarea>
    </div>

    {{-- Photo --}}
    <div class="sm:col-span-2">
        <x-input-label for="photo" value="Photo" />
        <input type="file" name="photo" class="mt-1 block w-full">

        @if($editEmp->photo)
            <img src="{{ asset($editEmp->photo) }}"
                 class="w-32 mt-3 rounded">
        @endif
    </div>

    {{-- Submit --}}
    <div class="sm:col-span-2 text-right">
        <x-primary-button>Update Employee</x-primary-button>
    </div>
</form>
                    </div>
                @endif
            @endif

        </div>
    </div>

    {{-- Image Preview Script --}}
    <script>
        function previewImage(event) {
            const preview = document.getElementById('photoPreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
