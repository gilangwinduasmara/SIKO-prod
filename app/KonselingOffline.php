<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonselingOffline extends Model
{
    use HasFactory;
    protected $fillable = ['nama_konseli', 'unit_asal_konseli', 'tempat', 'waktu', 'topik', 'rekam_konseling', 'rumusan_masalah', 'treatment', 'konselor_id'];

    public function konselor(){
        return $this->belongsTo('App\Konselor');
    }
}
