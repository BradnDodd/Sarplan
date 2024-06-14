<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        if (! $user->can('team-view-team')) {
            return Response::deny('You cannot view teams');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): Response
    {
        // Team isn't their team but they have view all permission
        if (
            ! $user->teams()->where('teams.id', $team->id)->exists()
            && $user->can('team-view-any')
        ) {
            return Response::allow();
        }

        // Callout is their team and they have view permission
        if (
            $user->teams()->where('teams.id', $team->id)->exists()
            && $user->can('team-view-team')
        ) {
            return Response::allow();
        }

        return Response::deny('You cannot view this team');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if (! $user->can('team-create')) {
            return Response::deny('You cannot create a team');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): Response
    {
        if (! $user->can('team-update')) {
            return Response::deny('You cannot update a team');
        }

        if (! $user->teams()->where('teams.id', $team->id)->exists()) {
            return Response::deny('You cannot update a team belonging to another team');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): Response
    {
        if (! $user->can('team-delete')) {
            return Response::deny('You cannot delete a team');
        }

        if (! $user->teams()->where('teams.id', $team->id)->exists()) {
            return Response::deny('You cannot delete another team');
        }

        return Response::allow();
    }

    public function restore(User $user, Team $team): Response
    {
        return Response::deny('This feature is not available');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): Response
    {
        return Response::deny('This feature is not available');
    }
}
