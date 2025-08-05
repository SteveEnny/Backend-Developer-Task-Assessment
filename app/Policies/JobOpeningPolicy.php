<?php

namespace App\Policies;

use App\Models\JobOpening;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobOpeningPolicy
{
    // $protected
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, JobOpening $jobOpening): Response
    {
        return $user->id === $jobOpening->user_id ? Response::allow() : Response::deny("You are not authorizes to view this resource");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, JobOpening $jobOpening): bool
    {
        return $user->id === $jobOpening->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, JobOpening $jobOpening): bool
    {
        return $user->id === $jobOpening->user_id;
    }

}