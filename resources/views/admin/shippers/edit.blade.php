@extends('admin.layouts.app')
@section('title', 'Cập nhật nhân viên giao hàng')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Cập nhật thông tin nhân viên giao hàng
            </h2>
            <form action="{{ route('shippers.update',['id' => $shipper->id]) }} }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Tên người dùng
                        </span>
                        <input name="name" value="{{ $shipper->name }}" type="text" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm tên người dùng " >
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
                        <input name="email" value="{{ $shipper->email }}" type="email" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm email người dùng " >
                        @error('email')
                        <span class="text-xs text-red-600" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Số điện thoại
                        </span>
                        <input name="phone" value="{{ $shipper->phone }}" type="tel" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm số điện thoại" >
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
                    <label class="block mt-4 text-sm">
                        <div class="relative h-32 w-32 ...">
                            <div class="absolute h-14 w-14 -left-4 -top-4 ...">
                                <button @click="closeModal" class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                                        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <img class="h-32 w-70" src="{{ asset('storage/' . $shipper->image) }}" loading="lazy">
                        </div>
                    </label>
                    <br>
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Cập nhật
                    </button>
                </div>
            </form>

            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Cập nhật mật khẩu người dùng
            </h2>
            <form action="{{ route('shippers.update-password', ['id' => $shipper->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Mật khẩu
                        </span>
                        <input name="current_password" type="password" id="password" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm mật khẩu" >
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
