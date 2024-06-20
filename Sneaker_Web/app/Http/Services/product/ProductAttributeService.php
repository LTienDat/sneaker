<?php 
namespace App\Http\Services\Product;
use App\Models\Product;
use App\Models\Product_attributes;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\Session;

class ProductAttributeService{
    public function getAll(){
        return ProductAttribute::with('product')->get();
    }

    public function insertOrUpdate($request)
    {
        try {
            // Tìm hoặc tạo mới bản ghi dựa trên  và 'size'
        
             $productAttribute = ProductAttribute::updateOrCreate(
                ['product_id' => $request->input('product_id'),
                 'size' =>  $request->input('size')
                 , 'color'=>$request->input('color')],
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