<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TahunAjaran;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ajarans = TahunAjaran::all();
        return view('tahun_ajaran.index', ['tahun_ajarans' => $tahun_ajarans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahun_ajaran.create');
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
            'tahun_ajaran' => 'required|unique:tahun_ajaran'
        ]);

        TahunAjaran::create($validateData);

        return redirect()->back()->with('pesan',"Tahun Ajaran  {$validateData['tahun_ajaran']} sukses ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dump($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahun_ajaran = TahunAjaran::findOrFail($id);
        return view('tahun_ajaran.edit', ['tahun_ajaran' => $tahun_ajaran]);
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
            'tahun_ajaran' => 'required|unique:tahun_ajaran,tahun_ajaran,'.$id,
        ]);

        TahunAjaran::findOrFail($id)->update($validateData);

        return redirect()->back()->with('pesan',"Tahun Ajaran {$validateData['tahun_ajaran']} sukses diubah");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tahun_ajaran = TahunAjaran::findOrFail($id);
        TahunAjaran::findOrFail($id)->delete();
        return redirect()->route('tahun-ajaran.index')->with('pesan'," Tahun Ajaran {$tahun_ajaran['tahun_ajaran']} sukses dihapus");

    }
}
