<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailConference extends Model
{
    protected $fillable = ['konselor_id', 'case_conference_id', 'role'];
    public function konselor(){
        return $this->belongsTo('App\Konselor');
    }
}
