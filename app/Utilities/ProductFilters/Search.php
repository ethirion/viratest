<?php


namespace App\Utilities\ProductFilters;

use App\Utilities\QueryFilter;
use App\Utilities\FilterContract;

/**
 * Class Search
 * @package App\Utilities\ProductFilters
 */
class Search extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->where('name', 'LIKE' , '%'.$value.'%');
    }
}
