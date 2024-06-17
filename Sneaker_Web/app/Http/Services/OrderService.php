<?php 
namespace App\Http\Services;
use App\Models\Customer;

class OrderService{
    public function getCustomer(){
        return Customer::orderByDesc("id")->paginate(10);
    }

}