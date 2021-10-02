<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Member;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class PublicationController extends Controller{

    private function get_rules($id){
        return  [
            'bibtex' => 'required|string',
            'year' => 'required|integer',
            'type' => 'required|alpha_dash',
            'key' => ['required','alpha_dash',Rule::unique('publications')->ignore($id)],
            'citation'=> 'required|string',
            'members' => 'array',
            'members.*' => 'required|integer',
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
        return view('admin.publications.index', [
            'config' => $this->config,
            'publications' => Publication::orderBy('year', 'desc')->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.publications.form', [
            'config' => $this->config,
            'publication' => new Publication(),
            'all' => Member::orderBy('fullname')->get(),
            'action' => route('publications.store'), 
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
        $publication = new Publication(['bibtex' => $request->bibtex]);
        if (!$publication->parse()){
            return back()->withErrors(['bibtex'=>'Incorrect format.'])->withInput();
        }        
        $request['year'] = $publication->year;
        $request['type'] = $publication->type;
        $request['key'] = $publication->url;
        $request['citation'] = $publication->citation;
        $request->validate($this->get_rules(-1));
        $publication->save();
        $publication->members()->sync($request->members);
        return redirect()->action([PublicationController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication){
        return view('admin.publications.form', [
            'config' => $this->config,
            'publication' => $publication,
            'all' => Member::orderBy('fullname')->get(),
            'action' => route('publications.update', $publication->id), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication){
        $publication->fill($request->all());
        if (!$publication->parse()){
            return back()->withErrors(['bibtex'=>'Incorrect format.'])->withInput();
        }
        $request['year'] = $publication->year;
        $request['type'] = $publication->type;
        $request['key'] = $publication->url;
        $request['citation'] = $publication->citation;
        $request->validate($this->get_rules($publication->id));
        $publication->members()->sync($request->members);
        $publication->save();
        return redirect()->action([PublicationController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication){
        $publication->members()->sync([]);
        $publication->delete();
        return ['status' => 'OK', 'message' => 'The record was successfully deleted.'];
    }

    public function search(Request $request){
        return Publication::select(['id','url','citation'])
            ->where('citation', 'like', '%'.$request->key.'%')
            ->orderBy('url')->get();
    }
}