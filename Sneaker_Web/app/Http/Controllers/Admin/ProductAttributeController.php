<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductAttributeService;
use App\Http\Services\product\ProductService;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    protected $productAttribute;
    protected $product;
    public function __construct(ProductAttributeService $productAttribute){
        $this->productAttribute = $productAttribute;
    }
    public function show(){
        $product = $this->productAttribute->getAll();

        return view("admin.product.attribute.attribute",[
            "title" => 'Bảng size và màu',
            "products"=> $product 
        
        ]);
    }
    public function create(){
        $product = $this->productAttribute->getProduct();
        return view("admin.product.attribute.addAttribute",[
            "title"=> "Thêm size và màu",
            'products'=> $product
        ]);
    }

    public function store(Request $request)
    {

         $this->productAttribute->insertOrUpdate($request);


        return redirect()->back();
    }
}
