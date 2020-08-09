@extends('layouts.app')
@section('title','Home')
@section('page-heading','Dashboard')

@section('content')
    <div class="row">
        <!-- Siswa -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Siswa</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Siswa::all()->count() }} </div>
                    <hr>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">{{ App\Siswa::where('jenis_kelamin','laki-laki')->count() }} Laki-Laki</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">{{ App\Siswa::where('jenis_kelamin','perempuan')->count() }} Perempuan</div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Guru -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Guru</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Guru::all()->count() }}</div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Kelas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kelas</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Kelas::all()->count() }}</div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- Mapel -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Mapel</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Mapel::all()->count() }}</div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection




