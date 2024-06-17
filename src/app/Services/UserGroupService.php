<?php

namespace App\Services;

use App\Enums\User\UserGroup\UserGroupPrivacyEnum;
use App\Http\Requests\User\UserGroup\UserGroupStoreRequest;
use App\Http\Requests\User\UserGroup\UserGroupUpdateRequest;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Gate;

class UserGroupService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, UserGroup>
     */
    public function index()
    {
        return UserGroup::all();
    }

    public function store(UserGroupStoreRequest $request): UserGroup
    {
        Gate::authorize('create', UserGroup::class);

        $validated = $request->validated();

        $userGroup = UserGroup::create([
            'name' => $validated['name'],
            'privacy' => $validated['privacy'] ??= UserGroupPrivacyEnum::private(),
            'creator' => $validated['creator'],
            'description' => $validated['description'],
        ]);

        return $userGroup;
    }

    public function show(string $id): UserGroup
    {
        $userGroup = UserGroup::findOrFail($id);
        Gate::authorize('view', $userGroup);

        return $userGroup;
    }

    public function update(UserGroupUpdateRequest $request, string $id): UserGroup
    {
        $validated = $request->validated();
        $userGroup = $this->show($id);

        Gate::authorize('update', $userGroup);
        $userGroup->update($validated);

        return $userGroup;
    }

    public function delete(string $id): void
    {
        $userGroup = UserGroup::findOrFail($id);

        Gate::authorize('delete', $userGroup);

        $userGroup->delete();
    }
}
