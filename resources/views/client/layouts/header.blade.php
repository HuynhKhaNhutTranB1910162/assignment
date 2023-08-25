<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Free shipping, 30-day return or refund guarantee.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            @if(! Auth::check())
                                <a href="{{ route('login') }}">Đăng nhập</a>
                            @else
                                <a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    Đăng xuất
                                </a>
                            @endif
                            <a href="#">FAQs</a>
                        </div>
                        <div class="header__top__hover">
                            <span>Usd <i class="arrow_carrot-down"></i></span>
                            <ul class="dropdown">
                                <li>USD</li>
                                <li>EUR</li>
                                <li>USD</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href=" {{ route('client') }} "><img src="{{asset('client/img/logo.png')}}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{ request()->routeIs('client') ? 'active' : '' }}"><a href=" {{ route('client') }} ">Trang chủ</a></li>
                        <li class="{{ request()->routeIs('client-service') ? 'active' : '' }}"><a href=" {{ route('client-service') }} ">Dịch vụ</a></li>
                        <li class="{{ request()->routeIs('shop') ? 'active' : '' }}"><a href=" {{ route('shop') }} ">Shop</a>
                            <ul class="dropdown">
                                @foreach($categories as $category)
                                    <li><a href="./about.html">{{$category->name}}</a></li>
                                @endforeach

                            </ul>
                        </li>
                        <li><a href="./shop.html">Đặt lịch</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="{{asset('client/img/icon/search.png')}}" alt=""></a>
                    <a href="#"><img src="{{asset('client/img/icon/heart.png')}}" alt=""></a>
                    <a href="{{ route('cart-product') }}"><img src="{{asset('client/img/icon/cart.png')}}" alt=""> <span>@if(Auth::check()) {{!is_null(\App\Models\Cart::where('user_id', Auth::user()->id)->get())
                                                                                                                                ? count(\App\Models\Cart::where('user_id', Auth::user()->id)->get()) : 0 }}@endif</span></a>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
