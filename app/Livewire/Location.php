<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Location extends Component
{
    public string $provinceId = '';
    public string $districtId = '';
    public string $wardId = '';
    public $districts = [];
    public $wards = [];
    public $address;
    public $houseNumber;

    public function addNew()
    {
        Address::create([
            'user_id' => Auth::user()->id,
            'house_number' => $this->houseNumber,
            'address' => $this->address,
            'province_id' => $this->provinceId,
            'district_id' => $this->districtId,
            'ward_id' => $this->wardId,
        ]);
        toastr()->success('thêm địa chỉ thành công');

        $this->reset();
    }

    public function render()
    {
        $provinces = Province::all();

        if (!empty($this->provinceId)) {
            $this->districts = District::where('province_id', $this->provinceId)->get();
        }
        if (!empty($this->districtId)) {
            $this->wards = Ward::where('district_id', $this->districtId)->get();
        }

        return view('livewire.location', [
            'provinces' => $provinces,
        ]);
    }
}
