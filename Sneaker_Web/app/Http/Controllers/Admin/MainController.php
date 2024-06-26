<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Statistacal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{

    public function index()
    {
        // $latestOrder = Cart::latest()->first();
        // if ($latestOrder && !Session::has("order")) { 
        //     echo "<script>
        //         alert('có đơn hàng mới, mã đơn hàng là {$latestOrder->id}')
        //     </script>";
        // }
        // Session::put("order", true);
        return view("admin.home",
        ["title"=> "Trang quản trị admin"]);
}

    public function filterByDate(Request $request){
        $data = $request->all();
        $from_date = $data["from_date"];
        $to_date = $data["to_date"];
        
        $statistics = Statistacal::whereBetween('order_date', [$from_date, $to_date])
            ->orderBy('order_date', 'ASC')
            ->get();
    
        $chart_data = [];
        
        foreach ($statistics as $value) {
            $chart_data[] = array(
                'period' => $value->order_date,
                'order' => $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        }
    
        return response()->json($chart_data);
    }
    
    
}
