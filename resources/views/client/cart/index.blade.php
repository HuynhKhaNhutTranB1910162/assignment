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
    @if(Auth::check())
        @php $total = 0; @endphp
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
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $item)
                                    @php
                                        $price = $item->product->selling_price !==Null ? $item->product->selling_price : $item->product->original_price;
                                        $priceEnd = $price * $item->quantity;
                                        $total += $priceEnd;
                                    @endphp
                                    <tr>
                                        <form hidden id="formUpdateCart" action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                        </form>

                                        <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img width="100px" height="100px" src="{{ asset('storage/' . $item->product->image) }}" alt="">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h5>{{ $item->product->name }}</h5>
                                                    <h6>{{ $item->product->category->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                @if($item->product->stock > $item->quantity)
                                                    <div class="quantity">
                                                        <div class="row">
                                                        <div class="input-group-prepend">
                                                            <button data-dec-product-id="{{ $item->id }}" id="decrease" class="decrease btn btn-outline-primary" type="button">&minus;</button>
                                                        </div>
                                                        <input type="text" class="text-center p-2" style="width: 60px" name="quantity" value="{{ $item->quantity }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                                        <div class="input-group-append">
                                                            <button data-inc-product-id="{{ $item->id }}" id="increase" class="increase btn btn-outline-primary" type="button">&plus;</button>
                                                        </div>
                                                        </div>
                                                </div>
                                                @else
                                                    <span>Out of stock</span>
                                                @endif
                                            </td>
                                            <td class="cart__price">{{ CurrencyHelper::format($price) }}</td>
                                            <td class="cart__price">{{ CurrencyHelper::format($priceEnd) }}</td>
                                            <td class="cart__close">
                                                <a href="{{ route('cart.delete', ['id' => $item->id]) }}">
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
                    <div class="col-lg-4">
                        <div class="cart__total">
                            <h6>Thanh Toán</h6>
                            <ul>
                                <li>Tổng tiền <span>{{ CurrencyHelper::format($total) }}</span></li>
                            </ul>
                            <a href="#" class="primary-btn">Đặt hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <br>
        <div class="text-center">
            <img style="height: 200px; width: 300px" src="{{asset('client/img/cart-empty.png')}}" class="rounded" alt="...">
        </div>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.increase').on('click', function(e) {
            e.preventDefault()

            let url = $('#formUpdateCart').attr('action');
            let id = $(this).data('inc-product-id');

            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                    id: id,
                    type: 'inc',
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    location.reload()
                },
                error: function (error) {
                    console.log(error)
                }
            })
        });
    </script>

    <script type="text/javascript">
        $('.decrease').on('click', function(e) {
            e.preventDefault()

            let url = $('#formUpdateCart').attr('action');
            let id = $(this).data('dec-product-id');

            $.ajax({
                url: url,
                method: 'PUT',
                data: {
                    id: id,
                    type: 'dec',
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    location.reload()
                },
                error: function (error) {
                    console.log(error)
                }
            })
        });
    </script>
@endsection

