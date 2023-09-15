@extends('admin.layouts.app')
@section('title', ' Chi tiết đơn hàng')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Chi tiết đơn hàng
            </h2>
            <div class="grid gap-6 mb-8 md:grid-cols-2">
                <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                    <h6 class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Tên khách hàng: {{ $order->user_name }}</h6>
                    <h6 class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Số điện thoại: {{ $order->phone }}</h6>
                    <h6 class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Địa chỉ: </h6>
                    <p class="text-gray-600 dark:text-gray-400"> {{ $order->shipping_address }} </p>
                </div>
                <div class="min-w-0 p-4 text-white  rounded-lg shadow-xs dark:bg-gray-800">

                    <h4 class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Ngày đặt hàng : {{ $order->created_at->format('g:i A') }}
                        {{$order->created_at->format('d')}} - {{$order->created_at->format('m')}} -
                        {{$order->created_at->format('Y')}}</h4>
                    <h5  class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Trạng thái :
                        @if($order->status === 'pending')
                            Đang chờ duyệt
                        @elseif($order->status === 'accepted')
                            Đã được duyệt
                        @elseif($order->status === 'inDelivery')
                            Đang vận chuyển
                        @elseif($order->status === 'success')
                            Thành công
                        @elseif($order->status === 'cancel')
                            Hủy bỏ
                        @else
                            Hoàn tiền
                        @endif
                    </h5>
                    <h5  class="mb-4 font-semibold text-gray-500 dark:text-gray-300">Mã đơn hàng : {{ $order->tracking_number }}</h5>
                    <p class="text-gray-600 dark:text-gray-400">Tổng tiền đơn hàng :  {{ CurrencyHelper::format($order->total) }}</p>
                </div>
            </div>
            <form action="" method="POST">
                @csrf
                @method('PUT')
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <!-- Helper text -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Tên sản phẩm</th>
                                    <th class="px-4 py-3">Mã hàng</th>
                                    <th class="px-4 py-3">Số lượng</th>
                                    <th class="px-4 py-3">Giá</th>
                                    <th class="px-4 py-3">thành tiền</th>
                                </tr>
                                </thead>
                                @foreach($orderProducts as $key => $orderProduct)

                                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <tr class="text-gray-700 dark:text-gray-400">
                                        <td class="px-4 py-3 text-sm">
                                            {{ $key + 1}}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                    <img class="object-cover w-full h-full rounded-full" src="{{ asset('storage/' . $orderProduct->product->image) }}" loading="lazy" alt="{{ $orderProduct->product->name }}">
                                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                </div>
                                                <div>
                                                    <p class="font-semibold"> {{ $orderProduct->product->name }}</p>
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                                        {{ $orderProduct->product->category->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p>
                                                        {{ $orderProduct->product->sku }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p>
                                                        {{ $orderProduct->quantity }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p>
                                                        {{ CurrencyHelper::format($orderProduct->purchase_price) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p>
                                                        {{ CurrencyHelper::format($orderProduct->purchase_price*$orderProduct->quantity) }}
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
            </form>
        </div>
        <div class="container px-6 mx-auto grid">
            <form action="{{ route('orders.update', ['id' => $order->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <!-- Helper text -->
                    <label class="block mt-4 text-sm">
                        <h6 class="my-6 text-2xl font-semibold text-gray-400 dark:text-gray-100" style="color:blueviolet">
                            Cập nhật trạng thái đơn hàng
                        </h6>
                        <select name="status" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            @switch($order->status)
                                @case('pending')
                                    <option value="pending" >Đang chờ duyệt</option>
                                @case('accepted')
                                    <option value="accepted">Đã được duyệt</option>
                                @case('inDelivery')
                                    <option value="inDelivery">Đang vận chuyển</option>
                                @case('success')
                                    <option value="success">Thành công</option>
                                @case('cancel')
                                    <option value="cancel" >Hủy bỏ</option>
                                @case('refund')
                                    <option value="refund">Hoàn tiền</option>
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
