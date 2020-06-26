<?php


namespace App\Utilities\ProductFilters;

use App\Utilities\QueryFilter;
use App\Utilities\FilterContract;

/**
 * Class Price
 * @package App\Utilities\ProductFilters
 */
class Price extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $value = explode(';',$value);

        $this->query->whereHas('colors', function ($q) use ($value) {
            return $q->where('color_product.price' ,'>=', $value[0])
                ->where('color_product.price' , '<=' , $value[1]);
        })->with(['colors' => function ($q) use ($value) {
            $q->where('color_product.price' ,'>=', $value[0])
                ->where('color_product.price' , '<=' , $value[1]);
        }]);
    }
}
