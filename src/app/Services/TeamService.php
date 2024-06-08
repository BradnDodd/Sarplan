<?php

namespace App\Services;

use App\Http\Requests\Team\TeamStoreRequest;
use App\Http\Requests\Team\TeamUpdateRequest;
use App\Models\Team;

class TeamService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, Team>
     */
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

    public function show(string $id): Team
    {
        return Team::findOrFail($id);
    }

    public function update(TeamUpdateRequest $request, string $id): Team
    {
        $validated = $request->validated();
        $team = $this->show($id);

        $team->update($validated);

        return $team;
    }

    public function delete(string $id): void
    {
        $team = Team::findOrFail($id);

        $team->delete();
    }
}
