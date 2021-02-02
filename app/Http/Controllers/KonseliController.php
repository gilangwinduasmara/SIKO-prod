<?php

namespace App\Http\Controllers;

use App\Konseli;
use Illuminate\Http\Request;

class KonseliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items =  Konseli::with('prodi')->get();
        return response()->json([
            'success'=>true,
            'message'=>'',
            'rows'=> $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Konseli  $konseli
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Konseli::with('user')->find($id);
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
     * @param  \App\Konseli  $konseli
     * @return \Illuminate\Http\Response
     */
    public function edit(Konseli $konseli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Konseli  $konseli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konseli $konseli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konseli  $konseli
     * @return \Illuminate\Http\Response
     */
    public function destroy(Konseli $konseli)
    {
        //
    }
}
