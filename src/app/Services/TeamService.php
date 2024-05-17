<?php

namespace App\Services;

use App\Http\Requests\TeamStoreRequest;
use App\Models\Team;

class TeamService
{
    public function index()
    {
        return Team::all();
    }

    public function store(TeamStoreRequest $request): Team
    {
        $validated = $request->validated();

        $team = Team::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'active' => $validated['active'] ??= true,
        ]);

        return $team;
    }
}
