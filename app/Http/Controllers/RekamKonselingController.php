<?php

namespace App\Http\Controllers;

use App\RekamKonseling;
use Illuminate\Http\Request;

class RekamKonselingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekamKonseling = RekamKonseling::get();
        return response()->json([
            "success" => true,
            "message" => "",
            "rows" =>$rekamKonseling
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
     * @param  \App\RekamKonseling  $rekamKonseling
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $input = $request->all();
        if($request->has('konseling_id')){
            $rekamKonseling = RekamKonseling::where('konseling_id', $input['konseling_id'])->get();
            return response()->json([
                'success' => true,
                'message' => '',
                'rows' => $rekamKonseling
            ]);
        }
        $rekamKonseling = RekamKonseling::with(['konseling' => function($query){
            $query->with(['konselor' => function($query){
                $query->with('user')->get();
            }])->with('konseli')->get();
        }])->get();
        return response()->json([
            'success' => true,
            'message' => '',
            'rows' => $rekamKonseling
        ]);
        return 'halo';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RekamKonseling  $rekamKonseling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RekamKonseling $rekamKonseling)
    {
        $rekamKonseling = RekamKonseling::find($request->id);
        $rekamKonseling->judul_konseling = $request->judul_konseling;
        $rekamKonseling->isi_rekam_konseling = $request->isi_rekam_konseling;
        if($rekamKonseling->save())
            return response()->json([
                'success' => true,
                'message' => 'rekam konseling updated!',
            ]);
        else{
            return response()->json([
                'success' => false,
                'message' => 'rekam konseling update failed!',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RekamKonseling  $rekamKonseling
     * @return \Illuminate\Http\Response
     */
    public function destroy(RekamKonseling $rekamKonseling)
    {
        //
    }
}
