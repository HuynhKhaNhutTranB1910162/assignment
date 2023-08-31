@extends('client.layouts.app')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Đặt hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('client') }}">Trang chủ</a>
                            <a href="{{ route('shop') }}">Sản phẩm</a>
                            <span>Đặt hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="shopping__cart__table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <th>Địa chỉ</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($addresses as $item)
                                        <tr>
                                            <td class="product__cart__item__text"><h5>{{ $item->user_name }}</h5></td>
                                            <td class="cproduct__cart__item">{{ $item->address }}</td>
                                            <td class="cart__close"><a href=""><i class="fa fa-check"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="continue__btn">
                                        <a href="{{ route('profile') }}">Thêm địa chỉ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                                <ul class="checkout__total__products">
                                    <li>Vanilla salted caramel <span>$ 300.0</span></li>
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Tổng tiền <span>$750.99</span></li>
                                </ul>
                                <ul class="checkout__total__products">
                                    <li>Tên :<span>Huỳnh Kha Nhựt Trân</span></li>
                                </ul>
{{--                                <p>Tên : Huỳnh Kha Nhựt Trân</p>--}}
                                <p>Địa chỉ : Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input">
                                    <p>Lời nhắn : </p>
                                    <textarea></textarea>
                                </div>
                                <button type="submit" class="site-btn">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
