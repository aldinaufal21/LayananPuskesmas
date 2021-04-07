<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = "pasien";
    protected $fillable = ['nama', 'alamat', 'jenis_kelamin', 'berat_badan', 'tinggi_badan', 'gol_darah', 'tgl_lahir', 'no_hp', 'email', 'password'];

    protected $hidden = ['email', 'password'];

    public function pemeriksaan()
    {
       return $this->hasMany('App\Pemeriksaan');
    }

    public function ktp()
    {
        return $this->hasMany('App\Ktp');
    }
}
