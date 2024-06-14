<?php

namespace App\Services;

use App\Http\Requests\Team\TeamStoreRequest;
use App\Http\Requests\Team\TeamUpdateRequest;
use App\Models\Team;
use Illuminate\Support\Facades\Gate;

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
        Gate::authorize('create', Team::class);

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
        $team = Team::findOrFail($id);
        Gate::authorize('view', $team);

        return $team;
    }

    public function update(TeamUpdateRequest $request, string $id): Team
    {
        $validated = $request->validated();
        $team = $this->show($id);

        Gate::authorize('update', $team);
        $team->update($validated);

        return $team;
    }

    public function delete(string $id): void
    {
        $team = Team::findOrFail($id);

        Gate::authorize('delete', $team);

        $team->delete();
    }
}
