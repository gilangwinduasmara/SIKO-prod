<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Konseli;
use App\User;
use App\Admin;
use App\Konselor;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $user;

    function assignUser(){
        if(session()->has('userId')){
            $userId = session()->get('userId');
            $this->user = User::find($userId);
            if($this->user->role == 'konselor'){
                $this->user['details'] = Konselor::where('user_id', $this->user->id)->get()->first();
            }else if ($this->user->role == 'konseli'){
                $this->user['details'] = Konseli::where('user_id', $this->user->id)->get()->first();
            }else if($this->user->role == 'admin'){
                $this->user['details'] = Admin::where('user_id', $this->user->id)->get()->first();
            }
        }
    }

    function __construct()
    {
    }


}
