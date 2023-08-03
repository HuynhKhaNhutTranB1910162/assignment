@extends('admin.layouts.app')
@section('title', 'Cập nhật trạng thái banner')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Thêm banner
            </h2>
            <form action="{{ route('banners.update',['id'=>$banner->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <!-- Helper text -->
                    <div class="mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Trạng thái
                        </span>
                        <div class="mt-2">
                            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="status" value="1" {{ $banner->status == 1 ? 'checked' : '' }}>
                                <span class="ml-2">Hiển thị</span>
                            </label>
                            <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="status" value="0" {{ $banner->status == 0 ? 'checked' : '' }}>
                                <span class="ml-2">Không hiển thị</span>
                            </label>
                            @error('status')
                            <span class="text-xs text-red-600" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Cập nhật trạng thái banner
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
