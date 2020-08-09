<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';

    protected $guarded = [];

    public function guru()
    {
        return $this->belongsTo('App\Guru');
    }
}
