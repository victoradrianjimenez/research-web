<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller{

    public function __construct(){
        $this->config = Configuration::get_all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $assets = [];
        foreach(Storage::files('public') as $f){
            array_push($assets, (object)[
                'name' => substr($f, 7),
                'size' => Storage::size($f),
                'time' => Storage::lastModified($f)
            ]);
        }
        return view('admin.assets.index', [
            'config' => $this->config,
            'assets' => $assets
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'asset' => ['required','file',function($attribute, $value, $fail) use ($request){
                $file = $request->file('asset');
                if ($file){
                    if (Storage::disk('public')->exists($file->getClientOriginalName())){
                       $fail('The file already exists.');
                    }
                }else{
                    $fail('The file is empty.');
                }
            }]
        ]);
        $file = $request->file('asset');
        $file->storeAs('', $file->getClientOriginalName(), 'public');
        return redirect()->action([AssetController::class, 'index']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $old_name){
        $request->validate([
            'name' => 'required|regex:/^[a-z0-9_.-]*$/'
        ]);
        Storage::disk('public')->move($old_name, $request->name);
        return redirect()->action([AssetController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name){
        Storage::disk('public')->delete($name);
        return ['status' => 'OK', 'message' => 'The file was successfully deleted.'];
    }
}
