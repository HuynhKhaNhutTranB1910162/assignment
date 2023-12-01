<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        return view('client.order.index', compact('categories'));
    }

    public function review(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'reviews' => 'nullable',
        ]);

        $order = Order::getOrderById($id);

        $order->update([
            'reviews' => $data['reviews'],
        ]);

        toastr()->success('Cập nhật đơn hàng thành công');

        return redirect()->back();
    }
}
