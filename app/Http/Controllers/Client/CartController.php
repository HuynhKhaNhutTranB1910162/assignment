<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $carts = Cart::all();

        return view('client.cart.index', compact('categories', 'carts'));
    }

    public function update(Request $request, String $id): RedirectResponse
    {
        $data = $request->validate([
            'qty' => ['nullable', 'int', 'min:1']
        ]);
        $carts = Cart::getCartById($id);

        $carts->update([
             'quantity' => $data['qty'],
         ]);

        toastr()->success('Cap nhat so luong vào giỏ hàng thành công');

        return redirect('cart');
    }

    public function destroy(string $id): RedirectResponse
    {

        $carts = Cart::getCartById($id);

        $carts->delete();

        toastr()->success('Xóa thành công san pham');

        return redirect('cart-product');
    }

}
