<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ktp extends Model
{
    protected $table = "ktp";

    protected $fillable = ['nik', 'foto', 'id_pasien'];

    public function pasien()
    {
        return $this->belongsTo('App\Pasien', 'id_pasien');
    }
}
