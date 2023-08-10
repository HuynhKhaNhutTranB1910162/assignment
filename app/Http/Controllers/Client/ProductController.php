<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $products = Product::all();
        return view('client.product.index', compact('categories','products'));
    }

    public function showDetail(string $id): View
    {
        $categories = Category::all();
        $product = Product::getProductById($id);
        $productRelated = Product::all();
        return view('client.product.detail' , compact('categories' , 'productRelated', 'product'));
    }
}
