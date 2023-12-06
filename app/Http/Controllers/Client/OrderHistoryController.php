<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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
        $orders = Order::where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('client.order.history', compact('categories','orders'));
    }

    public function pending(): View
    {
        $categories = Category::all();
        $orders = Order::where('user_id', Auth::user()->id)->where('status', 'pending')->get();
        return view('client.orderstatus.pending', compact('categories','orders'));
    }

    public function accepted(): View
    {
        $categories = Category::all();
        $orders = Order::where('user_id', Auth::user()->id)->where('status', 'accepted')->get();
        return view('client.orderstatus.accepted', compact('categories','orders'));
    }

    public function inDelivery(): View
    {
        $categories = Category::all();
        $orders = Order::where('user_id', Auth::user()->id)->where('status', 'inDelivery')->get();
        return view('client.orderstatus.inDelivery', compact('categories','orders'));
    }

    public function success(): View
    {
        $categories = Category::all();
        $orders = Order::where('user_id', Auth::user()->id)->where('status', 'success')->get();
        return view('client.orderstatus.success', compact('categories','orders'));
    }

    public function cancels(): View
    {
        $categories = Category::all();
        $orders = Order::where('user_id', Auth::user()->id)->where('status', 'cancel')->get();
        return view('client.orderstatus.cancel', compact('categories','orders'));
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
            OrderProduct::updated([
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

    public function thankyou()
    {
        $categories = Category::all();

        return view('client.order.thankyou', compact('categories'));
    }

    public function paymentCallback()
    {
        $message = 'Giao dịch thành công';
        $vnpSecureHash = request('vnp_SecureHash');
        $vnpHashSecret = config('services.VNPay.vnp_HashSecret');

        $inputData = array();
        foreach (request()->query() as $key => $value) {
            if (substr($key, 0, 4) == 'vnp_') {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = '';

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnpHashSecret);

        if ($secureHash != $vnpSecureHash) {
            return $message = 'Chữ ký không hợp lệ!';
        }

        if (request('vnp_ResponseCode') != '00') {
            return $message = 'Giao dịch không thành công!';
        }

        Order::where('tracking_number', request('vnp_TxnRef'))->update([
            'payment_status' => 'VNPAY'
        ]);

        return view('client.order.thankyou', [
            'message' => $message,
        ]);
    }
}
