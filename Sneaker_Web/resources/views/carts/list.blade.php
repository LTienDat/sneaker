@extends('main')

@section('content')
<form class="bg0 p-t-75 p-b-85" action="/carts" method="post">
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="/index" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Giỏ hàng
            </span>
        </div>

        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <!-- san pham -->
<<<<<<< HEAD
                    <div class="wrap-table-shopping-cart">
                        <?php $total = 0?>
=======
                    <?php $total = 0?>
                    <div class="wrap-table-shopping-cart">
>>>>>>> 47c79db86c2c90c37ca175cba998ae407ac91fef
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
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" min="1"
                                                name="num_product[{{$product->id}}]" value="{{$carts[$product->id]}}">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5 subtotal"
                                        data-price="{{$product->price * $carts[$product->id]}}">
                                        {{number_format($product->price * $carts[$product->id])}}</td>
                                    <td class="p-r-15"><a href="/carts/delete/{{$product->id}}">
                                            Xoa
                                        </a></td>
                                </tr>
<<<<<<< HEAD
                                <?php $total += $product->price * $carts[$product->id]?>
=======
>>>>>>> 47c79db86c2c90c37ca175cba998ae407ac91fef
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center">
                            <h2>Giỏ hàng trống</h2>
<<<<<<< HEAD
=======
                        </div>
                        @endif
                    </div>

                    <!-- cap nhat gio hang -->
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">

                        <input type="" value="Cập nhật giỏ hàng" formaction="/update-cart"
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                        @csrf
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                <!-- {{number_format($total)}} -->
                            </span>
>>>>>>> 47c79db86c2c90c37ca175cba998ae407ac91fef
                        </div>
                        @endif
                    </div>

<<<<<<< HEAD
                    <!-- cap nhat gio hang -->
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">

                        <input type="" value="Cập nhật giỏ hàng" formaction="/update-cart"
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">

                            <a href="/pay" value="Thanh toán"
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Thanh toán</a>
                        </div>
                        @csrf
                    
=======
                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-100 p-r-18 p-r-0-sm w-full-ssm">
                            <div class="p-t-15">
                                <span class="stext-112 cl8">
                                    Thông tin khách hàng
                                </span>

                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name"
                                        placeholder="Tên khách hàng" required>
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone"
                                        placeholder="Số điện thoại" required>
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="email"
                                        placeholder="Email" required>
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address"
                                        placeholder="Địa chỉ nhận hàng" required>
                                </div>

                                <div class="bor8 bg0 m-b-22">
                                    <textarea class="stext-111 cl8 plh3 size-111 p-lr-15" name="note"
                                        placeholder="Ghi chú"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                <!-- {{number_format($total)}} -->
                            </span>
                        </div>
                    </div>

                    <button type="submit" 
                        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Đặt hàng
                    </button>
>>>>>>> 47c79db86c2c90c37ca175cba998ae407ac91fef
                </div>
            </div>
        </div>
    </div>
</form>
@endsection