@extends('admin.layouts.app')
@section('title', 'Quản lý phiếu nhập')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Danh sách đơn hàng
            </h2>
            <div>
                <button @click="openModal" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Thêm sản phẩm để tạo phiếu
                </button>
            </div>
            <form action="{{ route('receipts.addReceipt') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div
                    x-show="isModalOpen"
                    class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                    <!-- Modal -->
                    <div
                        x-show="isModalOpen"
                        @click.away="closeModal"
                        @keydown.escape="closeModal"
                        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                        role="dialog"
                        id="modal"
                    >
                        <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                        <header class="flex justify-end">
                            <a
                                class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                                aria-label="close"
                                @click="closeModal"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    role="img"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                        fill-rule="evenodd"
                                    ></path>
                                </svg>
                            </a>
                        </header>
                        <!-- Modal body -->
                        <div class="mt-4 mb-6">
                            <!-- Modal title -->
                            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                Danh sách sản phẩm
                            </p>
                            <!-- Modal description -->
                            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full whitespace-no-wrap">
                                        <thead>
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Ảnh sản phẩm</th>
                                            <th class="px-4 py-3">Giá</th>
                                            <th class="px-4 py-3">Số lượng</th>
                                            <th class="px-4 py-3"></th>
                                        </tr>
                                        </thead>
                                        @foreach($products as $product)
                                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                            <img
                                                                class="object-cover w-full h-full rounded-full"
                                                                src="{{ asset('storage/' . $product->image) }}" loading="lazy" alt="{{ $product->name }}"/>
                                                            <div
                                                                class="absolute inset-0 rounded-full shadow-inner"
                                                                aria-hidden="true"></div>
                                                        </div>
                                                        <div>
                                                            <p class="font-semibold">{{ $product->name }}</p>
                                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                                {{ $product->category->name }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    {{ CurrencyHelper::format($product->original_price) }}
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    {{ $product->stock }}
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <input type="checkbox" name="options[]" value="{{$product->id}}">
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                    {{ $products->links('admin.pagination.index') }}
                                </div>
                            </div>
                        </div>
                        <footer
                            class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
                        >
                            <button type="submit" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Thêm vào phiếu nhập
                            </button>
                        </footer>
                    </div>
                </div>
            </form>
            <br>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Mã phiếu nhập</th>
                            <th class="px-4 py-3">Người nhập</th>
                            <th class="px-4 py-3">Tổng tiền</th>
                            <th class="px-4 py-3">Trạng thái</th>
                            <th class="px-4 py-3">Ngày nhập</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                        </thead>
                        @foreach( $receipts as $item)
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{$item->id}}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="">
                                                {{ $item->tracking_number }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="">
                                                {{ $item->admin->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="">
                                                {{ CurrencyHelper::format($item->total) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                @if($item->status == 'accepted')
                                    <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                          Đã được duyệt
                                        </span>
                                    </td>
                                @else
                                    <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                            Chưa được duyệt
                                        </span>
                                    </td>
                                @endif
                                <td class="px-4 py-3 text-sm">
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        @if($item->status == 'pending')
                                            <a class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" href="{{ route('receipts.edit', ['id' => $item->id]) }}">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </a>
                                            <a class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" href="{{ route('receipt.delete', ['id' => $item->id]) }}">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        @else
                                            <a class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" href="{{ route('receipt.show', ['id' => $item->id]) }}">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                    {{ $receipts->links('admin.pagination.index') }}
                </div>
            </div>
        </div>
    </main>
@endsection
