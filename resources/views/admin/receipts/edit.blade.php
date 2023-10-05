@extends('admin.layouts.app')
@section('title', 'Thêm phiếu nhập')
@section('content')
    <main class="h-full pb-16 overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200" style="color:blueviolet">
                Thêm phiếu nhập
            </h2>
            <form action="{{ route('receipt.update',['id'=>$receipt->id]) }}" method="POST" >
                @csrf
                @method('PUT')
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
                                        <input type="number" value="{{$receiptProduct->price}}" name="price[]"  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input">
                                        @error('price')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <input type="number" value="{{$receiptProduct->stock}}" name="stock[]" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input">
                                        @error('stock')
                                        <span class="text-danger" role="alert">
                                             <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
                <br>
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Mô tả</span>
                        <textarea name="notes" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" rows="3" placeholder="Mô tả sản phẩm.">{{ $receipt->notes }}</textarea>
                    </label>
                    <div class="mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Trạng thái
                        </span>
                        <div class="mt-2">
                            <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="status" value="pending" {{ $receipt->status == 'pending' ? 'checked' : '' }}>
                                <span class="ml-2">Chưa duyệt</span>
                            </label>
                            <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                <input type="radio" class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="status" value="accepted" {{ $receipt->status == 'accepted' ? 'checked' : '' }}>
                                <span class="ml-2">Đã duyệt</span>
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
                        Chỉnh sửa
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
