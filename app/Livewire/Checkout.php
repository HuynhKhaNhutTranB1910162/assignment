<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Checkout extends Component
{
    public $cartProducts, $total, $totalCurrencyExchange;

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
            return redirect()->route('order');
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

        Cart::where('user_id', Auth::user()->id)->delete();

        return redirect()->route('client');
    }

    public function render(): View
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::user()->id)->get();

            $addresses = Address::where('user_id', Auth::id())->get();
            return view('livewire.checkout',
                [
                    'cart' => $cart,
                    'addresses' => $addresses,
                ]);
        }
    }
}
