<div {{ $attributes }}>
    <x-navigation.nav-link :href="route('logout')" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </x-navigation.nav-link>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
