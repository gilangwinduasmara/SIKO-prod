<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ChatConference extends Model
{
    protected $fillable = ['UserID', 'chat_konseling', 'tgl_chat', 'case_conference_id'];

    public function getChatKonselingAttribute(){
        try{
            return Crypt::decryptString($this->attributes['chat_konseling']);
        }catch(Exception $e){
            return $this->attributes['chat_konseling'];
        }
    }

    public function setChatKonselingAttribute($value){
        $this->attributes['chat_konseling'] = Crypt::encryptString($value);
    }

    public function caseConference(){
        return $this->belongsTo('App\CaseConference');
    }
    public function user(){
        return $this->belongsTo('App\User', 'UserID');
    }
    public function konselor(){
        return $this->hasOneThrough('App\Konselor', 'App\User', 'id', 'user_id', 'UserID');
    }
}
