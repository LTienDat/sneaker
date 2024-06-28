<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    protected $cartService;
    public function __construct(CartService $cartService){
        $this->cartService = $cartService;    
    }
    public function index(Request $request)
    {
        if (!auth()->user()) {
            echo "<script>
                var confirmLogin = confirm('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng, bạn có muốn đăng nhập không?');
                if (confirmLogin) {
                    window.location.href = 'login';
                } else {
                    window.history.back();
                }
            </script>";
        } else {
        $this->cartService->create($request);
        return redirect()->back();
        }
        
    }


    public function show(Request $request)
    {
        $products = $this->cartService->getProduct();
        $carts =Session::get('carts');
        if(!empty($carts)){
            $keycarts = array_keys($carts);
            foreach( $keycarts as $key=>$value ) {
                $keycart[] = $value;
            }
        }else{
            $keycart = [];
        }
        return view('carts.list', [
            'title'=> 'Danh sách giỏ hàng',
            'products' => $products,
            'carts' => $carts,
            'keycarts' => $keycart,
            'request' => $request

        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->cartService->update($request);

        return redirect('/carts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = 0)
    {
        $this->cartService->remove($id);
        return redirect('/carts');
    }

    public function order(Request $request){
         $this->cartService->pay($request);
        return redirect()->back();
    }
}