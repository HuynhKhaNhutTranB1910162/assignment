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
                <form action="{{ route('product-detail',['id' => $product->id]) }}" method="POST">
                    @csrf
                    <div class="product__details__content">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="">
                                </div>
                                <div class="col-lg-6">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-lg-8">
                                            <div class="product__details__text">
                                                <h4>{{ $product->name }}</h4>
                                                <div class="rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <span> - 5 Reviews</span>
                                                </div>
                                                <h3>{{ CurrencyHelper::format($product->original_price) }} <span>{{ CurrencyHelper::format($product->selling_price) }}</span></h3>
                                                <div class="product__details__btns__option">
                                                    <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                                                </div>
                                                <div class="product__details__cart__option">
                                                    <div class="quantity">
                                                        <div class="pro-qty"><span class="fa fa-angle-up dec qtybtn"></span>
                                                            <input type="text" value="1">
                                                            <span class="fa fa-angle-down inc qtybtn"></span></div>
                                                    </div>
                                                    <a href="#" class="primary-btn">add to cart</a>
                                                </div>
                                                <div class="product__details__last__option">
                                                    <ul>
                                                        <li><span>SKU:</span> {{ $product->sku }}</li>
                                                        <li><span>Categories:</span> {{ $product->category->name }}</li>
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
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="product__details__text">
                    <div class="product__details__last__option">
                        <h5><span>Guaranteed Safe Checkout</span></h5>
                        <img src="{{asset('client/img/shop-details/details-payment.png')}}" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Description</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                @foreach($productRelated as $related)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">

                            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $related->image) }}">
                                <span class="label">New</span>
                                <ul class="product__hover">
                                    <li><a href="#"><img src="{{asset('client/img/icon/heart.png')}}" alt=""></a></li>
                                    <li><a href="{{ route('product-detail', ['id' => $related->id]) }}"><img src="{{asset('client/img/icon/search.png')}}" alt=""></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>{{ $related->name }}</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>{{ CurrencyHelper::format($product->original_price) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Section End -->

@endsection
