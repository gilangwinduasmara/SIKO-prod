<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::get()->first();
        return response()->json([
            'success' => true,
            'data' => $setting
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
        $setting = Setting::get()->first();
        if($setting){
            if($request->has('expired')){
                $setting->expired = $request->expired;
            }else if($request->has('max')){
                $setting->session_limit = $request->max;
            }
            $setting->save();
            return response()->json([
                'success' => true,
                'message' => 'Settings updated!'
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Error!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        $setting = Setting::get()->first();
        return response()->json([
            'success' => true,
            'data' => $setting
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
