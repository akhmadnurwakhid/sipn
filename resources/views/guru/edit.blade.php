@extends('layouts.app')
@section('title','Edit Data Guru')
@section('page-heading','Edit Data Guru')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            @if (session()->has('pesan'))
                <div class="alert alert-success">
                    {{ session()->get('pesan') }}
                </div>
            @endif
            <form action="{{route('guru.update',['guru' => $guru->id])}}" method="post">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" id="nip" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{old('nip') ?? $guru->nip}}">
                    @error('nip')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama') ?? $guru->nama}}">
                    @error('nama')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username') ?? $user->username}}">
                    @error('username')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="email">Email (Opsional)</label>
                    <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email') ?? $user->email}}">
                    @error('email')
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
