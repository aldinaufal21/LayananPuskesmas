<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = "antrian";
    protected $fillable = ['tanggal', 'antrian', 'id_pemeriksaan', 'id_poli'];

    public function pemeriksaan()
    {
        return $this->belongsTo('App\Pemeriksaan', 'id_pemeriksaan');
    }

    public function poli()
    {
        return $this->belongsTo('App\Poli', 'id_poli');
    }
}
