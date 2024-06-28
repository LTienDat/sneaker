<?php

namespace App\Http\Controllers;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductUserService;

class UserMainController extends Controller
{

    protected $menuService;
    protected $product;
    public function __construct(MenuService $menuService, ProductUserService $product){
        $this->menuService = $menuService;
        $this->product = $product;
    }
    public function index(Request $request)
    {
        $a = auth()->user();

        // Session::put('insex=',$request->fullUrl());
        return view("home",[
            'title'=> 'Sneaker Store',
            'menus' => $this->menuService->show(),
            'products'=> $this->product->get(),
            'request' => $request
        ]);

    }

    
    public function search(Request $request){
        $products = $this->product->searchProduct($request);
        return view("home", [
            'title'=>'Sneaker Store',
            'menus' => $this->menuService->show(),
            'products'=>$products,
            'request' => $request
        ]);
    }
    
    public function loadProduct(Request $request){
        $page = $request->input('page',0);
        $result = $this->product->get($page);
        if(count($result) != 0 ){
            $html = view('products.list', ['products' => $result])->render();

            return response()->json([
                'html' => $html
            ]);
        }
        return response()->json([
            'html' => ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}