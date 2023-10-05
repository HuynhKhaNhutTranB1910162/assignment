<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderHistoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('client.order.history', compact('categories','orders'));
    }

    public function detail(string $id): View
    {
        $categories = Category::all();
        $order = Order::getOrderById($id);
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();
        return view('client.order.detail', compact('categories','order','orderProducts'));
    }

    public function cancel(string $id): RedirectResponse
    {
        $categories = Category::all();

        $order = Order::getOrderById($id);
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();

        $order->update([
            'status' => 'cancel',
        ]);

        foreach ($orderProducts as $orderProduct){
            OrderProduct::update([
                'quantity' => $orderProduct->quantity,
            ]);
            $findProduct = Product::getProductById($orderProduct->product->id);

            $findProduct->update([
                'stock' => $findProduct->stock + $orderProduct->quantity,
            ]);
        }
        toastr()->success('Hủy đơn hàng thành công');

        return redirect()->back();
    }
}
