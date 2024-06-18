<?php

namespace App\Services;

use App\Http\Requests\User\UserContactMethod\UserContactMethodStoreRequest;
use App\Http\Requests\User\UserContactMethod\UserContactMethodUpdateRequest;
use App\Models\UserContactMethod;
use Illuminate\Support\Facades\Gate;

class UserContactMethodService
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, UserContactMethod>
     */
    public function index()
    {
        return UserContactMethod::all();
    }

    public function store(UserContactMethodStoreRequest $request): UserContactMethod
    {
        Gate::authorize('create', UserContactMethod::class);

        $validated = $request->validated();

        $userContactMethod = UserContactMethod::create([
            'user_id' => $validated['user_id'],
            'contact' => $validated['contact'],
            'type' => $validated['type'],
            'primary_method_for_type' => $validated['primary_method_for_type'],
        ]);

        return $userContactMethod;
    }

    public function show(string $id): UserContactMethod
    {
        $userContactMethod = UserContactMethod::find($id);

        Gate::authorize('view', $userContactMethod);

        return $userContactMethod;
    }

    public function update(UserContactMethodUpdateRequest $request, string $id): UserContactMethod
    {

        $validated = $request->validated();
        $userContactMethod = $this->show($id);

        Gate::authorize('update', $userContactMethod);

        $userContactMethod->update($validated);

        return $userContactMethod;
    }

    public function delete(string $id): void
    {
        $userContactMethod = UserContactMethod::findOrFail($id);

        Gate::authorize('delete', $userContactMethod);

        $userContactMethod->delete();
    }
}
