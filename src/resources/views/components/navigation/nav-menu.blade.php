<nav class="p-4 bg-grey-600 dark:bg-gray-900 selection:text-white">
    <div class="container flex items-center justify-between mx-auto">
        <div class="flex items-center space-x-4">
            <x-navigation.nav-link :href="route('home')" :active="request()->routeIs('home')" >
                Home
            </x-navigation.nav-link>
        </div>

        <div class="flex items-center space-x-4">
            <livewire:teams.user-select-team/>
            <div class="text-sm">
                {{ Auth::user()->name }}
            </div>
            <x-dropdown class="mx-0" icon="chevron-down">
                <x-dropdown.header label="Settings">
                    <x-dropdown.item icon="cog" label="Preferences" />
                    <x-dropdown.item icon="user" label="My Profile" :href="route('profile')" :active="request()->routeIs('profile')" />
                </x-dropdown.header>
                <x-dropdown.item
                    separator
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                    Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </x-dropdown.item>
            </x-dropdown>
        </div>


    </div>
</nav>
