<?php

namespace App\Http\Services;

use App\Events\OrderCreated;
use App\Helpers\Helper;
use App\Jobs\SendMail;
use App\Jobs\SendMailAdmin;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\WareHouse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentService
{
    public function getProduct()
    {
        $keyProductId = [];
        $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }
        $productIds = array_keys($carts);
        foreach( $productIds as $productId ) {
            $keyProductId[] = intval(subStr(strval($productId), 0, -2));
            
        }

        return Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)->whereIn('id', $keyProductId)->get();
    }

    public function pay($request)
    {
        try {
            
            DB::beginTransaction();
            $carts = Session::get('carts');
            
            if (is_null($carts)) {
                return false;
            }
            $customer = Customer::create([
                "name" => $request->input("name"),
                "email" => $request->input("email"),
                "phone" => $request->input("phone"),
                "address" => $request->input("address"),
                "note" => $request->input("note"),
            ]);
            
            
            
            $this->infoProduct($carts, $customer->id);
  
            DB::commit();
            Session::flash("success", "Đặt hàng thành công");
            
            SendMail::dispatch($request->input("email"))->delay(now()->addSeconds(5));
            SendMailAdmin::dispatch('datletien.18012002@gmail.com')->delay(now()->addSeconds(5));
            Session::forget('carts');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Đặt hàng không thành công: ' . $e->getMessage());
            Session::flash("error", "Đặt hàng không thành công, vui lòng thử lại sau");
            return false;
        }
        return true;
    }

    protected function infoProduct($carts, $customer_id)
    {
        // Lấy ra các ID sản phẩm từ mảng $carts
        $keyProductId = [];
        $productIds = array_keys($carts);
        // Truy vấn các sản phẩm từ cơ sở dữ liệu dựa trên các ID đã lấy
        foreach($productIds as $productId) {
            $keyProductId[] = intval(subStr(strval($productId), 0, -2));
        }
        
        $products = Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)
            ->whereIn('id', $keyProductId)
            ->get();

        // Chuẩn bị mảng dữ liệu để chèn vào cơ sở dữ liệu
        $data = [];
        foreach ($products as $product) {
            foreach($productIds as $productId){
                
            // Kiểm tra xem ID sản phẩm hiện tại có tồn tại trong $carts không
            if (isset($carts[$productId]) && $product->id == intval(subStr(strval($productId), 0, -2))) {
                $data[] = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'quantity' => $carts[$productId]['num_product'], // Lấy số lượng từ $carts
                    'size' => isset($carts[$productId]['size']) ? $carts[$productId]['size'] : null,
                    'color' => isset($carts[$productId]['color']) ? $carts[$productId]['color'] : null,
                    'price' => Helper::price($product->price, $product->price_sale),
                    'created_at' => Carbon::now()
                ];
            }
            $warehouses = Warehouse::where('product_id', $product->id)->where('size', $carts[$productId]['size'])->first();   
            $warehouses->quantity -= $carts[$productId]['num_product'];
            $warehouses->save();
        }
        }


        // Truy xuất tất cả các bản ghi Warehouse tương ứng với danh sách sản phẩm
        // Chèn dữ liệu vào cơ sở dữ liệu sử dụng model Cart
        return Cart::insert($data); 
        
    }
}