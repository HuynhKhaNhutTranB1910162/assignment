<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        if (Auth::check()){
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('client.order.index', compact('categories', 'carts'));
        }
        return view('client.order.index', compact('categories'));
    }


}
