<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ChatKonseling extends Model
{
    protected $fillable = ['userID', 'chat_konseling', 'tgl_chat', 'konseling_id'];

    public function getChatKonselingAttribute(){
        try{
            return Crypt::decryptString($this->attributes['chat_konseling']);
        }catch(Exception $e){
            return "";
        }
    }

    public function setChatKonselingAttribute($value){
        $this->attributes['chat_konseling'] = Crypt::encryptString($value);
    }

    public function konseling(){
        return $this->belongsTo('App\Konseling');
    }
}
