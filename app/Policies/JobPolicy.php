<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
   
    public function modify(User $user, Job $job): Response
    {
        return $user->id === $job->user_id ? Response::allow() : Response::deny('You do not own this post');
    }
}
