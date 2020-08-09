<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Siswa;
use App\Kelas;
use App\TahunAjaran;
use App\User;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = Siswa::with(['user','kelas','tahun_ajaran'])->get();
        // dd($siswas);
        return view('siswa.index', ['siswas' => $siswas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $tahun_ajaran = TahunAjaran::all();
        return view('siswa.create', ['kelas' => $kelas, 'tahun_ajaran' => $tahun_ajaran]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $validateData = $request->validate([
            'nis' => 'required|unique:siswa',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'kelas' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'email' => 'email|nullable|unique:users',
        ]);

        $user = User::create([
            'username' => $validateData['nis'],
            'password' => bcrypt($validateData['nis']),
            'hak_akses'=> 'siswa',
            'email' => $validateData['email']
        ]);

        $siswa = Siswa::create([
            'nis' => $validateData['nis'],
            'nama' => $validateData['nama'],
            'jenis_kelamin' => $validateData['jenis_kelamin'],
            'kelas_id' => $validateData['kelas'],
            'user_id' => $user->id,
            'semester' => $validateData['semester'],
            'tahun_ajaran_id' => $validateData['tahun_ajaran'],
        ]);

        if (!$siswa || !$user) {
            DB::rollback();
        }else {
            DB::commit();
            return redirect()->back()->with('pesan',"Siswa dengan nama {$validateData['nama']} sukses ditambahkan");
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        $kelas = Kelas::all();
        $tahun_ajaran = TahunAjaran::all();


        return view('siswa.edit', ['siswa' => $siswa, 'kelas' => $kelas, 'tahun_ajaran' => $tahun_ajaran]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $validateData = $request->validate([
            'nis' => 'required|unique:siswa,nis,'.$id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'kelas' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'email' => 'email|nullable|unique:users,email,'.$siswa->user_id,
        ]);

        DB::beginTransaction();

        $user = User::where('id',$siswa->user_id)->update([
            'email' => $validateData['email']
        ]);

        $siswa = Siswa::where('id', $id)->update([
            'nis' => $validateData['nis'],
            'nama' => $validateData['nama'],
            'jenis_kelamin' => $validateData['jenis_kelamin'],
            'kelas_id' => $validateData['kelas'],
            'semester' => $validateData['semester'],
            'tahun_ajaran_id' => $validateData['tahun_ajaran'],
        ]);

        if (!$siswa || !$user) {
            DB::rollback();
        }else {
            DB::commit();
            return redirect()->back()->with('pesan',"Siswa dengan nama {$validateData['nama']} sukses diupdate");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        User::where('id', $siswa->user_id)->delete();

        return redirect()->route('siswa.index')->with('pesan',"Siswa dengan nama $siswa->nama sukses dihapus");

    }
}
