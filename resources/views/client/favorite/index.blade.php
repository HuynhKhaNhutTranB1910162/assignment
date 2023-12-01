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
                                <th>Số lượng còn lại</th>
                                <th>Hoạt động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($favorites  as $key => $item)
                                <tr>
                                    <td class="cart__price">{{ $key + 1 }}</td>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img width="100px" height="100px" src="{{ asset('storage/' . $item->product->image) }}" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h5>{{ $item->product->name }}</h5>
                                            <h6>{{ $item->product->category->name }}</h6>
                                        </div>
                                    </td>
                                    @if($item->product->stock > 0)
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__text">
                                                <h5 style="margin-left: 50px;">{{$item->product->stock}}</h5>
                                            </div>
                                        </td>
                                    @else
                                        <td class="product__cart__item">
                                            <span style="color: #b21f2d">Sản phẩm đã hết</span>
                                        </td>
                                    @endif
                                    <td class="cart__close">
                                        <a href="{{ route('product-detail', ['id' => $item->product->id]) }}">
                                            <i class="fa fa-cart-plus"></i>
                                        </a>
                                        <a href="{{ route('favorite.delete', ['id' => $item->id]) }}">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </td>
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
