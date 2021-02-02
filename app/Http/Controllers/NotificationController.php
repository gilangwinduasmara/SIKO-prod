<?php

namespace App\Http\Controllers;

use App\CaseConference;
use App\Konseling;
use App\Notification;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function count($user_id, Request $request){
        if($request->has('chat'))
            $notification = Notification::where('user_id',$user_id)->whereNull('read_at')->where('type', 'chat')->get();
        else
            $notification = Notification::where('user_id',$user_id)->whereNull('read_at')->where('type', '!=', 'chat')->get();
        return response()->json([
            'success'=>true,
            'message'=>'',
            'data'=>count($notification)
        ]);
    }


    public function readAll(Request $request){
        $this->assignUser();
        $user = $this->user;
        if($request->type == 'chat'){
            $notif = Notification::where('user_id', $user->id)->whereIn('type', ['chat', 'chat_conference'])->get();
            foreach($notif as $n){
                $n->read_at = now();
                $n->save();
            }
        }
        if($request->type == 'notif'){
            $notif = Notification::where('user_id', $user->id)->whereNotIn('type', ['chat', 'chat_conference'])->get();

            // dd(json_encode($notif));
            foreach($notif as $n){
                $n->read_at = now();
                $n->save();
            }
        }

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function read($id){
        $this->assignUser();
        $user = $this->user;
        $notif = Notification::find($id);
        if($notif->read_at != null){
            return redirect()->back();
        }
        if($notif->type == 'chat' || $notif->type == 'chat_conference'){
            $data = $notif->data;
            $chats = Notification::where('data', $data)->update(['read_at' => now()]);
        }
        $notif->read_at = now();
        $notif->save();
        if($notif->type == 'chat'){
            if($user->role === 'konseli'){
                return redirect('/ruangkonseling');
            }
            if($user->role === 'konselor'){
                return redirect('/daftarkonseli?open&id='.$notif->data);
            }
        }

        if($notif->type == 'chat_conference'){
            return redirect('/caseconference?id='.$notif->data);
        }

        if($notif->type == 'new_referral'){
            if($user->role === 'konselor'){
                return redirect('/daftarkonseli?open&id='.$notif->data);
            }
            if($user->role === 'konseli'){
                return redirect("/dashboard#modal__referral");
            }
        }

        if($notif->type == 'new_conference'){
            return redirect('/caseconference?id='.$notif->data);
        }

        if($notif->type == 'ask_referral'){
            if($user->role === 'konseli'){
                return redirect("/dashboard#modal__referral");
            }
        }

        if($notif->type == 'ask_conference'){
            if($user->role === 'konseli'){
                return redirect("/dashboard#modal__case_conference");
            }
        }

        if($notif->type == 'invitation_conference'){
            if($user->role === 'konselor'){
                return redirect('/caseconference?id='.$notif->data);
            }
        }

        if($notif->type == 'agreed_referral'){
            if($user->role === 'konselor'){
                return redirect("/setup/referral?id=".$notif->data);
            }
        }
        if($notif->type == 'declined_referral'){
            if($user->role === 'konselor'){
                return redirect("/setup/referral?id=".$notif->data);
            }
        }

        if($notif->type == 'agreed_conference'){
            if($user->role === 'konselor'){
                return redirect("/setup/caseconference?id=".$notif->data);
            }
        }

        if($notif->type == 'declined_conference'){
            if($user->role === 'konselor'){
                return redirect("/setup/caseconference?id=".$notif->data);
            }
        }

        if($notif->type == 'new_konseling'){
            if($user->role === 'konselor'){
                return redirect("/daftarkonseli?&id=".$notif->data);
            }
        }

        if($notif->type == 'end_konseling'){
            if($user->role === 'konselor'){
                return redirect("/daftarkonseli?id=".$notif->data);
            }
        }

        return redirect('/dashboard');

    }


    public function index(Request $request)
    {
        $this->assignUser();
            $user = $this->user;
        $n = [];
        $dataGroups = Notification::where('type','chat')->where('user_id', $user->id)->orderBy('created_at', 'desc')->where('read_at')->get()->groupBy('data');
        foreach($dataGroups as $group){
            array_push($n, head($group)[0]);
        }
        $notifications = Notification::where('type', '!=', 'chat')->where('user_id', $user->id)->orderBy('created_at', 'desc')->where('read_at')->get();
        foreach($notifications as $notif){
            array_push($n, $notif);
        }
        // return response()->json([
        //     'success'=>true,
        //     'message'=>'',
        //     'rows'=>$n,
        // ]);
        if(true){
            $notifications = Notification::where('read_at')->where('type','chat')->orderBy('created_at')->where('user_id', $user->id)->get()->groupBy(['data']);
            // dd($notifications);
            $notification = [];
            foreach($notifications as $n){
                $konseling = Konseling::find($n[0]['data']);
                if($konseling){
                    if($konseling->status_selesai == "C" && $konseling->refered != "ya"){
                        array_push($notification, $n[count($n)-1]);
                    }
                }
            }
            $askReferral = [];

            $_chatConference = Notification::whereNull('read_at')->where('type', 'chat_conference')->where('user_id', $user->id)->get()->groupBy(['data']);
            // dd(json_encode($_chatConference));
            foreach($_chatConference as $chat){
                $case = CaseConference::find($chat[0]['data']);
                if($case){
                    if($case->status == "on-going"){
                        // dd(true);
                        array_push($notification, $chat[count($chat)-1]);
                    }
                }
            }

            $_askReferrals = Notification::where('read_at')->whereIn('type', ['ask_referral', 'agreed_referral', 'declined_referral'])->where('type','!=','chat')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get()->groupBy(['type'])->first();
            if($_askReferrals){
                $_askReferrals->toArray();
                foreach($_askReferrals as $ar){
                    $k = Konseling::where('status_selesai', 'C')->where('refered','!=','ya')->where('id',$ar['data'])->get();
                    if($user->role == 'konseli'){
                        $k = Konseling::where('status_selesai', 'C')->where('refered','ask')->where('id',$ar['data'])->get();
                    }
                    if(count($k)>0){
                        array_push($notification, $ar);
                    }
                };
            }

            $referral = Notification::where('read_at')->where('user_id', $user->id)->whereIn('type', ['new_referral'])->orderBy('created_at')->get();

            foreach($referral as $r){
                $k = Konseling::find($r->data);
                if($k->status_selesai == 'C' && $k->refered != 'ya')
                    array_push($notification, $r);
            }

            $_conferences = Notification::where('read_at')->where('user_id', $user->id)->whereIn('type', ['ask_conference','agreed_conference','invitation_conference', 'declined_conference'])->orderBy('created_at')->get();
            // return response()->json([$_conferences]);
            foreach($_conferences as $c){
                $conf = Konseling::find($c->data);
                if($c->type == 'ask_conference'){
                    if($conf->conferenced != 'ask'){
                        continue;
                    }
                }
                if($c->type == 'ask_referral'){
                    if($conf->refered != 'ask'){
                        continue;
                    }
                }
                array_push($notification, $c);
            }



            $_others = Notification::where('read_at')->where('user_id', $user->id)->whereIn('type', ['new_konseling', 'end_konseling'])->orderBy('created_at')->get();
            foreach ($_others as $o) {
                if($o->type == 'new_konseling'){
                    $k = Konseling::with(['chats' => function($query) use ($user){
                        $query->where('userID', $user->id);
                    }])->find($o->data);
                    if($k){
                        if($k->status_selesai == 'C' && $k->refered != "ya" && count($k->chats) == 0){
                            array_push($notification, $o);
                        }
                    }
                }
                if($o->type == 'end_konseling'){
                    $k = Konseling::with('rangkumanKonseling')->find($o->data);
                    if($k->rangkumanKonseling == null){
                        array_push($notification, $o);
                    }
                }
            }

        }
        foreach($notification as $notif){
            $notif['timestamp'] = $notif->created_at->diffForHumans(null, true);
        }

        $created_at = array_column($notification, 'created_at');
        array_multisort($created_at, SORT_DESC, $notification);

        return response()->json([
            'success'=>true,
            'message'=>'',
            'rows'=>$notification,
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
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
