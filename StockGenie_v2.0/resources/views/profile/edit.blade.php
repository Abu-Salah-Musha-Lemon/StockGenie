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
                              action="{{ route('update', $editEmp->id) }}"
                              enctype="multipart/form-data"
                              class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            @csrf
                            @method('PATCH')

                            {{-- Phone --}}
                            <div>
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input
                                    id="phone"
                                    name="phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :value="old('phone', $editEmp->phone)"
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            {{-- City --}}
                            <div>
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input
                                    id="city"
                                    name="city"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :value="old('city', $editEmp->city)"
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('city')" />
                            </div>

                            {{-- Address --}}
                            <div class="sm:col-span-2">
                                <x-input-label for="address" :value="__('Address')" />
                                <x-text-input
                                    id="address"
                                    name="address"
                                    type="text"
                                    class="mt-1 block w-full"
                                    :value="old('address', $editEmp->address)"
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            {{-- Photo Upload --}}
                            <div class="sm:col-span-2">
                                <x-input-label for="photo" :value="__('Profile Photo')" />
                                <input
                                    id="photo"
                                    name="photo"
                                    type="file"
                                    accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-700
                                           file:mr-4 file:py-2 file:px-4
                                           file:rounded-md file:border-0
                                           file:bg-indigo-50 file:text-indigo-700
                                           hover:file:bg-indigo-100"
                                    onchange="previewImage(event)"
                                />
                                <x-input-error class="mt-2" :messages="$errors->get('photo')" />

                                {{-- Preview --}}
                                <div class="mt-4">
                                    <img
                                        id="photoPreview"
                                        src="{{ asset(old('photo', $editEmp->photo)) }}"
                                        class="w-40 h-40 rounded-lg object-cover border"
                                        style="display: {{ old('photo', $editEmp->photo) ? 'block' : 'none' }};"
                                    />
                                </div>
                            </div>

                            {{-- Save Button --}}
                            <div class="sm:col-span-2 flex justify-end">
                                <x-primary-button class="px-6">
                                    {{ __('Save Changes') }}
                                </x-primary-button>
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
