<?php

namespace App\Policies;

use App\Models\Callout;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CalloutPolicy
{
    /**
     * Determine whether the user can view models.
     *
     * User must either have the callout-view-any permission
     * or they callout must belong to their team
     * and they have permission to view their own teams callouts
     */
    public function view(User $user, Callout $callout): Response
    {
        // Callout isn't their team but they have view all permission
        if (
            ! $user->teams()->where('teams.id', $callout->primary_team)->exists()
            && $user->can('callout-view-any')
        ) {
            return Response::allow();
        }

        // Callout is their team and they have view permission
        if (
            $user->teams()->where('teams.id', $callout->primary_team)->exists()
            && $user->can('callout-view-team')
        ) {
            return Response::allow();
        }

        return Response::deny('You cannot view this callout');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if (! $user->can('callout-create')) {
            return Response::deny('You cannot create a callout');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * User can only update their own teams callouts if they have the callout-update permission
     */
    public function update(User $user, Callout $callout): Response
    {
        if (! $user->can('callout-update')) {
            return Response::deny('You cannot update a callout');
        }

        if (! $user->teams()->where('teams.id', $callout->primary_team)->exists()) {
            return Response::deny('You cannot update a callout belonging to another team');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Callout $callout): Response
    {
        if (! $user->can('callout-delete')) {
            return Response::deny('You cannot delete a callout');
        }

        if (! $user->teams()->where('teams.id', $callout->primary_team)->exists()) {
            return Response::deny('You cannot delete a callout belonging to another team');
        }

        return Response::allow();
    }
}
