<?php

namespace App\Http\Controllers;

use App\Http\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class paymentsController extends Controller
{
    protected $payments;
    public function __construct(PaymentService $payments){
        $this->payments = $payments;
    }
    public function pay(){
        $products = $this->payments->getProduct();
        return view('pay', [
            'title'=> 'Danh sách giỏ hàng',
            'products' => $products,
            'carts' => Session::get('carts')
        ]);
    }

    public function order(Request $request){
        
        $this->payments->pay($request);

        return redirect()->back();
   }

}
