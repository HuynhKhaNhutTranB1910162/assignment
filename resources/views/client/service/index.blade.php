@extends('client.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Dịch vụ</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('client') }}">Trang chủ</a>
                            <span>Dịch vụ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <livewire:listservice> </livewire:listservice>
@endsection
