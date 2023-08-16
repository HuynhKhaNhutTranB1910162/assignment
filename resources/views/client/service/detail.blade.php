@extends('client.layouts.app')

@section('content')

    <section class="blog-hero spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 text-center">
                    <form action="{{ route('service-detail',['id' => $service->id]) }}" method="POST">
                        @csrf
                        <div class="blog__hero__text">
                            <h2>{{ $service->name }}</h2>
                            <ul>
                                <li>By Deercreative</li>
                                <li>February 21, 2019</li>
                                <li>8 Comments</li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-details spad">
        <div class="container">
            <form action="{{ route('service-detail',['id' => $service->id]) }}" method="POST">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12">
                        <div class="blog__details__pic">
                            <img src="{{ asset('storage/' . $service->image) }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="blog__details__content">
                            <div class="blog__details__share">
                                <span>share</span>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                                </ul>
                            </div>
                            <div class="blog__details__option">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                    </div>
                                </div>
                            </div>
                            <div class="blog__details__text">
                                <p>{{ $service->description }}</p>
                            </div>
                            <div class="blog__details__option">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="related-title">Hiệu quả dịch vụ</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog__details__comment">
                <h4>Leave A Comment</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <input type="text" placeholder="Name">
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <input type="email" placeholder="Email">
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <input type="tel" placeholder="Phone">
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <input type="datetime-local" placeholder="Email">
                        </div>
                        <div class="col-lg-12 text-center">
                            <textarea placeholder="Comment"></textarea>
                            <button type="submit" class="site-btn">Post Comment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
