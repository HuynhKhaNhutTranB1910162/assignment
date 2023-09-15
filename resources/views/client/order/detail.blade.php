@extends('client.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Tất cả</a>
                            <a href="./shop.html"> <span>đơn hàng</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="vh-20">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-stepper" style="border-radius: 10px;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-column">
                                    <span style="color: #b21f2d" class="lead fw-normal">Mã đơn hàng : {{ $order->tracking_number }}</span>
                                    <span style="color: #b21f2d" class="text-muted small">
                                        Ngày đặt hàng : {{ $order->created_at->format('g:i A') }}
                                        {{$order->created_at->format('d')}} -
                                        {{$order->created_at->format('m')}} -
                                        {{$order->created_at->format('Y')}}
                                    </span>
                                    <br>
                                    <h5 style="color: #b21f2d">Tổng tiền đơn hàng :  {{ CurrencyHelper::format($order->total) }}</h5>
                                </div>
                                @if( $order->status === 'pending')
                                    <div>
                                        <div class="continue__btn">
                                            <a href="{{route('orders.detail.update', ['id' => $order->id])}}"></i> Hủy đơn hàng</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <hr class="my-4">

                            <div class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                @if($order->status === 'pending')
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot">
                                            <i class="fa fa-check text-white"></i>
                                        </span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                @elseif($order->status === 'accepted')
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot">
                                        <i class="fa fa-check text-white"></i>
                                    </span>
                                @elseif($order->status === 'inDelivery')
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot">
                                        <i class="fa fa-check text-white"></i>
                                    </span>
                                @elseif($order->status === 'success')
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line"><span class="dot"></span>
                                    <hr class="flex-fill track-line"><span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot">
                                         <i class="fa fa-check text-white"></i>
                                        </span>
                                @elseif($order->status === 'cancel')
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot">
                                            <i class="fa fa-close text-white"></i>
                                        </span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                @else
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line">
                                    <span class="d-flex justify-content-center align-items-center big-dot dot">
                                        <i class="fa fa-money text-white"></i>
                                    </span>
                                    <hr class="flex-fill track-line">
                                    <span class="dot"></span>
                                @endif
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                @if($order->status === 'pending')
                                    <div class="d-flex flex-column align-items-start">
                                        <span></span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Đang chờ duyệt</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span></span>
                                    </div>
                                @elseif($order->status === 'accepted')
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Đang chờ duyệt</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Đã được duyệt</span>
                                    </div>
                                @elseif($order->status === 'inDelivery')
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Đang chờ duyệt</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Đã được duyệt</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Đang vận chuyển</span>
                                    </div>
                                @elseif($order->status === 'success')
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Đang chờ duyệt</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Đã được duyệt</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Đang vận chuyển</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Thành công</span>
                                    </div>
                                @elseif($order->status === 'cancel')
                                    <div class="d-flex flex-column align-items-start">
                                        <span></span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span style="color: #b21f2d">Hủy bỏ</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span></span>
                                    </div>
                                @else
                                    <div class="d-flex flex-column align-items-start">
                                        <span></span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span style="color: #b21f2d">Hoàn tiền</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-start">
                                        <span></span>
                                    </div>
                                @endif
                            </div>
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
                                <th>Sản phẩm</th>
                                <th>Mã hàng</th>
                                <th>Số lượng</th>
                                <th>Giá tiền</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderProducts as $key => $orderProduct)
                                <tr>
                                    <td class="cart__price">{{ $key + 1 }}</td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img width="100px" height="100px" src="{{ asset('storage/' . $orderProduct->product->image) }}" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h5>{{ $orderProduct->product->name }}</h5>
                                            <h6> {{ $orderProduct->product->category->name }}</h6>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <h5>{{ $orderProduct->product->sku }}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <h5>{{ $orderProduct->quantity }}</h5>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price"> {{ CurrencyHelper::format($orderProduct->purchase_price) }}</td>
                                    <td class="cart__price">  {{ CurrencyHelper::format($orderProduct->purchase_price*$orderProduct->quantity) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <style>
        .track-line {
            height: 2px !important;
            background-color: #488978;
            opacity: 1;
        }

        .dot {
            height: 10px;
            width: 10px;
            margin-left: 3px;
            margin-right: 3px;
            margin-top: 0px;
            background-color: #488978;
            border-radius: 50%;
            display: inline-block
        }

        .big-dot {
            height: 25px;
            width: 25px;
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 0px;
            background-color: #488978;
            border-radius: 50%;
            display: inline-block;
        }

        .big-dot i {
            font-size: 12px;
        }

        .card-stepper {
            z-index: 0
        }

    </style>
@endsection

