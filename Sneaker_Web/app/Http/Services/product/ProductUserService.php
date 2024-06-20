<?php 

namespace App\Http\Services\Product;
use App\Models\Product;
use App\Models\ProductAttribute;

class ProductUserService 
{
    const LIMIT = 16;
    public function get($page = null){
        return Product::select('id', 'name', 'price', 'price_sale', 'file')
        ->orderByDesc('id')
        ->when($page != null, function ($query) use ($page){
           $query->offset($page * self::LIMIT);
        })
        ->limit(self::LIMIT)
        ->get();
    }

    public function show($id){
        $product =  Product::where('id' ,$id)->where('active',1)
        ->with('menu')->firstOrFail();
        return (object)$product;
    }
    public function showAttribute($id){
        $product =  ProductAttribute::where('product_id', $id)->get(); 
        return (object)$product;
    }

}
