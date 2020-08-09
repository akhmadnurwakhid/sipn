@extends('layouts.app')
@section('title','Data Mapel')
@section('page-heading','Data Mapel')
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
                    <a href="{{route('mapel.create')}}" class="btn btn-success mb-2"> <i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kode Mapel</th>
                            <td>Pengampu</td>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mapels as $mapel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mapel->nama }}</td>
                                <td>{{ $mapel->kode }}</td>
                                <td>{{$mapel->guru->nama}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('mapel.edit', ['mapel' => $mapel->id])}}" class="btn btn-info">Edit</a>
                                        <form action="{{route('mapel.destroy',['mapel' => $mapel->id])}}" method="post">
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
