@extends('layouts.app')
@section('title','Ubah Data Kelas')
@section('page-heading','Ubah Data Kelas')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            @if (session()->has('pesan'))
                <div class="alert alert-success">
                    {{ session()->get('pesan') }}
                </div>
            @endif
            <form action="{{route('kelas.update', ['kela' => $kelas->id])}}" method="post">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Kelas</label>
                    <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama') ?? $kelas->nama}}">
                    @error('nama')
                         <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="wali-kelas">Wali Kelas</label>
                    @php
                        $selectValue = $kelas->guru_id;
                    @endphp
                    <select name="wali_kelas" id="wali-kelas" class="form-control">
                        @forelse ($gurus as $guru)
                            <option value="{{ $guru->id }}" {{$selectValue == $guru->id ? 'selected' : '' }}>{{ $guru->nama  }}</option>
                        @empty
                            <option value="" disabled>Tidak Ada data</option>
                        @endforelse
                    </select>
                    @error('wali_kelas')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <button class="btn btn-success" type="submit">Update</button>
            </form>
        </div>
    </div>
@endsection
