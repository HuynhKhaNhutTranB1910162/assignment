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
            <livewire:checkout></livewire:checkout>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
