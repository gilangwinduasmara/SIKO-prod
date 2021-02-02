<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Konselor;
use App\JadwalKonselor;
use App\Setting;
use App\User;
use Illuminate\Support\Str;

use Validator;

class KonselorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $settings = Setting::get()->first();
        $konselors =  Konselor::with('user')->with('jadwalKonselor')->where('status', 'aktif')->get();
        $return = [];

        foreach ($konselors as $konselor) {
            $count = 0;
            foreach($konselor->jadwalKonselor as $jadwal){
                if($jadwal->available == "false"|| $jadwal->available == "candidate"){
                    $count++;
                }
            }
            if($count < $settings->session_limit || $request->exists("all")){
                array_push($return, $konselor);
            }
        }
        return response()->json([
            'success'=>true,
            'message'=>'',
            'rows'=> $return
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBase64($image_64){
        $image_64 = substr($image_64, strpos($image_64,",")+1);
        $file = base64_decode($image_64);
        $folderName = 'public/avatars/';
        $safeName = Str::random(10).'.'.'png';
        $destinationPath = public_path() . $folderName;
        $success = file_put_contents(public_path().'/avatars/'.$safeName, $file);
        return $safeName;
    }
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nama_konselor' => 'required',
            'email_konselor' => 'required|email|unique:users,email',
        ], [
            'required'=>':attribute harus diisi',
            'unique'=>':attribute sudah dipakai'
        ]);
        if ($validatedData->fails()) {
            return response()->json([
                'success'=>false,
                'message'=>$validatedData->errors()
            ], 401);
        }

        $user = new User;
        $user->name = $request->nama_konselor;
        $user->email = $request->email_konselor;
        if($request->exists('avatar')){
            $avatar = $this->storeBase64($request->avatar);
            $user->avatar = $avatar;
        }
        $user->password = bcrypt("siko");
        $user->role = "konselor";
        $user->save();
        try{
            $konselor = new Konselor;
            $konselor->nama_konselor = $request->nama_konselor;
            $konselor->profesi_konselor = $request->profesi_konselor;
            $konselor->email_konselor = $request->email_konselor;
            $konselor->no_hp_konselor = $request->no_hp_konselor;
            $konselor->status = "aktif";
            $konselor->user_id = $user->id;
            $konselor->save();
            if($request->exists("jadwals")){
                $jadwals = $request->jadwals;
                for($i=0; $i<count($jadwals); $i++){
                    $req_jadwal = $jadwals[$i];
                    if(strpos($req_jadwal['id'], 'new') === 0){
                        JadwalKonselor::create([
                            "hari" => $req_jadwal['hari'],
                            "jam_mulai" => $req_jadwal['jam_mulai'],
                            "jam_akhir" => $req_jadwal['jam_akhir'],
                            "available" => 'true',
                            "konselor_id" => $konselor->id
                        ]);
                    }else{
                        $jadwal = JadwalKonselor::find($req_jadwal['id']);
                        if($jadwal){
                            $jadwal->hari = $req_jadwal['hari'];
                            $jadwal->jam_mulai = $req_jadwal['jam_mulai'];
                            $jadwal->jam_akhir = $req_jadwal['jam_akhir'];
                            $jadwal->save();
                        }
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Data successfuly stored',
            ]);
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $item = Konselor::find($id);
        if($item){
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => $item
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $konselor = Konselor::find($id);
            $konselor->nama_konselor = $request->nama_konselor;
            $konselor->profesi_konselor = $request->profesi_konselor;
            $konselor->email_konselor = $request->email_konselor;
            $konselor->no_hp_konselor = $request->no_hp_konselor;
            $konselor->save();

            if($request->exists('avatar')){
                if($request->avatar != null){
                    $user = User::find($konselor->user_id);
                    $avatar = $this->storeBase64($request->avatar);
                    $user->avatar = $avatar;
                    $user->save();
                }
            }

            if(count($request->jadwals)>0){
                $jadwals = $request->jadwals;
                for($i=0; $i<count($jadwals); $i++){
                    $req_jadwal = $jadwals[$i];
                    if(strpos($req_jadwal['id'], 'new') === 0){
                        JadwalKonselor::create([
                            "hari" => $req_jadwal['hari'],
                            "jam_mulai" => $req_jadwal['jam_mulai'],
                            "jam_akhir" => $req_jadwal['jam_akhir'],
                            "available" => 'true',
                            "konselor_id" => $id
                        ]);
                    }else{
                        $jadwal = JadwalKonselor::find($req_jadwal['id']);
                        if($jadwal){
                            $jadwal->hari = $req_jadwal['hari'];
                            $jadwal->jam_mulai = $req_jadwal['jam_mulai'];
                            $jadwal->jam_akhir = $req_jadwal['jam_akhir'];
                            $jadwal->save();
                        }
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Data successfuly updated',
            ]);
        }catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>$e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
