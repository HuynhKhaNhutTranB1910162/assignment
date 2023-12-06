@extends('shipper.layouts.app')
@section('title', 'Quản lý đơn hàng')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Danh sách đơn hàng
            </h2>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Mã đơn hàng</th>
                            <th class="px-4 py-3">Giá</th>
                            <th class="px-4 py-3">Trạng thái</th>
                            <th class="px-4 py-3">Ngày thêm</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                        </thead>
                        @foreach( $orders as $item)
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
                                                    {{ CurrencyHelper::format($item->total) }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    @if($item->shipper_status === 'pending')
                                        <td class="px-4 py-3 text-xs">
                                            <span style="background-color: #F7D0EC" class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Chờ xác nhận</span>
                                        </td>
                                    @elseif($item->shipper_status === 'cancel')
                                        <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                          Bị Từ chối
                                        </span>
                                        </td>
                                    @elseif($item->shipper_status === 'accepted')
                                        <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                          Đã nhận đơn
                                        </span>
                                        </td>
                                    @elseif($item->shipper_status === 'success')
                                        <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-indigo-700 dark:text-indigo-100">
                                            Giao thành công
                                        </span>
                                        </td>
                                    @elseif($item->shipper_status === 'refund')
                                        <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                            Giao thất bại
                                        </span>
                                        </td>
                                    @else
                                        <td class="px-4 py-3 text-xs">
                                            <p></p>
                                        </td>
                                    @endif
                                    <td class="px-4 py-3 text-sm">
                                        {{ $item->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">
                                            <a class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" href="{{ route('shipperPage.edit', ['id' => $item->id]) }}">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
{{--                    {{ $orders->links('shipper.pagination.index') }}--}}
                </div>
            </div>
        </div>
    </main>
@endsection
