<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        if (! Auth::check()) {
            toastr()->warning('Đăng nhập trước khi sử dụng dịch vụ');
            return redirect('login');
        }
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('client.cart.index', compact('categories', 'carts'));
    }

    public function update(Request $request, String $id): RedirectResponse
    {
        $data = $request->validate([
            'qty' => ['nullable', 'int', 'min:1']
        ]);

        $carts = Cart::getCartByUserId($id);

        $carts->update([
             'quantity' => $data['qty'],
         ]);

        toastr()->success('Cập nhật số lượng vào giỏ hàng thành công');

        return redirect('cart');
    }

    public function destroy(string $id): RedirectResponse
    {

        $carts = Cart::getCartByUserId($id);

        $carts->delete();

        toastr()->success('Xóa thành công sản phẩm');

        return redirect('cart');
    }

}
