<div>
    <form wire:submit.prevent="addNew">
        <div class="checkout__input">
            <p>Số nhà</p>
            <input wire:model="houseNumber" type="text" placeholder="Street Address" class="checkout__input__add">
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="checkout__input">
                    <p>Chọn thành phố<span>*</span></p>
                    <select wire:model.live="provinceId" class="choose" >
                        <option >Chọn thành phố</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                    @error('provinceId')
                    <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout__input">
                    <p>Chọn Quận huyện<span>*</span></p>
                    <select wire:model.live="districtId"  class="choose" aria-label=".form-select-sm">
                        <option >Chọn Quận huyện</option>
                        @foreach($districts as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('districtId')
                    <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-4">
                <div class="checkout__input">
                    <p>Chọn xã phường<span>*</span></p>
                    <select  wire:model.live="wardId" id="ward" class="choose" aria-label=".form-select-sm">
                        <option >Chọn xã phường</option>
                        @foreach($wards as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('wardId')
                    <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="checkout__input">
            <p>Địa chỉ</p>
            <input wire:model="address" type="text" placeholder="Street Address" class="checkout__input__add">
        </div>
        <div>
            <button type="submit" class="site-btn">Thêm địa chỉ</button>
        </div>
    </form>

</div>
