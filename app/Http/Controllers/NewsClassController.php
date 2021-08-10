<?php

namespace App\Http\Controllers;

use App\Models\NewsClass;
use App\Models\Configuration;
use Illuminate\Http\Request;

class NewsClassController extends Controller{

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
        return view('admin.news_classes.index', [
            'config' => $this->config,
            'news_classes' => NewsClass::orderBy('name')->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.news_classes.form', [
            'config' => $this->config,
            'news_classes' => [],
            'action' => route('news_classes.store'), 
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
            $res = (new NewsClass([
                'name' => $request->name,
                'lang' => $request->lang[$i],
                'text' => $request->text[$i]
            ]))->save();
        }
        return redirect()->action([NewsClassController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsClass  $NewsClass
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $name){
        return view('admin.news_classes.form', [
            'config' => $this->config,
            'news_classes' => NewsClass::where('name','=',$name)->get(),
            'action' => route('news_classes.update', $name), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewsClass  $NewsClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name){
        $request->validate($this->get_rules($name));
        NewsClass::where('name','=',$name)->delete();
        for($i=0; $i<count($request->lang); $i++){
            $res = (new NewsClass([
                'name' => $request->name,
                'lang' => $request->lang[$i],
                'text' => $request->text[$i]
            ]))->save();
        }
        return redirect()->action([NewsClassController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsClass  $NewsClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $name){
        NewsClass::where('name','=',$name)->delete();
        return ['status' => 'OK', 'message' => 'The record was successfully deleted.'];
    }
}
