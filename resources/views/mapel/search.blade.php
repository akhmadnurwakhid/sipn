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
                <div class="d-flex justify-content-end">
                    <form action="{{route('mapel.search')}}" method="get">
                        @csrf
                        <label for="search">Cari :</label>
                        <input type="text" name="search" id="search" value="{{$cari}}">
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Mata Pelajaran</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mapels as $mapel)
                            <tr>
                                <td>{{ ++$no }}</td>
                                <td>{{ $mapel->kode }}</td>
                                <td>{{ $mapel->nama }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('mapel.edit',['mapel'=>$mapel])}}" class="btn btn-info">Edit</a>
                                        <form action="{{route('mapel.destroy',['mapel'=> $mapel->id])}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger ml-2" onclick="return confirm('yakin ingin menghapus ?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data ...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>Hasil pencarian : {{ $jumlah_mapels }} ditemukan</div>
                <div class="d-flex justify-content-end">{{ $mapels->links() }}</div>
            </div>
        </div>
    </div>
@endsection
