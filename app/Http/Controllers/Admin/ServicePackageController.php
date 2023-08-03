<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicePackage\CreateServicePackageRequest;
use App\Http\Requests\ServicePackage\UpdateServicePackageRequest;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServicePackageController extends Controller
{
    use ImageTrait;
    public int $itemPerPage = 5;
    public function index(): View
    {
        $servicepackages = ServicePackage::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.servicepackages.index', compact('servicepackages'));
    }

    public function create(): View
    {
        $services = Service::all();

        return view('admin.servicepackages.create', compact('services'));
    }

    public function store(CreateServicePackageRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        if (! empty($request->input('selling_price'))) {
            $data['selling_price'] = $request->input('selling_price');
        } else {
            foreach ($data['service_ids'] as $id) {
                $service = Service::getServiceById($id);
                $data['selling_price'] += $service->selling_price;
            }
        }

        ServicePackage::query()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
        ]);

        toastr()->success('Thêm mới dịch vụ thành công');

        return redirect('service-packages');
    }

    public function edit(string $id): View
    {
        $services = Service::all();

        $servicepackage = ServicePackage::getServicePackageById($id);

        return view('admin.servicepackages.edit', compact('servicepackage','services'));
    }

    public function update(UpdateServicePackageRequest $request,string $id): RedirectResponse
    {
        $data = $request->validated();

        $servicepackage = ServicePackage::getServicePackageById($id);

        if (! $request->hasFile('image')) {
            $data['image'] = $servicepackage->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $servicepackage->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        if (!empty($request->input('selling_price'))) {
            $data['selling_price'] = $request->input('selling_price');
        } else {
            foreach ($data['service_ids'] as $id) {
                $service = Service::getServiceById($id);$data['selling_price'] += $service->selling_price;
            }
        }

        $servicepackage->update([
            'name' => $data['name'],
            'image' => $data['image'],
            'description' => $data['description'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
        ]);

        $servicepackage->services()->sync($data['service_ids']);

        toastr()->success('Cập nhật gói dịch vụ ' . $servicepackage->name . ' thành công');

        return redirect('service-packages');

    }

    public function destroy(string $id): RedirectResponse
    {
        $servicepackage = ServicePackage::getServicePackageById($id);

        $servicepackage->delete();

        toastr()->success('Xóa gói dịch vụ thành công');

        return redirect('service_packages');
    }
}
