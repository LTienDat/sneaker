<?php

namespace App\Http\Controllers;

use App\Http\Services\PaymentService;
use App\Models\Cart;
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
        $carts = Session::get('carts');
        if(!empty($carts)){
            $keycarts = array_keys($carts);
            foreach( $keycarts as $key=>$value ) {
                $keycart[] = $value;
            }
        }else{
            $keycart = [];
        }
        return view('pay', [
            'title'=> 'Danh sách giỏ hàng',
            'products' => $products,
            'carts' => $carts,
            'keycarts' => $keycart
        ]);
    }

    public function order(Request $request){
  
        $this->payments->pay($request);

        return redirect()->back();
   }
   public function VNPay(Request $request){
        $total = $request->input('vnp');
        $maxId = Cart::max('id');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/pay";
        $vnp_TmnCode = "LSX7MU8C";//Mã website tại VNPAY 
        $vnp_HashSecret = "V8AF1H09UUY5FTW4X0DVB73M44MHI4JL"; //Chuỗi bí mật
        
        $vnp_TxnRef = $maxId + 1; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
        $vnp_OrderInfo = "Thanh toán đơn hàng đặt tại Sneaker Store";
        $vnp_OrderType = "billPayment";
        $vnp_Amount = ($total + 30000) * 100;
        $vnp_Locale = "VNĐ";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef

        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
    
   }

}