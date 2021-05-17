<?php

namespace App\Console;

use App\CaseConference;
use App\JadwalKonselor;
use App\Konseling;
use App\Notification;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function (){
            // $konselings = Konseling::whereDate('tgl_daftar_konseling', '>', 'tgl_expired_konseling')->get();
            $candidates = [];
        $konselings = Konseling::with('konseli')->with('konselor')->with('chats')->get();
        $setting = Setting::get()->first();
        foreach($konselings as $konseling){
            $lastchat = null;
            foreach($konseling->chats as $chat){
                $userChat = User::find($chat->userID);
                if($userChat->role == 'konseli'){
                    $lastchat = $userChat;
                    break;
                }
            }
            if($lastchat){
                $tgl_last_activity = Carbon::createFromFormat("Y-m-d",Carbon::parse($lastchat->created_at)->toDateString(),'Asia/Jakarta');
            }else{
                $tgl_last_activity = $konseling->created_at;
            }


            if($konseling->status_selesai == "C" && $konseling->refered == "tidak"){
                if($konseling->konseli->nim){
                    // dd($tgl_last_activity->diffInDays(now(), false));
                }
                // dd("682017048");
                $tgl_daftar = Carbon::createFromFormat('Y-m-d', $konseling->tgl_daftar_konseling);
                if($tgl_last_activity->diffInDays(now(), false)>=$setting->expired){
                    array_push($candidates, $konseling);

                    $notification = Notification::create([
                        "type" => "end_konseling",
                        "data" => $konseling->id,
                        'title' => $konseling->konseli->nama_konseli,
                        "message" => "Sesi konseling kadaluarsa",
                        "user_id" => $konseling->konselor->user_id
                    ]);
                    $notification = Notification::create([
                        "type" => "end_konseling",
                        "data" => $konseling->id,
                        'title' => $konseling->konselor->nama_konselor,
                        "message" => "Sesi konseling kadaluarsa",
                        "user_id" => $konseling->konseli->user_id
                    ]);


                    $konseling->status_selesai = 'expired';
                    $konseling->save();
                    $jadwal = JadwalKonselor::find($konseling->jadwal_konselor_id);
                    $jadwal->save();
                    // kevin -> 682017048
                    $conferences = CaseConference::where('konseling_id', $konseling->id)->where('status','on-going')->get();
                    foreach($conferences as $conference){
                        $conference->status = 'selesai';
                        $conference->save();
                    }
                }
            }
        }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
