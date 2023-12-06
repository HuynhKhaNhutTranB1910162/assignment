<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductReview;
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
        $productRelated = OrderProduct::selectRaw('product_id, COUNT(*) as totalSold')
            ->groupBy('product_id')
            ->orderBy('totalSold', 'desc')
            ->limit(4)
            ->get();
        $productReview = ProductReview::where('product_id', $product->id)->get();
        $productRating = round(ProductReview::where('product_id', $product->id)->avg('rating'),1);

        $checkBought = false;

        if (Auth::user()) {
            $productIds = [];

            foreach (Auth::user()->orders as $order) {
                foreach ($order->orderProduct as $orderProduct) {
                    $productIds[] = $orderProduct->product_id;
                }
            }

            if(in_array($id, $productIds)) {
                $checkBought = true;
            }
        }

        return view('client.product.detail', compact('categories', 'productRelated', 'product','productReview','productRating','checkBought'));
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

        if ($data['qty'] > $product->stock) {
            toastr()->warning('Số lượng sản phẩm không đủ.');
            return redirect()->back();
        }

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

    public function addToFavorite(int $productId): RedirectResponse
    {
        if (! Auth::check()) {
            toastr()->warning('Đăng nhập trước khi sử dụng dịch vụ');
            return redirect('login');
        }

        if (Favorite::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {
            toastr()->warning('Bạn đã yêu thích sản phẩm.');
            return redirect()->back();
        }

        $product = Product::getProductById($productId);

        Favorite::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        toastr()->success('Thêm sản phẩm' . $product->name . 'vào yêu thích thành công');

        return redirect()->back();
    }


}
