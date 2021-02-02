<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['nama_admin', 'user_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
