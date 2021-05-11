<?php

namespace App\Providers;

use App\Konseling;
use App\Mail\NotifEmail;
use App\Notification;
use App\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            Notification::created(function ($notification){
                $user = User::find($notification->user_id);
                $email = [];
                $email['to'] = $user->email;
                $email['subject'] = $notification->type;
                $email['body'] = $notification->message;
                $subject = "";
                $data = null;

                switch($notification->type){
                    case 'new_konseling':
                        $subject = "Sesi Konseling Baru";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                    case 'end_konseling':
                        $subject = "Sesi Konseling Berakhir";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                    case 'ask_referral':
                        $subject = "Permintaan Referal";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                    case 'agreed_referral':
                        $subject = "Permintaan Referal Disetujui";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                    case 'declined_referral':
                        $subject = "Permintaan Referal Ditolak";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                    case 'ask_conference':
                        $subject = "Permintaan Case Conference";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                    case 'agreed_conference':
                        $subject = "Permintaan Case Conference Disetujui";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                    case 'declined_conference':
                        $subject = "Permintaan Case Conference Ditolak";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                    case 'new_referral':
                        $subject = "Pemindahan sesi konseling";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                    case 'invitation_conference':
                        $subject = "Undangan Case Conference";
                        $data = Konseling::with('konseli')->with('konselor')->find($notification->data);
                        break;
                }
                try{
                    if($notification->type != 'chat' && $notification->type != 'chat_conference'){
                        // if($user->role == 'konselor'){
                        //     if($user->email == 'maria.nugraheni@uksw.edu'){
                        //         Mail::to('nina.setiyawati@uksw.edu')->send(new NotifEmail($notification, $data, $subject));
                        //     }else if($user->email == 'ones.dani@uksw.edu'){
                        //         Mail::to('dwihosanna.bangkalang@uksw.edu')->send(new NotifEmail($notification, $data, $subject));
                        //     }else{
                        //         Mail::to('gilangwinduasmara2@gmail.com')->send(new NotifEmail($notification, $data, $subject));
                        //     }
                        //     foreach(['nina.setiyawati@uksw.edu', 'gilangwinduasmara2@gmail.com', 'dwihosanna.bangkalang@uksw.edu'] as $to){
                        //     }
                        // }else{
                        //     Mail::to($user->email)->send(new NotifEmail($notification, $data, $subject));
                        // }
                        Mail::to($user->email)->send(new NotifEmail($notification, $data, $subject));
                    }
                }catch(Exception $e){

                }

            });
    }
}
