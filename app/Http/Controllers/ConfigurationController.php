<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigurationController extends Controller{
    
    public function __construct(){
        $this->config = Configuration::get_all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.configurations.index', [
            'config' => $this->config,
            'configurations' => Configuration::orderBy('key')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(Configuration $configuration){
        return view('admin.configurations.form', [
            'config' => $this->config,
            'configuration' => $configuration,
            'action' => route('configuration.update', $configuration->name), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuration $configuration){
        switch ($configuration->type){
            case "file":
                $request->validate(['value' => 'required|file']);
                $file = $request->file('value');
                if ($file){
                    Storage::disk('public')->delete($configuration->value);
                    $configuration->value = $file->storeAs('', $file->getClientOriginalName(), 'public');
                }
                break;
            case 'url':
                $request->validate(['value' => 'required|url']);
                $configuration->value = $request->value;
                break;
            default:    
                $request->validate(['value' => 'required|string']);
                $configuration->value = $request->value;
        }
        $configuration->save();
        return redirect()->action([ConfigurationController::class, 'index']);
    }

}
