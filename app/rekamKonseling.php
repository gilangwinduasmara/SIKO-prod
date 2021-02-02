<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekamKonseling extends Model
{
    protected $fillable = ['tgl_konseling', 'judul_konseling', 'isi_rekam_konseling', 'konseling_id'];
    public function konseling(){
        return $this->belongsTo('App\Konseling');
    }
}
