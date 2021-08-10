<?php

namespace App\Http\Controllers;

use App\Models\ProjectClass;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ProjectClassController extends Controller{

    private function get_rules($id){
        return [
            'name' => 'required|alpha_dash',
            'text' => 'required|array',
            'lang' => 'required|array',
            'text.*' => 'required|string',
            'lang.*' => 'required|alpha|size:2'
        ];
    }
    
    public function __construct(){
        $this->config = Configuration::get_all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.project_classes.index', [
            'config' => $this->config,
            'project_classes' => ProjectClass::orderBy('name')->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.project_classes.form', [
            'config' => $this->config,
            'project_classes' => [],
            'action' => route('project_classes.store'), 
            'method' => 'POST'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate($this->get_rules(-1));
        for($i=0; $i<count($request->lang); $i++){
            $res = (new ProjectClass([
                'name' => $request->name,
                'lang' => $request->lang[$i],
                'text' => $request->text[$i]
            ]))->save();
        }
        return redirect()->action([ProjectClassController::class, 'index']);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectClass  $projectClass
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $name){
        return view('admin.project_classes.form', [
            'config' => $this->config,
            'project_classes' => ProjectClass::where('name','=',$name)->get(),
            'action' => route('project_classes.update', $name), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectClass  $projectClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name){
        $request->validate($this->get_rules($name));
        ProjectClass::where('name','=',$name)->delete();
        for($i=0; $i<count($request->lang); $i++){
            $res = (new ProjectClass([
                'name' => $request->name,
                'lang' => $request->lang[$i],
                'text' => $request->text[$i]
            ]))->save();
        }
        return redirect()->action([ProjectClassController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectClass  $projectClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $name){
        ProjectClass::where('name','=',$name)->delete();
        return ['status' => 'OK', 'message' => 'The record was successfully deleted.'];
    }
}
