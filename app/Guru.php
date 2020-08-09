<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kelas()
    {
        return $this->hasOne('App\Kelas');
    }

    public function mapels()
    {
        return $this->hasMany('App\Mapel');
    }
}
