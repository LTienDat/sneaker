<?php 

namespace App\Http\Services\Product;
use App\Models\Product;

class ProductUserService 
{
    const LIMIT = 16;
    public function get(){
    return Product::select('id', 'name', 'price', 'price_sale', 'file')
        ->orderByDesc('id')
        ->limit(self::LIMIT)
        ->get();
}

}
