@extends('admin.layouts.app')
@section('title', 'Thêm nhân viên giao hàng')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Thêm nhân viên giao hàng
            </h2>
            <form action="{{ route('shippers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <!-- Helper text -->
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Tên người dùng
                        </span>
                        <input name="name" value="{{ old('name') }}" type="text" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm tên người dùng " >
                        @error('name')
                        <span class="text-xs text-red-600" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Email
                        </span>
                        <input name="email" value="{{ old('email') }}" type="email" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm email người dùng " >
                        @error('email')
                        <span class="text-xs text-red-600" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Phone
                        </span>
                        <input name="phone" value="{{ old('phone') }}" type="tel" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm số điện thoại" >
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
                        <input type="file" name="image" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm giá sản phẩm" >
                        @error('image')
                        <span class="text-xs text-red-600" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                          Password
                        </span>
                        <div class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400">
                            <input name="password" value="{{ old('password') }}" type="password" id="password" class="block w-full pr-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm mật khẩu">
                            <label class="flex items-center dark:text-gray-400">
                                <input id="showHidePassword" type="checkbox" class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                <span class="ml-2">
                                    show password
                                </span>
                            </label>
                        </div>
                        @error('password')
                        <span class="text-xs text-red-600" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <br>
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Thêm
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        const password = document.getElementById('password')
        const showHidePwd = document.getElementById('showHidePassword')

        showHidePwd.onclick = () => {
            showHidePassword()
        }

        const showHidePassword = () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            showHidePwd.textContent = (type === 'password') ? 'Show password' : 'Hide password';
        }
    </script>
@endsection
