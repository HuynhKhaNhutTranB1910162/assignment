<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\ReceiptProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    public int $itemPerPage = 5;
    public int $itemPerPageproduct = 4;

    public function index(): View
    {
        $receipts = Receipt::query()
            ->orderByDesc('created_at')->paginate($this->itemPerPage);
        $products = Product::query()->orderByDesc('created_at')->paginate($this->itemPerPageproduct);
        return view('admin.receipts.index', compact('receipts','products'));
    }

    public function create(): View
    {
        $products = Product::query()->orderByDesc('created_at')->paginate($this->itemPerPageproduct);

        return view('admin.receipts.create' ,compact('products'));
    }

    public function addReceipt(Request $request)
    {
        $product_ids = $request->input('options', []);

        $data = json_encode($product_ids);

        session()->put('san_pham', $data);

        return redirect('/show-receipt');
    }

    public function getReceiptProduct()
    {
        $data = json_decode(session()->get('san_pham'));

        if ($data) {
            $products = Product::whereIn('id', $data)->get();
            return view('admin.receipts.show', compact('products'));
        }

        return redirect()->back();
    }

    public function addQtyAndPrice(Request $request)
    {
        $quantity = $request->input('quantity', []);
        $price = $request->input('price', []);
        $product = json_decode(session()->get('san_pham'));

        $data = [
            'quantity' => $quantity,
            'price' => $price,
            'san_pham' => $product,
        ];

        $matchedData = [];
        foreach ($data['san_pham'] as $index => $sanPham) {
            $matchedData[] = [
                'quantity' => $data['quantity'][$index],
                'price' => $data['price'][$index],
                'san_pham' => $sanPham
            ];
        }

        $amount = 0;
        foreach ($matchedData as $product) {
            $amount += $product['quantity'] * $product['price'];
        }
        $notes = $request->input('notes');

        $receipt = Receipt::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'total' => $amount,
            'notes' => $notes,
            'tracking_number' => Str::random(16),
        ]);

        foreach ($matchedData as $product) {
            ReceiptProduct::create([
                'receipt_id' => $receipt->id,
                'product_id' => $product['san_pham'],
                'stock' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }

        session()->forget('san_pham');
        toastr()->success('Thêm mới phiếu nhập thành công');
        return redirect()->route('receipts');
    }

    public function edit(string $id): View
    {
        $receipt = Receipt::getReceiptById($id);

        $receiptProducts = ReceiptProduct::where('receipt_id', $receipt->id)->get();

        return view('admin.receipts.edit', compact('receipt','receiptProducts'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'in:pending,accepted',
            'notes' => 'nullable',
        ]);

        $receipt = Receipt::getReceiptById($id);
        $receipt->update([
            'status' => $data['status'],
            'notes' => $data['notes'],
        ]);

        if ($receipt->status == 'accepted')
        {
            $receiptProducts = $receipt->receiptProduct;
            foreach ($receiptProducts as $detail)
            {
                $findProduct = Product::getProductById($detail->product_id);
                $findProduct->update([
                    'stock' => $findProduct->stock + $detail['stock'],
                ]);
            }
        }

        toastr()->success('Cập nhật phiếu nhập thành công');
        return redirect('receipts');
    }

    public function show(string $id): View
    {
        $receipt = Receipt::getReceiptById($id);

        $receiptProducts = ReceiptProduct::where('receipt_id', $receipt->id)->get();

        return view('admin.receipts.show-detail', compact('receipt','receiptProducts'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $receipt = Receipt::getReceiptById($id);

        $receiptProducts = $receipt->receiptProduct;
        foreach ($receiptProducts as $detail)
        {
            $detail->delete();
        }

        $receipt->delete();

        toastr()->success('Xóa phiếu nhập thành công');

        return redirect('receipts');
    }
}
