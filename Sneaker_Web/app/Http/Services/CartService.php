<?php 
 namespace App\Http\Services;

 class CartService{
    public function create($request){
        $num = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if($num<= 0 || $product_id <= 0){
            Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('cart');

    }
 }