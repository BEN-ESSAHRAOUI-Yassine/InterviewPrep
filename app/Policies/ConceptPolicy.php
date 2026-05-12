<?php

namespace App\Policies;

use App\Models\Domain;
use App\Models\User;

class ConceptPolicy
{
    public function view(User $user, Domain $domain): bool
    {
        return $user->id === $domain->user_id;
    }
}