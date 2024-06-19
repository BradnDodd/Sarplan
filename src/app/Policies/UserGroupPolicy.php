<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Auth\Access\Response;

class UserGroupPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserGroup $userGroup): Response
    {
        // Team isn't their team but they have view all permission
        if (
            ! $user->groups()->where('user_groups.id', $userGroup->id)->exists()
            && $user->can('user-group-view-any')
        ) {
            return Response::allow();
        }

        // Callout is their team and they have view permission
        if (
            $user->groups()->where('user_groups.id', $userGroup->id)->exists()
            && $user->can('user-group-view-team')
        ) {
            return Response::allow();
        }

        return Response::deny('You cannot view this user group');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if (! $user->can('user-group-create')) {
            return Response::deny('You cannot create a user group');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserGroup $userGroup): Response
    {
        if (! $user->can('user-group-update')) {
            return Response::deny('You cannot update a user group');
        }

        if (! $user->groups()->where('user_groups.id', $userGroup->id)->exists()) {
            return Response::deny('You cannot update a user group belonging to another team');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserGroup $userGroup): Response
    {
        if (! $user->can('user-group-delete')) {
            return Response::deny('You cannot delete a user group');
        }

        if (! $user->groups()->where('user_groups.id', $userGroup->id)->exists()) {
            return Response::deny('You cannot delete another teams user group');
        }

        return Response::allow();
    }
}
