@extends('admin.layouts.app')
@section('title', 'Cập nhật Sản Phẩm')
@section('content')

    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">

            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Cập nhật sản phẩm
            </h2>
            <form action="{{ route('products.update',['id' => $product->id]) }}" method="POST" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <!-- Helper text -->
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Tên danh mục
                        </span>
                        <input name="name" value="{{ $product->name }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm tên danh mục" >

                        @error('name')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Danh mục sản phẩm
                        </span>
                        <select name="category_id" value="{{ $product->category_id }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option>Chọn danh mục</option>
                            @foreach ($categories as $category )
                                <option value="{{ $category->id }}" @if($product->category->id === $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Mã sản phẩm
                        </span>
                        <input name="sku" value="{{ $product->sku }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm mã sản phẩm" >

                        @error('sku')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Số lượng sản phẩm
                        </span>
                        <input name="stock" value="{{ $product->stock }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm số lượng sản phẩm" >

                        @error('stock')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Giá
                        </span>
                        <input name="original_price" value="{{ $product->original_price }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm giá sản phẩm" >

                        @error('original_price')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Giá sale
                        </span>
                        <input name="selling_price" value="{{ $product->selling_price }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm giá sản phẩm" >

                        @error('selling_price')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Ảnh đại diện
                        </span>
                        <input type="file" name="image" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm giá sản phẩm" >

                        @error('image')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                            <img class="h-auto max-w-lg rounded-lg" src="{{ asset('storage/' . $product->image) }}" loading="lazy" alt="{{ $product->name }}">
                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Mô tả</span>
                        <textarea name="description" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Enter some long form content.">{{ $product->description }}</textarea>
                    </label>
                    <br>
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </main>

@endsection


