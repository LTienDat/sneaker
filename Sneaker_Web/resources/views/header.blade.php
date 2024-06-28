<header>
    @php
    $menusHtml = \App\Helpers\Helper::menus($menus, $parent_id = 0);
    @endphp
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop">
            <!-- Topbar -->
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="/index" class="logo">
                    <Span>Sneaker Store</Span>
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="/index">Trang chủ</a>
                        </li>
                        {!!$menusHtml!!}

                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart "
                        id="showCart"
                        data-notify="{{!is_null(Session::get('carts')) ? count(Session::get('carts')) : 0}}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    
                                        <div class="cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti profile">
                        <div class="box">
                            <img src="{{asset('/Template/images/users.png')}}" alt="" onclick="toggleMenu()">
                        </div>
                        <div class="sub-user-wrap" id="subMenu">
                            <div class="sub-user">
                                <div class="user-info">
                                    <img src="{{asset('/Template/images/user.JFIF')}}" alt="">
                                    <h3>{{!empty($users)? $users->name : ""}}</h3>
                                </div>
                                <hr>
                                <a href="#" class="sub-user-link">
                                    <img src="{{asset('/Template/images/user.JFIF')}}" alt="">
                                    <p>Chinh sua</p>
                                    <span>></span>
                                </a>
                                <a href="#" class="sub-user-link">
                                    <img src="{{asset('/Template/images/user.JFIF')}}" alt="">
                                    <p>Chinh sua</p>
                                    <span>></span>
                                </a>
                                <a href="#" class="sub-user-link">
                                    <img src="{{asset('/Template/images/user.JFIF')}}" alt="">
                                    <p>Chinh sua</p>
                                    <span>></span>
                                </a>
                                <a href="#" class="sub-user-link">
                                    <img src="{{asset('/Template/images/user.JFIF')}}" alt="">
                                    <form action="{{!empty($users) ? route('logout') : route('login')}}" method="{{!empty($users) ? "post" : "get"}}">
                                        @csrf
                                        <button type="submit"><p>{{!empty($users) ? "Đăng xuất" : "Đăng nhập"}}</p></button>
                                    </form>
                                    <span>></span>
                                </a>
                                
                            </div>
                        </div>                         
                        
                    </div>
                    



                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                data-notify="{{!is_null(Session::get('carts')) ? count(Session::get('carts')) : 0}}">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>



        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="main-menu-m">
            {!!$menusHtml!!}
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="/Template/images/icons/icon-close2.png" alt="CLOSE">
            </button>
            <?php 
            $router = null;
                if($request->fullUrl() == "http://127.0.0.1:8000/index"){
                    $router = route('searchHome');
                }elseif($request->segment(1) == "danh-muc"){
                    foreach($menus as $menu){

                        $router = route("UserSearchProduct{{$menu->id}}-{{Str::slug($menu->id,'-')}}");
                    }
                }
            ?>

            <form action="{{ $router!= Null ? $router :  ""}}  " method="post" class="wrap-search-header flex-w p-l-15">
                @csrf
                <button type="submit" class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Tìm kiếm">
            </form>
        </div>
    </div>
</header>