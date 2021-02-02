<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    public function faculty(){
        return $this->belongsTo('App\Faculty');
    }
    public function konselis(){
        return $this->hasMany('App\Konseli');
    }
}
