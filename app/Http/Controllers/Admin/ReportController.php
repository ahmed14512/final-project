<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $range = $request->get('range', 'month');

        $startDate = match($range) {
            'today' => Carbon::today(),
            'week'  => Carbon::now()->startOfWeek(),
            'month' => Carbon::now()->startOfMonth(),
            'all'   => Carbon::createFromTimestamp(0),
            default => Carbon::now()->startOfMonth(),
        };

        // All orders in selected period
        $orders = Order::where('created_at', '>=', $startDate)->get();

        // Summary cards
        $totalSales    = $orders->sum('total');
        $totalOrders   = $orders->count();
        $avgOrderValue = $totalOrders > 0
                         ? $totalSales / $totalOrders
                         : 0;

        // Top 5 products by revenue
        $topProducts = OrderItem::select(
                           'product_name',
                           DB::raw('SUM(quantity) as total_qty'),
                           DB::raw('SUM(price * quantity) as total_revenue')
                       )
                       ->whereHas('order', function($q) use ($startDate) {
                           $q->where('created_at', '>=', $startDate);
                       })
                       ->groupBy('product_name')
                       ->orderByDesc('total_revenue')
                       ->take(5)
                       ->get();

        return view('admin.reports.index', compact(
            'orders',
            'range',
            'totalSales',
            'totalOrders',
            'avgOrderValue',
            'topProducts'
        ));
    }
}