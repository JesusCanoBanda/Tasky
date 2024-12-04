<section class="bg-gradient-to-r from-blue-100 to-blue-50 p-8 rounded-xl shadow-md border border-blue-300">
    <header>
        <h2 class="text-xl font-bold text-blue-700">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-blue-600">
            {{ __("Actualiza tu nombre") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-blue-50 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:border-blue-500" :value="old('name', $user->name)" required autofocus autocomplete="name" maxlength="20" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input id="email" name="email" type="hidden" class="mt-1 block w-full bg-blue-50 border border-blue-300 rounded-md focus:ring focus:ring-blue-500 focus:border-blue-500" :value="old('email', $user->email)" required autocomplete="username" maxlength="62" readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</section>
