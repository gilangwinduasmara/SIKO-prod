<?php

namespace App\Console;

use App\CaseConference;
use App\JadwalKonselor;
use App\Konseling;
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
            $konselings = Konseling::with('chats')->get();
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
                    $tgl_daftar = Carbon::createFromFormat('Y-m-d', $konseling->tgl_daftar_konseling);
                    if($konseling->created_at->diffInDays(now(), false)>$setting->expired){
                        array_push($candidates, $konseling);
                        $konseling->status_selesai = 'expired';
                        $konseling->save();
                        $jadwal = JadwalKonselor::find($konseling->jadwal_konselor_id);
                        $jadwal->save();

                        $conference = CaseConference::where('konseling_id', $konseling->id)->where('status','on-going')->first();
                        if($conference){
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
