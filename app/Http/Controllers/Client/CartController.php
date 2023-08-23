<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        if (Auth::check()){
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('client.cart.index', compact('categories', 'carts'));
        }
        return view('client.cart.index', compact('categories'));

    }

    public function update(Request $request): JsonResponse
    { $data = $request->validate([
        'id' => ['required', 'integer'],
        'type' => ['required', 'in:inc,dec'],
    ]);

        $product = Cart::find($data['id']);

        if (! $product) {
            return response()->json([
                'message' => 'Not found product!',
            ]);
        }

        if ($data['type'] == 'inc') {
            $product->update([
                'quantity' => $product->quantity + 1,
            ]);

            return response()->json([
                'message' => 'success',
                'data' => $product,
            ]);
        }

        if ($data['type'] == 'dec') {
            if ($product->quantity >= 2) {
                $product->update([
                    'quantity' => $product->quantity - 1,
                ]);

                return response()->json([
                    'message' => 'success',
                    'data' => $product,
                ]);
            }
        }

        $product->delete();

        return response()->json([
            'message' => 'success',
            'data' => 'Delete product success!',
        ]);

//        toastr()->success('Cập nhật số lượng vào giỏ hàng thành công');
//
//        return redirect('cart');
    }

    public function destroy(string $id): RedirectResponse
    {

        $carts = Cart::getCartByUserId($id);

        $carts->delete();

        toastr()->success('Xóa thành công sản phẩm');

        return redirect('cart');
    }

}
