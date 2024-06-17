<?php 
 namespace App\Http\Services;
 use App\Helpers\Helper;
 use App\Jobs\SendMail;
 use App\Models\Cart;
 use App\Models\Customer;
 use App\Models\Product;
 use Illuminate\Support\Arr;
 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Session;

 class CartService{
    public function create($request){
        $num = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if($num<= 0 || $product_id <= 0){
            Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('carts');
        if(is_null($carts)){
            Session::put('carts',[
                $product_id => $num
            ]);

            return true;
        }
        $exists = Arr::exists($carts, $product_id);
        if($exists){
            $carts[$product_id] += $num;
            Session::put('carts', $carts);
            return true;
        }
        $carts[$product_id] = $num;
        Session::put('carts',$carts);
        return true;
    }

    public function getProduct(){
        $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }
        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)->whereIn('id', $productId)->get();
    }


    public function update($request){
        Session::put('carts', $request->input('num_product', ));
        return true;
    }

    public function remove($id){
        $carts = Session::get('carts');
        unset($carts[$id]);
        Session::put('carts', $carts);
        return true;
    }

    public function pay($request){
        try{

            DB::beginTransaction();
               $carts = Session::get('carts');
            if(is_null($carts)){
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
            
            Session::flash("success","Đặt hàng thành công");
            Session::forget('carts');
        }catch(\Exception $e){
            DB::rollBack();
            Session::flash("eror","Đặt hàng không thành công, vui lòng thử lại sau");
            return false;
        }
        return true;
    }

    protected function infoProduct($carts, $customer_id){
        $productId = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)->whereIn('id', $productId)->get();

        $data = [];
        foreach($products as $product){
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'quantity'=> $carts[$product->id],
                'price' => Helper::price($product->price, $product->price_sale),
            ];
        }
        return Cart::insert($data);

    }
 }