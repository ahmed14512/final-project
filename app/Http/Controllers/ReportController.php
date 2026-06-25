<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request){
            
            $range = $request->get('range','month');
        
            $startDate = match($range){
                'today' => Carbon::today(),
                'week' => Carbon::now()->startOfWeek(),
                'month' => Carbon::now()->startOfMonth(),
                'all' => Carbon::createFromTimestamp(0),
                default => Carbon::now()->startOfMonth(),
            };

            $orders = Order::where('created_at', '>=', $startDate)->get();

            //summary
            $totalSales = $orders->sum('total');
            $totalOrders = $orders->count();
            $avgOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;

            return view('admin.reports.index', compact(
            'range',
            'totalSales',
            'totalOrders',
            'avgOrderValue'
        ));

    }
}
