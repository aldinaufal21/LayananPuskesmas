<?php

namespace App;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Praktik extends Model
{
    protected $table = "praktik";
    protected $fillable = ['mulai', 'berakhir', 'id_dokter'];
    protected $hidden = ['mulai', 'berakhir'];
    protected $appends = ['jam_mulai', 'jam_berakhir'];

    public function getJamMulaiAttribute()
    {
        return Carbon::parse($this->mulai)->format('H:i:s');
    }

    public function getJamBerakhirAttribute()
    {
        return Carbon::parse($this->berakhir)->format('H:i:s');
    }

    public function dokter()
    {
        return $this->belongsTo('App\Dokter', 'id_dokter');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
