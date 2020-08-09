<?php

namespace App\Http\Controllers;

use App\Mapel;
use App\Guru;
use Illuminate\Http\Request;

class MapelController extends Controller
{

    public function index()
    {

        $mapels = Mapel::with('guru')->get();
        // dd($mapels);
        return view('mapel.index',['mapels'=>$mapels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gurus = Guru::all();
        return view('mapel.create',['gurus' => $gurus]);
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode' => 'required|unique:mapel',
            'nama' => 'required|unique:mapel',
            'guru' => 'required',
        ]);



        Mapel::create([
            'kode' => $validateData['kode'],
            'nama' => $validateData['nama'],
            'guru_id' => $validateData['guru']
        ]);

       return redirect()->back()->with('pesan',"Mata Pelajaran {$validateData['nama']} sukses ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    public function edit(Mapel $mapel)
    {
        $gurus = Guru::all();
        return view('mapel.edit',['mapel' => $mapel, 'gurus' => $gurus]);
    }

    public function update(Request $request, Mapel $mapel)
    {
        $validateData = $request->validate([
            'kode' => 'required|unique:mapel,kode,'.$mapel->id,
            'nama' => 'required|unique:mapel,nama,'.$mapel->id,
            'guru' => 'required',
        ]);

        Mapel::where('id',$mapel->id)->update([
            'kode' => $validateData['kode'],
            'nama' => $validateData['nama'],
            'guru_id' => $validateData['guru']

        ]);

        return redirect()->back()->with('pesan',"Mata Pelajaran {$validateData['nama']} sukses diupdate");

    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route('mapel.index')->with('pesan',"Mata Pelajaran $mapel->nama sukses dihapus");

    }

}
