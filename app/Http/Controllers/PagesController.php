<?php

namespace App\Http\Controllers;

use App\CaseConference;
use App\JadwalKonselor;
use App\Konseli;
use App\Konseling;
use App\Konselor;
use App\Mail\NotifEmail;
use App\Pengumuman;
use App\Quote;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function statistic(){
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
        $konselor_id = $this->user->details->id;
        $konselings = Konseling::where("konselor_id", $konselor_id)->get();
        $conferences = CaseConference::where('status', 'on-going')->with(['detailConferences' => function ($query) use($konselor_id){
            $query->with('konselor')->where('konselor_id', $konselor_id)->get();
        }])->get();
        $countConference = 0;
        foreach($conferences as $conference){
            if(count($conference->detailConferences)>0)
                $countConference++;
        }
        $count = [
            'total_conference' =>$countConference
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

        return [
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

    }

    public function index()
    {
        $this->assignUser();
        $token = session('token');
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $user = $this->user;
        // if($user->role == 'konselor'){
        //     $user['details'] = Konselor::where('user_id', $user->id)->get()->first();
        // }else{
        //     $user['details'] = Konseli::where('user_id', $user->id)->get()->first();
        // }


        $daftarkonseling = Konseling::with('rangkumanKonseling')->doesntHave('rangkumanKonseling')->with('jadwal')->with(['konseli' => function ($query){
            $query->with('user')->get();
        }])->where('refered','!=','ya')->where('konselor_id', $user->details->id)->get()->groupBy('jadwal.hari');
        if($this->user->role == 'konselor'){
            $statistik = $this->statistic();
//            dd($statistik);
            $compact = compact('page_title', 'page_description', 'token', 'user', 'daftarkonseling', 'statistik');
            return view('pages.dashboard', $compact);
        }else if($this->user->role == 'konseli'){
            $konseling = Konseling::where('konseli_id',$user->details->id)->where('status_selesai','C')->where('refered','!=','ya')->with(['konselor' => function ($query){
                $query->with('user')->get();
            }])->with('jadwal')->with('referal')->get()->first();
            $compact = compact('page_title', 'page_description', 'token', 'user', 'daftarkonseling', 'konseling');
            return view('pages.konseli.dashboard', $compact);
        }

    }

    public function profile(){
        $this->assignUser();
        $user = $this->user;
        $jadwal = JadwalKonselor::where('konselor_id', $user->details->id)->get()->groupBy('hari');
        return view('pages.konselor.profile', compact('user', 'jadwal'));
    }

    public function daftarkonseli(){
        $this->assignUser();
        $user = $this->user;
        $page_title = 'Daftar Konseli';
        $page_description = '';
        $type = 'daftarkonseling';
        $konselor = Konselor::where('user_id', $this->user->id)->get()->first();

        $konseling = Konseling::where('refered', '!=', 'ya')->with('rangkumanKonseling')->doesntHave('rangkumanKonseling')->with('referral', function($query){
            $query->with('konselor')->with(['referredFrom' => function($query){
                $query->with('konselor');
            }]);
        })->with(['konseli' => function ($query) {
            $query->with('user')->with(['prodi' => function ($query){
                $query->with('faculty')->get();
            }])->get();
        }])->with('chats', function($query){
            return $query->latest()->get();
        })->with('rekamKonselings')->where('konselor_id',$konselor->id)->with('jadwal')->with('latestChat')->get()->sortByDesc('latestChat.created_at');



        $konseling = $konseling->toArray();
        $konselingaktif = [];
        $konselingselesai = [];
        $konselingreferal = [];
        $filteredKonseling = [];

        $ordered = [];
        foreach($konseling as $k){
            $k['p'] = 1;

            if($k['status_selesai'] == 'C'){
                $k['p'] = 2;
            }
            array_push($filteredKonseling, $k);
        }

        usort($filteredKonseling, function ($item1, $item2){
            return $item1['p'] <=> $item2['p'];
        });

        $konselings = $filteredKonseling;
        $showChat = false;
        $user = $this->user;

        // dd($konselis);
        return view('pages.konselor.daftarkonseli', compact('page_title', 'page_description', 'konselings', 'showChat', 'type', 'user'));
    }

    public function gantiJadwal(){
        $this->assignUser();
        $user = $this->user;
        if($this->user->role != "konseli"){
            return redirect("/dashboard");
        }
        return view('pages.konseli.gantijadwal');
    }

    public function caseconference(){
        $this->assignUser();
        $user = $this->user;
        $page_title = 'Case Conference';
        $page_description = '';
        $cases = CaseConference::with('konseling')->with(['detailConferences' => function($query){
            $query->with(['konselor' => function($query){
                $query->with('user')->get();
            }]);
        }])->where('status', 'on-going')->get()->sortByDesc('created_at');
        $caseconferences = [];
        $konselors = Konselor::with('user')->get();
        foreach($cases as $case){
            foreach($case->detailConferences as $details){
                if($details->konselor->id == $user->details->id){
                    array_push($caseconferences, $case);
                    break;
                }
            }
        }
        // dd($caseconferences);
        return view('pages.konselor.caseconference', compact('user', 'caseconferences', 'konselors', 'page_title'));
    }

    public function pin(){
        $this->assignUser();
        $user = $this->user;
        $secure_pin = Crypt::encryptString($user->id);
        return view('pages.konseli.pin', compact('user', 'secure_pin'));
    }

    public function changePin(){
        $this->assignUser();
        // old_pin, new_pin
        $user = $this->user;
        return view('pages.konseli.gantipin', compact('user'));
    }

    public function arsip(){
        $this->assignUser();
        $user = $this->user;
        $page_title = 'Arsip';
        $page_description = '';
        $type = 'arsip';


        $konselor = Konselor::where('user_id', $this->user->id)->get()->first();

        $konselings = Konseling::with(['konselor'=>function($query){
            $query->with('user');
        }])->with(['referral' => function ($query){
                            $query->with('konselor')->with(['referredFrom' => function($query){
                                $query->with('konselor');
                            }])->get();
                        }])->with('rangkumanKonseling')->has('rangkumanKonseling')->with(['konseli' => function ($query) {
                            $query->with('user');
                        }])->with(['chats' => function ($query) {
                                    $query->orderBy('id', 'desc')->first();
                            }])->with('rekamKonselings')->where('konseli_id',$this->user->details->id)->with('jadwal')->get();

        $showChat = false;
        // dd($konselis);
        $user = $this->user;
        if($user->role == 'konseli'){
            $konselings_referred = Konseling::with(['konselor'=>function($query){
                $query->with('user');
            }])->with(['referral' => function ($query){
                                $query->with('konselor')->with('referredFrom')->get();
                            }])->with('rangkumanKonseling')->with(['konseli' => function ($query) {
                                $query->with('user');
                            }])->with(['chats' => function ($query) {
                                        $query->orderBy('id', 'desc')->first();
                                }])->with('rekamKonselings')->where('refered', 'ya')->where('konseli_id',$this->user->details->id)->with('jadwal')->get();

            $konselings = $konselings->merge($konselings_referred)->sortByDesc('updated_at');
            return view('pages.konseli.arsip', compact('page_title', 'page_description', 'konselings', 'showChat', 'type', 'user'));
        }

        $konselings = Konseling::with(['konselor'=>function($query){
            $query->with('user');
        }])->with(['referral' => function ($query){
                            $query->with('konselor')->with(['referredFrom' => function($query){
                                $query->with('konselor');
                            }])->get();
                        }])->with('rangkumanKonseling')->has('rangkumanKonseling')->with(['konseli' => function ($query) {
                            $query->with('user');
                        }])->with(['chats' => function ($query) {
                                    $query->orderBy('id', 'desc')->first();
                            }])->with('rekamKonselings')->where('konselor_id',$this->user->details->id)->with('jadwal')->get();


        $konseling_referred = Konseling::with(['konselor'=>function($query){
            $query->with('user');
        }])->with(['referral' => function ($query){
                            $query->with('konselor')->get();
                        }])->with('rangkumanKonseling')->with(['konseli' => function ($query) {
                            $query->with('user');
                        }])->with(['chats' => function ($query) {
                                    $query->orderBy('id', 'desc')->first();
                            }])->with('rekamKonselings')->where('refered', 'ya')->where('konselor_id',$this->user->details->id)->with('jadwal')->get();

        $konselings = $konselings->merge($konseling_referred)->sortByDesc('updated_at');

        return view('pages.konselor.daftarkonseli', compact('page_title', 'page_description', 'konselings', 'showChat', 'type', 'user'));
    }

    public function landing(){
        $this->assignUser();
        $pengumuman = Pengumuman::orderBy('created_at', 'DESC')->get()->first();
        $quotes = Quote::get();
        $user = $this->user;
        $konselors = Konselor::with('user')->get();
        return view('pages.landing.landing', compact('konselors', 'pengumuman', 'quotes', 'user'));
    }

    public function conferenceSetup(Request $request){
        $this->assignUser();
        $user = $this->user;
        $currentKonselor = Konselor::where('user_id', $this->user->id)->get()->first();
        $page_title = 'Case Conference';
        $page_description = '';
        $konseling = Konseling::find($request->get('id'));

        $caseconference = CaseConference::where('konseling_id', $konseling->id)->get()->first();

        // dd($caseconference);

        if($caseconference != null){
            return redirect('/caseconference?open&id='.$caseconference->id);
        }

        if($konseling == null || $konseling->konselor_id != $user->details->id || $konseling->refered == 'ya' || $konseling->status_selesai != 'C'){
            return redirect('/dashboard');
        }

        $konselors = Konselor::with('user')->where('id', '!=', $currentKonselor->id)->get();
        return view('pages.setups.case-conference-setup', compact('page_title', 'page_description', 'konseling', 'konselors', 'user'));
    }

    public function gantiPassword(){
        $this->assignUser();
        $user = $this->user;
        if($user->role == 'konseli'){
            return redirect('/dashboard');
        }
        return view('pages.gantipassword', compact('user'));
    }

    public function referralSetup(Request $request){
        $this->assignUser();
        $user = $this->user;
        $currentKonselor = Konselor::where('user_id', $this->user->id)->get()->first();
        $page_title = 'Referral';
        $page_description = '';
        $konseling = Konseling::find($request->get('id'));
        if($konseling == null || $konseling->konselor_id != $user->details->id || $konseling->refered == 'ya' || $konseling->status_selesai != 'C'){
            return redirect('/dashboard');
        }
        $konselors = Konselor::with('user')->where('id', '!=', $currentKonselor->id)->get();
        return view('pages.setups.referral-setup', compact('page_title', 'page_description', 'konseling', 'konselors', 'user'));
    }

    public function tes(){
        return now();
    }

    public function ruangKonseling(){
        $this->assignUser();
        $user = $this->user;
        $konseling = Konseling::where('konseli_id',$this->user->details->id)->where('status_selesai','C')->where('refered','!=','ya')->with(['konseli' => function ($query){
            $query->with('user')->get();
        }])->with(['konselor' => function ($query){
            $query->with('user')->get();
        }])->with('jadwal')->with('referal')->get()->first();

        if($konseling == null){
            return redirect('/dashboard');
        }

        $user = $this->user;
        if($konseling->jadwal->available == 'candidate'){
            $konselor = $konseling->konselor;
            $jadwals = JadwalKonselor::where('konselor_id',$konselor->id)->where(function ($query) use($konseling){
                $query->where('available','true')->orWhere('id', $konseling->jadwal->id);
            })->get()->groupBy('hari');
            return view('pages.konseli.gantijadwal', compact('user', 'konseling', 'konselor', 'jadwals'));
        }
        return view('pages.konseli.ruangkonseling', compact('user', 'konseling'));
    }

    public function daftarSesi(){
        $this->assignUser();
        $user = $this->user;
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $user = $this->user;

        $konseling = Konseling::where('konseli_id',$user->details->id)->where('status_selesai','C')->where('refered','!=','ya')->with(['konselor' => function ($query){
            $query->with('user')->get();
        }])->with('jadwal')->with('referal')->get()->first();

        if($konseling != null){
            return redirect('/dashboard');
        }

        $settings = Setting::get()->first();
        $konselors =  Konselor::with('user')->with(['jadwalKonselor' => function($query){
            $query->where('available','true')->get()->groupBy('hari');
        }])->where('status', 'aktif')->get();

        $return = [];

//        dd($konselors);

        foreach ($konselors as $konselor) {
            $count = 0;
            foreach(JadwalKonselor::where('konselor_id', $konselor->id)->get() as $jadwal){
                // dd($konselor->jadwalKonselor);
                if($jadwal->available == "false"|| $jadwal->available == "candidate"){
                    $count++;
                }
            }
           if($count < $settings->session_limit){
               $konselor->active_konseling = $count;
               array_push($return, $konselor);
           }
        }
        $konselors = $return;
        return view('pages.konseli.daftarsesi', compact('konselors', 'user'));
    }

    public function pengumuman(){
        $this->assignUser();
        $user = $this->user;
        $pengumumans = Pengumuman::orderBy('created_at', 'DESC')->get();
        return view("pages.pengumuman", compact('pengumumans', 'user'));
    }

    public function pengumumanDetail($id){
        $this->assignUser();
        $user = $this->user;
        $pengumuman = Pengumuman::find($id);
        return view("pages.pengumuman-detail", compact('pengumuman', 'user'));
    }

    /**
     * Demo methods below
     */

    // Datatables
    public function datatables()
    {
        $page_title = 'Datatables';
        $page_description = 'This is datatables test page';

        return view('pages.datatables', compact('page_title', 'page_description'));
    }

    // KTDatatables
    public function ktDatatables()
    {
        $page_title = 'KTDatatables';
        $page_description = 'This is KTdatatables test page';

        return view('pages.ktdatatables', compact('page_title', 'page_description'));
    }

    // Select2
    public function select2()
    {
        $page_title = 'Select 2';
        $page_description = 'This is Select2 test page';

        return view('pages.select2', compact('page_title', 'page_description'));
    }

    // jQuery-mask
    public function jQueryMask()
    {
        $page_title = 'jquery-mask';
        $page_description = 'This is jquery masks test page';

        return view('pages.jquery-mask', compact('page_title', 'page_description'));
    }

    // custom-icons
    public function customIcons()
    {
        $page_title = 'customIcons';
        $page_description = 'This is customIcons test page';

        return view('pages.icons.custom-icons', compact('page_title', 'page_description'));
    }

    // flaticon
    public function flaticon()
    {
        $page_title = 'flaticon';
        $page_description = 'This is flaticon test page';

        return view('pages.icons.flaticon', compact('page_title', 'page_description'));
    }

    // fontawesome
    public function fontawesome()
    {
        $page_title = 'fontawesome';
        $page_description = 'This is fontawesome test page';

        return view('pages.icons.fontawesome', compact('page_title', 'page_description'));
    }

    // lineawesome
    public function lineawesome()
    {
        $page_title = 'lineawesome';
        $page_description = 'This is lineawesome test page';

        return view('pages.icons.lineawesome', compact('page_title', 'page_description'));
    }

    // socicons
    public function socicons()
    {
        $page_title = 'socicons';
        $page_description = 'This is socicons test page';

        return view('pages.icons.socicons', compact('page_title', 'page_description'));
    }

    // svg
    public function svg()
    {
        $page_title = 'svg';
        $page_description = 'This is svg test page';

        return view('pages.icons.svg', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}
