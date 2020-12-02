<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $fillable = ['nama_poli', 'kode_antrian'];

    public function dokter()
    {
        return $this->hasMany('App\Dokter');
    }

    public function pemeriksaan()
    {
        return $this->hasMany('App\Pemeriksaan');
    }

    public function antrian()
    {
        return $this->hasMany('App\Antrian');
    }
}
