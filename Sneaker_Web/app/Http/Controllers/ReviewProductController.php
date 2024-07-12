<?php

namespace App\Http\Controllers;

use App\Models\Review_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReviewProductController extends Controller
{
    public function store(Request $request){
        $validateData = $request->validate(['review' => 'required', 'star' => 'required', 'user_id' => '']);
        $validateData['user_id'] =  Auth::user()->id;
        Review_Product::create($validateData);
        Session::flash('success','Thêm sản phẩm thành công');
        return redirect()->back();
    }
}
