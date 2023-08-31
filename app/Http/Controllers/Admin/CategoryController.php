<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public int $itemPerPage = 5;

    public function index(): View
    {
        $categories = Category::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {

        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $category = Category::query()->create([
                'name' => $data['name'],
            ]);
        toastr()->success('Thêm mới danh mục thành công');

        return redirect('categories');
    }

    public function edit(string $id): View
    {
        $categories = Category::getCategoryById($id);

        return view('admin.categories.edit', compact('categories'));
    }

    public function update(CategoryRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $category = Category::getCategoryById($id);

        $category->update([
            'name' => $data['name'],
        ]);
        toastr()->success('Cập nhật danh mục ' . $category->name  . ' thành công');

        return redirect('categories')->with('status', 'Category updated successfully');
    }
    public function destroy(string $id): RedirectResponse
    {
        $category = Category::getCategoryById($id);

        if ($category->products->count() > 0) {
            toastr()->warning('Vui lòng xóa các sản có trong danh mục này trước');

            return redirect('categories');
        }

        $category->delete();

        toastr()->success('Xóa danh mục ' . $category->name  . ' thành công');

        return redirect('categories');
    }
}
