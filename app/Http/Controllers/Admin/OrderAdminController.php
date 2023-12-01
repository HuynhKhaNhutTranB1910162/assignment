<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Shipper;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public int $itemPerPage = 5;

    public function index(): View
    {
        $searchTerm = request()->query('searchTerm') ?? '';

        if (is_array($searchTerm)){
            $searchTerm = '';
        }
        $search = '%' . $searchTerm . '%';

        $orders = Order::where(function ($query) use ($search){
            $query->where('tracking_number', 'like',$search )
                ->orwhere('id', 'like',$search );
        })->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.orders.index', compact('orders'));
    }

    public function edit(string $id): View
    {
        $order = Order::getOrderById($id);
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();
        $shippers = Shipper::all();
        return view('admin.orders.edit', compact('order','orderProducts','shippers'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'in:pending,accepted,inDelivery,success,cancel,refund',
            'shipper_id' => 'nullable',
        ]);
        $order = Order::getOrderById($id);

        if ($order->status == 'accepted'){
            $order->update([
                'status' => $data['status'],
                'shipper_id' => $data['shipper_id'],
                'shipper_status' => 'pending',
            ]);
        }

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
