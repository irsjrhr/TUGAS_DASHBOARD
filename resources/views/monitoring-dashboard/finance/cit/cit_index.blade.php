@extends('layouts.app')
@section('titlepage', 'PBT Dashboard')

@section('content')
@section('navigasi')
<span>PBT Dashboard</span>
@endsection

@php
$asset_dashboard = asset('assets/img/icons/dashboard/');
@endphp

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/cit.css')}}">
<div class="row">   
    <div class="col-12">
        <div class="container-fluid">
            {{-- Row Box Dashboard --}}
            <div class="row row_box_dashboard">
                @for ($i = 0; $i < 5; $i++)
                <div class="col-sm-4 col_box_dashboard">
                    <div class="box_dashboard">

                        <div class="logo">
                            <img src="{{asset($asset_dashboard)}}/car.png">
                        </div>
                        <div class="content">
                            <h4>
                                Total Orders
                            </h4>
                            <h2>
                                2367
                            </h2>
                        </div>
                    </div>

                </div>
                @endfor
            </div>
            {{-- End Of Row Box Dashboard --}}
            <div class="row row_box_grafik">

                <div class="col-sm-5 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="bar_chart" width="500" height="350"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5 col_box_grafik">
                    <div class="box_grafik">
                        <div class="card_header">
                            <p> Total Orders </p>
                        </div>
                        <div class="card_body">
                            <canvas id="pie_chart" width="500" height="350"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
 // Warna keren untuk chart
    const purpleColor = '#836AF9',
    yellowColor = '#ffe800',
    cyanColor = '#28dac6',
    orangeColor = '#FF8132',
    oceanBlueColor = '#299AFF';

// Ambil konteks canvas
    const ctx = document.getElementById('bar_chart').getContext('2d');

// Gradient background untuk dataset
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, purpleColor);
    gradient.addColorStop(1, cyanColor);

    const myChart = new Chart(ctx, {
    type: 'bar', // Bisa diganti line, pie, doughnut
    data: {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
            label: 'Monthly Sales',
            data: [12, 19, 3, 5, 2],
            backgroundColor: [
                purpleColor,
                yellowColor,
                cyanColor,
                orangeColor,
                oceanBlueColor
            ],
            borderColor: '#fff',
            borderWidth: 2,
            borderRadius: 8, // Membuat batang chart membulat
            barPercentage: 0.6, // Lebar batang
            hoverBackgroundColor: gradient // Gradient saat hover
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            tooltip: {
                enabled: true,
                backgroundColor: '#333',
                titleFont: { size: 14, weight: 'bold' },
                bodyFont: { size: 12 }
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: { size: 13 }
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: '#e0e0e0'
                },
                ticks: {
                    font: { size: 13 }
                }
            }
        },
        animation: {
            duration: 1500,
            easing: 'easeOutQuart'
        }
    }
});

</script>


@endsection
