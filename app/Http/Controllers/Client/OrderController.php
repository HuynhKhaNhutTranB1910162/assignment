<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        if (Auth::check()) {
            $order = Order::where('user_id', Auth::user()->id)->get();
            $addresses = Address::where('user_id', Auth::user()->id)->get();
            return view('client.order.index', compact('categories', 'order','addresses'));
        }
        return view('client.order.index', compact('categories'));

    }
}
