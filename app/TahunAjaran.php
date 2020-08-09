<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';

    protected $guarded = [];

    public function siswa()
    {
        return $this->hasMany('App\Siswa');
    }
}
