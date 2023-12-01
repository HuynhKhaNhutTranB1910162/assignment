<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $newOrders = Order::where('status', 'pending')->count();

        $allOrders = Order::all()->count();
        $successOrders = Order::where('status', 'success')->count();

        $bounceRate = round(($successOrders / $allOrders), 2) * 100;

        $userCount = User::all()->count();

        $monthlyRevenue = Order::getMonthlyRevenue();

        $date = Carbon::now();
        $month = $date->month;

        return view('admin.home.home',
            compact('newOrders','bounceRate','userCount','monthlyRevenue','month'));
    }


}
