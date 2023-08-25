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
                                    @foreach($addresses as $item)
                                        <tr>
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
                            <h6 class="checkout__title">Thông tin địa chỉ khách hàng</h6>
                          <div>
                              <livewire:location>
                              </livewire:location>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title"></h4>
                                <div class="continue__btn">
                                    <a>Xem sản phẩm</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection


