<?php

namespace App\Http\Controllers;

use App\Guru;
use App\User;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        return view('guru.index',['gurus'=>$gurus]);

    }

    public function create()
    {
        return view('guru.create');
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
            'nip' => 'numeric|nullable|unique:guru',
            'nama' => 'required',
            'email' => 'email|nullable|unique:users',
            'username' => 'required|alpha_dash|unique:users',
            'password' => 'required|min:3',
        ]);

       $user = User::create([
            'username' => $validateData['username'],
            'password' => bcrypt($validateData['password']),
            'hak_akses'=> 'guru',
        ]);

        $guru = Guru::create([
            'nip' => $validateData['nip'],
            'nama' => $validateData['nama'],
            'user_id' => $user->id,
        ]);

        if (!$guru || !$user) {
            DB::rollback();
        }else {
            DB::commit();
            return redirect()->back()->with('pesan',"Guru dengan nama {$validateData['nama']} sukses ditambahkan");
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    public function edit(Guru $guru)
    {
        $user = User::where('id',$guru->user_id)->first();
        return view('guru.edit',['guru' => $guru, 'user' => $user]);
    }


    public function update(Request $request, Guru $guru)
    {

        DB::beginTransaction();

        $user = User::where('id',$guru->user_id)->first();

        $validateData = $request->validate([
            'nip' => 'numeric|nullable|unique:guru,nip,'.$guru->id,
            'nama' => 'required',
            'email' => 'email|nullable|unique:users,email,'.$user->id,
            'username' => 'required|alpha_dash|unique:users,username,'.$user->id,
        ]);

       $user = User::where('id',$guru->user_id)->update([
            'username' => $validateData['username'],
            'email' => $validateData['email'],
            ]);

        $guru = Guru::where('id',$guru->id)->update([
            'nip' => $validateData['nip'],
            'nama' => $validateData['nama'],
        ]);

        if (!$guru || !$user) {
            DB::rollback();
        }else {
            DB::commit();
            return redirect()->back()->with('pesan',"Guru dengan nama {$validateData['nama']} sukses diupdate");
        }
    }


    public function destroy(Guru $guru)
    {
        $user = User::where('id',$guru->user_id)->delete();

        return redirect()->route('guru.index')->with('pesan',"Guru dengan nama $guru->nama sukses dihapus");

    }


}
