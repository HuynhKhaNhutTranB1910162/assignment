<div>
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" wire:model.live="searchTerm" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($services as $service)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg">
                                        <img style="width: 500px" src="{{ asset('storage/' . $service->image) }}">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="{{asset('client/img/icon/heart.png')}}" alt=""></a></li>
                                            <li><a href="{{ route('service-detail', ['id' => $service->id]) }}"><img src="{{asset('client/img/icon/search.png')}}" alt=""></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>{{$service->name}}</h6>
                                        <h5>{{ CurrencyHelper::format($service->original_price) }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div style="display: flex; justify-content: right;">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
