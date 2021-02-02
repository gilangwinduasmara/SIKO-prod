<?php

namespace App\Http\Controllers;

use App\JadwalKonselor;
use App\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->exists("latest")){
            $pengumuman = Pengumuman::where("status", "aktif")->orderBy('id', 'DESC')->first();
            return response()->json([
                "success" => true,
                "message" => "",
                "data" => $pengumuman
            ]);
        }else{
            $pengumuman = Pengumuman::where("status", "aktif")->get();
        }
        return response()->json([
            "success" => true,
            "message" => "",
            "rows" => $pengumuman
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
        $pengumuman = new Pengumuman;
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;
        $pengumuman->source_gambar = "";
        $pengumuman->status = "aktif";
        $pengumuman->save();
        return response()->json([
            "success" => true,
            "message" => "",
            "data" => $pengumuman
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengumuman = Pengumuman::find($id);
        return response()->json([
            "success" => true,
            "message" => "",
            "data" => $pengumuman
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $pengumuman = Pengumuman::find($id);
        $pengumuman->judul = $request->judul;
        $pengumuman->isi = $request->isi;
        $pengumuman->source_gambar = $request->source_gambar;
        $pengumuman->status = $request->status;
        $pengumuman->save();

        return response()->json([
            "success" => true,
            "message" => "",
            "data" => $pengumuman
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();
        return response()->json([
            "success" => true,
            "message" => "data deleted"
        ]);
    }
}
