<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProductController extends Controller
{
    public int $itemPerPage = 10;
    public function index(): View
    {
        return view('client.product.index');
    }

    public function showDetail(string $id): View
    {
        $categories = Category::all();
        $product = Product::getProductById($id);
        $productRelated = Product::all()->take(4);
        return view('client.product.detail', compact('categories', 'productRelated', 'product'));
    }

    public function addToCart(Request $request, int $productId): RedirectResponse
    {
        $data = $request->validate([
            'qty' => ['nullable', 'int', 'min:1']
        ]);

        if (! Auth::check()) {
            toastr()->warning('Đăng nhập trước khi sử dụng dịch vụ');
            return redirect('login');
        }

        if (Cart::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {
            toastr()->warning('Sản phẩm đã có trong giỏ hàng.');
            return redirect()->back();
        }

        $product = Product::getProductById($productId);

        if ($data['qty']) {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $data['qty'],
            ]);

            toastr()->success('Thêm sản phẩm' . $product->name . 'vào giỏ hàng thành công');

            return redirect()->back();
        }

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'quantity' => 1,
        ]);

        toastr()->success('Thêm sản phẩm' . $product->name . 'vào giỏ hàng thành công');

        return redirect()->back();
    }
}
