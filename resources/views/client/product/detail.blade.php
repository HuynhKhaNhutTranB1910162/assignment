@extends('client.layouts.app')

@section('content')
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ route('client') }}">Trang chủ</a>
                            <a href="{{ route('shop') }}">Sản phẩm</a>
                            <span>Chi tiết sản phẩm</span>
                        </div>
                    </div>
                </div>
                <form action="{{ route('favorite.addToFavorite', ['id' => $product->id]) }}" method="POST" id="addfavorite">
                    @csrf
                </form>
                <form action="{{ route('cart.addToCart', ['id' => $product->id]) }}" method="POST" id="addcart">
                    @csrf
                    <div class="product__details__content">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-md-3">
                                    <ul class="nav nav-tabs" role="tablist">
{{--                                        <div class="card example-1 square scrollbar-dusty-grass square thin">--}}
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabs" role="tab">
                                                <div class="product__thumb__pic set-bg" data-setbg="{{ asset('storage/' . $product->image) }}">
                                                </div>
                                            </a>
                                        </li>
                                            @foreach($product->productImages as $key => $image)
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#tabs-{{ $key }}" role="tab">
                                                        <div class="product__thumb__pic set-bg" data-setbg="{{ asset($image->image) }}">
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
{{--                                        </div>--}}
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-9">
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="tabs" role="tabpanel">
                                            <div class="product__details__pic__item">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                            </div>
                                        </div>
                                        @foreach($product->productImages as $key => $image)
                                            <div class="tab-pane" id="tabs-{{ $key }}" role="tabpanel">
                                                <div class="product__details__pic__item">
                                                    <img src="{{ asset($image->image) }}" alt="">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-8">
                                            <div class="product__details__text">
                                                <h4>{{ $product->name }}</h4>
                                                <div class="rating">
                                                    @php
                                                        $fullStars = floor($productRating); // Số sao đầy
                                                        $halfStar = $productRating - $fullStars; // Phần nửa sao
                                                        $emptyStars = 5 - $fullStars - ceil($halfStar); // Số sao rỗng
                                                    @endphp
                                                    @for ($i = 1; $i <= $fullStars; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor

                                                    @if ($halfStar > 0)
                                                        <i class="fa fa-star-half"></i>
                                                    @endif

                                                    @for ($i = 1; $i <= $emptyStars; $i++)
                                                        <i class="fa fa-star-o"></i>
                                                    @endfor
                                                    <span> {{$productRating}} ({{$productReview->count()}} reviewer)</span>
                                                </div>
                                                <h3>
                                                    @if($product->selling_price === NULL) {{CurrencyHelper::format($product->original_price)}}
                                                    @else {{CurrencyHelper::format($product->selling_price)}} <span>{{ CurrencyHelper::format($product->original_price) }}</span>
                                                    @endif
                                                </h3>
                                                <div class="product__details__btns__option">
                                                    <a href="{{ route('favorite.addToFavorite', ['id' => $product->id]) }}" onclick="event.preventDefault(); document.getElementById('addfavorite').submit();">
                                                        <i class="fa fa-heart"></i>Thêm yêu thích</a>
                                                </div>
                                                <div class="product__details__cart__option">
                                                    @if($product->stock > 0)
                                                        <div class="quantity">
                                                            <div class="pro-qty">
                                                                <span class="fa fa-angle-up dec qtybtn" onclick="let increaseWith = 1;document.getElementById('base-life').value = parseInt(document.getElementById('base-life').value)+increaseWith;"></span>
                                                                <input id="base-life" name="qty" value="1" min="1" class="form-control bg-light text-center" readonly>
                                                                <span class="fa fa-angle-down inc qtybtn" onclick="let increaseWith = 1;document.getElementById('base-life').value = parseInt(document.getElementById('base-life').value)-increaseWith;"></span>
                                                                @error('qty')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('cart.addToCart', ['id' => $product->id]) }}" class="primary-btn" onclick="event.preventDefault(); document.getElementById('addcart').submit();">Thêm giỏ hàng</a>
                                                    @else
                                                        <span style="color: #b21f2d">Sản phẩm đã hết</span>
                                                    @endif
                                                </div>
                                                <div class="product__details__last__option">
                                                    <ul>
                                                        <li><span>Số lượng còn lại:</span> {{ $product->stock }} sản phẩm</li>
                                                        <li><span>Danh mục sản phẩm:</span> {{ $product->category->name }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="product__details__text">
                    <div class="product__details__last__option">
                        <h5><span>Phương thức thanh toán ngân hàng</span></h5>
                        <img src="{{asset('client/img/shopping-cart/payment1.png')}}" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Đánh giá</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <p>{{ $product->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    @if($productReview->count()>0)
                                    <div class="scrollbar scrollbar-warning">
                                        <div class="force-overflow">
                                            @foreach($productReview as $item)
                                                <div class="product__details__tab__content">
                                                    <div class="product__details__tab__content__item">
                                                        <div class="d-flex flex-start">
                                                            <img class="rounded-circle shadow-1-strong me-3"
                                                                 src="{{ asset('storage/' . $item->user->image) }}" alt="avatar" width="40"
                                                                 height="40"/>
                                                            <div>
                                                                <h6 class="fw-bold mb-1">{{$item->user->name}}</h6>
                                                                <div class="d-flex align-items-center mb-3">
                                                                    <p class="mb-0">
                                                                        {{ $item->created_at->format('g:i A') }}
                                                                        {{$item->created_at->format('d')}} - {{$item->created_at->format('m')}} -
                                                                        {{$item->created_at->format('Y')}}
                                                                    </p>
                                                                    <div style="margin-left: 5px">
                                                                        @for ($i = 1; $i <= $item->rating; $i++)
                                                                            <i class="fa fa-star" style="color: #ffc107 "></i>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                                <p class="mb-0">
                                                                    {{$item->comment}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-0"/>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="blog__details__comment">
                <h4>Đánh giá sản phẩm</h4>
                <form action="{{ route('comment.product',['id' => $product->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="rating11 my-4">
                                <label>
                                    <input type="radio" name="rating" value="1" />
                                    <span class="fa fa-star icon"></span>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="2" />
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="3" />
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="4" />
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="5" />
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                    <span class="fa fa-star icon"></span>
                                </label>
                            </div>
                            <div style="margin-bottom: 20px"><span>Viết đánh giá: </span>
                                <textarea style="margin-top: 20px" placeholder="Comment" name="comment"></textarea>
                                @if($checkBought)
                                    <button type="submit" class="site-btn">Đánh giá</button>
                                @endif
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Sản phẩm bán chạy</h3>
                </div>
            </div>
            <div class="row">
                @foreach($productRelated as $related)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">

                            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $related->product->image) }}">
                                <ul class="product__hover">
                                    <li><a href="#"><img src="{{asset('client/img/icon/heart.png')}}" alt=""></a></li>
                                    <li><a href="{{ route('product-detail', ['id' => $related->product->id]) }}"><img src="{{asset('client/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{ $related->product->name }}</h6>
                                <h5> {{($related->product->selling_price === NULL) ? CurrencyHelper::format($related->product->selling_price) : CurrencyHelper::format($related->product->original_price) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('style')
    <style>
        .rating11 {
            display: inline-block;
            position: relative;
            height: 50px;
            line-height: 50px;
            font-size: 25px;
        }

        .rating11 label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating11 label:last-child {
            position: static;
        }

        .rating11 label:nth-child(1) {
            z-index: 5;
        }

        .rating11 label:nth-child(2) {
            z-index: 4;
        }

        .rating11 label:nth-child(3) {
            z-index: 3;
        }

        .rating11 label:nth-child(4) {
            z-index: 2;
        }

        .rating11 label:nth-child(5) {
            z-index: 1;
        }

        .rating11 label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating11 label .icon {
            float: left;
            color: transparent;
        }

        .rating11 label:last-child .icon {
            color: black;
        }

        .rating11:not(:hover) label input:checked ~ .icon,
        .rating11:hover label:hover input ~ .icon {
            color: #ffa904;
        }

        .rating11 label input:focus:not(:checked) ~ .icon:last-child {
            color: black;
            text-shadow: 0 0 5px #ffa904;
        }

        .scrollbar {
            margin-left: 30px;
            float: left;
            height: 300px;
            width: 820px;
            background: #fff;
            overflow-y: scroll;
            margin-bottom: 25px;
        }
        .force-overflow {
            min-height: 450px;
        }

        .scrollbar-warning::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 10px;
        }

        .scrollbar-warning::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .scrollbar-warning::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #FF8800;
        }

        .scrollbar-warning {
            scrollbar-color: #FF8800 #F5F5F5;
        }

        .scrollbar-dusty-grass::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-color: #F5F5F5;
            border-radius: 15px;
        }

        .scrollbar-dusty-grass::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .scrollbar-dusty-grass::-webkit-scrollbar-thumb {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
            background-image: -webkit-linear-gradient(330deg, #d4fc79 0%, #96e6a1 100%);
            background-image: linear-gradient(120deg, #d4fc79 0%, #96e6a1 100%);
        }

        .square::-webkit-scrollbar-track {
            border-radius: 0 !important;
        }

        .square::-webkit-scrollbar-thumb {
            border-radius: 0 !important;
        }

        .thin::-webkit-scrollbar {
            width: 6px;
        }

        .example-1 {
            position: relative;
            overflow-y: scroll;
            height: 400px;
            background: #f3f2ee;
            border-width: 0;
            border-style: none;
            border-color: transparent;
        }
    </style>
@endsection
