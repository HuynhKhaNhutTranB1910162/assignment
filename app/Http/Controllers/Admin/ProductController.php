<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class ProductController extends Controller
{
    use ImageTrait;

    public int $itemPerPage = 10;

    public function index(): View
    {
        $products = Product::query()
            ->orderByDesc('created_at')
            ->paginate($this->itemPerPage);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(CreateProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        $product = Product::query()->create([
            'name' => $data['name'],
            'stock' => $data['stock'],
            'sku' => $data['sku'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
        ]);

        toastr()->success('Thêm mới sản phẩm thành công');

        return redirect('products');
    }

    public function edit(string $id): View
    {
        $product = Product::getProductById($id);

        $categories = Category::all();

        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $product = Product::getProductById($id);

        if (! $request->hasFile('image')) {
            $data['image'] = $product->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $product->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $product->query()->update([
            'name' => $data['name'],
            'stock' => $data['stock'],
            'sku' => $data['sku'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
        ]);

        toastr()->success('Cập nhật sản phẩm ' . $product->name . ' thành công');

        return redirect('products');
    }

    public function destroy(string $id): RedirectResponse
    {
        $product = Product::getProductById($id);

        $image = 'storage/' . $product->image;

        $this->deleteImage($image);

        $product->delete();

        toastr()->success('Xóa sản phẩm thành công');

        return redirect('products');
    }
}
