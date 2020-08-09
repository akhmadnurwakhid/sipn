@extends('layouts.app')
@section('title','Tambah Data Tahun AJaran')
@section('page-heading','Tambah Data Tahun Ajaran')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            @if (session()->has('pesan'))
                <div class="alert alert-success">
                    {{ session()->get('pesan') }}
                </div>
            @endif
            <form action="{{route('tahun-ajaran.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="tahun-ajaran">Tahun Ajaran</label>
                    <input type="text" id="tahun-ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" name="tahun_ajaran" value="{{old('tahun_ajaran')}}">
                    @error('tahun_ajaran')
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
