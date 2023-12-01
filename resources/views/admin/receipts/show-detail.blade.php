@extends('admin.layouts.app')
@section('title', 'Thêm phiếu nhập')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Xem chi tiết phiếu nhập
            </h2>
            <div class="grid gap-6 mb-8 md:grid-cols-2">
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h6 class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Tên người lập: {{ $receipt->admin->name }}</h6>
                    <h6 class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Ghi chú: </h6>
                    <p class="text-gray-600 dark:text-gray-400"> {{ $receipt->notes }} </p>
                </div>
                <div class="min-w-0 p-4 text-white  rounded-lg shadow-xs dark:bg-gray-800">

                    <h4 class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Ngày đặt hàng : {{ $receipt->created_at->format('g:i A') }}
                        {{$receipt->created_at->format('d')}} - {{$receipt->created_at->format('m')}} -
                        {{$receipt->created_at->format('Y')}}</h4>
                    <h5  class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Trạng thái :
                        @if($receipt->status == 'pending')
                            Đang chờ duyệt
                        @else
                            Đã được duyệt
                        @endif
                    </h5>
                    <h5  class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Mã phiếu nhập : {{ $receipt->tracking_number }}</h5>
                    <p class="text-gray-600 dark:text-gray-400">Tổng tiền :  {{ CurrencyHelper::format($receipt->total) }}</p>
                </div>
            </div>
            <br>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Ảnh sản phẩm</th>
                            <th class="px-4 py-3">Giá</th>
                            <th class="px-4 py-3">Số lượng</th>
                            <th class="px-4 py-3">Tổng tiền</th>
                        </tr>
                        </thead>
                        @foreach($receiptProducts as $receiptProduct)
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <div class="flex items-center text-sm">
                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                            <img
                                                class="object-cover w-full h-full rounded-full"
                                                src="{{ asset('storage/' . $receiptProduct->product->image) }}" loading="lazy" alt="{{ $receiptProduct->product->name }}"/>
                                            <div
                                                class="absolute inset-0 rounded-full shadow-inner"
                                                aria-hidden="true">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $receiptProduct->product->name }}</p>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                {{ $receiptProduct->product->category->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="">
                                                {{ $receiptProduct->price }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="">
                                                {{ $receiptProduct->stock }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="">
                                                {{ CurrencyHelper::format($receiptProduct->price*$receiptProduct->stock) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
