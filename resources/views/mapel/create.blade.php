@extends('layouts.app')
@section('title','Tambah Data Mapel')
@section('page-heading','Tambah Data Mapel')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            @if (session()->has('pesan'))
                <div class="alert alert-success">
                    {{ session()->get('pesan') }}
                </div>
            @endif
            <form action="{{route('mapel.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" id="kode" class="form-control @error('kode') is-invalid @enderror" name="kode" value="{{old('kode')}}">
                    @error('kode')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama Mata Pelajaran</label>
                    <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}">
                    @error('nama')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="guru">Guru Pengampu</label>
                    <select name="guru" id="guru" class="form-control">
                        @forelse ($gurus as $guru)
                            <option value="{{$guru->id}}">{{ $guru->nama }}</option>
                        @empty
                            <option value="" disabled>Tidak Ada data</option>
                        @endforelse
                    </select>
                    @error('guru')
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
