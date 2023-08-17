@extends('client.layouts.app')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('client') }}">Trang chủ</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($carts as $item)
                            <tr>
                                <form action="{{ route('cart.update', ['id' => $item->id]) }}" method="POST" id="update-qty">
                                    @csrf
                                    @method('PUT')
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img width="100px" height="100px" src="{{ asset('storage/' . $item->product->image) }}" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $item->product->name }}</h6>
                                            <h5>{{ $item->product->category->name }}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input id="qty" name="qty" value="{{$item->quantity}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">{{ CurrencyHelper::format($item->product->original_price) }}</td>
                                <td class="cart__close">
                                    <a href="{{ route('cart.delete', ['id' => $item->id]) }}">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </td>
                                </form>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('shop') }}">Xem sản phẩm</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="{{ route('cart-product') }}" onclick="event.preventDefault(); document.getElementById('update-qty').submit();"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__total">
                        <h6>Thanh Toán</h6>
                        <ul>
                            <li>Subtotal <span>$ 169.50</span></li>
                            <li>Tổng tiền <span>$ 169.50</span></li>
                        </ul>
                        <a href="#" class="primary-btn">Đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
