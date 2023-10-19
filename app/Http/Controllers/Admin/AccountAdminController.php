<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAccountRequest;
use App\Http\Requests\Admin\UpdatedAccountRequest;
use App\Models\Admin;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AccountAdminController extends Controller
{
    use ImageTrait;
    public int $itemPerPage = 5;

    public function index(): View
    {
        $admins = Admin::query()->orderByDesc('created_at')->paginate($this->itemPerPage);
        return view('admin.accounts.index', compact('admins'));
    }

    public function create(): View
    {
        return view('admin.accounts.create');
    }

    public function store(CreateAccountRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        Admin::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'cccd' => $data['cccd'],
            'address' => $data['address'],
            'image' => $data['image'],
            'is_admin' => $data['is_admin'],
            'password' => Hash::make($data['password']),
        ]);

        toastr()->success('Thêm mới nhan vien thành công');

        return redirect('admins');
    }

    public function edit(String $id): View
    {
        $admin = Admin::getAdminById($id);

        return view('admin.accounts.edit', compact('admin'));
    }

    public function update(UpdatedAccountRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();

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
            'email' => $data['email'],
            'phone' => $data['phone'],
            'cccd' => $data['cccd'],
            'address' => $data['address'],
            'image' => $data['image'],
            'is_admin' => $data['is_admin'],
        ]);

        toastr()->success('Cập nhật thông tin người dùng ' . $admin->name  . ' thành công');

        return redirect('admins');
    }

    public function updatePassword(Request $request, string $id): RedirectResponse
    {
        $admin = Admin::getAdminById($id);

        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        $admin->update([
            'password' => Hash::make($data['password']),
        ]);

        toastr()->success('Cập nhật mật khẩu người dùng ' . $admin->name  . ' thành công');

        return redirect('admins');
    }

    public function destroy(string $id): RedirectResponse
    {
        $admin = Admin::getAdminById($id);

        $image = 'storage/' . $admin->image;

        $this->deleteImage($image);

        $admin->delete();

        toastr()->success('Xóa người dùng ' . $admin->name  . ' thành công');

        return redirect('admins');
    }

}
