<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Address;
use App\Models\Category;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use ImageTrait;
    public function index(): View
    {
        $categories = Category::all();
        if (Auth::check()) {
            $addresses = Address::where('user_id', Auth::user()->id)->get();
            return view('client.profile.index', compact('categories', 'addresses'));
        }
        return view('client.profile.index', compact('categories'));
    }

    public function edit(string $id):view
    {

        $categories = Category::all();

        $user = User::getUserById($id);

        return view('client.profile.edit', compact('categories','user'));
    }

    public function update(UpdateUserRequest $request,string $id): RedirectResponse
    {
        $data = $request->validated();

        $user = User::getUserById($id);

        if (! $request->hasFile('image')) {
            $data['image'] = $user->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $user->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $user->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'image' => $data['image'],
        ]);

        toastr()->success('Cập nhật thông tin người dùng ' . $user->name  . ' thành công');

        return redirect()->back();
    }

    public function updatePassword(Request $request, string $id): RedirectResponse
    {
        $user = User::getUserById($id);

        $data = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        if(!Hash::check($request->current_password, $user->password)) {
            toastr()->warning('Mật khẩu cũ không chính xác');
            return redirect()->back();
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        toastr()->success('Cập nhật mật khẩu người dùng ' . $user->name  . ' thành công');

        return redirect()->back();
    }

    public function destroy(string $id): RedirectResponse
    {

        $address = Address::getAddressByUserId($id);

        $address->delete();

        toastr()->success('Xóa thành công địa chỉ');

        return redirect('user-profile');
    }

}
