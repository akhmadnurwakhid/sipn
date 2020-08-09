<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use App\Guru;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelass = Kelas::all();
        return view('kelas.index', ['kelass' => $kelass]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('kelas.create',['gurus' => $gurus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|unique:kelas',
            'wali_kelas' => 'required|unique:kelas,guru_id',
        ]);

        Kelas::create([
            'nama' => $validateData['nama'],
            'guru_id' => $validateData['wali_kelas'],
        ]);

        return redirect()->back()->with('pesan',"Kelas {$validateData['nama']} sukses ditambahkan");
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
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::all();

        return view('kelas.edit', ['kelas' => $kelas, 'gurus' => $gurus]);
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
        $validateData = $request->validate([
            'nama' => 'required|unique:kelas,nama,'.$id,
            'wali_kelas' => 'required|unique:kelas,guru_id,'.$id,
        ]);

        Kelas::FindOrFail($id)->update([
            'nama' => $validateData['nama'],
            'guru_id' => $validateData['wali_kelas'],
        ]);

        return redirect()->back()->with('pesan',"Data Kelas {$validateData['nama']} sukses diubah");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        Kelas::findOrFail($id)->delete();
        return redirect()->route('kelas.index')->with('pesan'," Kelas {$kelas['nama']} sukses dihapus");


    }
}
