<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RedactRedacted implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {

        $redacteds = [
            'Sjin',
            'Caff',
            'CaffCast',
            'ASMRCast',
            'Turps'
        ];

        foreach ($redacteds as $redacted) {
            $builder->where('title', 'NOT LIKE', '%'.$redacted.'%')
                ->where('title', 'NOT LIKE', '%'.strtolower($redacted).'%');

            $builder->where('description', 'NOT LIKE', '%'.$redacted.'%')
                ->where('description', 'NOT LIKE', '%'.strtolower($redacted).'%');
        }

        return $builder;

    }

}