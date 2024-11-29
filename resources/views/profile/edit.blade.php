<x-app-layout>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="p-8 bg-gradient-to-r from-blue-100 to-blue-50 rounded-xl shadow-md border border-blue-300">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="p-8 bg-gradient-to-r from-green-100 to-green-50 rounded-xl shadow-md border border-green-300">
                @include('profile.partials.update-password-form')
            </div>

            <div class="p-8 bg-gradient-to-r from-red-100 to-red-50 rounded-xl shadow-md border border-red-300">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
