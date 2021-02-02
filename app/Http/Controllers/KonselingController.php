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
use App\RekamKonseling;
use App\Setting;
use App\User;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Carbon;
use Validator;

class KonselingController extends Controller
{
    public function checkExpired(Request $request){
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

        return response()->json([
            'setting' => $setting,
            'data' => $candidates
        ]);
    }



    public function end(Request $request){
        $konseling = Konseling::with('konseli')->with('konselor')->find($request->id);
        if($konseling){
            $konseling->status_selesai = 'E';
            $conferences = CaseConference::where('konseling_id', $request->id)->where('status','on-going')->get();
            $jadwal = JadwalKonselor::find($konseling->jadwal_konselor_id);
            if($jadwal){
                // $jadwal->available = "true";
                $jadwal->save();
            }
            foreach($conferences as $conference){
                $conference->status = 'selesai';
                $conference->save();
            }
            $konseling->save();

            $notification = Notification::create([
                "type" => "end_konseling",
                "data" => $konseling->id,
                'title' => $konseling->konseli->nama_konseli,
                "message" => "mengakhiri sesi konseling",
                "user_id" => $konseling->konselor->user_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Konseling Selesai'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Konseling tidak ada'
        ]);
    }

    public function statistic(Request $request){
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

        if($request->exists("konselor_id")){
            $konselings = Konseling::where("konselor_id", $request->konselor_id)->get();
            $conferences = CaseConference::where('status', 'on-going')->with(['detailConferences' => function ($query) use($request){
                $query->with('konselor')->where('konselor_id', $request->konselor_id)->get();
            }])->get();
            $countConference = 0;
            foreach($conferences as $conference){
                if(count($conference->detailConferences)>0)
                    $countConference++;
            }
            $count = [
                'total_conference' =>$countConference
            ];
        }else{
            $konselings = Konseling::all();
            $konselors = Konselor::all();
            $caseconferences = CaseConference::where('status', 'on-going')->get();
            $count = [
                'total_konseling' => count($konselors),
                'total_conference' => count($caseconferences)
            ];
        }
        foreach($konselings as $konseling){
            if($konseling->status_selesai == "C" && $konseling->refered == 'tidak'){
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
        return response()->json([
            'success' => true,
            'data' => [
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
            ]
        ]);
    }

    public function count(Request $request){
        $input =  $request->all();
        if($input['status_aktif'] == 'aktif'){
            $data = Konseling::where('status_selesai', 'C')->where('refered','tidak')->where('konselor_id',$input['konselor_id'])->get();
//            $konseling
            return response()->json([
                'succes' => true,
                'message' => '',
                'data' => count($data)
            ]);
        }
        if($input['status_aktif'] == 'selesai'){
            $data = Konseling::where('status_selesai', 'E')->where('konselor_id',$input['konselor_id'])->get();
            return response()->json([
                'succes' => true,
                'message' => '',
                'data' => count($data)
            ]);
        }
    }

    public function index(Request $request){
        if($request->has('konselor_id') && $request->has('active')){
            $konseling = Konseling::with('rangkumanKonseling')->doesntHave('rangkumanKonseling')->with('jadwal')->with(['konseli' => function ($query){
                $query->with('user')->get();
            }])->where('refered','tidak')->where('konselor_id', $request->konselor_id)->get()->groupBy('jadwal.hari');
            return response()->json([
                'success'=>true,
                'message'=>'',
                'rows'=>$konseling
            ]);
        }

        if($request->has('konseli_id')){
            if($request->has('arsip')){
                $konselings = Konseling::where('konseli_id',$request->konseli_id)->with('rangkumanKonseling')->has('rangkumanKonseling')->with(['konselor' => function ($query){
                    $query->with('user')->get();
                }])->with('jadwal')->with(['referral' => function ($query){
                    $query->with('konselor')->get();
                }])->with('rekamKonselings')->get();
                // $konseling = $konselings->toArray();
                // foreach($konselings as $konseling){
                //     $user = User::find($konseling->user_id);
                //     $konseling['user'] = $user;
                // }
                // return "";
                return response()->json([
                    'success' => true,
                    'message' => '',
                    'rows' => $konselings
                ]);
            }
            if($request->has('id')){
                $konseling = Konseling::where('konseli_id', $request->konseli_d)->where('')->where('status_selesai', 'C')->where('id', $request->id)->get();
                return response()->json([
                    'success' => true,
                    'message' => '',
                    'data' => $konseling
                ]);
            }

            $konseling = Konseling::where('konseli_id',$request->konseli_id)->where('status_selesai','C')->where('refered','!=','ya')->with(['konselor' => function ($query){
                $query->with('user')->get();
            }])->with('jadwal')->with('referal')->get();
            return response()->json([
                'success' => true,
                'message' => '',
                'rows' => $konseling
            ]);
        }

        // if($request->has('konselor_id')){
        //     $konseling = Konseling::where('refered', '!=', 'ya')->with('rangkumanKonseling')->with('referal')->with(['konseli' => function ($query) {
        //         $query->with('user')->with(['prodi' => function ($query){
        //             $query->with('faculty')->get();
        //         }])->get();
        //     }])->with(['chats' => function ($query) {
        //                 $query->orderBy('id', 'desc')->first();
        //         }])->with('rekamKonselings')->where('konselor_id',$request->konselor_id)->where('status_selesai','C')->with('jadwal')->get();
        //     $konseling = $konseling->toArray();
        //     return response()->json([
        //         'success' => true,
        //         'message' => '',
        //         'rows' => $konseling
        //     ]);
        // }


        if($request->has('konselor_id')){

            if($request->has('arsip')){
                $konseling = Konseling::with(['referral' => function ($query){
                    $query->with('konselor')->get();
                }])->with('rangkumanKonseling')->has('rangkumanKonseling')->with(['konseli' => function ($query) {
                    $query->with('user')->with(['prodi' => function ($query){
                        $query->with('faculty')->get();
                    }])->get();
                }])->with(['chats' => function ($query) {
                    $query->orderBy('id', 'desc')->first();
                }])->with('rekamKonselings')->where('konselor_id',$request->konselor_id)->with('jadwal')->get();
                $konseling = $konseling->toArray();
                return response()->json([
                    'success' => true,
                    'message' => '',
                    'rows' => $konseling
                ]);
            }

            // $ord = ["selesai", "referal"];

            $konseling = Konseling::where('refered', '!=', 'ya')->with('rangkumanKonseling')->with('referal')->with(['konseli' => function ($query) {
                $query->with('user')->with(['prodi' => function ($query){
                    $query->with('faculty')->get();
                }])->get();
            }])->with(['chats' => function ($query) {
                $query->orderBy('id', 'desc')->first();
            }])->with('rekamKonselings')->where('konselor_id',$request->konselor_id)->with('jadwal')->get();
            $konseling = $konseling->toArray();
            $konselingaktif = [];
            $konselingselesai = [];
            $konselingreferal = [];
            $filteredKonseling = [];

            $ordered = [];
            foreach($konseling as $k){
                if($k['rangkuman_konseling'] == null){
                    $k['p'] = 5;
                    if($k['status_selesai'] != 'C'){
                        $k['p'] = 1;
                    }
                    if($k['status_konseling'] == 'ref'){
                        $k['p'] = 2;
                    }
                    array_push($filteredKonseling, $k);
                }
            }

            usort($filteredKonseling, function ($item1, $item2){
                return $item1['p'] <=> $item2['p'];
            });

            return response()->json([
                'success' => true,
                'message' => '',
                'rows' => $filteredKonseling,
                'ordered' => true
            ]);
        }

        // $konseling = Konseling::where('refered', '!=', 'ya')->with('konselor')->with('referal')->with(['konseli' => function ($query) {
        //     $query->with('user')->with(['prodi' => function ($query){
        //         $query->with('faculty')->get();
        //     }])->get();
        // }])->with(['chats' => function ($query) {
        //             $query->orderBy('id', 'desc')->first();
        //     }])->with('rekamKonselings')->with('jadwal')->get();
        // $konseling = $konseling->toArray();
        // return response()->json([
        //     'success' => true,
        //     'message' => '',
        //     'rows' => $konseling
        // ]);

        $konseling = Konseling::with('konselor')->with('referal')->with(['konseli' => function ($query) {
            $query->with('user')->with(['prodi' => function ($query){
                $query->with('faculty')->get();
            }])->get();
        }])->with(['chats' => function ($query) {
            $query->orderBy('id', 'desc')->first();
        }])->with('rekamKonselings')->with('jadwal')->get();
        $konseling = $konseling->toArray();
        return response()->json([
            'success' => true,
            'message' => '',
            'rows' => $konseling
        ]);

    }

    public function show($id){
        $this->assignUser();
        $konseling = Konseling::with(['konseli' => function ($query){
            $query->with('user')->get();
        }])->find($id);

        $konseling = Konseling::where('id',$id)->with('konselor')->with('referal')->with(['konseli' => function ($query) {
            $query->with('user')->with(['prodi' => function ($query){
                $query->with('faculty')->get();
            }])->get();
        }])->with(['chats' => function ($query) {
            $query->orderBy('id', 'desc')->first();
        }])->with('rekamKonselings')->with('jadwal')->get();
        $konseling = $konseling->toArray();

        if($konseling){
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => $konseling
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'data not found',
                'data' => null
            ]);
        }
    }

    public function create(request $request){
        $this->assignUser();
        $user = $this->user;
        $roleValidator = Validator::make($request->all(), [
//            'status_konseling' => 'required',
//            'status_selesai' => 'required',
//            'konseli_id' => 'required|exists:konselis,id',
            'konselor_id' => 'required|exists:konselors,id',
            'jadwal_konselor_id' => 'required|exists:jadwal_konselors,id',
        ]);
        if($roleValidator->fails()){
            return response()->json([
                'success' => false,
                'message' => $roleValidator->errors()
            ]);
        }


        $limit = Setting::first();
        $currentDate = now();
        $inputs = $request->all();
        $jadwal = JadwalKonselor::find($inputs['jadwal_konselor_id']);


        $currentKonseling = Konseling::where('konseli_id',$user->details->id)->where('status_selesai','C')->where('refered','!=','ya')->with(['konselor' => function ($query){
            $query->with('user')->get();
        }])->with('jadwal')->with('referal')->get()->first();

        if($currentKonseling){
            return response()->json([
                "success" => false,
                "error" => "Anda sudah terdaftar sesi konseling",
                "redirect" => "/dashboard"
            ]);
        }

        if($jadwal->available != "true"){
            return response()->json([
                "success" => false,
                "error" => "Jadwal sudah tidak tersedia",
                "redirect" => "/daftarsesi"
            ]);
        }

        $inputs['status_konseling'] = "non-ref";
        $inputs['status_selesai'] = "C";
        $inputs['konseli_id'] = $this->user->details->id;
        $inputs['tgl_daftar_konseling'] = $currentDate;
        $currentDate = now()->addDays($limit->expired);
        $inputs['tgl_akhir_konseling'] = $currentDate;
        $inputs['tgl_expired_konseling'] = $currentDate;
        $konseling = Konseling::create($inputs);

        $jadwal->available = 'false';
        $jadwal->save();

        $konselor = Konselor::find($request->konselor_id);
        $notification = Notification::create([
            "type" => "new_konseling",
            "data" => $konseling->id,
            'title' => $this->user->details->nama_konseli,
            "message" => "sesi konseling baru",
            "user_id" => $konselor->user_id
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'',
        ]);
    }

    public function update(){

    }
}
