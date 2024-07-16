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
                    <h3 class="card-title">List Barang Keluar</h3>

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
                    <div class="mb-2 text-right">
                        <a href="{{ route('barang-keluar.create') }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-plus"></i>
                            Barang Keluar</a>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Tanggal</th>
                                    <th>Kuantitas</th>
                                    <th>Dibuat oleh</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item => $i)
                                    <tr>
                                        <td>{{ $item + 1 }}</td>
                                        <td>{{ $i->stockBarang->nama }}</td>
                                        <td>{{ $i->tanggal }}</td>
                                        <td>{{ $i->kuantitas }}</td>
                                        <td>{{ $i->createdBy->name ?? '' }}</td>
                                        <td>{{ $i->keterangan }}</td>
                                        <td>
                                            @can('barang-keluar.edit')
                                                <a href="{{ route('barang-keluar.edit', $i->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            @endcan
                                            @can('barang-keluar.delete')
                                                <a href="#" class="btn btn-sm btn-danger btn-delete"
                                                    data-barang_keluar="{{ $i }}"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            @endcan
                                            {{-- <form action="{{ route('barang-masuk.destroy', $i->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                            </form> --}}
                                        </td>
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
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var barang_keluar = $(this).data('barang_keluar');
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: `Barang Keluar ${barang_keluar.tanggal} yang dihapus tidak dapat dikembalikan!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `{{ route('barang-keluar.index') }}/${barang_keluar.id}`,
                            type: 'DELETE',
                            data: {
                                _token: `{{ csrf_token() }}`
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Terhapus!',
                                    'Barang Keluar berhasil dihapus.',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Gagal!',
                                    'Barang Keluar gagal dihapus.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
