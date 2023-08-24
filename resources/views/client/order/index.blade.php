@extends('client.layouts.app')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Đơn hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('client') }}">Trang chủ</a>
                            <span>Đơn hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Thông tin khách hàng</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add">
                                <input type="text" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>

                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <select>
                                            <option value="volvo">Volvo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <select>
                                            <option value="volvo">Volvo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <select>
                                            <option value="volvo">Volvo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Note about your order, e.g, special noe for delivery
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                       placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        @if(Auth::check())
                            @php $total = 0; @endphp
                            @foreach($carts as $item)
                                @php
                                    $price = $item->product->selling_price !==Null ? $item->product->selling_price : $item->product->original_price;
                                    $priceEnd = $price * $item->quantity;
                                    $total += $priceEnd;
                                @endphp
                                <div class="col-lg-4 col-md-6">
                                    <div class="checkout__order">
                                        <h4 class="order__title">Sản phẩm đơn hàng</h4>
                                        <div class="checkout__order__products">Sản phẩm <span>Tổng tiền</span></div>
                                        <ul class="checkout__total__products">
                                            <li>{{ $item->product->name }} <span>{{ CurrencyHelper::format($priceEnd) }}</span></li>
                                        </ul>
                                        <ul class="checkout__total__all">
                                            <li>Tổng tiền <span>{{ $total }}</span></li>
                                        </ul>
                                        <div class="checkout__input__checkbox">
                                            <label for="acc-or">
                                                Create an account?
                                                <input type="checkbox" id="acc-or">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                            ut labore et dolore magna aliqua.</p>
                                        <div class="checkout__input__checkbox">
                                            <label for="payment">
                                                Check Payment
                                                <input type="checkbox" id="payment">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="checkout__input__checkbox">
                                            <label for="paypal">
                                                Paypal
                                                <input type="checkbox" id="paypal">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <button type="submit" class="site-btn">Xác nhận đặt hàng</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
