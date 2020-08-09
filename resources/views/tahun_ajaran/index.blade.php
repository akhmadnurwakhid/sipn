@extends('layouts.app')
@section('title','Data Tahun Ajaran')
@section('page-heading','Data Tahun Ajaran')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            @if (session()->has('pesan'))
            <div class="alert alert-success">
                {{ session()->get('pesan') }}
            </div>
            @endif

            <div class="table-responsive">
                <div class="d-flex justify-content-end">
                    <a href="{{route('tahun-ajaran.create')}}" class="btn btn-success mb-2"> <i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tahun Ajaran</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tahun_ajarans as $tahun_ajaran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tahun_ajaran->tahun_ajaran }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('tahun-ajaran.edit', ['tahun_ajaran' => $tahun_ajaran->id])}}" class="btn btn-info">Edit</a>
                                        <form action="{{route('tahun-ajaran.destroy',['tahun_ajaran' => $tahun_ajaran->id])}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger ml-2" onclick="return confirm('yakin ingin menghapus ?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data ...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
