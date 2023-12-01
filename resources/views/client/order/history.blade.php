@extends('client.layouts.app')

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Lịch sử mua hàng</h4>
                        <div class="breadcrumb__links">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <section class="shopping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shopping__cart__table">
                            <table>
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Thông tin</th>
                                    <th>Số điện thoại</th>
                                    <th>Thành tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Hoạt động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key => $order)
                                <tr>
                                    <td class="cart__price">{{ $key + 1 }}</td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__text">
                                            <h5>{{ $order->user_name}}</h5>
                                            <h6>{{$order->shipping_address }}</h6>

                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                               <h5>{{ $order->phone }}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">{{ CurrencyHelper::format($order->total) }}</td>
                                    @if($order->status === 'pending')
                                        <td class="cart__price"> Đang chờ duyệt</td>
                                    @elseif($order->status === 'accepted')
                                        <td class="cart__price">Đã được duyệt</td>
                                    @elseif($order->status === 'inDelivery')
                                        <td class="cart__price">Đang vận chuyển</td>
                                    @elseif($order->status === 'success')
                                        <td class="cart__price">Thành công</td>
                                    @elseif($order->status === 'cancel')
                                        <td class="cart__price">Hủy bỏ</td>
                                    @else
                                        <td class="cart__price">Hoàn tiền</td>
                                    @endif
                                    <td class="cart__close"><a href="{{ route('order.detail', ['id' => $order->id]) }}"><i class="fa fa-eye"></i></a></td>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
