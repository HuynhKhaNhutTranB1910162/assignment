<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shipper\CreateShipperRequest;
use App\Http\Requests\Shipper\UpdatedShipperRequest;
use App\Models\Shipper;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShipperController extends Controller
{
    use ImageTrait;
    public int $itemPerPage = 5;

    public function index(): View
    {
        $shippers = Shipper::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.shippers.index', compact('shippers'));
    }

    public function create(): View
    {
        return view('admin.shippers.create');
    }

    public function store(CreateShipperRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        Shipper::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'image' => $data['image'],
            'password' => Hash::make($data['password']),
        ]);

        toastr()->success('Thêm mới nhân viên giao hàng thành công');

        return redirect('shippers');
    }

    public function edit(String $id): View
    {
        $shipper = Shipper::getShipperById($id);

        return view('admin.shippers.edit', compact('shipper'));
    }

    public function update(UpdatedShipperRequest $request, $id): RedirectResponse
    {
        $data = $request->validated();

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
            'email' => $data['email'],
            'phone' => $data['phone'],
            'image' => $data['image'],
        ]);

        toastr()->success('Cập nhật thông tin người dùng ' . $shipper->name  . ' thành công');

        return redirect('shippers');
    }

    public function updatePassword(Request $request, string $id): RedirectResponse
    {
        $shipper = shipper::getShipperById($id);

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

        toastr()->success('Cập nhật mật khẩu người dùng ' . $shipper->name  . ' thành công');

        return redirect('shippers');
    }

    public function destroy(string $id): RedirectResponse
    {
        $shipper = Shipper::getShipperById($id);

        $image = 'storage/' . $shipper->image;

        $this->deleteImage($image);

        $shipper->delete();

        toastr()->success('Xóa người dùng ' . $shipper->name  . ' thành công');

        return redirect('shippers');
    }

}
