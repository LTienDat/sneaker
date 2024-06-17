@extends('main')

@section('content')
<form class="bg0 p-t-75 p-b-85" method="post">
    @include('admin.alert')
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/index" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
                Thanh toán
            </span>
        </div>

        <div class="row">   
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <!-- san pham -->
                    <?php $total = 0?>
                    <div class="wrap-table-shopping-cart">
                        @if(count($products) != 0)
                        <table class="table-shopping-cart">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Total</th>
                                    <th class="column-6"></th>
                                </tr>

                                @foreach ($products as $product)
                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{$product->file}}" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">{{$product->name}}</td>
                                    <td class="column-3">{{number_format($product->price)}}</td>
                                    <td class="column-4">
                                        <div class="text-center">
                                        {{$carts[$product->id]}}
                                        </div>
                                    </td>
                                    <td class="column-5 subtotal"
                                        data-price="{{$product->price * $carts[$product->id]}}">
                                        {{number_format($product->price * $carts[$product->id])}}</td>
                                    <td class="p-r-15"><a href="/carts/delete/{{$product->id}}">
                                            Xoa
                                        </a></td>
                                </tr>
                               <?php  $total += $product->price * $carts[$product->id]?>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>

                    <!-- cap nhat gio hang -->
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm pay">
                        <!-- <input type="" value="Cập nhật giỏ hàng" formaction="/update-cart"
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                        @csrf -->
                            
                        <input type="text" name="name" class="form-control m-t-15" placeholder="Họ và tên">
                        <div class="email-phone">
                            <input type="email" name="email" class="form-control m-t-15" placeholder="email">
                            <input type="phone" name="phone" class="form-control m-t-15 m-l-30 " placeholder="Số điện thoại">
                        </div>
                        <input type="text" name="address" class="form-control m-t-15" placeholder="Địa chỉ">
                        <textarea name="note" id="" class="form-control m-t-15" placeholder="Ghi chú"></textarea>

                        <div class="ship m-t-15">Phí ship: 30,000</div>
                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Tổng tiền:
                                </span>
                            </div>
    
                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2 cart-total">
                                    {{number_format($total + 30000)}}
                                </span>
                            </div>
                            <button type="submit" value="Đặt hàng" formaction=""
                                class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10"> Đặt hàng</button>
                            @csrf
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection