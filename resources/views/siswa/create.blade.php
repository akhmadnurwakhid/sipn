@extends('layouts.app')
@section('title','Tambah Data Siswa')
@section('page-heading','Tambah Data Siswa')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            @if (session()->has('pesan'))
                <div class="alert alert-success">
                    {{ session()->get('pesan') }}
                </div>
            @endif
            <form action="{{route('siswa.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" id="nis" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{old('nis')}}">
                    @error('nis')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}">
                    @error('nama')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="form-check">
                        <input type="radio" name="jenis_kelamin" value="laki-laki" class="form-check-input" id="laki-laki">
                        <label for="laki-laki" class="form-check-label">Laki-Laki</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="jenis_kelamin" value="perempuan" class="form-check-input" id="perempuan">
                        <label for="perempuan" class="form-check-label">Perempuan</label>
                    </div>
                    @error('jenis_kelamin')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select name="kelas" id="kelas" class="form-control">
                        @forelse ($kelas as $item)
                            <option value="{{$item->id}}">{{ $item->nama }}</option>
                        @empty
                            <option disabled></option>
                        @endforelse
                    </select>
                    @error('kelas')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester" class="form-control">
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                    @error('semester')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tahun-ajaran">Tahun Ajaran</label>
                    <select name="tahun_ajaran" id="tahun-ajaran" class="form-control">
                        @forelse ($tahun_ajaran as $item)
                            <option value="{{$item->id}}">{{ $item->tahun_ajaran }}</option>
                        @empty
                            <option disabled></option>
                        @endforelse
                    </select>
                    @error('tahun_ajaran')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email (Opsional)</label>
                    <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <button class="btn btn-success" type="submit">Kirim</button>
            </form>
        </div>
    </div>
@endsection
