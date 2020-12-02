<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = "pasien";
    protected $fillable = ['nama', 'alamat', 'jenis_kelamin', 'berat_badan', 'tinggi_badan', 'gol_darah', 'tgl_lahir', 'no_hp', 'email', 'password'];

    public function pemeriksaan()
    {
        $this->hasMany('App\Pemeriksaan');
    }
}
