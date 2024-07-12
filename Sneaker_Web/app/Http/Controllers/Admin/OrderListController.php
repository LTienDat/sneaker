<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Services\OrderService;
class OrderListController extends Controller
{
    protected $orderservice;

    public function __construct(OrderService $orderservice){
        $this->orderservice = $orderservice;
    }
    public function index(){
        return view("admin.carts.customer",[
            'title' => 'Danh sách đơn đặt hàng',
            'customers'=> $this->orderservice->getCustomer(),
        ]);
    }
    
    public function search(Request $request){
        $customers = $this->orderservice->searchOrder($request);
        return view("admin.carts.customer", [
            'title'=>'Danh sách đơn đặt hàng',
            'customers'=>$customers
        ]);
    }


    public function show(Customer $customer, Cart $cart){
        // $a = $customer->carts()->with('product')->get();
        // dd($a);
        return view('admin.carts.detail',[
            'title'=> 'Chi tiết đơn hàng',
            'customers' => $customer,
            'carts' => $customer->carts()->with('product')->get(),
            'carts_customer' => $cart->customer()->with('customer')->get()
        ]);
    }

    public function updateStatus(Request $request, $id){
        $option = $request->input('option');
        $cart = Cart::where('id', $id) // Thay đổi điều kiện lấy dữ liệu theo đúng id của model
                ->update(['status' => $option]);
        if($cart == 1){
            echo "<script>alert('Cập nhật trạng thái đơn hàng thành công')</script>";
        }else{
            echo "<script>alert('Cập nhật trạng thái đơn hàng thất bại, vui lòng thử lại sau')</script>";
        }

        return response()->json(['success' => true, 'message' => 'Option updated successfully']);
    }
}
