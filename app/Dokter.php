<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = "dokter";
    protected $fillable = ['nama', 'ttl', 'jenis_kelamin', 'alamat', 'poli_id'];

    public function poli()
    {
        return $this->belongsTo('App\Poli', 'poli_id');
    }

    public function praktik()
    {
        return $this->hasMany('App\Praktik');
    }
}
