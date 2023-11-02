<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Shipper;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ShipperProfileController extends Controller
{
    use ImageTrait;

    public function index(string $id): View
    {
        $shipper = Shipper::getShipperById($id);

        return view('shipper.profile.index' ,compact('shipper'));
    }

    public function update(Request $request,string $id): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'image' => 'nullable',
        ]);

        $shipper = Shipper::getShipperById($id);

        if (! $request->hasFile('image')) {
            $data['image'] = $shipper->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $shipper->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $shipper->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'image' => $data['image'],
        ]);

        toastr()->success('Cập nhật thông tin người dùng ' . $shipper->name  . ' thành công');

        return redirect()->back();
    }
    public function updatePassword(Request $request, string $id): RedirectResponse
    {
        $shipper = Shipper::getShipperById($id);

        $data = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        if(!Hash::check($request->current_password, $shipper->password)) {
            toastr()->warning('Mật khẩu cũ không chính xác');
            return redirect()->back();
        }

        $shipper->update([
            'password' => Hash::make($data['password']),
        ]);

        toastr()->success('Cập nhật mật khẩu  ' . $shipper->name  . ' thành công');

        return redirect()->back();
    }
}
