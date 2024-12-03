<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[rgba(246,229,210,1)] flex items-center justify-center h-screen">
    <div class="flex flex-col md:flex-row rounded-xl overflow-hidden max-w-3xl w-full h-auto">
        <div class="flex items-center justify-center flex-1 bg-[rgba(246,229,210,1)] p-3 md:p-4">
            <img src="images/Register.png" alt="Persona trabajando"
                class="max-w-[350px] md:max-w-[350px] w-full h-auto rounded-lg">
        </div>

        <div class="flex items-center justify-center p-3 md:p-5 flex-1">
            <div class="w-full max-w-sm bg-[#272207B1] p-7 rounded-lg shadow-lg">
                <h2 class="text-center text-lg md:text-xl font-bold mb-3" style="color: #E0E0E0;">Register</h2>
                <form method="POST" action="{{ route('register') }}" class="space-y-3">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nombre')" class="block text-sm font-medium"
                            style="color: #E0E0E0;" />
                        <x-text-input id="name" name="name" type="text" :value="old('name')" maxlength="20" required autofocus
                            autocomplete="name"
                            class="mt-1 block w-full px-2 py-1 bg-white border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="apellidos" :value="__('Apellidos')" class="block text-sm font-medium"
                            style="color: #E0E0E0;" />
                        <x-text-input id="apellidos" name="apellidos" type="text" :value="old('apellidos')" maxlength="15" required
                            autofocus autocomplete="apellidos"
                            class="mt-1 block w-full px-2 py-1 bg-white border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('apellidos')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="user_name" :value="__('User name')" class="block text-sm font-medium"
                            style="color: #E0E0E0;" />
                        <x-text-input id="user_name" name="user_name" type="text" :value="old('user_name')" maxlength="15" required
                            autofocus autocomplete="user_name"
                            class="mt-1 block w-full px-2 py-1 bg-white border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('user_name')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium"
                            style="color: #E0E0E0;" />
                        <x-text-input id="email" name="email" type="email" :value="old('email')" maxlength="62" required
                            autocomplete="email"
                            class="mt-1 block w-full px-2 py-1 bg-white border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" class="block text-sm font-medium"
                            style="color: #E0E0E0;" />
                        <x-text-input id="password" name="password" type="password" required
                            autocomplete="new-password"
                            class="mt-1 block w-full px-2 py-1 bg-white border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium"
                            style="color: #E0E0E0;" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                            autocomplete="new-password"
                            class="mt-1 block w-full px-2 py-1 bg-white border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <div class="text-center text-gray-300 text-xs">
                        ¿Ya tienes una cuenta?
                        <a href="{{ route('login') }}" class="text-green-400 hover:underline">Inicia sesión</a>
                    </div>

                    <div>
                        <x-primary-button
                            class="w-full justify-center bg-green-600 text-white py-1 px-3 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-offset-2 focus:ring-green-500 text-sm font-semibold transition">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>
