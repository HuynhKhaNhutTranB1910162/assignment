@extends('client.layouts.app')

@section('content')

    @include('client.home.banner')

    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-7.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/img.png')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-8.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-11.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-10.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-11.jpg')}}"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Về chúng tôi</h2>
                        <p  style="color:#1c64f2 ;font-weight: 500"> HẾT SỨC – TẬN TÂM – ĐỒNG HÀNH. Là tiêu chí mà chúng tôi muốn hướng đến khách hàng.</p>
                        <h3>#SPA_SHOP</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>

    @include('client.home.service')

    @include('client.home.service-package')

    <div class="container">
        <div class="blog__details__comment">
            <h4>Tư vấn Miễn phí</h4>
            <form action="{{ route('appointment.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        @error('name') <span style="color: red;" class="error">{{ $message }}</span> @enderror
                        <input name="name" type="text" placeholder="Name">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        @error('email') <span style="color: red;" class="error">{{ $message }}</span> @enderror
                        <input name="email" type="text" placeholder="Email">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        @error('phone') <span style="color: red;" class="error">{{ $message }}</span> @enderror
                        <input name="phone" type="text" placeholder="Phone">

                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea name="notes" placeholder="Comment"></textarea>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="site-btn">Đăng ký ngay</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
