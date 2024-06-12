<?php 
namespace App\Http\Services\Menu;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Menu;

class MenuService {

    public function getParent(){
        return Menu::where('parent_id',0)->get();
    
    }
    public function getAll(){
        return Menu::orderByDesc('id')->paginate(10);
    }
    public function create($request) {
    try {
            Menu::create([
                'name' => (string)$request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string)$request->input('description'),
                'content' =>(string) $request->input('content'),
                'active' =>(int) $request->input('active'),
                'slug' => Str::slug($request->input('name')),
            ]);
            

            Session::flash('success', 'Tạo danh mục thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Đã xảy ra lỗi: ' . $e->getMessage()); // Thêm tin nhắn "Đã xảy ra lỗi: "
            return false;
        }
        return true;
    }

    public function destroy($request){
        $id = (int) $request->input('id');
        $menu = Menu::Where('id', $id)->first();
        if($menu){
            return Menu::Where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;   
    }

    public function update($menu ,$request){
        if($request->input('parent_id') != $menu->id){
            $menu ->fill($request->input());
            $menu -> save();
     
            Session::flash('success','Cập nhật thành công danh mục');
            return true;
        }
        else{
            Session::flash('error','Cập nhật không thành công do danh mục '.$menu->name.' không thể làm con của nó');
        }
    }


}
?>
