<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
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

        $orders = Order::where('created_at', '>=', $startDate)->get();

        $totalSales    = $orders->sum('total');
        $totalOrders   = $orders->count();
        $avgOrderValue = $totalOrders > 0
                         ? $totalSales / $totalOrders
                         : 0;

        return view('admin.reports.index', compact(
            'range',
            'totalSales',
            'totalOrders',
            'avgOrderValue'
        ));
    }
}