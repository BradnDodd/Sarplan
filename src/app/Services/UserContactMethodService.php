<?php

namespace App\Services;

use App\Http\Requests\User\UserContactMethod\UserContactMethodStoreRequest;
use App\Http\Requests\User\UserContactMethod\UserContactMethodUpdateRequest;
use App\Models\UserContactMethod;

class UserContactMethodService
{
    public function index()
    {
        return UserContactMethod::all();
    }

    public function store(UserContactMethodStoreRequest $request): UserContactMethod
    {
        $validated = $request->validated();

        $callout = UserContactMethod::create([
            'user_id' => $validated['user_id'],
            'contact' => $validated['contact'],
            'type' => $validated['type'],
            'primary_method_for_type' => $validated['primary_method_for_type'],
        ]);

        return $callout;
    }

    public function show(string $id): UserContactMethod
    {
        return UserContactMethod::findOrFail($id);
    }

    public function update(UserContactMethodUpdateRequest $request, string $id): UserContactMethod
    {
        $validated = $request->validated();
        $callout = $this->show($id);

        $callout->update($validated);

        return $callout;
    }

    public function delete(string $id): void
    {
        $callout = UserContactMethod::findOrFail($id);

        $callout->delete();
    }
}
