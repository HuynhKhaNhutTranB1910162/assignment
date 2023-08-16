<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public int $itemPerPage = 2;
    public function index(): View
    {
        $categories = Category::all();
        $services = Service::orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('client.service.index', compact('services', 'categories'));
    }

    public function showDetail(string $id): View
    {
        $categories = Category::all();
        $service = Service::getServiceById($id);

        return view('client.service.detail', compact('categories', 'service'));
    }

}
