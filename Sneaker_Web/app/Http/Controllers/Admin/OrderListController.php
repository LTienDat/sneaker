<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function show(Customer $customer, Cart $cart){
        return view('admin.carts.detail',[
            'title'=> 'Chi tiết đơn hàng',
            'customers' => $customer,
            'carts' => $customer->carts()->with('product')->get(),
            'carts_customer' => $cart->customer()->with('customer')->get()
        ]);
    }
}
