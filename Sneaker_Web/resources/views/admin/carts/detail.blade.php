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
                <th class="column-3">Số lượng</th>
                <th class="column-4">Giá</th>
                <th class="column-6"></th>
            </tr>

            @foreach ($carts as $cart)
            <tr class="table_row">
                <td class="column-1">{{$cart->product->name}}</td>
                <td class="column-2">
                    <div class="how-itemcart1">
                        <img src="{{$cart->product->file}}" width="50px" alt="IMG">
                    </div>
                </td>
                <td class="column-3">{{$cart->quantity}}</td>
                <td class="column-4">{{number_format($cart->price)}}</td>
                <td class="p-r-15"><a href="/carts/delete/{{$cart->quantity}}">Xoa</a></td>
            </tr>
            <?php $total += $cart->price * $cart->quantity?>
            @endforeach
            <tr>
                <td colspan="4" class="text-right">Tổng tiền</td>
                <td>{{number_format($total)}}</td>
            </tr>
        </tbody>
    </table>
    @endif

</div>



@endsection