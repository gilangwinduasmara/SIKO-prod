<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'path', 'konseling_id', 'user_id', 'file_type', 'file_size'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
