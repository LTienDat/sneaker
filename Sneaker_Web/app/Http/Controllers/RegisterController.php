<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function index(){
        return view("admin.register", [
            'title' => 'Đăng ký tài khoản'
        ]);
    }

    public function create(Request $request){
        $this->userService->create($request->input());
<<<<<<< HEAD
        return redirect()->back('login');
=======
        return redirect()->back();
>>>>>>> 899e94295808cd1684998bbb2c1f0b0e841b7f75
    }
}
