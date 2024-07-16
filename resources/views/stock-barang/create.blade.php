@extends('templates.main')

@push('styles')
@endpush

@section('content-header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Stock Barang</h1>
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
                    <h3 class="card-title">Tambah Stock Barang</h3>

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
                        <a href="{{ route('stock-barang.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Stock Barang</a>
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
                    <form action="{{ route('stock-barang.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama *</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required value="{{ old('nama') }}">
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis *</label>
                            <input type="text" name="jenis" id="jenis" class="form-control" placeholder="Jenis" required value="{{ old('jenis') }}">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori *</label>
                            <input type="text" name="kategori" id="kategori" class="form-control" placeholder="Kategori" required value="{{ old('kategori') }}">
                        </div>
                        <div class="form-group">
                            <label for="merk">Merk *</label>
                            <input type="text" name="merk" id="merk" class="form-control" placeholder="Merk" required value="{{ old('merk') }}">
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan *</label>
                            <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan" required value="{{ old('satuan') }}">
                        </div>
                        <div class="form-group">
                            <label for="kuantitas">Kuantitas *</label>
                            <input type="number" name="kuantitas" id="kuantitas" class="form-control" placeholder="Kuantitas" required value="{{ old('kuantitas') }}">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan *</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10">{{ old('keterangan') }}</textarea>
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
