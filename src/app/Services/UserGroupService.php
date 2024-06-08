<?php

namespace App\Services;

use App\Enums\User\UserGroup\UserGroupPrivacyEnum;
use App\Http\Requests\User\UserGroup\UserGroupStoreRequest;
use App\Http\Requests\User\UserGroup\UserGroupUpdateRequest;
use App\Models\UserGroup;

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
        return UserGroup::findOrFail($id);
    }

    public function update(UserGroupUpdateRequest $request, string $id): UserGroup
    {
        $validated = $request->validated();
        $userGroup = $this->show($id);

        $userGroup->update($validated);

        return $userGroup;
    }

    public function delete(string $id): void
    {
        $userGroup = UserGroup::findOrFail($id);

        $userGroup->delete();
    }
}
