<nav class="p-4 text-base font-light sm:text-2xl bg-grey-600 dark:bg-gray-900 selection:text-white">
    <div class="container flex items-center justify-between mx-auto">
        <div class="flex items-center space-x-4">
            <x-navigation.nav-link
                :href="route('home')"
                :active="request()->routeIs('home')"
                wire:navigate
            >
                Home
            </x-navigation.nav-link>
            <x-navigation.nav-link
                :href="route('callout.index')"
                :active="request()->routeIs('callout.index')"
                wire:navigate
            >
                Callouts
            </x-navigation.nav-link>
            <x-navigation.nav-link>
                Team
            </x-navigation.nav-link>
        </div>

        <div class="flex items-center space-x-4">
            <div class="hidden sm:flex">
                <livewire:teams.user-select-team/>
            </div>
            <div class="dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                {{ Auth::user()->name }}
            </div>
            <x-dropdown class="mx-0" icon="chevron-down">
                <x-dropdown.header label="Settings">
                    <x-dropdown.item icon="cog" label="Preferences" />
                    <x-dropdown.item icon="user" label="My Profile" :href="route('profile')" :active="request()->routeIs('profile')" />
                </x-dropdown.header>
                <div class="sm:hidden">
                    <x-dropdown.header separator label="Team"/>
                    @foreach (Auth::user()->teams()->get() as $team)
                        <x-dropdown.item>{{ $team->name }}</x-dropdown.item>
                    @endforeach
                </div>
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
