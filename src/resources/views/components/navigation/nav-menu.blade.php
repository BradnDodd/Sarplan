<div class="p-6 text-right sm:fixed sm:top-0 sm:right-0">
    <div class="flex justify-between h-16">
        <div class="flex">
            <div class="inline-flex items-center" >
                <x-navigation.nav-link :href="route('home')" :active="request()->routeIs('home')" >
                    Home
                </x-navigation.nav-link>
            </div>
            <x-auth.logout class="inline-flex items-center px-3">
            </x-auth.logout>
        </div>
    </div>
</div>
