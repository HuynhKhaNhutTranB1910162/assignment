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
    @if(Auth::check())
        <section class="checkout spad">
            <div class="container">
                <div class="checkout__form">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="shopping__cart__table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Tên khách hàng</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Hoạt động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($addresses as $item)
                                        <tr>
                                            <td class="product__cart__item__text"><h5>{{ $item->user_name }}</h5></td>
                                            <td class="cproduct__cart__item">{{ $item->phone_number }}</td>
                                            <td class="cproduct__cart__item">{{ $item->address }}</td>
                                            <td class="cart__close">
                                                <a href="{{ route('profile.delete', ['id' => $item->id]) }}">
                                                    <i class="fa fa-close"></i>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="checkout__title">Địa chỉ khách hàng</h6>
                            <div>
                                <livewire:location></livewire:location>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Thông tin tài khoản</h4>
                                <div class="checkout__order__products">
                                    <div class="blog__item__pic set-bg" data-setbg="{{ asset('client/img/blog/blog-2.jpg') }}">
                                    </div>

                                </div>
                                <ul class="checkout__total__all">
                                    <li>Tên khách hàng <span>{{ Auth::user()->name }}</span></li>
                                    <li>Email <span>{{ Auth::user()->email }}</span></li>
                                    <li>Số điện thoại <span>{{ Auth::user()->phone }}</span></li>
                                    <li>Số điện thoại <span>{{ Auth::user()->id }}</span></li>
                                </ul>
                                <a href="{{ route('profile.edit-user', ['id' => Auth::user()->id]) }}"><button class="site-btn">Cập nhật thông tin</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection




