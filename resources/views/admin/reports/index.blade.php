@extends('adminlte::page')

@section('title', 'Reports')

@section('content_header')
    <h1>Sales Report</h1>
@endsection

@section('content')

    {{-- Filter buttons — printable should hide this --}}
    <div class="card no-print">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div class="btn-group">
                <a href="{{ route('admin.reports.index', ['range' => 'today']) }}"
                    class="btn {{ $range == 'today' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Today
                </a>
                <a href="{{ route('admin.reports.index', ['range' => 'week']) }}"
                    class="btn {{ $range == 'week' ? 'btn-primary' : 'btn-outline-primary' }}">
                    This Week
                </a>
                <a href="{{ route('admin.reports.index', ['range' => 'month']) }}"
                    class="btn {{ $range == 'month' ? 'btn-primary' : 'btn-outline-primary' }}">
                    This Month
                </a>
                <a href="{{ route('admin.reports.index', ['range' => 'all']) }}"
                    class="btn {{ $range == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">
                    All Time
                </a>
            </div>

            <button onclick="window.print()" class="btn btn-secondary">
                <i class="fas fa-print me-1"></i> Print / Download PDF
            </button>

        </div>
    </div>

    {{-- Printable report area --}}
    <div id="printArea">

        <div class="text-center mb-4 print-only">
            <h2>SmartPickz — Sales Report</h2>
            <p class="text-muted">
                Period:
                @switch($range)
                    @case('today')
                        Today
                    @break

                    @case('week')
                        This Week
                    @break

                    @case('month')
                        This Month
                    @break

                    @case('all')
                        All Time
                    @break
                @endswitch
                &nbsp;|&nbsp; Generated on {{ now()->format('M d, Y h:i A') }}
            </p>
        </div>

        {{-- Summary cards --}}
        <div class="row">
            <div class="col-md-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>Rs. {{ number_format($totalSales) }}</h3>
                        <p>Total Sales</p>
                    </div>
                    <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Rs. {{ number_format($avgOrderValue, 2) }}</h3>
                        <p>Average Order Value</p>
                    </div>
                    <div class="icon"><i class="fas fa-chart-line"></i></div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style>
        .print-only {
            display: none;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            .print-only {
                display: block !important;
            }

            .main-sidebar,
            .app-header,
            .app-footer,
            .content-header {
                display: none !important;
            }

            .app-main {
                margin-left: 0 !important;
            }
        }
    </style>
@endsection
