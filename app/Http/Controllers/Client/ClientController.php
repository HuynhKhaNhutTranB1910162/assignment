<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServicePackage;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $banners = Banner::all();
        $categories = Category::all();
        $services = Service::all()->take(4);
        $servicePackages = ServicePackage::all();

        return view('client.home.home', compact('banners', 'categories', 'services', 'servicePackages'));
    }
}
