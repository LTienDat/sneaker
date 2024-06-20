<?php 
 namespace App\Http\Services;
 use App\Helpers\Helper;
 use App\Jobs\SendMail;
 use App\Models\Cart;
 use App\Models\Customer;
 use App\Models\Product;
 use Illuminate\Support\Arr;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Session;

 class CartService{
public function create( $request)
{
    if (Auth::check()) {
        $num = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');
        $size = (int)$request->input('size');
        $color = $request->input('color');

        if ($num <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác');
            return false;
        }

        // Lấy giỏ hàng từ session
        $carts = Session::get('carts', []);
        $exists = false;
        foreach ($carts as $key => $item) {
            if ($key == $product_id && $item['size'] == $size && $item['color'] == $color) {
                // Nếu sản phẩm đã tồn tại với cùng $product_id, $size, và $color, cập nhật số lượng
                $carts[$key]['num_product'] += $num;
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            // Nếu sản phẩm chưa tồn tại với $product_id, $size, và $color, thêm mới vào giỏ hàng
            $carts[$product_id] = [
                'num_product' => $num,
                'color' => $color,
                'size' => $size,
            ];
        }

        // Lưu lại giỏ hàng vào session
        Session::put('carts', $carts);

        return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng'], 200);
    } else {
        return response()->json(['message' => 'Bạn cần phải đăng nhập để thêm sản phẩm vào giỏ hàng'], 401);
    }
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
        // Lấy ra các ID sản phẩm từ mảng $carts
        $productIds = array_keys($carts);
    
        // Truy vấn các sản phẩm từ cơ sở dữ liệu dựa trên các ID đã lấy
        $products = Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)
            ->whereIn('id', $productIds)
            ->get();
    
        // Chuẩn bị mảng dữ liệu để chèn vào cơ sở dữ liệu
        $data = [];
    
        foreach ($products as $product) {
            // Kiểm tra xem ID sản phẩm hiện tại có tồn tại trong $carts không
            if (isset($carts[$product->id])) {
                $data[] = [
                    'customer_id' => $customer_id,
                    'product_id' => $product->id,
                    'quantity' => $carts[$product->id]['num_product'], // Lấy số lượng từ $carts
                    'size' => isset($carts[$product->id]['size']) ? $carts[$product->id]['size'] : null,
                    'color' => isset($carts[$product->id]['color']) ? $carts[$product->id]['color'] : null,
                    'price' => Helper::price($product->price, $product->price_sale),
                ];
            }
        }
    
        // Chèn dữ liệu vào cơ sở dữ liệu sử dụng model Cart
        return Cart::insert($data);
    }
    
 }