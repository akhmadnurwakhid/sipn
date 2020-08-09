@extends('layouts.app')
@section('title','Data Siswa')
@section('page-heading','Data Siswa')
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
                    <a href="{{route('siswa.create')}}" class="btn btn-success mb-2"> <i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nis }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->kelas->nama}}</td>
                                <td>{{ $item->semester}}</td>
                                <td>{{ $item->tahun_ajaran->tahun_ajaran}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('siswa.edit',['siswa' => $item->id])}}" class="btn btn-info">Edit</a>
                                        <form action="{{route('siswa.destroy',['siswa' => $item->id])}}" method="post">
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
