<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
// class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function konseli(){
        return $this->belongsTo('App\Konseli');
    }

    public function konselor()
    {
        return $this->hasOne('App\Konselor');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        $user = $this;
        if($this->role == 'konseli'){
            $user->info = Konseli::where('user_id', $this->id)->first();
        }else if($this->role == 'konselor'){
            $user->info = Konselor::where('user_id', $this->id)->first();
        }else if($this->role == 'admin'){
            $user->info = Admin::where('user_id', $this->id)->first();
        }else{
            $user->info = [
                'role' => 'hacker'
            ];
        }

        return [
            'user' => $user,
        ];
    }


    //jwt

    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

    // /**
    //  * Return a key value array, containing any custom claims to be added to the JWT.
    //  *
    //  * @return array
    //  */
    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }
}
