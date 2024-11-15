@extends('admin.main')

@section('content')

<div class="customer mt-3">
    <ul>
        <li>Tên khách hàng: <strong>{{$customers->name}}</strong></li>
        <li>Số điện thoại: <strong>{{$customers->phone}}</strong></li>
        <li>Email: <strong>{{$customers->email}}</strong></li>
        <li>Địa chỉ: <strong>{{$customers->address}}</strong></li>
        <li>Ghi chú: <strong>{{$customers->note}}</strong></li>
    </ul>
</div>

<div class="carts">
    <?php $total = 0?>
    @if(isset($customers) && !is_null($customers))
    <table class="table">
        <tbody>
            <tr class="table_head">
                <th class="column-1">Tên sản phẩm</th>
                <th class="column-2">Ảnh sản phẩm</th>
                <th class="column-2">Size</th>
                <th class="column-2">Màu</th>
                <th class="column-3">Số lượng</th>
                <th class="column-4">Giá</th>
                <th class="column-4">Phương thức thanh toán</th>
                <th class="column-4">Trạng thái đơn hàng</th>
                <th class="column-6"></th>
            </tr>

            @foreach ($carts as $cart)
            <input type="hidden" id="cartId" value="{{$cart->id}}">
            <tr class="table_row">
                <td class="column-1">{{$cart->product->name}}</td> 
                <td class="column-2">
                    <div class="how-itemcart1">
                        <img src="{{$cart->product->file}}" width="50px" alt="IMG">
                    </div>
                </td>
                <td class="column-3">{{$cart->size}}</td>
                <td class="column-3">{{$cart->color}}</td>
                <td class="column-3">{{$cart->quantity}}</td>
                <td class="column-4">{{number_format($cart->price)}}</td>
                <td class="column-4">{{$cart->payment == 0 ? "Thanh toán khi nhận hàng" : "Thanh toán VNP"}}</td>
                <td class="column-4">
                    <select class="form-control" name="status" id="statusOrder">
                        <option value="">{{$cart->status}}</option>
                        <hr>
                        <option value="chờ xác nhận">chờ xác nhận</option>
                        <option value="đã xác nhận">đã xác nhận</option>
                        <option value="đang vận chuyển">đang vận chuyển</option>
                        <option value="đã giao hàng">đã giao hàng</option>
                    </select>
                </td>
                <td class="p-r-15"><a href="/carts/delete/{{$cart->quantity}}" class="btn btn-primary btn-sm" ><i class="fas fa-trash"></i></a></td>
            </tr>
            <?php $total += $cart->price * $cart->quantity?>
            @endforeach
            <tr>
                <td colspan="8" class="text-right">Tổng tiền</td>
                <td>{{number_format($total)}}</td>
            </tr>
        </tbody>
    </table>
    @endif

</div>



@endsection