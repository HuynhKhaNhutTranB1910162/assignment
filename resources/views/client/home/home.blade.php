@extends('client.layouts.app')

@section('content')

    @include('client.home.banner')

    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-1.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-2.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-3.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-4.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-5.jpg')}}"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="{{asset('client/img/instagram/instagram-6.jpg')}}"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Về chúng tôi</h2>
                        <p  style="color:#1c64f2 ;font-weight: 500"> HẾT SỨC – TẬN TÂM – ĐỒNG HÀNH. Là tiêu chí mà chúng tôi muốn hướng đến khách hàng.</p>
                        <h3>#Male_Fashion</h3>
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
            <h4>Đặt lịch</h4>
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
                    <div class="col-lg-4 col-md-4">
                        @error('appointment_at') <span style="color: red;" class="error">{{ $message }}</span> @enderror
                        <input name="appointment_at" type="datetime-local" placeholder="appointment_at">
                    </div>
                    <div class="col-lg-8 col-md-4">
                        <textarea name="notes" placeholder="Comment"></textarea>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="site-btn">Đặt lịch</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
