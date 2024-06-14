<?php 
namespace App\Http\View\Composers;

use App\Models\Menu;
use App\Models\Product;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
class CartComposer{

    protected $users;
    public function __construct()
    {

    }
    public function compose(View $view)
    {
        $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }
        $productId = array_keys($carts);
        $product = Product::select('id', 'name', 'price', 'price_sale', 'file')
            ->where('active', 1)->whereIn('id', $productId)->get();
        $view->with('products', $product);
    }
}