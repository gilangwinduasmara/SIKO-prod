<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::get();
        return response()->json([
            'success' => true,
            'message' => '',
            'rows' => $quotes
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
        Quote::create([
            "quote"=>$request->quote,
            "oleh"=>$request->oleh
        ]);
        return response()->json([
            "success"=>true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $quote = Quote::find($id);
        $quote->quote = $request->quote;
        $quote->oleh = $request->oleh;
        $quote->save();
        return response()->json([
            "success"=>true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quote  $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::find($id);
        $quote->delete();
        return response()->json([
            "success"=>true
        ]);
    }
}
