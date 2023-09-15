<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public int $itemPerPage = 5;

    public function index(): View
    {
        $orders = Order::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.orders.index', compact('orders'));
    }

    public function edit(string $id): View
    {
        $order = Order::getOrderById($id);
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();
        return view('admin.orders.edit', compact('order','orderProducts'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'in:pending,accepted,inDelivery,success,cancel,refund',
        ]);
        $order = Order::getOrderById($id);

        $order->update([
            'status' => $data['status'],
        ]);

        if ($order->status == 'cancel'){

            $orderProducts = OrderProduct::where('order_id', $order->id)->get();

            foreach ($orderProducts as $orderProduct){
                OrderProduct::updated([
                    'quantity' => $orderProduct->quantity,
                ]);
                $findProduct = Product::getProductById($orderProduct->product->id);

                $findProduct->update([
                    'stock' => $findProduct->stock + $orderProduct->quantity,
                ]);
            }
        }
        toastr()->success('Cập nhật trạng thái thành công');

        return redirect('orders');
    }
}
