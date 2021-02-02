<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = ["judul", "isi", "source_gambar", "status"];
}
