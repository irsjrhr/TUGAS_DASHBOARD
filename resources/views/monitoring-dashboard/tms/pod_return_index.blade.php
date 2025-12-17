@extends('layouts.app')
@section('titlepage', 'POD Return Summary')

@section('content')
@section('navigasi')
    <span>POD Return → Summary</span>
@endsection

<style>
    .kpi-card {
        border-radius: 12px;
        background: white;
        padding: 18px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        margin-bottom: 15px;
    }
    .kpi-title { font-size: 0.9rem; font-weight: 600; color: #555; }
    .kpi-value { font-size: 1.6rem; font-weight: 700; color: #0d6efd; }
</style>

{{-- ====================== FILTER BAR ====================== --}}
<div class="card p-3 mb-4 shadow-sm">
    <h5 class="fw-bold">🎯 Filters</h5>

    <form class="row g-3 mt-2">
        <div class="col-md-3">
            <label class="form-label fw-bold">Date</label>
            <input type="date" class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label fw-bold">Region</label>
            <select class="form-select" multiple>
                @foreach ($regions as $r)
                    <option value="{{ $r->region }}">{{ $r->region }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-bold">Branch</label>
            <select class="form-select" multiple>
                @foreach ($branches as $b)
                    <option value="{{ $b->territory_code }}">{{ $b->branch_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100 fw-bold">Apply Filter</button>
        </div>
    </form>
</div>

{{-- ====================== SUMMARY KPI CARDS ====================== --}}
<h4 class="fw-bold mb-3">📌 Summary KPI</h4>

<div class="row">
    {{-- Group 1 --}}
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Orders</div><div class="kpi-value">{{ number_format($summaryData['TotalOrder']) }}</div></div></div>
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Amount</div><div class="kpi-value">{{ number_format($summaryData['AmountOrder']) }}</div></div></div>

    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Assigned PI</div><div class="kpi-value">{{ number_format($summaryData['TotalPlannedOrder']) }}</div></div></div>
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Amount Assigned PI</div><div class="kpi-value">{{ number_format($summaryData['AmountPlannedOrder']) }}</div></div></div>

    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">% Assigned PI</div><div class="kpi-value">{{ $summaryData['PlannedOrderRatio'] }}%</div></div></div>

    {{-- Group 2 --}}
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Document Rejection</div><div class="kpi-value">{{ number_format($summaryData['TotalRejectedOrder']) }}</div></div></div>
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Amount PI Rejection</div><div class="kpi-value">{{ number_format($summaryData['AmountRejectedOrder']) }}</div></div></div>
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Quantity Rejection</div><div class="kpi-value">{{ number_format($summaryData['TotalQtyRejected']) }}</div></div></div>

    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Outlet with Rejection</div><div class="kpi-value">{{ number_format($summaryData['TotalRejectingOutlet']) }}</div></div></div>
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">% Rejection Document</div><div class="kpi-value">{{ $summaryData['RejectedCountRatio'] }}%</div></div></div>

    {{-- Group 3 --}}
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Document Rejection (Not GR)</div><div class="kpi-value">{{ number_format($summaryData['total_doc_reject_not_gr'] ?? 0) }}</div></div></div>
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Amount Rejection (Not GR)</div><div class="kpi-value">{{ number_format($summaryData['total_amount_reject_not_gr'] ?? 0) }}</div></div></div>
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Quantity Rejection (Not GR)</div><div class="kpi-value">{{ number_format($summaryData['total_qty_reject_not_gr'] ?? 0) }}</div></div></div>

    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">Total Outlet with Rejection (Not GR)</div><div class="kpi-value">{{ number_format($summaryData['total_outlet_reject_not_gr'] ?? 0) }}</div></div></div>
    <div class="col-md-3"><div class="kpi-card"><div class="kpi-title">% Rejection (Not GR)</div><div class="kpi-value">{{ $summaryData['percent_reject_not_gr'] ?? 0 }}%</div></div></div>
</div>



{{-- ====================== REJECTION COUNT BY REASON CHART ====================== --}}
<div class="card p-3 mt-4 shadow-sm">
    <h5 class="fw-bold">📊 Rejection Count by Reason</h5>
    <canvas id="rejectionReasonChart" height="140"></canvas>
</div>



{{-- ====================== LINK TO REJECTION PAGE ====================== --}}
<div class="mt-4 text-end">
    <a href="/pod-return/rejection-analysis" class="btn btn-outline-primary fw-bold">
        Go to Rejection Analysis →
    </a>
</div>

@endsection



@push('myscript')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('rejectionReasonChart'), {
    type: 'bar',
    data: {
        labels: @json($rejectionByReason->pluck('reason')),
        datasets: [{
            label: 'Rejection Count',
            data: @json($rejectionByReason->pluck('total')),
            backgroundColor: '#ef4444'
        }]
    },
    options: {
        indexAxis: 'y',
        plugins: {
            legend: { display: false }
        },
        scales: {
            x: { beginAtZero: true }
        }
    }
});
</script>
@endpush
