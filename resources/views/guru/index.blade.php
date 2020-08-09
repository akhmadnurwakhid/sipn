@extends('layouts.app')
@section('title','Data Guru')
@section('page-heading','Data Guru')
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
                    <a href="{{route('guru.create')}}" class="btn btn-success mb-2"> <i class="fa fa-plus"></i> Tambah Data</a>
                </div>
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $guru)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $guru->nip }}</td>
                                <td>{{ $guru->nama }}</td>
                                <td>{{ $guru->user->username }}</td>
                                <td>{{ $guru->user->email }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('guru.edit',['guru'=> $guru->id])}}" class="btn btn-info">Edit</a>
                                        <form action="{{route('guru.destroy',['guru'=> $guru->id])}}" method="post">
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
