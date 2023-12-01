<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class chartController extends Controller
{
    public function getChartOnlyMonth()
    {
        $startDate = Carbon::parse()->startOfMonth();
        $endDate = Carbon::parse()->endOfMonth();

        $query = Order::orderBy('created_at')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'success')
            ->select('created_at', 'total');

        $revenueData = $query->get();

        $labels = $revenueData->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('d/m/y H:i');
        })->toArray();
        $data = $revenueData->pluck('total')->toArray();

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function filterGetChartOnlyMonth(Request $request)
    {
        $validator =$request->validate( [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
        ]);

        $startDate = $validator['startDate'];
        $endDate = $validator['endDate'];

        $query = Order::orderBy('created_at')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'success')
            ->select('created_at', 'total');

        $revenueData = $query->get();

        $labels = $revenueData->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('d/m/y H:i');
        })->toArray();
        $data = $revenueData->pluck('total')->toArray();

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function chartTopSellingProducts()
    {

        $currentMonth = date('m'); // Tháng hiện tại
        $currentYear = date('Y'); // Năm hiện tại

        $revenueProduct = OrderProduct::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('product_id, COUNT(*) as totalSold')
            ->groupBy('product_id')
            ->orderBy('totalSold', 'desc')
            ->limit(3)
            ->get();

        // Tổng số sản phẩm đã được bán trong tháng hiện tại
        $totalProductsSold = OrderProduct::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        foreach ($revenueProduct as $product) {
            $data[] = ($product->totalSold / $totalProductsSold) * 100;
            $labels[] = $product->product->name;
        }
        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function chartTopSellingProductOnlyMonth(Request $request)
    {
        $validator =$request->validate( [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
        ]);

        $startDate = $validator['startDate'];
        $endDate = $validator['endDate'];

        $revenueProduct = OrderProduct::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('product_id, COUNT(*) as totalSold')
            ->groupBy('product_id')
            ->orderBy('totalSold', 'desc')
            ->limit(3)
            ->get();

        $totalProductsSold = OrderProduct::whereBetween('created_at', [$startDate, $endDate])
            ->count();
        foreach ($revenueProduct as $product) {
            $data[] = ($product->totalSold / $totalProductsSold) * 100;
            $labels[] = $product->product->name;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function ChartStatusOrder()
    {
        $currentMonth = date('m'); // Tháng hiện tại
        $currentYear = date('Y'); // Năm hiện tại

        $revenueStatusOrder = Order::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('status, COUNT(*) as totalSold')
            ->groupBy('status')
            ->orderBy('totalSold', 'desc')
            ->get();

        $totalStatusSold = Order::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
        foreach ($revenueStatusOrder as $status) {
            $data[] = ($status->totalSold / $totalStatusSold) * 100;
            $labels[] = $status->status;
        }
        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

    public function chartStatusOrderOnlyMonth(Request $request)
    {
        $validator =$request->validate( [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
        ]);

        $startDate = $validator['startDate'];
        $endDate = $validator['endDate'];

        $revenueStatusOrder = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('status, COUNT(*) as totalSold')
            ->groupBy('status')
            ->orderBy('totalSold', 'desc')
            ->get();

        $totalStatusSold = Order::whereBetween('created_at', [$startDate, $endDate])
            ->count();
        foreach ($revenueStatusOrder as $status) {
            $data[] = ($status->totalSold / $totalStatusSold) * 100;
            $labels[] = $status->status;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }

}
