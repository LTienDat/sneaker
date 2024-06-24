<?php 
namespace App\Http\Services\Product;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Session;

class ProductImageService{
    public function getAll(){
        return ProductImage::with('product')->get();
    }

    public function getProduct(){
        return Product::get();
    }

    public function insert($request){
        try{
            $request->except('_token');
            ProductImage::create($request->all());
    
            Session::flash('success','Thêm sản phẩm thành công');
        }catch(\Exception $e){
            Session::flash('error','Thêm sản phẩm thât bại');
            \Log::info($e->getMessage());
            return false;
        }
        return true;   
    }

    public function getShow($id){
        return ProductImage::with('product')->find($id);
    }

    public function edit($ProductImage,$request){
        try{
            $ProductImage -> fill($request->input());
            $ProductImage -> save();
            Session::flash('success','Cập nhật thành công');
        }catch(\Exception $e){
            Session::flash('error','Cập nhật thất bại');
            \Log::info($e->getMessage());
            return false;
        }
        return true;   
    }

    public function delete($request){
        $supplier = ProductImage::where('id', $request->input('id'))->first();
        if($supplier){
            $supplier->delete();
            return true;
        }
        return false;
     }
}
?>