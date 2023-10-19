<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipper;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShipperPageController extends Controller
{
    public function index(): View
    {
        return view('shipper.home.home');
    }

    public function list(): View
    {
        $orders = Order::where('shipper_id', Auth::guard('shipper')->user()->id)->get();

        return view('shipper.orders.index',compact('orders'));
    }

    public function edit(string $id): View
    {
        $order = Order::getOrderById($id);
        $orderProducts = OrderProduct::where('order_id', $order->id)->get();
        $shippers = Shipper::all();
        return view('shipper.orders.edit', compact('order','orderProducts','shippers'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'shipper_status' => 'in:pending,accepted,cancel,success,refund',
        ]);
        $order = Order::getOrderById($id);

        $order->update([
            'shipper_status' => $data['shipper_status'],
        ]);

        if($order->shipper_status == 'accepted')
        {
            $order->update([
                'status' => 'inDelivery',
            ]);
        }

        if($order->shipper_status == 'success')
        {
            $order->update([
                'status' => 'success',
            ]);
        }

        toastr()->success('Cập nhật trạng thái thành công');

        return redirect('shipperPage');
    }

}
