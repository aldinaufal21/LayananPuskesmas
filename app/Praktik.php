<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Praktik extends Model
{
    protected $table = "praktik";
    protected $fillable = ['mulai', 'berakhir', 'id_dokter'];

    public function dokter()
    {
        return $this->belongsTo('App\Dokter', 'id_dokter');
    }
}
