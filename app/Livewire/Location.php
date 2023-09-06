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
    public $userName;

    protected $rules = [
        'userName' => 'required|string|max:36',
        'address' => 'required|string|max:255',
        'provinceId' => 'required',
        'districtId' => 'required',
        'wardId' => 'required',
    ];

    protected $messages = [
        'userName.required' => 'Vui lòng nhập họ tên.',
        'userName.max:36' => 'Họ tên không vượt quá 36 kí tự',
        'address.required' => 'Vui lòng nhập địa chỉ cụ thể.',
        'address.max:255' => 'Địa chỉ cụ thể không vượt quá 255 kí tự',
        'provinceId.required' => 'Vui lòng chọn tỉnh thành phố.',
        'districtId.required' => 'Vui lòng nhập huyện.',
        'wardId.required' => 'Vui lòng chọn xã phường.',
    ];

    public function addNew()
    {
        $validatedData = $this->validate();
        if (!(Auth::user()->addresses()->count() < 3)) {
            toastr()->warning('Địa chỉ không được thêm quá 3');

            return redirect()->route('profile');
        } else {
            Address::create([
                'user_id' => Auth::user()->id,
                'user_name' => $validatedData['userName'],
                'address' => $validatedData['address'],
                'province_id' => $validatedData['provinceId'],
                'district_id' => $validatedData['districtId'],
                'ward_id' => $validatedData['wardId'],
            ]);

            toastr()->success('thêm địa chỉ thành công');

            return redirect()->route('profile');
        }

    }

    public function render()
    {
        $provinces = Province::all();

        if (! empty($this->provinceId)) {
            $this->districts = District::where('province_id', $this->provinceId)->get();
        }
        if (! empty($this->districtId)) {
            $this->wards = Ward::where('district_id', $this->districtId)->get();
        }

        return view('livewire.location', [
            'provinces' => $provinces,
        ]);
    }
}
