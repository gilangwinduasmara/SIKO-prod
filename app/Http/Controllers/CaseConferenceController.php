<?php

namespace App\Http\Controllers;

use App\CaseConference;
use App\ChatConference;
use App\Konseling;
use App\DetailConference;
use App\Konselor;
use App\Notification;
use Exception as GlobalException;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Validator;

class CaseConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->assignUser();
        $konselor = $this->user->details;
        $caseConference = CaseConference::with('detailConferences')->get();
        if($request->has('konselor_id') && ($request->konselor_id == $konselor->id)){
            $detail = DetailConference::where('konselor_id', $request->konselor_id)->get();
            $caseConference = [];
            if($detail){
                foreach($detail as $d){
                    array_push($caseConference, CaseConference::with(['detailConferences' => function($query){
                        $query->with(['konselor' => function ($query){
                            $query->with('user')->get();
                        }])->get();
                    }])->where('id', $d->case_conference_id)->where('status', 'on-going')->get()->first());
                }
            }
            foreach ($caseConference as $casecon){
                if($casecon){
                    $lastChat = ChatConference::where('case_conference_id', $casecon->id)->latest()->first();
                    if($lastChat){
                        $lastChat['nama_konselor'] = Konselor::where('user_id', $lastChat->UserID)->first()->nama_konselor;
                    }
                    $casecon['last_chat'] = $lastChat;
                }
            }
        }else if($request->has('konseling_id')){
            $caseConference = CaseConference::with('detailConferences')->where('konseling_id', $request->konseling_id)->where('status', 'on-going')->latest()->first();
        }else if($request->has('case_conference_id')){
            $caseConference = CaseConference::with(['detailConferences' => function($query){
                $query->with(['konselor' => function ($query){
                    $query->with('user')->get();
                }])->get();
            }])->where('id', $request->case_conference_id)->where('status', 'on-going')->latest()->first();
        }
        return response()->json([
            'success' => true,
            'message' => '',
            'rows' => $caseConference
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->assignUser();
        $konselor_id = $this->user->details->id;
        $validator = Validator::make($request->all(), [
            'judul_case_conference' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ]);
        }
        $inputs = $request->all();
        $inputs['tgl_mulai_case_conference'] = now();
        $inputs['status'] = 'on-going';
        $caseConference = CaseConference::create($inputs);
        $host = DetailConference::create([
            'konselor_id' => $this->user->details->id,
            'case_conference_id' => $caseConference->id,
            'role' => 'host'
        ]);

        $konseling = Konseling::find($request->konseling_id);
        $konseling->conferenced = 'ya';
        if($request->has('konselors')){
            $konselors = $inputs['konselors'];
            foreach ($konselors as $konselor){
                $k = DetailConference::create([
                    'konselor_id' => $konselor,
                    'case_conference_id' => $caseConference->id,
                    'role' => 'anggota'
                ]);
                $konselor_host = Konselor::find($this->user->details->id);
                $konselor = Konselor::find($konselor);
                $Notification = Notification::create([
                    'type' => 'invitation_conference',
                    'title' => $konselor_host->nama_konselor,
                    'message' => 'Undangan case conference',
                    'data' => $caseConference->id,
                    'user_id' =>$konselor->user_id
                ]);

            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Data successfully stored!',
            'redirect' => '/caseconference?open=true&id='.$caseConference->id
        ]);
    }

    public function declideAgreement(Request $request){
        $konseling = Konseling::with('konseli')->with('konselor')->find($request->konseling_id);
        if($konseling->conferenced == 'ask'){
            $konseling->conferenced = 'tidak';
            $konseling->save();

            $Notification = Notification::create([
                'type' => 'declined_conference',
                'title' => $konseling->konseli->nama_konseli,
                'message' => 'Persetujuan case conference ditolak',
                'data' => $konseling->id,
                'user_id' =>$konseling->konselor->user_id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'data updated!'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'nothing was changed'
        ]);
    }

    public function createAgreement(Request $request){
        try{
            $konseling = Konseling::find($request->konseling_id);
            if($konseling->conferenced == 'tidak' || $konseling->conferenced == 'declined'){
                $konseling->conferenced = 'ask';
                $konseling->save();

                $Notification = Notification::create([
                    'type' => 'ask_conference',
                    'title' => $konseling->konselor->nama_konselor,
                    'message' => 'Permintaan persetujuan case conference',
                    'data' => $konseling->id,
                    'user_id' =>$konseling->konseli->user_id
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'data updated!'
                ]);
            }else if($konseling->conferenced == 'ask'){
                $konseling->conferenced = 'agreed';
                $konseling->save();

                $Notification = Notification::create([
                    'type' => 'agreed_conference',
                    'title' => $konseling->konseli->nama_konseli,
                    'message' => 'Menyetujui permintaan case conference',
                    'data' => $konseling->id,
                    'user_id' =>$konseling->konselor->user_id
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'data updated!'
                ]);
            }
            return response()->json([
                'success' => false,
                'message' => ''
            ]);
        } catch (GlobalException $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CaseConference  $caseConference
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $caseConference = CaseConference::with('detailConferences')->find($id);
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => $caseConference
        ]);
    }

    public function chat(Request $request)
    {
//        $input = $request->all();
//        if($request->has('case_conference_id')){
//            $chat = ChatConference::where('id', $input['case_conference_id'])->get()->groupBy('tgl_chat');
//            $caseConference = CaseConference::with(['chatConferences' => function ($query){
//                $query->
//            }]);
//        }
//        return response()->json([
//            'success' => true,
//            'message' => '',
//            'rows' => $chat
//        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CaseConference  $caseConference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaseConference $caseConference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CaseConference  $caseConference
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseConference $caseConference)
    {
        //
    }
}
