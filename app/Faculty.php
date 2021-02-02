<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faculty extends Model
{
    public function prodis(){
        return $this->hasMany('App\Prodi');
    }
}
