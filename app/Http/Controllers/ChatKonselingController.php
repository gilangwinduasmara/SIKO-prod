<?php

namespace App\Http\Controllers;

use App\ChatKonseling;
use App\RekamKonseling;
use DateTime;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Notification;
use App\Konseling;
use App\Konseli;
use App\Konselor;

class ChatKonselingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function assignUser(){
        $userId = session('userId');
        $this->user = User::find($userId);
        session(['token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8yMDYuMTg5Ljk0LjE4Mzo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNjA5ODI2ODM1LCJleHAiOjE2MDk4MzA0MzUsIm5iZiI6MTYwOTgyNjgzNSwianRpIjoiYTA3bzBsWTcySzdMSnhpYyIsInN1YiI6MywicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSIsInVzZXIiOnsiaWQiOjMsIm5hbWUiOiJQZHQuIE9uZXNpbXVzIERhbmkiLCJlbWFpbCI6Im9uZXMuZGFuaUB1a3N3LmVkdSIsImVtYWlsX3ZlcmlmaWVkX2F0IjpudWxsLCJyb2xlIjoia29uc2Vsb3IiLCJjcmVhdGVkX2F0IjoiMjAyMC0wOS0yNFQxOToxMToxNC4wMDAwMDBaIiwidXBkYXRlZF9hdCI6IjIwMjAtMDktMjRUMTk6MTE6MTQuMDAwMDAwWiIsImF2YXRhciI6InJkNnRHalYyeXQucG5nIiwiaW5mbyI6eyJpZCI6MiwibmFtYV9rb25zZWxvciI6IlBkdC4gT25lc2ltdXMgRGFuaSIsInByb2Zlc2lfa29uc2Vsb3IiOiJQZHQgVW5pdmVyc2l0YXMgS3Jpc3RlbiBTYXR5YSBXYWNhbmEiLCJlbWFpbF9rb25zZWxvciI6Im9uZXMuZGFuaUB1a3N3LmVkdSIsIm5vX2hwX2tvbnNlbG9yIjoiMDgxIiwic3RhdHVzIjoiYWt0aWYiLCJ1c2VyX2lkIjozLCJjcmVhdGVkX2F0IjoiMjAyMC0wOS0yNFQxOToxMToxNC4wMDAwMDBaIiwidXBkYXRlZF9hdCI6IjIwMjAtMDktMjRUMTk6MTQ6MzAuMDAwMDAwWiJ9fX0.aTNMHdlQhPjdMUt7CAof96fBcRcYRS-G5W-ogvnV5aY']);

        if($this->user->role == 'konselor'){
            $this->user['details'] = Konselor::where('user_id', $this->user->id)->get()->first();
        }else{
            $this->user['details'] = Konseli::where('user_id', $this->user->id)->get()->first();
        }
    }

    public function index(Request $request)
    {

        $this->assignUser();
        $user = $this->user;
        $input = $request->all();

        if($request->has('last') && $request->has('konseling_id')){
            $chatKonseling = ChatKonseling::where('konseling_id', $request->konseling_id)->latest()->first();
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => $chatKonseling
            ]);
        }

        $chat = ChatKonseling::where('konseling_id', $input['konseling_id'])->get()->groupBy('tgl_chat');

        $konseling = Konseling::find($input['konseling_id']);

        if($user->role == 'konseli'){
            if($konseling->konseli_id != $user->details->id){
                dd(json_encode($user));
                return "denied";
            }
        }else if($user->role == 'konselor'){
            if($konseling->konselor_id != $user->details->id){
                dd(json_encode($user));
                return "denied";
            }
        }else{
            dd(json_encode($user));
            return "denied";
        }

        if($konseling->status_selesai != "C"){
            return response()->json([
                'success' => false,
                'error' => 'konseling_end',
                'data' => $konseling
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => '',
            'rows' => $chat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request){
        $this->assignUser();
        $roleValidator = Validator::make($request->all(), [
            'chat_konseling' => 'required',
            'konseling_id' => 'required|exists:konselings,id',
        ]);

        $konseling = Konseling::find($request->konseling_id);
        $sender = User::find($this->user->id);



        if($sender->role == 'konseli'){
            $konselor = Konselor::find($konseling->konselor_id);
            $notification = Notification::create([
                "user_id" => $konselor->user_id,
                "message" => $request->chat_konseling,
                "data" => $konseling->id,
                "type" => "chat",
                "title" => $sender->name
            ]);
        }
        if($sender->role == 'konselor'){
            $konseli = Konseli::find($konseling->konseli_id);
            $notification = Notification::create([
                "user_id" => $konseli->user_id,
                "message" => $request->chat_konseling,
                "data" => $konseling->id,
                "type" => "chat",
                "title" => $sender->name
            ]);
        }

        if($roleValidator->fails()){
            return response()->json([
                'success' => false,
                'message' => $roleValidator->errors()
            ]);
        }
        $currentDate = now();
        $inputs = $request->all();

        $inputs['tgl_chat'] = $currentDate;
        $inputs['userID'] = $this->user->id;
        $inputs['chat_konseling'] = base64_encode($inputs['chat_konseling']);

        $chatKonseling = ChatKonseling::create($inputs);

        $chatDate = new DateTime($chatKonseling->tgl_chat);
        $chatDate = $chatDate->format('Y-m-d');

        $rekamKonseling = RekamKonseling::where('konseling_id', $inputs['konseling_id'])->where('tgl_konseling', $chatDate)->get();
        if(count($rekamKonseling)){
            return response()->json([
                'success'=>true,
                'message'=>'rekam konseling sudah ada',
                'rekamKonseling' =>$rekamKonseling
            ]);
        }

        $user = User::find($chatKonseling->userID);
        if($user->role == 'konselor'){
            $rekamKonseling = RekamKonseling::create([
                'konseling_id' => $inputs['konseling_id'],
                'tgl_konseling' => $currentDate->toDateString(),
                'judul_konseling' => '',
                'isi_rekam_konseling' => ''
            ]);

            return response()->json([
                'success'=>true,
                'message'=>'rekam konseling dibuat!',
            ]);
        }
        return response()->json([
            'success'=>true,
            'message'=>'rekam tidak dibuat!',
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChatKonseling  $chatKonseling
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChatKonseling  $chatKonseling
     * @return \Illuminate\Http\Response
     */
    public function edit(ChatKonseling $chatKonseling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChatKonseling  $chatKonseling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChatKonseling $chatKonseling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChatKonseling  $chatKonseling
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatKonseling $chatKonseling)
    {
        //
    }
}
