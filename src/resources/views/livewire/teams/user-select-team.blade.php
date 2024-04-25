<div>
    @if (Auth::user()->teams()->count() > 1)
    <x-dropdown>
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                <div>
                    <strong>Team:</strong>
                    @if (!empty(session('user.selectedTeam')))
                        {{ Auth::user()->teams()->where('team_id', session('user.selectedTeam'))->get()->first()->name }}
                    @else
                        {{ Auth::user()->teams()->first()->name }}
                    @endif
                </div>
                <div>
                    <svg class="w-4 h-4 transition duration-150 ease-in-out text-secondary-500 hover:text-secondary-700 dark:hover:text-secondary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </button>
        </x-slot>
        @foreach (Auth::user()->teams()->get() as $team)
            <x-dropdown.item>{{$team->name}}</x-dropdown.item>
        @endforeach
    </x-dropdown>
    @endif
</div>
