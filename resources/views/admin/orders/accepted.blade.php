@extends('admin.layouts.app')
@section('title', 'Quản lý đơn hàng')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Danh sách đơn hàng
            </h2>
            <br>
            <div class="grid grid-flow-col auto-cols-max">
                <div class="flex justify-center flex-1 lg:mr-40">
                    <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                        <form method="GET">
                            <input
                                class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                                type="text"
                                name="searchTerm"
                                placeholder="Tìm kiếm đơn hàng"
                                aria-label="Search"/>
                            <button type="submit">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Mã đơn hàng</th>
                            <th class="px-4 py-3">Giá</th>
                            <th class="px-4 py-3">Trạng thái</th>
                            <th class="px-4 py-3">Trạng thái Shipper</th>
                            <th class="px-4 py-3">Ngày thêm</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                        </thead>
                        @foreach( $orders as $item)
                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                            @if($item->status =='accepted')
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
                                    @if($item->status === 'pending')
                                        <td class="px-4 py-3 text-xs">
                                            <span style="background-color: #F7D0EC" class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Đang chờ duyệt</span>
                                        </td>
                                    @elseif($item->status === 'accepted')

                                        <td class="px-4 py-3 text-xs">
                                            <span style="background-color: #FEFEC4" class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">Đã được duyệt</span>
                                        </td>
                                    @elseif($item->status === 'inDelivery')
                                        <td class="px-4 py-3 text-xs">
                                        <span style="background-color: #C4F2FE" class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                          Đang vận chuyển
                                        </span>
                                        </td>
                                    @elseif($item->status === 'success')
                                        <td class="px-4 py-3 text-xs">
                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-indigo-700 dark:text-indigo-100">Thành công</span>
                                        </td>
                                    @elseif($item->status === 'cancel')
                                        <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700">
                                          Hủy bỏ
                                        </span>
                                        </td>
                                    @else
                                        <td class="px-4 py-3 text-xs">
                                        <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                          Hoàn tiền
                                        </span>
                                        </td>
                                    @endif
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
                                            @if($item->status === 'success')
                                                <a class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" href="{{ route('orders.edit', ['id' => $item->id]) }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/></path>
                                                    </svg>
                                                </a>
                                            @else
                                                <a class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" href="{{ route('orders.edit', ['id' => $item->id]) }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        @endforeach
                    </table>
                    {{ $orders->links('admin.pagination.index') }}
                </div>
            </div>
        </div>
    </main>
@endsection
