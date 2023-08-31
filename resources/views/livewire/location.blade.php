<div>
    <form wire:submit.prevent="addNew">
        <div class="checkout__input">
            <p>Tên Khách hàng</p>
            <input wire:model="userName" type="text" placeholder="Street Address" class="checkout__input__add">
            @error('userName') <span style="color: red;" class="error">{{ $message }}</span> @enderror
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="checkout__input">
                    <p>Chọn thành phố<span>*</span></p>
                    <select wire:model.live="provinceId" class="form-control" >
                        <option value="">Chọn thành phố</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('provinceId') <span style="color: red;" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-4">
                <div class="checkout__input">
                    <p>Chọn Quận huyện<span>*</span></p>
                    <select wire:model.live="districtId"  class="form-control" aria-label=".form-select-sm">
                        <option value="">Chọn Quận huyện</option>
                        @foreach($districts as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('districtId') <span style="color: red;" class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-lg-4">
                <div class="checkout__input">
                    <p>Chọn xã phường<span>*</span></p>
                    <select  wire:model.live="wardId" id="ward" class="form-control" aria-label=".form-select-sm">
                        <option value="">Chọn xã phường</option>
                        @foreach($wards as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('wardId') <span style="color: red;" class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="checkout__input">
            <p>Địa chỉ cụ thể</p>
            <input wire:model="address" type="text" placeholder="Street Address" class="checkout__input__add">
            @error('address') <span style="color: red;" class="error">{{ $message }}</span> @enderror
        </div>
        <div>
            <button type="submit" class="site-btn">Thêm địa chỉ</button>
        </div>
    </form>
</div>

