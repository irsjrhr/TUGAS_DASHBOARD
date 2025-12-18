@extends('layouts.app')
@section('titlepage', 'CIT Dashboard')

@section('content')
@section('navigasi')
<span>CIT Dashboard</span>
@endsection

@php
$asset_dashboard = asset('assets/img/icons/dashboard/');



//Cashier Driver
$row_cashier_driver = $datasets[0][0]; //card

$row_ar_remaining = $datasets[1][0]; //card
$data_teritory = $datasets[2]; //Tabel
$data_sales = $datasets[3]; //Tabel
$data_customer = $datasets[4]; //Tabel
$data_payment = $datasets[5]; //Tabel
$data_uncollectible = $datasets[6]; //Tabel
$data_transaction = $datasets[7]; //Tabel

@endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/cit.css')}}">

<div class="row">   



    {{-- Col_container_data - row_cashier_driver --}}
    <div class="col-12 col_container_data type_data" id="row_cashier_driver">

        <div class="title_type_data">
            Summary Driver Cashier
        </div>

        <div class="container-fluid">
            {{-- Row Box Dashboard  --}}
            <div class="row row_box_dashboard">

                {{-- Col Box Dashboard --}}
                <div class="col-sm-5 col_box_dashboard">
                    <div class="box_dashboard">
                        <div class="logo">
                            <img src="{{asset($asset_dashboard)}}/car.png">
                        </div>
                        <div class="content">
                            <h4>
                                Driver Claimed
                            </h4>
                            <h4>
                                {{ $row_cashier_driver['driver_claimed_amount'] }}

                            </h4>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Dashboard --}}

                {{-- Col Box Dashboard --}}
                <div class="col-sm-5 col_box_dashboard">
                    <div class="box_dashboard">
                        <div class="logo">
                            <img src="{{asset($asset_dashboard)}}/car.png">
                        </div>
                        <div class="content">
                            <h4>
                                Cashier Confirmed
                            </h4>
                            <h4>
                                {{ $row_cashier_driver['cashier_confirmed_amount'] }}

                            </h4>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Dashboard --}}
                {{-- Col Box Dashboard --}}
                <div class="col-sm-5 col_box_dashboard">
                    <div class="box_dashboard">
                        <div class="logo">
                            <img src="{{asset($asset_dashboard)}}/car.png">
                        </div>
                        <div class="content">
                            <h4>
                                Total Difference
                            </h4>
                            <h4>
                                {{ $row_cashier_driver['total_difference'] }}

                            </h4>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Dashboard --}}
                {{-- Col Box Dashboard --}}
                <div class="col-sm-5 col_box_dashboard">
                    <div class="box_dashboard">
                        <div class="logo">
                            <img src="{{asset($asset_dashboard)}}/car.png">
                        </div>
                        <div class="content">
                            <h4>
                                Confirmation Rate PCT
                            </h4>
                            <h4>
                                {{ $row_cashier_driver['confirmation_rate_pct'] }}

                            </h4>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Dashboard --}}

            </div>
            {{-- End Of Row Box Dashboard --}}
            <div class="row row_box_grafik">

                {{-- Col Box Grafik - Trend Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="trendChart" style="height: 300px !important; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Trend Chart --}}


                {{-- Col Box Grafik - Cluster Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="clusterChart" style="height: 300px; max-height: 300px; display: block; box-sizing: border-box; width: 892px;" width="1338" height="450"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Cluster Chart --}}
            </div>

        </div>
    </div>
    {{-- End Of Col_container_data - row_cashier_driver --}}


    {{-- Col_container_data - row_ar_remaining --}}
    <div class="col-12 col_container_data type_data" id="row_ar_remaining">

        <div class="title_type_data">
            Summary AR Remaining
        </div>

        <div class="container-fluid">
            {{-- Row Box Dashboard  --}}
            <div class="row row_box_dashboard">

                {{-- Col Box Dashboard --}}
                <div class="col-sm-5 col_box_dashboard">
                    <div class="box_dashboard">
                        <div class="logo">
                            <img src="{{asset($asset_dashboard)}}/car.png">
                        </div>
                        <div class="content">
                            <h4>
                                AR Remaining Real
                            </h4>
                            <h4>
                                {{ $row_ar_remaining['remaining_ar_real'] }}

                            </h4>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Dashboard --}}

                {{-- Col Box Dashboard --}}
                <div class="col-sm-5 col_box_dashboard">
                    <div class="box_dashboard">
                        <div class="logo">
                            <img src="{{asset($asset_dashboard)}}/car.png">
                        </div>
                        <div class="content">
                            <h4>
                                Overdue PCT
                            </h4>
                            <h4>
                                {{ $row_ar_remaining['overdue_pct'] }}

                            </h4>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Dashboard --}}
            </div>
            {{-- End Of Row Box Dashboard --}}
            <div class="row row_box_grafik">

                {{-- Col Box Grafik - Trend Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="trendChart" style="height: 300px !important; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Trend Chart --}}


                {{-- Col Box Grafik - Cluster Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="clusterChart" style="height: 300px; max-height: 300px; display: block; box-sizing: border-box; width: 892px;" width="1338" height="450"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Cluster Chart --}}
            </div>

        </div>
    </div>
    {{-- End Of Col_container_data - row_cashier_driver --}}


    {{-- Col_container_data - data_teritory --}}
    <div class="col-12 col_container_data type_data" id="data_teritory">

        <div class="title_type_data">
            Summary Per Territory 
        </div>

        <div class="container-fluid">
            {{-- Row Table --}}
            <div class="row row_table">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle small">
                            <thead class="table-light">
                                <tr>
                                    @foreach ($data_teritory[0] as $key => $kolom )
                                    <td>{{ $key }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_teritory as $row_data)
                                <tr>
                                    @foreach ($data_teritory[0] as $key2=>$kolom)
                                    <td> {{$row_data[ $key2 ]}}  </td>
                                    @endforeach
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Of Row Table --}}

            <div class="row row_box_grafik">

                {{-- Col Box Grafik - Trend Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="trendChart" style="height: 300px !important; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Trend Chart --}}


                {{-- Col Box Grafik - Cluster Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="clusterChart" style="height: 300px; max-height: 300px; display: block; box-sizing: border-box; width: 892px;" width="1338" height="450"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Cluster Chart --}}
            </div>

        </div>
    </div>
    {{-- End Of Col_container_data - data_teritory --}}

    {{-- Col_container_data - data_sales --}}
    <div class="col-12 col_container_data type_data" id="data_sales">

        <div class="title_type_data">
            Sales/Driver Performance 
        </div>

        <div class="container-fluid">
            {{-- Row Table --}}
            <div class="row row_table">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle small">
                            <thead class="table-light">
                                <tr>
                                    @foreach ($data_sales[0] as $key => $kolom )
                                    <td>{{ $key }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_sales as $row_data)
                                <tr>
                                    @foreach ($data_sales[0] as $key2=>$kolom)
                                    <td> {{$row_data[ $key2 ]}}  </td>
                                    @endforeach
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Of Row Table --}}

            <div class="row row_box_grafik">

                {{-- Col Box Grafik - Trend Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="trendChart" style="height: 300px !important; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Trend Chart --}}


                {{-- Col Box Grafik - Cluster Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="clusterChart" style="height: 300px; max-height: 300px; display: block; box-sizing: border-box; width: 892px;" width="1338" height="450"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Cluster Chart --}}
            </div>

        </div>
    </div>
    {{-- End Of Col_container_data - data_sales --}}


    {{-- Col_container_data - data_customer --}}
    <div class="col-12 col_container_data type_data" id="data_customer">

        <div class="title_type_data">
            Customer Level Data 
        </div>

        <div class="container-fluid">
            {{-- Row Table --}}
            <div class="row row_table">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle small">
                            <thead class="table-light">
                                <tr>
                                    @foreach ($data_customer[0] as $key => $kolom )
                                    <td>{{ $key }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_customer as $row_data)
                                <tr>
                                    @foreach ($data_customer[0] as $key2=>$kolom)
                                    <td> {{$row_data[ $key2 ]}}  </td>
                                    @endforeach
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Of Row Table --}}

            <div class="row row_box_grafik">

                {{-- Col Box Grafik - Trend Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="trendChart" style="height: 300px !important; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Trend Chart --}}


                {{-- Col Box Grafik - Cluster Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="clusterChart" style="height: 300px; max-height: 300px; display: block; box-sizing: border-box; width: 892px;" width="1338" height="450"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Cluster Chart --}}
            </div>

        </div>
    </div>
    {{-- End Of Col_container_data - data_customer --}}


    {{-- Col_container_data - data_payment --}}
    <div class="col-12 col_container_data type_data" id="data_payment">

        <div class="title_type_data">
            Payment Type Summary 
        </div>

        <div class="container-fluid">
            {{-- Row Table --}}
            <div class="row row_table">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle small">
                            <thead class="table-light">
                                <tr>
                                    @foreach ($data_payment[0] as $key => $kolom )
                                    <td>{{ $key }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_payment as $row_data)
                                <tr>
                                    @foreach ($data_payment[0] as $key2=>$kolom)
                                    <td> {{$row_data[ $key2 ]}}  </td>
                                    @endforeach
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Of Row Table --}}

            <div class="row row_box_grafik">

                {{-- Col Box Grafik - Trend Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="trendChart" style="height: 300px !important; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Trend Chart --}}


                {{-- Col Box Grafik - Cluster Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="clusterChart" style="height: 300px; max-height: 300px; display: block; box-sizing: border-box; width: 892px;" width="1338" height="450"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Cluster Chart --}}
            </div>

        </div>
    </div>
    {{-- End Of Col_container_data - data_payment --}}

    {{-- Col_container_data - data_uncollectible --}}
    <div class="col-12 col_container_data type_data" id="data_uncollectible">

        <div class="title_type_data">
            Uncollectible Reason  
        </div>

        <div class="container-fluid">
            {{-- Row Table --}}
            <div class="row row_table">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle small">
                            <thead class="table-light">
                                <tr>
                                    @foreach ($data_uncollectible[0] as $key => $kolom )
                                    <td>{{ $key }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_uncollectible as $row_data)
                                <tr>
                                    @foreach ($data_uncollectible[0] as $key2=>$kolom)
                                    <td> {{$row_data[ $key2 ]}}  </td>
                                    @endforeach
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- End Of Row Table --}}

            <div class="row row_box_grafik">

                {{-- Col Box Grafik - Trend Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="trendChart" style="height: 300px !important; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Trend Chart --}}


                {{-- Col Box Grafik - Cluster Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="clusterChart" style="height: 300px; max-height: 300px; display: block; box-sizing: border-box; width: 892px;" width="1338" height="450"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Cluster Chart --}}
            </div>

        </div>
    </div>
    {{-- End Of Col_container_data - data_uncollectible --}}

    {{-- Col_container_data - data_transaction --}}
    <div class="col-12 col_container_data type_data" id="data_transaction">

        <div class="title_type_data">
            Transaction Level Detail  
        </div>

        <div class="container-fluid">
            {{-- Row Table --}}
            <div class="row row_table">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle small">
                            <thead class="table-light">
                                <tr>
                                    @foreach ($data_transaction[0] as $key => $kolom )
                                    <td>{{ $key }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 0; $i++)

                                $row_data = $data_transaction[$i];
                                <tr>
                                    @foreach ($data_transaction[0] as $key2=>$kolom)
                                    <td> {{$row_data[ $key2 ]}}  </td>
                                    @endforeach
                                </tr>
                                @endfor

                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
            {{-- End Of Row Table --}}

            <div class="row row_box_grafik">

                {{-- Col Box Grafik - Trend Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="trendChart" style="height: 300px !important; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Trend Chart --}}


                {{-- Col Box Grafik - Cluster Chart --}}
                <div class="col-sm-6 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="clusterChart" style="height: 300px; max-height: 300px; display: block; box-sizing: border-box; width: 892px;" width="1338" height="450"></canvas>
                        </div>
                    </div>
                </div>
                {{-- End Of Col Box Grafik - Cluster Chart --}}
            </div>

        </div>
    </div>
    {{-- End Of Col_container_data - data_transaction --}}



</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

<script>
    $(document).ready(function(){
      new WOW().init();

  });
</script>

@endsection



@push('myscript')



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script src="{{ asset('assets/js/utils/number-format-abbreviated.js') }}"></script>
<script src="{{ asset('assets/js/pages/sales-dashboard/clustered-chart.js') }}"></script>
<script src="{{ asset('assets/js/pages/sales-dashboard/trend-chart.js') }}"></script>

<script>
    Chart.register(ChartDataLabels);


    var data_trend = [
      {
        "MonthKey": "1",
        "MonthText": "January",
        "TotalSales": "667141635479.21"
    },
    {
        "MonthKey": "2",
        "MonthText": "February",
        "TotalSales": "646778277594.78"
    },
    {
        "MonthKey": "3",
        "MonthText": "March",
        "TotalSales": "693333377625.68"
    },
    {
        "MonthKey": "4",
        "MonthText": "April",
        "TotalSales": "537692109245.22"
    },
    {
        "MonthKey": "5",
        "MonthText": "May",
        "TotalSales": "624414443945.20"
    },
    {
        "MonthKey": "6",
        "MonthText": "June",
        "TotalSales": "608695829413.95"
    },
    {
        "MonthKey": "7",
        "MonthText": "July",
        "TotalSales": "676782374866.96"
    },
    {
        "MonthKey": "8",
        "MonthText": "August",
        "TotalSales": "635098683814.36"
    },
    {
        "MonthKey": "9",
        "MonthText": "September",
        "TotalSales": "718862864914.46"
    },
    {
        "MonthKey": "10",
        "MonthText": "October",
        "TotalSales": "679722144264.60"
    },
    {
        "MonthKey": "11",
        "MonthText": "November",
        "TotalSales": "682075572779.17"
    },
    {
        "MonthKey": "12",
        "MonthText": "December",
        "TotalSales": "333893520968.28"
    }];
    var data_cluster = [
      {
        DistChannel: "GT",
        TotalSales: "5059867721513.94",
        TotalReturns: "140827245129.13",
        ReturnRatio: "2.780000"
    },
    {
        DistChannel: "MTKA",
        TotalSales: "1024778116373.00",
        TotalReturns: "60042571777.00",
        ReturnRatio: "5.860000"
    },
    {
        DistChannel: "LMT",
        TotalSales: "1042486955014.93",
        TotalReturns: "51441384099.46",
        ReturnRatio: "4.930000"
    },
    {
        DistChannel: "MT",
        TotalSales: "194428036197.00",
        TotalReturns: "3125005738.00",
        ReturnRatio: "1.610000"
    },
    {
        DistChannel: "FS",
        TotalSales: "127464530863.00",
        TotalReturns: "542897425.00",
        ReturnRatio: "0.430000"
    },
    {
        DistChannel: "LD",
        TotalSales: "52281751191.00",
        TotalReturns: "399394945.00",
        ReturnRatio: "0.760000"
    },
    {
        DistChannel: "IT",
        TotalSales: "3183723759.00",
        TotalReturns: "2782314.00",
        ReturnRatio: "0.090000"
    }];
    trendChart("trendChart", data_trend);
    clusteredChart(
        "clusterChart",
        data_cluster.map(x => x.DistChannel),
        data_cluster.map(x => x.TotalSales),
        data_cluster.map(x => x.TotalReturns)
        );

    </script>


    @endpush