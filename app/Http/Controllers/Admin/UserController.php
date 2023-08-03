<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public int $itemPerPage = 5;

    public function index(): View
    {
        $users = User::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'is_admin' => $data['is_admin'],
            'password' => $data['password'],

        ]);

        toastr()->success('Thêm mới người dùng thành công');

        return redirect('users');
    }

    public function edit(String $id): View
    {
        $user = User::getUserById($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();

        $user = User::getUserById($id);

         $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'is_admin' => $data['is_admin'],
             'password'=> Hash::make($data['password']),

        ]);

        toastr()->success('Cập nhật thông tin người dùng ' . $user->name  . ' thành công');

        return redirect('users');
    }

    public function updatePassword(Request $request, string $id): RedirectResponse
    {
        $user = User::getUserById($id);

        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        toastr()->success('Cập nhật mật khẩu người dùng ' . $user->name  . ' thành công');

        return redirect('users');
    }

    public function destroy(string $id): RedirectResponse
    {
        $user = User::getUserById($id);

        $user->delete();

        toastr()->success('Xóa người dùng ' . $user->name  . ' thành công');

        return redirect('users')->with('status', 'Category deleted successfully');
    }
}
