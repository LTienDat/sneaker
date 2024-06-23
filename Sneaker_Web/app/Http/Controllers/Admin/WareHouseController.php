<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Product\ProductAttributeService;
use App\Http\Services\product\ProductService;
use App\Http\Services\Product\WareHouseService;
use App\Models\WareHouse;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    protected $warehouseService;
    protected $product;
    public function __construct(WareHouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }
    public function index()
    {
        $warehouses = $this->warehouseService->getAll();
        return view("admin.warehouse.list", [
            "title" => 'Kho hàng',
            "warehouses" => $warehouses

        ]);
    }
    public function create()
    {
        $product = $this->warehouseService->getProduct();
        $supplier = $this->warehouseService->getSupplier();
        return view("admin.warehouse.add", [
            "title" => "Thêm Sản phẩm vào kho hàng",
            'products' => $product,
            'suppliers' => $supplier
        ]);
    }

    public function store(Request $request)
    {


        $this->warehouseService->insertOrUpdate($request);


        return redirect()->back();
    }

    public function show($id)
    {
        $warehouses = $this->warehouseService->getWarehouse($id);
        return view("admin.warehouse.edit", [
            'title' => 'Chỉnh sửa kho hàng',
            'warehouses' => $warehouses

        ]);
    }

    public function update(WareHouse $wareHouse, CreateFormRequest $request)
    {
        dd(1);
        $this->warehouseService->edit($wareHouse, $request);
        return redirect('admin/warehouse/list');
    }

    public function destroy(Request $request)
    {
        $result = $this->warehouseService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }
        return response()->json([
            'error' => true,
            'message' => 'Xóa thành sản phẩm thất bại'
        ]);
    }
}