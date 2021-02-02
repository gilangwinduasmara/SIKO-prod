<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konselor extends Model
{

    protected $fillable = [
        'nama_konselor', 'profesi_konselor', 'email_konselor', 'no_hp_konselor', 'status', 'user_id'
    ];

    public function konselings()
    {
        return $this->hasMany('App\Konselings');
    }

    public function jadwalKonselor()
    {
        return $this->hasMany('App\JadwalKonselor');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public $timestamps = true;
}
