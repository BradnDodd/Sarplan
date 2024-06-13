<?php

namespace App\Services;

use App\Enums\Callout\CalloutStatusEnum;
use App\Http\Requests\Callout\CalloutStoreRequest;
use App\Http\Requests\Callout\CalloutUpdateRequest;
use App\Models\Callout;
use Illuminate\Support\Facades\Gate;

class CalloutService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, Callout>
     */
    public function index()
    {
        return Callout::all();
    }

    public function store(CalloutStoreRequest $request): Callout
    {
        Gate::authorize('create', Callout::class);

        $validated = $request->validated();

        $callout = Callout::create([
            'primary_team' => $validated['primary_team'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'status' => $validated['status'] ??= CalloutStatusEnum::open(),
        ]);

        return $callout;
    }

    public function show(string $id): Callout
    {
        $callout = Callout::findOrFail($id);
        Gate::authorize('view', $callout);

        return $callout;
    }

    public function update(CalloutUpdateRequest $request, string $id): Callout
    {
        $validated = $request->validated();
        $callout = $this->show($id);

        Gate::authorize('update', $callout);

        $callout->update($validated);

        return $callout;
    }

    public function delete(string $id): void
    {
        $callout = Callout::findOrFail($id);

        Gate::authorize('delete', $callout);

        $callout->delete();
    }
}
