<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\TahunAjaran');
    }

}
