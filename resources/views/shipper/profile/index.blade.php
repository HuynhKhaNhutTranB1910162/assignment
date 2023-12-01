@extends('shipper.layouts.app')
@section('title', 'Hồ sơ cá nhân')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Tổng quan
        </h2>
        <div class="container grid px-6 mx-auto">
            <div class="grid gap-6 mb-8 md:grid-cols-2">
                <div class="min-w-0 p-4 text-white bg-purple-600 rounded-lg shadow-xs">
                    <div class="flex justify-center items-center">
                        <img src="{{ asset('storage/' . Auth::guard('shipper')->user()->image) }}" alt="Avatar" style="width: 100px;" class="rounded-full overflow-hidden">
                    </div>
                    <br>
                    <ul style="border-top: 1px solid #d7d7d7;border-bottom: 1px solid #d7d7d7;padding: 15px 0;margin-bottom: 26px;">
                        <li style="list-style: none;font-size: 16px;line-height: 40px;overflow: hidden;">
                            Tên người dùng <span style="font-weight: 700;float: right;">
                                {{ Auth::guard('shipper')->user()->name }}</span></li>
                        <li style="list-style: none;font-size: 16px;line-height: 40px;overflow: hidden;">
                            Email <span style="font-weight: 700;float: right;">
                                {{ Auth::guard('shipper')->user()->email }}</span></li>
                        <li style="list-style: none;font-size: 16px;line-height: 40px;overflow: hidden;">
                            Số điện thoại <span style="font-weight: 700;float: right;">
                                {{ Auth::guard('shipper')->user()->phone }}</span></li>
                    </ul>
                </div>
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                        Thay đổi thông tin
                    </h4>
                    <form action="{{ route('shipper.update',['id' => $shipper->id]) }} }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Tên người dùng
                        </span>
                            <input name="name" value="{{$shipper->name}}" type="text" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm tên người dùng " >
                            @error('name')
                            <span class="text-xs text-red-600" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </label>
                        <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Số điện thoại
                        </span>
                            <input name="phone" value="{{$shipper->phone}}" type="text" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm tên người dùng " >
                            @error('phone')
                            <span class="text-xs text-red-600" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </label>
                        <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Ảnh đại diện
                        </span>
                            <input type="file" name="image" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input">
                            @error('image')
                            <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </label>
                        <br>
                        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Cập nhật
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
            Cập nhật mật khẩu nhân viên giao hàng
        </h2>
        <form action="{{ route('shipper.update-password-profile', ['id' => $shipper->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Mật khẩu
                        </span>
                    <input name="current_password" type="password" id="current_password" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm mật khẩu" >
                    <label class="flex items-center dark:text-gray-400 mt-2">
                        <input id="showHidePassword" type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <span class="ml-2">
                                Hiển thị mật khẩu
                            </span>
                    </label>
                    @error('current_password')
                    <span class="text-xs text-red-600" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>
                <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Mật khẩu cập nhật
                        </span>
                    <input name="password" type="password" id="password" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm mật khẩu" >
                    <label class="flex items-center dark:text-gray-400 mt-2">
                        <input id="showHidePassword" type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        <span class="ml-2">
                                Hiển thị mật khẩu
                            </span>
                    </label>
                    @error('password')
                    <span class="text-xs text-red-600" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label>
                <br>
                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Cập nhật
                </button>
            </div>
        </form>
    </main>
@endsection
