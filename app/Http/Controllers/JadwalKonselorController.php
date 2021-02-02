<?php

namespace App\Http\Controllers;

use App\JadwalKonselor;
use App\Konseling;
use Illuminate\Http\Request;

class JadwalKonselorController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('konselor_id')){
            if($request->has('online')){
                $items = JadwalKonselor::where('konselor_id',$request->konselor_id)->get();
                return response()->json([
                    'success'=>true,
                    'message'=>'',
                    'data' => $items
                ]);
            }
            $items = JadwalKonselor::where('konselor_id',$request->konselor_id)->where('available','true')->orderBy('jam_mulai')->get()->groupBy('hari');
            // foreach($items as $item){
            //     $toArray[] = (array) $item;
            // }
            return response()->json([
                'success'=>true,
                'message'=>'',
                'data' => $items
            ]);
        }

        $items =  JadwalKonselor::get();
        return response()->json([
            'success'=>true,
            'message'=>'',
            'rows'=> $items
        ]);
    }
}
