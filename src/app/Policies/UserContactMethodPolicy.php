<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserContactMethod;
use Illuminate\Auth\Access\Response;

class UserContactMethodPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserContactMethod $userContactMethod): Response
    {
        // User isn't their team but they have view all permission
        if (
            ! $user->contactMethods()->where('user_contact_methods.id', $userContactMethod->id)->exists()
            && $user->can('user-contact-method-view-any')
        ) {
            return Response::allow();
        }

        // Callout is their team and they have view permission
        if (
            $user->contactMethods()->where('user_contact_methods.id', $userContactMethod->id)->exists()
            && $user->can('user-contact-method-view-user')
        ) {
            return Response::allow();
        }

        return Response::deny('You cannot view this user contact method');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        if (! $user->can('user-contact-method-create-user')) {
            return Response::deny('You cannot create a user contact method');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserContactMethod $userContactMethod): Response
    {
        if (! $user->can('user-contact-method-update-user')) {
            return Response::deny('You cannot update a user contact method');
        }

        if (! $user->contactMethods()->where('user_contact_methods.id', $userContactMethod->id)->exists()) {
            return Response::deny('You cannot update a user contact method belonging to another user');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserContactMethod $userContactMethod): Response
    {
        if (! $user->can('user-contact-method-delete-user')) {
            return Response::deny('You cannot delete a user contact method');
        }

        if (! $user->contactMethods()->where('user_contact_methods.id', $userContactMethod->id)->exists()) {
            return Response::deny('You cannot delete another users contact method');
        }

        return Response::allow();
    }
}
