<?php

namespace App\Http\Controllers;

use App\CaseConference;
use App\DetailConference;
use App\Konselor;
use App\Notification;
use App\User;
use Illuminate\Http\Request;

class DetailConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => '',
            'rows' => DetailConference::all()
        ]);
    }

    public function tes (){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $c = CaseConference::with(['detailConferences' => function($query){
            $query->with('konselor')->where('role','host')->first();
        }])->find($request->case_conference_id);
        $a = $c->detailConferences->first();
//        memberids, case_conference_id
        $ids = $request->memberids;
        for($i=0; $i<count((array)$ids); $i++){
//            $konselor = Konselor::where('user_id', $ids[$i])->first();
            DetailConference::create([
                'konselor_id' => $ids[$i],
                'case_conference_id' => $request->case_conference_id,
                'role' => 'anggota'
            ]);

            $konselor = Konselor::find($ids[$i]);

            $Notification = Notification::create([
                'type' => 'invitation_conference',
                'title' => $a->konselor->nama_konselor,
                'message' => 'Undangan case conference',
                'data' => $request->case_conference_id,
                'user_id' =>$konselor->user_id
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => ''
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DetailConference  $detailConference
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetailConference  $detailConference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailConference $detailConference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetailConference  $detailConference
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailConference $detailConference)
    {
        //
    }
}
