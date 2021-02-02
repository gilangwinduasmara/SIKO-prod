<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseConference extends Model
{
    protected $fillable = ['tgl_mulai_case_conference', 'judul_case_conference', 'status', 'konseling_id'];

    public function konseling (){
        return $this->belongsTo('App\Konseling');
    }

    public function detailConferences(){
        return $this->hasMany('App\DetailConference');
    }

    public function chatConferences(){
        return $this->hasMany('App\ChatConference');
    }
}
