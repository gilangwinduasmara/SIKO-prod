<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['type', 'message', 'user_id', 'read_at', 'data', 'title'];
}
