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
                    <div class="wrap-table-shopping-cart">
                        <?php $total = 0?>

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
                                <?php $total += $product->price * $carts[$product->id]?>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center">
                            <h2>Giỏ hàng trống</h2>
                        </div>
                        @endif
                    </div>
                    <!-- cap nhat gio hang -->
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">

                        <input type="" value="Cập nhật giỏ hàng" formaction="/update-cart"
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">

                            <a href="/pay" value="Thanh toán"
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">Thanh toán</a>
                        </div>
                        @csrf
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
