@extends('admin.layouts.app')
@section('title', 'Cập nhật tư vấn khách hàng')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Cập nhật tư vấn khách hàng
            </h2>
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Tên người dùng
                        </span>
                        <input name="name" value="{{ $appointment->name }}" type="text" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm tên người dùng " >
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Số điện thoại
                        </span>
                        <input name="email" value="{{ $appointment->phone }}" type="email" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm email người dùng " >
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Email
                        </span>
                        <input name="email" value="{{ $appointment->email }}" type="email" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input" placeholder="Thêm email người dùng " >
                    </label>
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Chú thích
                        </span>
                        <textarea class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3">{{ $appointment->notes }}</textarea>
                    </label>
                </div>
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Cập nhật trạng thái
            </h2>
            <form action="{{ route('appointment.update', ['id' => $appointment->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <!-- Helper text -->
                    <label class="block mt-4 text-sm">
                        <select name="status" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            @switch($appointment->status)
                                @case('pending')
                                    <option value="pending" >Đang chờ duyệt</option>
                                @case('success')
                                    <option value="success" >Thành công</option>
                                @case('cancel')
                                    <option value="cancel">Hủy bỏ</option>
                                    @break
                            @endswitch
                        </select>
                    </label>
                    <br>
                    <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        cập nhật
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
