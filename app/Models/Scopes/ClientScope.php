<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ClientScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // If a client is logged in, only show records for their client
        /** @var \App\Models\Client|null $user */
            $user = Auth::user();

        if ($user && !$user->isAdmin()) {
            $builder->where($model->getTable() . '.client_id', Auth::id());
        }
    }
}
