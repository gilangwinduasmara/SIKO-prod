<?php

namespace App\Http\Controllers;

use App\CaseConference;
use Illuminate\Http\Request;
use App\Konseling;
use App\Prodi;
use App\Faculty;
use App\Konseli;
use App\JadwalKonselor;
use App\Notification;
use App\Konselor;
use App\Pengumuman;
use App\Quote;
use App\RekamKonseling;
use App\Setting;
use App\User;
use Illuminate\Support\Carbon;
use Validator;

class AdminController extends Controller
{

    public function index(){
        $this->assignUser();
        $user = $this->user;
        if(session()->has('userId')){
            return redirect('/admin/dashboard');
        }else{
            return redirect('/admin/login');
        }
    }
    public function login(){
        $this->assignUser();
        $user = $this->user;
        return view('pages.admin.login', compact('user'));
    }
    public function dashboard(){
        $this->assignUser();
        $user = $this->user;

        $aktif = [];
        $baru = 0;
        $referal = 0;
        $selesai['selesai'] = [];
        $cc = 0;
        $r = 0;
        $e = 0;
        $selesai['cc'] = 0;
        $selesai['r'] = 0;
        $selesai['e'] = 0;
        $count = [];

        $konselings = Konseling::all();
        $konselors = Konselor::all();
        $caseconferences = CaseConference::where('status', 'on-going')->get();
        $count = [
            'total_konseling' => count($konselors),
            'total_conference' => count($caseconferences)
        ];
        foreach($konselings as $konseling){
            if($konseling->status_selesai == "C" && $konseling->refered != 'ya'){
                if($konseling->status_konseling == 'ref'){
                    $referal++;
                }else{
                    $baru++;
                }
            }else{
                if($konseling->status_selesai == "expired"){
                    $e++;
                }else{
                    if($konseling->refered == 'ya'){
                        $r++;
                    }else{
                        $cc++;
                    }
                }
            }
        }

        $stat = [
            'aktif' => [
                'baru' => $baru,
                'referral' => $referal,
                'total' => $baru+$referal
            ],
            'selesai' => [
                'cc' => $cc,
                'r' => $r,
                'e' => $e,
                'total' => $cc+$r+$e
            ],
            'count' => $count
        ];

        return view('pages.admin.dashboard', compact('user', 'stat'));
    }

    public function tambahKonselor(){
        $this->assignUser();
        $user = $this->user;
        $action = 'create';
        return view('pages.admin.edit', compact('user', 'action'));
    }

    public function editKonselor($id){
        $this->assignUser();
        $user = $this->user;
        $action = 'edit';
        $konselor = Konselor::with('user')->find($id);
        $jadwal = JadwalKonselor::where('konselor_id', $konselor->id)->get()->groupBy('hari');
        return view('pages.admin.edit', compact('user', 'action', 'jadwal', 'konselor'));
    }

    public function konselor(){
        $this->assignUser();
        $user = $this->user;

        $konselors = Konselor::get();
        return view('pages.admin.konselor', compact('user', 'konselors'));
    }

    public function report(){
        $this->assignUser();
        $user = $this->user;
        $presensis = [];
        $konselings = [];
        $fakultas = [];
        if(request()->detail){
            $konselings = Konseling::with('konselor')->with('referal')->with(['konseli' => function ($query) {
                $query->with('user')->with(['prodi' => function ($query){
                    $query->with('faculty')->get();
                }])->get();
            }])->with(['chats' => function ($query) {
                        $query->orderBy('id', 'desc')->first();
                }])->with('rekamKonselings')->with('jadwal')->get();
            foreach ($konselings as $key => $konseling) {
                if(!in_array($konseling->konseli->fakultas, $fakultas)){
                    array_push($fakultas, $konseling->konseli->fakultas);
                }
            }
        }else{
            $presensis = RekamKonseling::with(['konseling' => function($query){
                $query->with('konseli')->with(['konselor' => function($query){
                    $query->with('user');
                }]);
            }])->get();
        }
        return view('pages.admin.report', compact('user', 'presensis', 'konselings', 'fakultas'));
    }

    public function setting(){
        $this->assignUser();
        $user = $this->user;
        $setting = Setting::get()->first();
        if(!request()->has('submenu')){
            return redirect('/admin/setting?submenu=expiration');
        }
        return view('pages.admin.setting', compact('user', 'setting'));
    }

    public function informasi(){
        $this->assignUser();
        $user = $this->user;
        $setting = Setting::get()->first();
        $pengumumen = null;
        $quotes = null;
        if(!request()->has('submenu')){
            return redirect('/admin/informasi?submenu=pengumuman');
        }
        if(request()->submenu == "pengumuman"){
            $pengumumen = Pengumuman::get();
        }else if(request()->submenu == "quote"){
            $quotes = Quote::get();
        }
        return view('pages.admin.informasi', compact('user', 'pengumumen', 'quotes'));
    }







// services
    public function doLogin(){

    }


}
