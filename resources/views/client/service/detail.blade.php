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
                                <li><h4>Giá : {{ CurrencyHelper::format($service->original_price) }}</h4></li>
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
        </div>
    </section>
@endsection
