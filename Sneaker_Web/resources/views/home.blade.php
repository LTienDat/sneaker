@extends('main')

@section('content')
<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1" style="background-image: url(/Template/images/adidas_baner.jpg);">
					<!-- <div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Women Collection 2018
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									NEW SEASON
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div> -->
				</div>

				<div class="item-slick1" style="background-image: url(/Template/images/nike_baner.jpg);">
					<!-- <div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Men New-Season
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									Jackets & Coats
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
								<a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div> -->
				</div>

				<div class="item-slick1" style="background-image: url(/Template/images/mlb_baner.png);">
					<!-- <div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Men Collection 2018
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									New arrivals
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
								<a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</section>

	<!-- Banner -->
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				@foreach ($menus as $menu)
				
				<div class="col-md-6 col-xl-3 p-b-30 m-lr-auto">
					
					<div class="block1 wrap-pic-w">
						
						<img src="{{$menu->file}}" alt="IMG-BANNER"
						>

						<a href="/danh-muc/{{$menu->id}}-{{Str::slug($menu->id,'-')}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-4 ">
									{{$menu->name}}
								</span>

								<span class="block1-info stext-102 trans-04">
									Spring 2018
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Shop Now
								</div>
							</div>
						</a>
					</div>
				</div>
				@endforeach

			</div>
		</div>
	</div>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">				
					Tổng quan về sản phẩm
				</h3>
			</div>
			<div class="flex-w flex-sb-m p-d-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					<button class="stext-106 c16 hav1 bar3 trans-04 m-r-32 m-tb-5 howactive1" data-filter="*">
						Tất cả sản phẩm
					</button>
				</div>
			</div>

			<div id="loadProduct">
				@include('products.list')
			</div>

	<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45" id="button-loadMore">
				<input type="hidden" value="" id="page">
				<a  onclick="loadMore()" class=" flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					<span>Tải Trang</span>
				</a>
			</div>
		</div>
	</section>

@endsection