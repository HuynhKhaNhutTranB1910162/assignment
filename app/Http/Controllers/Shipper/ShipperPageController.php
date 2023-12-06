<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipper;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShipperPageController extends Controller
{
    use ImageTrait;

    public int $itemPerPage = 10;
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

        return redirect('shipperList');
    }

    public function pending(): View
    {
        $orders = Order::where('shipper_id', Auth::guard('shipper')->user()->id)->get();

        return view('shipper.status.pending',compact('orders'));
    }

    public function accepted(): View
    {
        $orders = Order::where('shipper_id', Auth::guard('shipper')->user()->id)->get();

        return view('shipper.status.accepted',compact('orders'));
    }

    public function cancel(): View
    {
        $orders = Order::where('shipper_id', Auth::guard('shipper')->user()->id)->get();

        return view('shipper.status.cancel',compact('orders'));
    }

    public function success(): View
    {
        $orders = Order::where('shipper_id', Auth::guard('shipper')->user()->id)->get();

        return view('shipper.status.success',compact('orders'));
    }

    public function refund(): View
    {
        $orders = Order::where('shipper_id', Auth::guard('shipper')->user()->id)->get();

        return view('shipper.status.refund',compact('orders'));
    }
}
