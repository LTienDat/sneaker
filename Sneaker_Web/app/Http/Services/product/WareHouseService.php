<?php 
namespace App\Http\Services\Product;
use App\Models\Product;
use App\Models\Product_attributes;
use App\Models\ProductAttribute;
use App\Models\WareHouse;
use Illuminate\Support\Facades\Session;

class WareHouseService{
    public function getAll(){
        return WareHouse::with('product')->get();
    }

    public function insertOrUpdate($request)
    {
        try {
            // Tìm hoặc tạo mới bản ghi dựa trên  và 'size'
        
             $productAttribute = WareHouse::updateOrCreate(
                ['product_id' => $request->input('product_id'),
                 'size' =>  $request->input('size')
                 , 'color'=>$request->input('color'),
                'import_price' => $request->input('import_price')],
                ['quantity' => \DB::raw('quantity + ' .  $request->input('quantity'))]
            );
        
            if ($productAttribute->wasRecentlyCreated) {
                Session::flash('success', 'Thêm thành công');
            } else {
                Session::flash('success', 'Cập nhật thành công');
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Thêm/Cập nhật thất bại');
            \Log::error($e->getMessage());
            return false;
        }
    }

    public function getProduct(){
        return Product::get();
    }
}
?>