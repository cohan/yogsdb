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
            ->where('title', 'NOT LIKE', '%caff %')
            ->where('title', 'NOT LIKE', '%caffcast%')
            ->where('title', 'NOT LIKE', '%asmrcast%')
            ->where('title', 'NOT LIKE', '%turps%')
            ->where('title', 'NOT LIKE', '%Sjin%')
            ->where('title', 'NOT LIKE', '%Caff %')
            ->where('title', 'NOT LIKE', '%CaffCast%')
            ->where('title', 'NOT LIKE', '%ASMRCast%')
            ->where('title', 'NOT LIKE', '%Turps%');

        $builder->where('description', 'NOT LIKE', '%sjin%')
            ->where('description', 'NOT LIKE', '%caff %')
            ->where('description', 'NOT LIKE', '%caffcast%')
            ->where('description', 'NOT LIKE', '%asmrcast%')
            ->where('description', 'NOT LIKE', '%turps%')
            ->where('description', 'NOT LIKE', '%Sjin%')
            ->where('description', 'NOT LIKE', '%Caff %')
            ->where('description', 'NOT LIKE', '%CaffCast%')
            ->where('description', 'NOT LIKE', '%ASMRCast%')
            ->where('description', 'NOT LIKE', '%Turps%');


        $builder->addSelect("videos.*")
            ->join('stars', 'star_id', '=', 'stars.id')
            ->where('stars.slug', '=', $model->slug);

        $builder->where('stars.slug', 'NOT IN', "('sjin', 'caff', 'turps')");
    }

}