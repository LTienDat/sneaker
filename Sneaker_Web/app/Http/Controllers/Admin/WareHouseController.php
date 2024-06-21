<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductAttributeService;
use App\Http\Services\product\ProductService;
use App\Http\Services\Product\WareHouseService;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    protected $productAttribute;
    protected $product;
    public function __construct(WareHouseService $productAttribute){
        $this->productAttribute = $productAttribute;
    }
    public function show(){
        $warehouses = $this->productAttribute->getAll();

        return view("admin.product.attribute.attribute",[
            "title" => 'Bảng size và màu',
            "warehouses"=> $warehouses 
        
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
