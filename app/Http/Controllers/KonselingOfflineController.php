<?php

namespace App\Http\Controllers;

use App\KonselingOffline;
use Illuminate\Http\Request;

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
    public function update(Request $request, KonselingOffline $konselingOffline)
    {
        //
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
