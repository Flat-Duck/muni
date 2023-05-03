<?php

namespace App\Models\Scopes;

trait Builter
{

    /**
     * Adds a scope to search the table based on the
     * $searchableFields array inside the model
     *
     * @param [type] $query
     * @param [type] $search
     * @return void
     */
    public function scopeOnlyActive($query)
    {
        $query->where('active', '=', 1);

        return $query;
    }
}
