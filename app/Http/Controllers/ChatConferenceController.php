<?php

namespace App\Http\Controllers;

use App\CaseConference;
use App\ChatConference;
use App\ChatKonseling;
use App\DetailConference;
use App\Konseli;
use App\Notification;
use App\User;
use Illuminate\Http\Request;

class ChatConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $chat = ChatConference::all();
        if($request->has('konseling_id')){
            $chat = ChatConference::where('konseling_id', $input['konseling_id'])->get()->groupBy('tgl_chat');
        }
        if($request->has('case_conference_id')){
            $chat = ChatConference::with(['konselor' => function($query){
                $query->with('user');
            }])->where('case_conference_id', $input['case_conference_id'])->get()->groupBy('tgl_chat');
        }
        return response()->json([
            'success' => true,
            'message' => '',
            'rows' => $chat
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
        $inputs = $request->all();
        $inputs['tgl_chat'] = now();
        $user = User::find($request->UserID);
        $chat = ChatConference::create([
            'tgl_chat' => now(),
            'chat_konseling' => base64_encode($inputs['chat_konseling']),
            'UserID' => $this->user->id,
            'case_conference_id' => $request->case_conference_id
        ]);

        $members = DetailConference::with('konselor')->where('case_conference_id', $request->case_conference_id)->get();

        $caseconference = CaseConference::where('id',$request->case_conference_id)->get()->first();

        foreach ($members as $member) {
            if($member->konselor->user_id == $this->user->id){
                continue;
            }

            $notification = Notification::create([
                "user_id" => $member->konselor->user_id,
                "message" => $request->chat_konseling,
                "data" => $request->case_conference_id,
                "type" => "chat_conference",
                "title" => $caseconference->judul_case_conference
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
     * @param  \App\ChatConference  $chatConference
     * @return \Illuminate\Http\Response
     */
    public function show(ChatConference $chatConference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChatConference  $chatConference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatConference $chatConference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChatConference  $chatConference
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatConference $chatConference)
    {
        //
    }
}
