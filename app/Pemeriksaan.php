<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    protected $table = "pemeriksaan";
    protected $fillable = ['id_poli', 'keluhan', 'id_pasien', 'hasil_pemeriksaan', 'status_pemeriksaan', 'status'];
    protected $hidden = ['cetak', 'status_pemeriksaan'];

    public function antrian()
    {
        return $this->hasOne('App\Antrian', 'id_pemeriksaan');
    }
    
    public function pasien()
    {
        return $this->belongsTo('App\Pasien', 'id_pasien');
    }

    public function poli()
    {
        return $this->belongsTo('App\Poli', 'id_poli');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
