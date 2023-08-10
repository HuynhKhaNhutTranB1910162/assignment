<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Combo siêu tiết kiệm</span>
                    <h2>Gói dịch vụ</h2>
                </div>
            </div>
        </div>
            <div class="row">
                @foreach($servicePackages as $servicePackage)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset('storage/' . $servicePackage->image) }}"></div>
                        <div class="blog__item__text">
                            <h5>{{ $servicePackage->name }}</h5>
                            <div class="row">
                                <h6 style="padding-right: 7px">Giá tiết kiệm : </h6>
                                 <h6 style="color: #ff4a2c;font-weight: bold ; font-size: 20px">{{ CurrencyHelper::format($servicePackage->original_price) }}</h6>
                            </div>
                            <div>
                                <ul>
                                    @foreach($servicePackage->services as $item)
                                        <li style=" list-style: none;"><i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>{{ $item->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
</section>
