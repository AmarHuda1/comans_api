<?php

namespace App\Policies;

use App\Helpers\UserHelper;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BranchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any branches.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        $uh = new UserHelper();
        return $uh->checkPermision($user->user_id, ['super-admin','view-branch']) ? Response::allow()
            : Response::deny('Unauthorized', 401);
    }

    /**
     * Determine whether the user can view the branch.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Branch  $branch
     * @return mixed
     */
    public function view(User $user)
    {
        //
        $uh = new UserHelper();
        return $uh->checkPermision($user->user_id, ['super-admin']) ? Response::allow()
            : Response::deny('Unauthorized', 401);
    }

    /**
     * Determine whether the user can create branches.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        $uh = new UserHelper();
        return $uh->checkPermision($user->user_id, ['super-admin']) ? Response::allow()
            : Response::deny('Unauthorized', 401);
    }

    /**
     * Determine whether the user can update the branch.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Branch  $branch
     * @return mixed
     */
    public function update(User $user)
    {
        //
        $uh = new UserHelper();
        return $uh->checkPermision($user->user_id, ['super-admin']) ? Response::allow()
            : Response::deny('Unauthorized', 401);
    }

    public function updateb(User $user)
    {
        //
        $uh = new UserHelper();
        return $uh->checkPermision($user->user_id, ['edit-branch']) ? Response::allow()
            : Response::deny('Unauthorized', 401);
    }
    /**
     * Determine whether the user can delete the branch.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Branch  $branch
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        $uh = new UserHelper();
        return $uh->checkPermision($user->user_id, ['super-admin', 'delete-branch']) ? Response::allow()
            : Response::deny('Unauthorized', 401);
    }
}
