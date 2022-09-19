<?php

namespace App\Policies;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Loan $loan)
    {
        return $user->id === $loan->user_id;
    }

}
