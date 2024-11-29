<style>
    @import url('https://fonts.googleapis.com/css2?family=Parkinsans:wght@300..800&display=swap');

    *{
     font-family: 'Parkinsans', sans-serif;
    }

    .block:hover{
        transform: scale(1.1);
    }
</style>

<x-app-layout>
    <div class="py-12 bg-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold text-pink-500">{{ __("Welcome to your dashboard!") }}</h3>
                    <p class="mt-2 text-gray-600">{{ __("Here you can manage your tasks, projects, and more.") }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('table.index') }}" class="block">
                    <div class="bg-pink-50 p-6 rounded-lg shadow-md hover:bg-pink-100 transition duration-200">
                        <h4 class="text-lg font-semibold text-pink-600">Project</h4>
                        <p class="text-gray-600">Project name #1</p>
                    </div>
                </a>                
                <a href="{{ route('table.index') }}" class="block" role="button">
                    <div class="bg-green-50 p-6 rounded-lg shadow-md hover:bg-green-100 transition duration-200">
                        <h4 class="text-lg font-semibold text-green-600">Project</h4>
                        <p class="text-gray-600">Project name #2</p>
                    </div>
                </a>
                
                <a href="{{ route('table.index') }}" class="block">
                    <div class="bg-blue-50 p-6 rounded-lg shadow-md">
                        <h4 class="text-lg font-semibold text-blue-600">Project</h4>
                        <p class="text-gray-600">Project name #3</p>
                    </div>
                </a>
                
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold text-gray-800">Work spaces</h3>
                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="{{ route('table.index') }}" class="text-blue-500 hover:text-blue-600">Work Space #1</a>
                        </li>
                        <li>
                            <a href="#" class="text-green-500 hover:text-green-600">Work Space #2</a>
                        </li>
                        <li>
                            <a href="#" class="text-pink-500 hover:text-pink-600">Work Space #3</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
