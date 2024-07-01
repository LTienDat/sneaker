@extends('main')

@section('content')

<div class="card card-primary card-outline profile-order m-t-150 w-60%">
    <div class="card-body box-profile">
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Size</th>
                <th>Màu</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Phương thức thanh toán</th>
                <th>Ngày giờ đặt hàng</th>
                <th>Trạng thái đơn hàng</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = 0;?>
            @foreach ( $carts as $key => $cart )
            <tr>
                <?php $index++?>
                <td>{{$index}}</td>
                <td>{{$cart->product->name}}</td>
                <td><div class="how-itemcart1">
                        <img src="{{$cart->product->file}}" width="50px" alt="IMG">
                    </div></td>
                <td>{{$cart->size}}</td>
                <th>{{$cart->color}}</a></th>
                <td>{{$cart->quantity}}</td>
                <td>{{$cart->price}}</td>
                <td>{{$cart->payment == 0 ? "Thanh toán khi nhận hàng" : "Thanh toán online"}}</td>
                <td>{{$cart->created_at}}</td>
                <td>{{$cart->status}}</td>
           
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

</div>
@endsection