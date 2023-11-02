<?php

namespace App\Livewire;

use App\Mail\OrderMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Checkout extends Component
{
    public $cartProducts, $total, $totalCurrencyExchange;

    public mixed $paymentType;

    public mixed $showTypePayment;

    public function updatedPaymentType()
    {
        $this->showTypePayment = $this->paymentType;
    }

    #[Rule('required')]
    public $addressId;

    #[Rule('nullable|max:1024')]
    public $notes;

    protected $messages = [
        'addressId.required' => 'Nhập địa chỉ của bạn',
        'notes.max' => 'Tối đa 1024 ký tự.',
    ];
    public function mount()
    {
        $user = Auth::user();
        $shippingAddresses = Address::where('user_id', $user->id)->get();

        if ($shippingAddresses->count() === 0) {
            toastr()->warning('Vui lòng thêm địa chỉ trước khi thanh toán.');
            return redirect()->back();
        }

        $cartProducts = Cart::where('user_id', $user->id)->get();
        $this->cartProducts = $cartProducts;
        $this->totalCurrencyExchange = 0;
        foreach ($cartProducts as $product) {
            $price = $product->product->selling_price !==Null ? $product->product->selling_price : $product->product->original_price;
            $this->total = $price * $product->quantity;
            $this->totalCurrencyExchange += $this->total;
        }
    }

    public function checkoutVNPAY()
    {
        $data = $this->validate();

        $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
        $vnp_Returnurl = 'https://assignment.com/order-paymentCallback';
        $vnp_TmnCode = config('services.VNPay.vnp_TmnCode');
        $vnp_HashSecret = config('services.VNPay.vnp_HashSecret');

        $vnp_TxnRef = Str::upper('ORG' . Str::random(15));
        $vnp_OrderInfo = 'Thanh toan don hang Spa shop';
        $vnp_OrderType = 210000;
        $vnp_Amount = $this->total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = request()->ip();
        $inputData = array(
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => 'pay',
            'vnp_CreateDate' => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_OrderType' => $vnp_OrderType,
            'vnp_ReturnUrl' => $vnp_Returnurl,
            'vnp_TxnRef' => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != '') {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != '') {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = '';
        $i = 0;
        $hashdata = '';
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . '=' . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . '=' . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . '=' . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . '?' . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $selectAddress = Address::where('id', $this->addressId)->firstOrFail();

        $userName = $selectAddress->user_name;
        $phone = $selectAddress->phone_number;
        $ward = $selectAddress->ward->name;
        $district = $selectAddress->district->name;
        $province = $selectAddress->province->name;
        $shippingAddresses = $ward . ', ' . $district . ', ' . $province;

        $order = Order::create([
            'notes' => $data['notes'],
            'user_id' => Auth::user()->id,
            'user_name' => $userName,
            'phone' => $phone,
            'tracking_number' => Str::upper('ORG' . Str::random(15)),
            'status' => 'pending',
            'shipping_address' => $shippingAddresses,
            'total' => $this->totalCurrencyExchange,
            'payment_status' => 'VNPAY',
        ]);

        foreach ($this->cartProducts as $product){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->product->id,
                'quantity' => $product->quantity,
                'purchase_price' => $product->product->selling_price,
            ]);
            $findProduct = Product ::getProductById($product->product->id);

            $findProduct->update([
                'stock' => $findProduct->stock - $product->quantity,
            ]);
        }

        return redirect($vnp_Url)->with([
            'code' => '00',
            'message' => 'success',
        ]);
    }

    public function codOrder()
    {
        $data = $this->validate();

        $selectAddress = Address::where('id', $this->addressId)->firstOrFail();

        $userName = $selectAddress->user_name;
        $phone = $selectAddress->phone_number;
        $ward = $selectAddress->ward->name;
        $district = $selectAddress->district->name;
        $province = $selectAddress->province->name;
        $shippingAddresses = $ward . ', ' . $district . ', ' . $province;

        $order = Order::create([
            'notes' => $data['notes'],
            'user_id' => Auth::user()->id,
            'user_name' => $userName,
            'phone' => $phone,
            'tracking_number' => Str::upper('ORG' . Str::random(15)),
            'status' => 'pending',
            'shipping_address' => $shippingAddresses,
            'total' => $this->totalCurrencyExchange,
            'payment_status' => 'COD',
        ]);

        foreach ($this->cartProducts as $product){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->product->id,
                'quantity' => $product->quantity,
                'purchase_price' => $product->product->selling_price,
            ]);
            $findProduct = Product ::getProductById($product->product->id);

            $findProduct->update([
                'stock' => $findProduct->stock - $product->quantity,
            ]);
        }

        Mail::to($order->user->email)->send(new OrderMail($order));
        Cart::where('user_id', Auth::user()->id)->delete();

        return redirect()->route('thankyou');
    }

    public function render()
    {
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            $addresses = Address::where('user_id', Auth::id())->get();

            foreach ($carts as $item) {
                if(! Product::where('id', $item->product_id)->where('stock', '>=', $item->quantity)->exists()) {
                    $removeItem = Cart::where('user_id', Auth::user()->id)->where('product_id', $item->product_id)->first();
                    $removeItem -> delete();
                }
            }
            $cartItems = Cart::where('user_id', Auth::user()->id)->get();
            return view('livewire.checkout',
                [
                    'cart' => $cartItems,
                    'addresses' => $addresses,
                ]);
        }
    }
}
