<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Description;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SectionController extends Controller{

    private function get_rules($id){
        return  [
            'url' => ['required','alpha_dash',Rule::unique('sections')->ignore($id)],
            'descriptions' => 'required|array',
            'descriptions.*.id' => 'nullable|integer',
            'descriptions.*.lang' => 'required|string|size:2',
            'descriptions.*.type' => 'required|string',
            'descriptions.*.title' => 'required|string',
            'descriptions.*.logo' => 'nullable',
            'descriptions.*.file_logo' => 'nullable|file',
            'descriptions.*.text' => 'nullable|string',
            'descriptions.*.link' => 'nullable|string'
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
        return view('admin.sections.index', [
            'config' => $this->config,
            'sections' => Section::orderBy('url')->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.sections.form', [
            'config' => $this->config,
            'section' => new Section(),
            'action' => route('sections.store'), 
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
        $section = new Section($request->all());
        $section->save();
        foreach($request->descriptions as $i => $r){
            $d = new Description($r);
            if (isset($r['file_logo'])){
                $d->logo = $request->file('descriptions')[$i]['file_logo']->store('sections','public');
            }
            $section->descriptions()->save($d);
        }
        return redirect()->action([SectionController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section){
        return view('admin.sections.form', [
            'config' => $this->config,
            'section' => $section,
            'action' => route('sections.update', $section->id), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section){
        $request->validate($this->get_rules($section->id));
        $section->fill($request->all());
        $section->save();
        foreach($section->descriptions as $d){
            //borrar imagenes de items eliminados
            $keep = false;
            foreach($request->descriptions as $r){
                if ($d->id == $r['id']){
                    $keep = $r['logo'] == $d->logo && !isset($r['file_logo']);
                    break;
                }
            }
            if (!$keep && Storage::disk('public')->exists($d->logo)){
                Storage::disk('public')->delete($d->logo);
            }
        }
        $section->descriptions()->delete();
        foreach($request->descriptions as $i => $r){
            $d = new Description($r);
            if (isset($r['file_logo'])){
                $d->logo = $request->file('descriptions')[$i]['file_logo']->store('sections','public');
            }
            $section->descriptions()->save($d);
        }
        return redirect()->action([SectionController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section){
        foreach($section->descriptions as $d){
            Storage::disk('public')->delete($d->logo);
        }
        $section->descriptions()->delete();
        $section->delete();
        return ['status' => 'OK', 'message' => 'The record was successfully deleted.'];
    }
}
