@extends('client.layouts.app')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Thông tin người dùng</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('client') }}">Trang chủ</a>
                            <span>Thông tin người dùng</span>
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
                            <div class="shopping__cart__table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Địa chỉ</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="cart__price">30.00</td>
                                        <td class="cart__close"><i class="fa fa-close"></i></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="checkout__title">Thông tin khách hàng</h6>
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
                            <div class="checkout__input">
                                <p>Địa chỉ</p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title"></h4>
                                <button type="submit" class="site-btn">Xác nhận đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
