<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                   <a href="{{ route('client-service') }}"><li class="active" data-filter="*">Dịch vụ</li></a>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            @foreach($services as $service)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $service->image) }}">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="{{asset('client/img/icon/heart.png')}}" alt=""></a></li>
                                <li><a href="{{ route('service-detail', ['id' => $service->id]) }}"><img src="{{asset('client/img/icon/search.png')}}" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$service->name}}</h6>
                            {{--                            <a href="#" class="add-cart">+ Add To Cart</a>--}}
                            <h4>{{ CurrencyHelper::format($service->original_price) }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
