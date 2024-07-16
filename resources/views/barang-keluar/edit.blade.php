@extends('templates.main')

@push('styles')
@endpush

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Barang Keluar</h1>
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
                    <h3 class="card-title">Edit Barang Keluar</h3>

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
                        <a href="{{ route('barang-keluar.index') }}" class="btn btn-sm btn-secondary"><i
                                class="fas fa-arrow-left"></i> Barang Keluar</a>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('barang-keluar.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="stock_barang_id">Stock Barang *</label>
                            <select name="stock_barang_id" id="stock_barang_id" class="form-control select2">
                                <option value="">-- Pilih Stock Barang --</option>
                                @foreach ($stockBarang as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == old('stock_barang_id') | $item->id == $data->stock_barang_id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal *</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input"
                                    data-target="#reservationdate" name="tanggal" required value="{{ old('tanggal') ? old('tanggal') : $data->tanggal }}" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kuantitas">Kuantitas *</label>
                            <input type="number" name="kuantitas" id="kuantitas" class="form-control"
                                placeholder="Kuantitas" required value="{{ old('kuantitas') ? old('kuantitas') : $data->kuantitas }}">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan *</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10">{{ old('keterangan') ? old('keterangan') : $data->keterangan }}</textarea>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
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
@endpush
