<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function comments(Request $request, string $id): RedirectResponse
    {

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required',
        ]);

        $product = Product::getProductById($id);

        ProductReview::create([
            'product_id' => $product->id,
            'user_id' => Auth::user()->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);

        toastr()->success('Bạn gửi đánh giá thành công');

        return redirect()->back();
    }
}
