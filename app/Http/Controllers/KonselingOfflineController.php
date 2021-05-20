<?php

namespace App\Http\Controllers;

use App\Konseling;
use App\KonselingOffline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonselingOfflineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->assignUser();
        $user = $this->user;
        $konselingOffline = new KonselingOffline;
        if(empty($user) || $user->role == 'konseli'){
            return response()->json([
                'success' => false,
                'error' => 'wait a minute, who are you'
            ]);
        }
        if($user->role == 'konselor'){
            $konselingOfflines = $konselingOffline->where('konselor_id', $user->details->id)->get();
        }else if ($user->role == 'admin'){
            $konselingOfflines = $konselingOffline->with(['konselor' => function($query){
                return $query->with('user');
            }])->get();
        }
        return response()->json([
            'success' => true,
            'data' => $konselingOfflines
        ]);
    }

    public function dt(){
        $this->assignUser();
        $konseling = KonselingOffline::with('konselor');
        if($this->user->role == 'konseli'){
            return response()->json([
                'success' => false,
                'error' => 'Wait a minute, who are you?'
            ]);
        }
        if($this->user->role == 'konselor'){
            $konseling->where('konselor_id', $this->user->details->id);
        }
        $startDate = request()->get('from');
        $endDate = request()->get('to');

        if($startDate && $endDate){
            $konseling->whereDate('waktu', '>=', date('Y-m-d', strtotime($startDate)))->whereDate('waktu', '<=', date('Y-m-d', strtotime($endDate)));
        }

        $data = $konseling->get();
        return datatables($data)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $user = $this->user;
        KonselingOffline::create([
            'nama_konseli' => $request->nama_konseli,
            'unit_asal_konseli' => $request->unit_asal_konseli,
            'tempat' => $request->tempat,
            'waktu' => $request->waktu,
            'topik' => $request->topik,
            'rekam_konseling' => $request->rekam_konseling,
            'rumusan_masalah' => $request->rumusan_masalah,
            'treatment' => $request->treatment,
            'konselor_id' => $user->details->id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KonselingOffline  $konselingOffline
     * @return \Illuminate\Http\Response
     */
    public function show(KonselingOffline $konselingOffline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KonselingOffline  $konselingOffline
     * @return \Illuminate\Http\Response
     */
    public function edit(KonselingOffline $konselingOffline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KonselingOffline  $konselingOffline
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->assignUser();
        $konselingOffline = KonselingOffline::where('konselor_id', $this->user->details->id)->where('id', $id)->first();
        $konselingOffline->nama_konseli = request()->nama_konseli;
        $konselingOffline->tempat = request()->tempat;
        $konselingOffline->waktu = request()->waktu;
        $konselingOffline->topik = request()->topik;
        $konselingOffline->rekam_konseling = request()->rekam_konseling;
        $konselingOffline->rumusan_masalah = request()->rumusan_masalah;
        $konselingOffline->treatment = request()->treatment;
        $konselingOffline->konselor_id = $this->user->details->id;
        $konselingOffline->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KonselingOffline  $konselingOffline
     * @return \Illuminate\Http\Response
     */
    public function destroy(KonselingOffline $konselingOffline)
    {
        //
    }
}
