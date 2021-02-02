<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konseli extends Model
{
    protected $fillable =['nim','nama_konseli','tgl_lahir_konseli','no_hp_konseli','alamat_konseli', 'jenis_kelamin', 'suku', 'agama', 'prodi_id', 'user_id', 'progdi', 'fakultas', 'no_hp_kerabat', 'hubungan'];

    public function konseling(){
        return $this->hasMany('Konseling');
    }
    public function prodi(){
        return $this->belongsTo('App\Prodi');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
