@extends('layouts.app')
@section('titlepage', 'PBT Dashboard')

@section('content')
@section('navigasi')
<span>PBT Dashboard</span>
@endsection

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm mb-3">
            <div class="card-body">

            {{-- ===================== Filters ===================== --}}
            <form action="{{ route('dashboard.pbt.index') }}" method="GET"
                class="d-flex flex-wrap align-items-end gap-3 mb-4">

                {{-- MONTH FILTER --}}
                <div>
                    <label class="small text-muted fw-bold">Month</label>
                    <select name="month" class="form-control form-control-sm">
                        <option value="">YTD</option>
                        @foreach ($months as $m)
                            <option value="{{ $m }}"
                                    {{ request('month', $selectedMonth) == $m ? 'selected' : '' }}>
                                {{ $m }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- REGION FILTER --}}
                <div>
                    <label class="small text-muted fw-bold">Region</label>
                    <select name="region" class="form-control form-control-sm">
                        <option value="">All</option>
                        @foreach ($regions as $r)
                            <option value="{{ explode(' ', $r->region)[1] }}"
                                {{ request('region') == explode(' ', $r->region)[1] ? 'selected' : '' }}>
                            {{ $r->region }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- LOCATION FILTER --}}
                <div>
                    <label class="small text-muted fw-bold">Location</label>
                    <select name="location" class="form-control form-control-sm">
                        <option value="">All</option>
                        @foreach ($locations as $loc)
                            <option value="{{ $loc->location }}"
                                    {{ request('location') == $loc->location ? 'selected' : '' }}>
                                {{ $loc->location }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- BRANCH FILTER --}}
                <div>
                    <label class="small text-muted fw-bold">Branch</label>
                    <select name="branch" class="form-control form-control-sm">
                        <option value="">All</option>
                        @foreach ($branches as $b)
                            <option value="{{ $b->territory_code }}"
                                    {{ request('branch') == $b->territory_code ? 'selected' : '' }}>
                                {{ $b->branch_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- VIEW BY FILTER --}}
                <div>
                    <label class="small text-muted fw-bold">View By</label>
                    <select name="viewBy" class="form-control form-control-sm">
                        <option value="idr" {{ request('viewBy', 'idr') === 'idr' ? 'selected' : '' }}>
                            IDR
                        </option>
                        <option value="percent" {{ request('viewBy') === 'percent' ? 'selected' : '' }}>
                            Percentage
                        </option>
                    </select>
                </div>

                {{-- RESET BUTTON --}}
                <div class="mt-2">
                    <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm">
                        <i class="ti ti-refresh me-1"></i> Reset
                    </a>
                </div>

                {{-- APPLY BUTTON --}}
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="ti ti-filter me-1"></i> Apply
                    </button>
                </div>

            </form>
            {{-- ===================== METRIC THRESHOLD ===================== --}}
                @if(!empty($targets) && count($targets) > 0)
                <h6 class="fw-bold text-primary mb-3">📌 Target Score</h6>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle text-center small">
                        <thead class="table-light">
                            <tr>
                                @foreach($targets as $t)
                                    <th>{{ $t->Type }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($targets as $t)
                                    <td>{{ number_format($t->Value, 2) }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br>
                @endif

                {{-- ===================== PBT SUMMARY TABLE ===================== --}}
                <h5 class="fw-bold text-primary mb-3">📊 PBT Summary</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle small">
                        <thead class="table-light">
                            <tr>
                               @foreach($headers as $col)
                                    <th>{{ $col }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    @foreach($row as $cell)
                                        <td class="
                                            {{ $cell['status'] === 'pass' ? 'table-success' : '' }}
                                            {{ $cell['status'] === 'fail' ? 'table-danger' : '' }}
                                            text-end
                                        ">
                                            {{ $cell['is_numeric']
                                                ? number_format($cell['value'], 2)
                                                : $cell['value']
                                            }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 