<div class="checkout__form">
    <form wire:submit.prevent="codOrder">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                @foreach($addresses as $key => $address)
                <h6 class="coupon__code">
                    <label>
                        <input wire:model.live="addressId"
                               name="addressId"
                               class="form-check-input"
                               type="radio"
                               value="{{ $address->id }}"
                               id="{{ $key }}">
                        <span class="checkmark">
                        {{ $address->user_name }},{{ $address->phone_number}} ,{{$address->ward->name}}, {{$address->district->name}}, {{$address->province->name}}.
                        </span>
                    </label>
                    @error('addressId') <span style="color: red;" class="error">{{ $message }}</span> @enderror
                </h6>
                @endforeach

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{ route('profile') }}">Thêm địa chỉ</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="checkout__order">
                    <h4 class="order__title"> Đơn hàng của bạn </h4>
                    <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                    <ul class="checkout__total__products">
                        @foreach($cart as $item)
                            @php
                                $price = $item->product->selling_price !==Null ? $item->product->selling_price : $item->product->original_price;
                                $priceEnd = $price * $item->quantity;
                            @endphp
                            <li>{{$item->product->name}} x {{$item->quantity}} <span>{{ CurrencyHelper::format($priceEnd) }}</span></li>
                        @endforeach
                    </ul>

                    <ul class="checkout__total__all">
                        <li>Tổng tiền <span>{{ CurrencyHelper::format($totalCurrencyExchange)}}</span></li>
                    </ul>

                    <div class="checkout__input">
                        <p>Lời nhắn : </p>
                        <textarea wire:model="notes" placeholder="Ghi chú cho đơn hàng"></textarea>
                        @error('notes') <span style="color: red;" class="error">{{ $message }}</span> @enderror
                    </div>

                        <p>Chọn phương thức thanh toán : </p>

                    <div wire:model="payment">
                            <div >
                                <input wire:model.live="paymentType" value="payment" type="radio" id="payment">
                                <label for="payment"> Thanh toán qua ngân hàng</label>
                                <img src="{{asset('client/img/shop-details/details-payment.png')}}" alt="">
                                <span class="checkmark"></span>
                            </div>
                        <br>
                            <div >
                                <input wire:model.live="paymentType" value="paypal" type="radio" id="paypal">
                                <label for="paypal"> Thanh toán khi nhận hàng</label>
                                <span class="checkmark"></span>
                            </div>
                        </div>
                    @error('payment')
                    <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                    @switch($showTypePayment)
                        @case('payment')
                            <div class="p-l-49">
                                <form >
                                    <span wire:click="checkoutVNPAY" class="site-btn">thanh toan VNPay</span>
                                </form>
                            </div>
                            @break;
                        @case('paypal')
                            <br>
                            <button type="submit" class="site-btn">Đặt hàng</button>
                    @endswitch
                </div>
            </div>
        </div>
    </form>
</div>
