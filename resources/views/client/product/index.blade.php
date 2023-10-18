@extends('client.layouts.app')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Sản phẩm</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('client') }}">Trang chủ</a>
                        <span>Sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
    <livewire:list-product></livewire:list-product>
@endsection
