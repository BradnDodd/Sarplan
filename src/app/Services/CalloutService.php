<?php

namespace App\Services;

use App\Enums\Callout\CalloutStatusEnum;
use App\Http\Requests\Callout\CalloutStoreRequest;
use App\Http\Requests\Callout\CalloutUpdateRequest;
use App\Models\Callout;

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
        $validated = $request->validated();

        $callout = Callout::create([
            'primary_team' => $validated['primary_team'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => $validated['status'] ??= CalloutStatusEnum::open(),
        ]);

        return $callout;
    }

    public function show(string $id): Callout
    {
        return Callout::findOrFail($id);
    }

    public function update(CalloutUpdateRequest $request, string $id): Callout
    {
        $validated = $request->validated();
        $callout = $this->show($id);

        $callout->update($validated);

        return $callout;
    }

    public function delete(string $id): void
    {
        $callout = Callout::findOrFail($id);

        $callout->delete();
    }
}
