<?php

namespace App;

use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * product colors
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class)->withTimestamps()->withPivot('price');
    }

    /**
     * scope query to only include filters
     * @param $query
     * @param array $filters
     * @return mixed
     */
    public function scopeFilterBy($query, array $filters)
    {
        $namespace = 'App\Utilities\ProductFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }
}
