<?php

namespace App\Http\Controllers;

use App\Http\Services\Product\ProductUserService;
use Illuminate\Http\Request;
use App\Http\Services\product\ProductService;
class DetailProductController extends Controller
{

    protected $productService;
    public function __construct(ProductUserService $productService){
        $this->productService = $productService;
    }
    public function index($id = '', $slug = ''){
        $product = $this->productService->show($id);

        return view('products.detail',[
            'title'=> $product->name,
            'products' => $product
        ]);
        
    }   
}
