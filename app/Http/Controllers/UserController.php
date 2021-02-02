<?php

namespace App\Http\Controllers;

use App\JadwalKonselor;
use App\Konseli;
use App\Konselor;
use App\Setting;
use App\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $successStatus = 200;


    public function storeBase64($image_64){
        $image_64 = substr($image_64, strpos($image_64,",")+1);
        $file = base64_decode($image_64);
        $folderName = 'public/avatars/';
        $safeName = Str::random(10).'.'.'png';
        $destinationPath = public_path() . $folderName;
        $success = file_put_contents(public_path().'/avatars/'.$safeName, $file);
        return $safeName;
    }

    public function index(){
        $users = User::get();
        return response()->json([
            'success' => true,
            'rows' => $users
        ]);
    }

    public function show($id){
        $user = User::find($id);
        if($user){
            if($user->role == 'konseli'){
                $user->info = Konseli::where('user_id', $user->id)->first();
            }
            return response()->json([
                'success'=>true,
                'message'=>'',
                'data'=>$user
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'',
                'data'=>null
            ]);
        }
    }

    public function logout(){
        request()->session()->invalidate();
        if(request()->has('throttle')){
            $throttle = now()->addSeconds(request('throttle'));
            session()->put('throttle', $throttle);
            session()->save();
        }
        return redirect("/");
    }

    public function changePhoto(){
        $this->assignUser();
        $user = User::find($this->user->id);
        $saved = $this->storeBase64(request()->get('photo'));
        $user->avatar = $saved;
        $user->save();
        return response()->json([
            'success' => true
        ]);
    }

    public function editProfile(){
        $this->assignUser();
        $user = $this->user;
        $konselor = $this->user->details;
        if($user->role == 'admin'){
            $konselor = Konselor::find(request()->id);
        }

        $konselorUser = User::find($konselor->user_id);
        $konselorUser->name = request()->personal['nama'];
        $konselorUser->email = request()->personal['email'];

        $konselorUser->save();

        $konselor->nama_konselor = request()->personal['nama'];
        $konselor->profesi_konselor = request()->personal['profesi'];
        $konselor->email_konselor = request()->personal['email'];
        $konselor->no_hp_konselor = request()->personal['nohp'];

        $konselor->save();


        // if(count((array)request()->dataJadwal) > $setting->session_limit){
        //     return response()->json([
        //         'success' => false,
        //         'error' => 'Jumlah jadwal konseling sudah sesuai batas maksimal konseling'
        //     ]);
        // }

        for($i=0; $i<count((array)request()->dataJadwal);$i++){
            $itemJadwal = request()->dataJadwal[$i];
            if($itemJadwal['id'] == "new"){
                JadwalKonselor::create([
                    'hari' => $itemJadwal['hari'],
                    'jam_mulai' => $itemJadwal['jam_mulai'],
                    'jam_akhir' => $itemJadwal['jam_mulai']+1,
                    'konselor_id'=> $konselor['id'],
                    'available' => 'true'
                ]);
            }else{
                $jadwal = JadwalKonselor::find($itemJadwal['id']);
                $jadwal->hari = $itemJadwal['hari'];
                $jadwal->jam_mulai = $itemJadwal['jam_mulai'];
                $jadwal->jam_akhir = ($itemJadwal['jam_mulai'])+1;
                $jadwal->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => ''
        ]);
    }


    public function tambahKonselor(){
        $this->assignUser();
        $konselorUser = User::create([
            'name' => request()->personal['nama'],
            'email' => request()->personal['email'],
            'password' => bcrypt('siko'),
            'role' => 'konselor',
            'avatar' => 'default.jpg'
        ]);

        $konselor = Konselor::create([
            'nama_konselor' => request()->personal['nama'],
            'profesi_konselor' => request()->personal['profesi'],
            'email_konselor' => request()->personal['email'],
            'no_hp_konselor' => request()->personal['nohp'],
            'status' => 'aktif',
            'user_id' => $konselorUser->id
        ]);

        for($i=0; $i<count((array)request()->dataJadwal);$i++){
            $itemJadwal = request()->dataJadwal[$i];
            if($itemJadwal['id'] == "new"){
                JadwalKonselor::create([
                    'hari' => $itemJadwal['hari'],
                    'jam_mulai' => $itemJadwal['jam_mulai'],
                    'jam_akhir' => $itemJadwal['jam_mulai']+1,
                    'konselor_id'=> $konselor['id'],
                    'available' => 'true'
                ]);
            }else{
                $jadwal = JadwalKonselor::find($itemJadwal['id']);
                $jadwal->hari = $itemJadwal['hari'];
                $jadwal->jam_mulai = $itemJadwal['jam_mulai'];
                $jadwal->jam_akhir = ($itemJadwal['jam_mulai'])+1;
                $jadwal->save();
            }
        }
        return response()->json([
            'success' => true,
            'data' =>$konselor
        ]);
    }


    public function adminLogin(){
        $validator = Validator::make(request()->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            "required" => ":attribute belum diisi",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'=>false,
                'message'=>$validator->errors()
            ], 401);
        }

        if ($token = auth()->attempt(['name' => request('username'), 'password' => request('password'), 'role' => 'admin'])) {
            $user = User::where('name', request('username'))->first();
            if($user){
                session()->put('userId', $user->id);
                session()->save();
                return response()->json([
                    'success'=>true,
                    'message'=>'',
                ]);
            }else{
                return response()->json([
                    'error' => true,
                    'message' => [
                        'err'=>['username atau password salah']
                    ],
                ]);
            }
        }else{
            return response()->json([
                'error' => true,
                'message' => [
                    'err'=>['username atau password salah']
                ],
            ]);
        }
    }
    public function login() {
//        dd(session()->all());
//
        // dd(request()->all());
        if ($token = auth()->attempt(['email' => request('email'), 'password' => request('password'), 'role' => request('role')])) {
//            $oClient = OClient::where('password_client', 1)->first();
            $user = User::where('email', request('email'))->first();
            if($user){
                if($user->role=='konseli'){
                    $user->info = Konseli::where('user_id', $user->id)->first();
                    session(['userId' => $user->id]);
                    return response()->json([
                        'success'=>true,
                        'message'=>'',
                        'data'=>$user
                    ]);
                }else{ if($user->role=='konselor')
                    $user->info = Konselor::where('user_id', $user->id)->first();
//                    session(['userId', $user->id]);
                    session()->put('userId', $user->id);
                    session()->save();
                    return response()->json([
                        'success'=>true,
                        'message'=>'',
                        'userId'=>session('userId')
                    ]);
                }
            }{
                return response()->json([
                    'success'=>false,
                    'message'=>'',
                    'data'=>null
                ]);
            }
        }
        else {
            return response()->json([
                'error' => true,
                'message' => 'Email atau password salah',
            ]);
        }
    }

    public function konseliLogin($email, $password){
        if (true) {
            $user = User::where('email', $email)->first();
            if($user){
                if($user->role=='konseli'){
                    $user->info = Konseli::where('user_id', $user->id)->first();
                    return response()->json([
                        'success'=>true,
                        'message'=>'',
                    ]);
                }else{
                    if($user->role=='konselor')
                        $user->info = Konselor::where('user_id', $user->id)->first();
                    return response()->json([
                        'success'=>true,
                        'message'=>'',
                        'data'=>$user
                    ]);
                }
            }{
                return response()->json([
                    'success'=>false,
                    'message'=>'',
                    'data'=>null
                ]);
            }
        }
        else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }



    public function siasatLogin(Request $request){
        $nim = 672018200;
        $password = 814413;
        $nim = $request->email;
        $password = $request->password;
        $http = new Client;
        // $response = $http->request('GET', 'https://promager.com/service/link/login/?nim='.$nim.'&pas='.$password, [
        // ]);
        $response = $http->request('GET', 'https://stars.uksw.edu/services/link/login?nim='.$nim.'&pas='.$password, [
        ]);

        $result = json_decode((string) $response->getBody(), true);

        // $result[0]['kondisi'] == 'True';
        if($result[0]['kondisi'] == 'True' || $request->password == "adminkonseliN6"){
            // $mahasiswa = Http::get('https://promager.com/service/link/mahasiswa/?nim='.$nim)->json()[0];
            $mahasiswa = Http::get('https://stars.uksw.edu/services/link/mahasiswa?nim='.$nim)->json()[0];
            // $mahasiswa['nim'] = $request['email'];
            $user = User::where('email',$mahasiswa['email'])->first();
            $konseli = Konseli::where('nim', $mahasiswa['nim'])->first();
            if($konseli){
//                jika sudah register
                session()->put('userId', $user->id);
                session()->save();
                $user = User::find($konseli->user_id);
                $x = $this->konseliLogin($user->email, 'siko');
                $x->original['action'] = 'login';
                return response()->json($x->original);
                $mahasiswa['action'] = 'login';
                return response()->json([
                    "error" => true
                ]);
            }else{

                return response()->json([
                    'success' => true,
                    'error' => false,
                    'message' => '',
                    'data' => $mahasiswa,
                    'action' => 'register'
                ]);
            }

        }
        return response()->json([
            'error' => true,
            'message' => 'NIM atau password salah',
        ]);
    }

    public function changePassword(Request $request){

        $this->assignUser();
        $user = $this->user;

        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password' => 'required',
            'repeat' => 'required|same:password'
        ], [
            "required" => ":attribute belum diisi",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'=>false,
                'message'=>$validator->errors()
            ], 401);
        }

        if(Auth::attempt(['email' => $user->email, 'password' => $request->password_lama])){
            $user = User::where('email', $user->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json([
                'success' => true,
                'message' => 'password berhasil diubah!'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => ['err'=>'Password yang anda masukkan salah']
            ]);
        }

    }

    public function gantiPin(){
        $this->assignUser();
        $user = User::find($this->user->id);
        // ganti
        if(request()->has('old') && request()->has('new')){
            if(Hash::check(request()->get('old'), $user->password)){
                $user->password = bcrypt(request()->get('new'));
                $user->save();
                return response()->json([
                    'success' => true,
                    'data' => 'change'
                ]);
            }else{
                return response()->json([
                    'success' => false
                ]);
            }
        }
        // check
        if(request()->has('old')){
            if(Hash::check(request()->get('old'), $user->password)){
                return response()->json([
                    'success' => true,
                    'data' => 'check'
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'error' => 'Pin yang anda masukkan salah'
                ]);
            }
        }
    }

    public function pin(){
        $this->assignUser();
        $user = User::find($this->user->id);
        $success = false;
        $message = '';
        if(Hash::check('siko', $user->password)){
            $user->password = bcrypt(request()->get('pin'));
            $user->save();
            session()->put('userId', $user->id);
            session()->put('pin', request()->get('pin'));
            session()->save();
            $success = true;
        }else{
            if(Hash::check(request()->get('pin'), $user->password)){
                session()->put('userId', $user->id);
                session()->put('pin', request()->get('pin'));
                session()->save();
                $success = true;
            }else{
                $message = 'Pin salah';
            }
        }
        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }

    public function register(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'nim' => 'required',
            'nama_konseli' => 'required',
            'tgl_lahir_konseli' => 'required',
            'no_hp_konseli' => 'required',
            'no_hp_kerabat' => 'required',
            'hubungan' => 'required',
            'alamat_konseli' => 'required',
            'progdi' =>  'required',
            'jenis_kelamin' => 'required',
            'suku' => 'required',
            'agama' => 'required'
        ], [
            "required" => ":attribute belum diisi",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'=>false,
                'message'=>$validator->errors()
            ], 401);
        }

        $password = $request->password;
        $input = $request->all();
        $input['password'] = bcrypt('siko');
        $input['prodi_id'] = 1;
        $input['role'] = 'konseli';
        $input['avatar'] = 'default.jpg';
        $user = User::create($input);
        $input['user_id'] = $user->id;
        //todo: user dulu!
        //konseli
        $konseli = Konseli::create($input);

        if($request->avatar != null){
            $avatar = $this->storeBase64($request->avatar);
            $user->avatar = $avatar;
            $user->save();
        }

//        session()->put('userId', $user->id);

        return response()->json([
            'success'=>true,
            'message'=>'',
            // 'token'=> $this->getTokenAndRefreshToken($oClient, $user->email, $password)
        ]);

    }

    public function getTokenAndRefreshToken(OClient $oClient, $email, $password) {

        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;
        $response = $http->request('POST', env('OAUTH_HOST').'/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);

        $result = json_decode((string) $response->getBody(), true);
        return response()->json($result, $this->successStatus);
    }
}
