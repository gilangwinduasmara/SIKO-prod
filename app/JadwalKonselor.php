<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalKonselor extends Model
{
    protected $fillable = ['hari', 'jam_mulai', 'jam_akhir', 'konselor_id', 'available'];

    public function konselor()
    {
        return $this->belongsTo('App\Konselor');
    }

    public function konseling()
    {
        return $this->belongsTo('App\Konseling');
    }

}
