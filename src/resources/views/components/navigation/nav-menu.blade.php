<nav class="p-4 bg-grey-600 dark:bg-gray-900 selection:text-white">
    <div class="container flex items-center justify-between mx-auto">
        <div class="flex items-center">
            <x-navigation.nav-link :href="route('home')" :active="request()->routeIs('home')" >
                Home
            </x-navigation.nav-link>
        </div>

        <div class="flex items-center space-x-4">
            <x-navigation.nav-link :href="route('profile')" :active="request()->routeIs('profile')" >
                {{ Auth::user()->name }}
            </x-navigation.nav-link>
            <x-auth.logout class="inline-flex items-center px-3">
            </x-auth.logout>
        </div>
    </div>
</nav>
