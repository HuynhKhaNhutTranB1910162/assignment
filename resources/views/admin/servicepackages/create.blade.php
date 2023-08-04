@extends('admin.layouts.app')
@section('title', 'Thêm gói dịch vụ')
@section('content')

    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">

            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Thêm gói dịch vụ
            </h2>
            <form action="{{ route('service-packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <!-- Helper text -->
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Tên gói dịch vụ
                        </span>
                        <input name="name" value="{{ old('name') }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm tên gói dịch vụ" >

                        @error('name')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Chọn dịch vụ
                        </span>
                        @foreach($services as $service)
                                <label class="flex items-center dark:text-gray-400">
                                    <input type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <span class="ml-2"> {{ $service->name }} ( {{ $service->original_price }} ) </span>
                                </label>
                        @endforeach
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Giá dịch vụ
                        </span>
                        <input type="number" name="original_price" value="{{ old('original_price') }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm giá dịch vụ" >

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
                        <input type="number" name="selling_price" value="{{old('selling_price')}}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm giá sản phẩm" >

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
                        <input type="file" name="image" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm giá sale" >

                        @error('image')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Mô tả</span>
                        <textarea name="description" value="{{ old('description') }}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Mô tả dịch vụ"></textarea>
                    </label>
                    <br>
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Thêm mới
                    </button>
                </div>
            </form>
        </div>
    </main>



@endsection
