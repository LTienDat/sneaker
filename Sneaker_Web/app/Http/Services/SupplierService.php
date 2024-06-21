<?php 
namespace App\Http\Services;
use App\Models\Supplier;
use Illuminate\Support\Facades\Session;

class SupplierService{
    public function show(){
        return Supplier::all();
    }

    public function insert($request){
        try{
            $request->except('_token');
            Supplier::create($request->all());
    
            Session::flash('success','Thêm sản phẩm thành công');
        }catch(\Exception $e){
            Session::flash('error','Thêm sản phẩm thât bại');
            \Log::info($e->getMessage());
            return false;
        }
        return true;
    
       
    }

    public function get($id){
        return Supplier::find($id);
    }

    public function edit($supplier,$request){
        try{
            $supplier -> fill($request->input());
            $supplier -> save();
            Session::flash('success','Cập nhật thành công');
        }catch(\Exception $e){
            Session::flash('error','Cập nhật thất bại');
            \Log::info($e->getMessage());
            return false;
        }
        return true;   
    }
     public function delete($request){
        $supplier = Supplier::where('id', $request->input('id'))->first();
        if($supplier){
            $supplier->delete();
            return true;
        }
        return false;
     }
}
?>