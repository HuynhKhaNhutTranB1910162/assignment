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
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <select style="height: 40px;text-transform:uppercase;font-weight: 700; width: 240px;-webkit-border-radius: 0; border: 0;"
                                                        wire:model.live="selectedCategory">
                                                    <option style="list-style: none;color: #b7b7b7;
                                                                    font-size: 15px;
                                                                    line-height: 32px;"
                                                            value="">All Categories</option>
                                                    @foreach ($categories as $category)
                                                        <option style="list-style: none; color: #b7b7b7;
                                                                      font-size: 15px;
                                                                      line-height: 32px;"
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sắp xếp giá sản phẩm:</p>
                                    <select wire:model.live="sortOrder">
                                        <option value="asc">Giá: từ thấp đến cao</option>
                                        <option value="desc">Giá: từ cao đến thấp</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($products as $product)
                            @if($product->stock > 0)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg">
                                            <img style="width: 500px" src="{{ asset('storage/' . $product->image) }}">
                                            <ul class="product__hover">
                                                <li>
                                                    <form id="heart-form-{{ $product->id }}" action="{{ route('favorite.addToFavorite', ['id' => $product->id]) }}" method="POST" class="d-none">
                                                    @csrf
                                                    </form>
                                                <a class="add-heart"  href="#" onclick="event.preventDefault(); document.getElementById('heart-form-{{ $product->id }}').submit();">
                                                    <img src="{{ asset('client/img/icon/heart.png')}} " alt="">
                                                </a>
                                                </li>
{{--                                                <li><a href="#"><img src="{{ asset('client/img/icon/heart.png')}} " alt=""></a></li>--}}
                                                <li><a href="{{ route('product-detail', ['id' => $product->id]) }}"><img src="{{asset('client/img/icon/search.png')}}" alt=""></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6>{{$product->name}}</h6>
                                            <form id="addtocart-form-{{ $product->id }}" action="{{ route('cart.addToCart', ['id' => $product->id]) }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="number" value="1" hidden name="qty">
                                            </form>
                                            <a class="add-cart"  href="#" onclick="event.preventDefault(); document.getElementById('addtocart-form-{{ $product->id }}').submit();">
                                                + Thêm giỏ hàng
                                            </a>
                                            <h5>{{ CurrencyHelper::format($product->original_price) }}</h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div style="display: flex; justify-content: right;">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
