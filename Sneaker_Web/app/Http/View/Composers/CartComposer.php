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
        $keyProductId = [];
        $carts = Session::get('carts');
        if(is_null($carts)){
            return [];
        }
        $productIds = array_keys($carts);
        foreach( $productIds as $productId ) {
            $keyProductId[] = intval(subStr(strval($productId), 0, -2));
            
        }
        $products = Product::select('id', 'name', 'price', 'price_sale', 'file')
        ->where('active', 1)->whereIn('id', $keyProductId)->get();
        $view->with('productCart', $products);
    }
}