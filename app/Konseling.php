<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    protected $fillable = ['tgl_daftar_konseling', 'tgl_akhir_konseling', 'tgl_expired_konseling', 'status_konseling', 'status_selesai', 'konseli_id', 'konselor_id', 'jadwal_konselor_id', 'refered', 'conferenced', 'referral_id'];
    public function konseli()
    {
        return $this->belongsTo('App\Konseli');
    }

    public function konselor()
    {
        return $this->belongsTo('App\Konselor');
    }

    public function prodi()
    {
        return $this->hasOneThrough('App\Konseli', 'App\Prodi');
    }

    public function referal(){
        return $this->belongsTo('App\Referal', 'referral_id');
    }

    public function referral(){
        return $this->hasOne('App\Referal', 'id', 'referral_id');
    }

    public function chats(){
        return $this->hasMany('App\ChatKonseling');
    }

    public function latestChat(){
        return $this->hasOne('App\ChatKonseling')->latest();
    }

    public function jadwal()
    {
        return $this->belongsTo('App\JadwalKonselor', 'jadwal_konselor_id', 'id');
    }

    public function rekamKonselings(){
        return $this->hasMany('App\RekamKonseling');
    }

    public function rangkumanKonseling(){
        return $this->hasOne('App\RangkumanKonseling');
    }
    // public function toArray(){
    //     $array = parent::toArray();
    //     $camelArray = array();
    //     foreach($array as $name => $value){
    //         $camelArray[camel_case($name)] = $value;
    //     }
    //     return $camelArray;
    // }
}
