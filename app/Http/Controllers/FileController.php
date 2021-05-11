<?php

namespace App\Http\Controllers;

use App\File as AppFile;
use App\Konseling;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Str;

use File;

class FileController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->assignUser();
        $konseling = new Konseling();
        $konseling->with('konseli');
        $konseling->with('konselor');
        if($this->user->role == 'konseli'){
           $konseling->where('konseli_id', $this->user->details->konseli_id);
        }
        if($this->user->role == 'konselor'){
           $konseling->where('konselor_id', $this->user->details->konselor_id);
        }
        $konseling = $konseling->find(request()->konseling_id);
        if($konseling == null){
            return response()->json([
                'success' => false
            ]);
        }

        $file = AppFile::create([
            'name' => request()->file_name,
            'path' => 'uploads/'.request()->file_id,
            'user_id' => $this->user->id,
            'konseling_id' => $konseling->id,
            'file_type' => explode('.', request()->file_id)[1],
            'file_size' => File::size(public_path('uploads/'.request()->file_id))
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function upload(Request $request){

        if($request->hasFile('file')) {

          // Upload path
          $destinationPath = 'uploads/';

          // Get file extension
          $extension = $request->file('file')->getClientOriginalExtension();

          // Valid extensions
          $validextensions = array("jpeg","jpg","png","pdf");

          // Check extension
          if(in_array(strtolower($extension), $validextensions)){

            // Rename file
            $randomGeneratedName = Str::random(32);

            $fileName = $randomGeneratedName .'.' . $extension;
            // Uploading file to given path
            $request->file('file')->move($destinationPath, $fileName);

            return response()->json([
                'success' => true,
                'fileName' => $request->file('file')->getClientOriginalName(),
                'fileId' => $fileName,
            ]);
          }

        }
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
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
