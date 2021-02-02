<?php

namespace App\Http\Controllers;

use App\JadwalKonselor;
use App\Konseling;
use App\RangkumanKonseling;
use Illuminate\Http\Request;

class RangkumanKonselingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rangkumanKonseling = RangkumanKonseling::create([
            "rangkuman" => $request->rangkuman,
            "treatment" => $request->treatment,
            "konseling_id" => $request->konseling_id
        ]);
        $konseling = Konseling::find($request->konseling_id);
        $jadwal = JadwalKonselor::find($konseling->jadwal_konselor_id);
        $jadwal->available = "true";
        $jadwal->save();
        return response()->json([
            "success" => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rangkumanKonseling  $rangkumanKonseling
     * @return \Illuminate\Http\Response
     */
    public function show(rangkumanKonseling $rangkumanKonseling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rangkumanKonseling  $rangkumanKonseling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rangkumanKonseling $rangkumanKonseling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rangkumanKonseling  $rangkumanKonseling
     * @return \Illuminate\Http\Response
     */
    public function destroy(rangkumanKonseling $rangkumanKonseling)
    {
        //
    }
}
