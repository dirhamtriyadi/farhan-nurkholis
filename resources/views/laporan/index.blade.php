@extends('templates.main')

@push('styles')
@endpush

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Laporan</h1>
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
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('laporan.index') }}">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="start_date">Tanggal Awal *</label>
                                                <div class="input-group date" id="start_date"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#start_date" name="start_date" required
                                                        value="{{ old('start_date') ? old('start_date') : $start_date }}" />
                                                    <div class="input-group-append" data-target="#start_date"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="end_date">Tanggal Akhir *</label>
                                                <div class="input-group date" id="end_date"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#end_date" name="end_date" required
                                                        value="{{ old('end_date') ? old('end_date') : $end_date }}" />
                                                    <div class="input-group-append" data-target="#end_date"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 align-content-center">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 align-content-center text-right">
                                {{-- <a href="{{ route('laporan.generate') }}" class="btn btn-sm btn-success">Print</a> --}}
                                <form action="{{ route('laporan.generate') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="start_date" value="{{ $start_date }}">
                                    <input type="hidden" name="end_date" value="{{ $end_date }}">
                                    <button type="submit" class="btn btn-sm btn-success">Print</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal</th>
                                    <th>Kuantitas</th>
                                    <th>Dibuat oleh</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['merge'] as $item => $i)
                                    <tr>
                                        <td>{{ $item + 1 }}</td>
                                        <td>{{ $i->stockBarang->nama }}</td>
                                        <td>{{ $i->tanggal }}</td>
                                        <td>{{ $i->kuantitas }}</td>
                                        <td>{{ $i->createdBy->name ?? '' }}</td>
                                        <td>{{ $i->jenis }}</td>
                                        <td>{{ $i->keterangan }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('#start_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $('#end_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
    </script>
@endpush
