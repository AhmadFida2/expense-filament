<?php

namespace App\Policies;

use App\Models\IncomeCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IncomeCategoryPolicy
{
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
    public function view(User $user, IncomeCategory $incomeCategory): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->id() === 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, IncomeCategory $incomeCategory): bool
    {
        return auth()->id() === 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, IncomeCategory $incomeCategory): bool
    {
        return auth()->id() === 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, IncomeCategory $incomeCategory): bool
    {
        return auth()->id() === 1;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, IncomeCategory $incomeCategory): bool
    {
        return auth()->id() === 1;
    }
}
