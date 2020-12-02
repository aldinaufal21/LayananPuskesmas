<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    protected $table = "pemeriksaan";
    protected $fillable = ['id_poli', 'keluhan', 'id_pasien', 'status_pemeriksaan', 'status'];

    public function antrian()
    {
        return $this->hasMany('App\Antrian');
    }
    
    public function pasien()
    {
        return $this->belongsTo('App\Pasien', 'id_pasien');
    }

    public function poli()
    {
        return $this->belongsTo('App\Poli', 'id_poli');
    }
}
