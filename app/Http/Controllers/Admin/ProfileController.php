<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatedAccountRequest;
use App\Models\Admin;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use ImageTrait;

    public function index(string $id): View
    {
        $admin = Admin::getAdminById($id);

        return view('admin.profile.profile' ,compact('admin'));
    }

    public function update(Request $request,string $id): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'nullable',
        ]);

        $admin = Admin::getAdminById($id);

        if (! $request->hasFile('image')) {
            $data['image'] = $admin->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $admin->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $admin->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'image' => $data['image'],
        ]);

        toastr()->success('Cập nhật thông tin người dùng ' . $admin->name  . ' thành công');

        return redirect()->back();
    }
    public function updatePassword(Request $request, string $id): RedirectResponse
    {
        $admin = Admin::getAdminById($id);

        $data = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        if(!Hash::check($request->current_password, $admin->password)) {
            toastr()->warning('Mật khẩu cũ không chính xác');
            return redirect()->back();
        }

        $admin->update([
            'password' => Hash::make($data['password']),
        ]);

        toastr()->success('Cập nhật mật khẩu  ' . $admin->name  . ' thành công');

        return redirect()->back();
    }
}
