<section class="hero">
    <div class="hero__slider owl-carousel">
        @foreach($banners as $banner)
            @if($banner->status == '1')
                <div class="hero__items set-bg" data-setbg="{{ asset('storage/' . $banner->image) }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-5 col-lg-7 col-md-8">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>
