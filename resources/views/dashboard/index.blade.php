@extends('templates.main')

@push('styles')
@endpush

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Blank Page</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('dashboard') }}">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="start_date">Tanggal Awal *</label>
                            <div class="input-group date" id="start_date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#start_date"
                                    name="start_date" required
                                    value="{{ old('start_date') ? old('start_date') : $start_date }}" />
                                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="end_date">Tanggal Akhir *</label>
                            <div class="input-group date" id="end_date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#end_date"
                                    name="end_date" required value="{{ old('end_date') ? old('end_date') : $end_date }}" />
                                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 align-content-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $data['stock_barang'] }}</h3>
                    <p>Stock Barang</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('stock-barang.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $data['barang_masuk'] }}</h3>
                    <p>Barang Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('barang-masuk.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $data['barang_keluar'] }}</h3>
                    <p>Barang Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('barang-keluar.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Bar Chart</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="chart">
                <canvas id="barChart"
                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('adminlte') }}/plugins/chart.js/Chart.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#start_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $('#end_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $.ajax({
                url: "{{ route('dashboard.chart') }}" + "?start_date={{ $start_date }}&end_date={{ $end_date }}",
                type: "GET",
                success: function(data) {
                    // console.log(data);
                    stock_barang = data.stock_barang;
                    barang_masuk = data.barang_masuk;
                    barang_keluar = data.barang_keluar;

                    var areaChartData = {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July',
                            'August', 'September', 'October', 'November', 'December'
                        ],
                        datasets: [
                            {
                                label: 'Barang Masuk',
                                backgroundColor: 'rgba(40, 167, 69, 0.9)',
                                borderColor: 'rgba(40, 167, 69, 0.8)',
                                pointRadius: false,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(40, 167, 69, 1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(40, 167, 69, 1)',
                                data: data.barang_masuk
                            },
                            {
                                label: 'Stock Barang',
                                backgroundColor: 'rgba(23, 162, 184, 0.9)',
                                borderColor: 'rgba(23, 162, 184, 0.8)',
                                pointRadius: false,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(23, 162, 184, 1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(23, 162, 184, 1)',
                                data: data.stock_barang
                            },
                            {
                                label: 'Barang Keluar',
                                backgroundColor: 'rgba(255, 193, 7, 0.9)',
                                borderColor: 'rgba(255, 193, 7, 0.8)',
                                pointRadius: false,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(255, 193, 7, 1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(255, 193, 7, 1)',
                                data: data.barang_keluar
                            },
                        ]
                    }

                    //-------------
                    //- BAR CHART -
                    //-------------
                    var barChartCanvas = $('#barChart').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    var temp0 = areaChartData.datasets[0]
                    var temp1 = areaChartData.datasets[1]
                    var temp2 = areaChartData.datasets[2]
                    barChartData.datasets[0] = temp1
                    barChartData.datasets[1] = temp0
                    barChartData.datasets[2] = temp2

                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        datasetFill: false
                    }

                    new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });
    </script>
@endpush
