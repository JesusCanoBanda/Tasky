<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[rgba(246,229,210,1)] flex items-center justify-center min-h-screen">
    <div class="flex flex-col md:flex-row rounded-xl overflow-hidden max-w-6xl w-full h-[600px]">
        <div class="flex items-center justify-center p-14 flex-1">
            <div class="w-full max-w-md bg-[#272207B3] p-10 rounded-xl shadow-lg">
                <h2 class="text-center text-4xl font-bold mb-8" style="color: #E0E0E0;">LOGIN</h2>
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-lg font-medium" style="color: #E0E0E0;">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="example@mail.com"
                            required
                            class="mt-2 block w-full px-5 py-3 bg-white border border-gray-300 rounded-lg focus:ring-green-500 focyellowr95r-green-500 shadow-sm text-lg"
                        />
                    </div>

                    <div>
                        <label for="password" class="block text-lg font-medium" style="color: #E0E0E0;">Password</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            required
                            class="mt-2 block w-full px-5 py-3 bg-white border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 shadow-sm text-lg"
                        />
                    </div>

                    <div class="text-center text-gray-300 text-sm">
                        ¿No tienes una cuenta? 
                        <a href="{{ route('register') }}" class="text-green-400 hover:underline">Regístrate</a>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[rgba(138,183,141,1)] text-white py-3 px-6 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-offset-2 text-lg font-semibold transition">
                        Log In
                    </button>
                </form>
            </div>
        </div>

        <div class="flex items-center justify-center p-12 flex-1 bg-[rgba(246,229,210,1)]">
            <img src="{{ asset('images/login.png') }}" alt="Persona trabajando" class="w-[500px] h-auto rounded-lg">
        </div>
    </div>
</body>
</html>
