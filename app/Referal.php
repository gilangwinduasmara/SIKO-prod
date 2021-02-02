<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    protected $fillable = ['tgl_referral', 'judul_referral', 'pesan_referral', 'jadwal_konselor_id', 'konseling_id', 'konselor_tujuan_id', 'referral_id'];
    public function referredFrom(){
        return $this->belongsTo('App\Konseling', 'konseling_id');
    }

    public function konselor(){
        return $this->belongsTo('App\Konselor', 'konselor_tujuan_id', 'id');
    }
}
