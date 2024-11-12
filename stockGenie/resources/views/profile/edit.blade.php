<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Profile') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
			<div class="flex flex-wrap -mx-4">
				<div class="w-full lg:w-1/2 px-4 mb-4 lg:mb-0">
					<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
						<div class="max-w-xl">
							@include('profile.partials.update-profile-information-form')
						</div>
					</div>
				</div>

				<div class="w-full lg:w-1/2 px-4">
					<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
						<div class="max-w-xl">
							@include('profile.partials.update-password-form')
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
@if(Auth::user()->role==1)
@php
$id=Auth::user()->id;
$editEmp = DB::table('employees')->where('user_id',$id)->first();
@endphp
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="flex flex-wrap -mx-4">
        <section class="w-full bg-white shadow-md rounded-lg p-6"> <!-- Added shadow and padding -->
            <header>
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Profile Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Update your account's profile additional information.") }}
                </p>
            </header>

  
            @if ($editEmp)
    <form method="post" action="{{ route('update', $editEmp->id) }}" 
          class="mt-6 space-y-6 grid grid-cols-1 sm:grid-cols-2 gap-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Phone Field -->
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full shadow-sm border-gray-300 rounded-md" :value="old('phone', $editEmp->phone)" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <!-- Address Field -->
        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full shadow-sm border-gray-300 rounded-md" :value="old('address', $editEmp->address)" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>
  <!-- City Field -->
  <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full shadow-sm border-gray-300 rounded-md" :value="old('city', $editEmp->city)" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>
   <!-- Photo Field -->
<div>
    <x-input-label for="photo" :value="__('Photo URL')" />
    <x-text-input id="photo" name="photo" type="file" accept="image/*" class="mt-1 block w-full shadow-sm border-gray-300 rounded-md" onchange="previewImage(event)" />
    <x-input-error class="mt-2" :messages="$errors->get('photo')" />
    
    <!-- Preview Image -->
    <div class="mt-2">
    <img id="photoPreview" src="{{asset( old('photo', $editEmp->photo)) }}" alt="Photo Preview" class="w-full h-auto rounded-md" style="display: {{ old('photo', $editEmp->photo) ? 'block' : 'none' }}; width: 180px; height: 180px; object-fit: cover;" />
</div>

</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('photoPreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Show the preview
            }

            reader.readAsDataURL(input.files[0]); // Convert image file to base64 string
        } else {
            preview.src = ''; // Clear preview if no file is selected
            preview.style.display = 'none'; // Hide the preview
        }
    }
</script>


      

        <div class="flex items-center gap-4 col-span-2">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
@endif



        </section>
    </div>
</div>
@endif

    


	<!-- 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

        </div>
    </div> -->
</x-app-layout>