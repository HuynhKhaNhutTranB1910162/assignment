<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public int $itemPerPage = 3;
    public function index(): View
    {
        $categories = Category::all();
        $products = Product::query()
            ->orderByDesc('created_at')
            ->paginate($this->itemPerPage);
        return view('client.product.index', compact('categories', 'products'));
    }

    public function showDetail(string $id): View
    {
        $categories = Category::all();
        $product = Product::getProductById($id);
        $productRelated = Product::all();
        return view('client.product.detail', compact('categories', 'productRelated', 'product'));
    }
}
