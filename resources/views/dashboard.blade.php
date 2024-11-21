<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold text-pink-500">{{ __("Welcome to your dashboard!") }}</h3>
                    <p class="mt-2 text-gray-600">{{ __("Here you can manage your tasks, projects, and more.") }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-pink-50 p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-pink-600">Tasks</h4>
                    <p class="text-gray-600">You have <span class="font-bold text-pink-800">5</span> tasks pending.</p>
                </div>
                <div class="bg-green-50 p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-green-600">Completed</h4>
                    <p class="text-gray-600">You completed <span class="font-bold text-green-800">12</span> tasks this week.</p>
                </div>
                <div class="bg-blue-50 p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold text-blue-600">Projects</h4>
                    <p class="text-gray-600">You are working on <span class="font-bold text-blue-800">3</span> projects.</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold text-gray-800">Quick Links</h3>
                    <ul class="mt-4 space-y-2">
                        <li>
                            <a href="{{ route('table.index') }}" class="text-blue-500 hover:text-blue-600">View All Tasks</a>
                        </li>
                        <li>
                            <a href="#" class="text-green-500 hover:text-green-600">Add a New Task</a>
                        </li>
                        <li>
                            <a href="#" class="text-pink-500 hover:text-pink-600">Check Project Status</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
