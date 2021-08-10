<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsClass;
use App\Models\NewsDescription;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NewsController extends Controller{
    
    private function get_rules($id){
        return [
            'date' => 'required|date_format:Y-m-d', 
            'url' => ['required','alpha_dash',Rule::unique('news')->ignore($id)],
            'author' => 'required|string',
            'classes' => 'required|array',
            'classes.*' => 'required|string',
            'link' => 'nullable|url',
            'descriptions' => 'required|array',
            'descriptions.*.lang' => 'required|alpha|size:2',
            'descriptions.*.title' => 'required|string',
            'descriptions.*.short' => 'required|string',
            'descriptions.*.text' => 'string',
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
        return view('admin.news.index', [
            'config' => $this->config,
            'news' => News::orderBy('date','desc')->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.news.form', [
            'config' => $this->config,
            'news' => new News(),
            'classes' => NewsClass::where('lang','=','en')->get(),
            'action' => route('news.store'),
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
        $news = new News($request->all());
        $news->class = implode('|', $request->classes);
        $news->save();
        foreach($request->descriptions as $r){
            $news->descriptions()->save(new NewsDescription($r));
        }
        return redirect()->action([NewsController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news){
        return view('admin.news.form', [
            'config' => $this->config,
            'news' => $news,
            'classes' => NewsClass::where('lang','=','en')->get(),
            'action' => route('news.update', $news->id), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news){
        $request->validate($this->get_rules($news->id));
        $news->fill($request->all());
        $news->class = implode('|', $request->classes);
        $news->save();
        $news->descriptions()->delete();
        foreach($request->descriptions as $r){
            $news->descriptions()->save(new NewsDescription($r));
        }
        return redirect()->action([NewsController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news){
        $news->descriptions()->delete();
        $news->delete();
        return ['status' => 'OK', 'message' => 'The record was successfully deleted.'];
    }
}
