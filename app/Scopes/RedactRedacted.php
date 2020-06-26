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
        $builder->where('title', 'NOT LIKE', '%sjin%')
            ->where('title', 'NOT LIKE', '%caff%')
            ->where('title', 'NOT LIKE', '%turps%');

        $builder->where('description', 'NOT LIKE', '%sjin%')
            ->where('description', 'NOT LIKE', '%caff%')
            ->where('description', 'NOT LIKE', '%turps%');


        $builder->addSelect("videos.*")
            ->join('stars', 'star_id', '=', 'stars.id')
            ->where('stars.slug', '=', $model->slug);

        $builder->where('stars.slug', 'NOT IN', "('sjin', 'caff', 'turps')");
    }

}