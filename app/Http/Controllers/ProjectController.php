<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectClass;
use App\Models\ProjectDescription;
use App\Models\Partner;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProjectController extends Controller{

    private function get_rules($id){
        return [
            'type' => 'required|alpha_dash',
            'title' => ['required','string',Rule::unique('projects')->ignore($id)],
            'logo' => 'required_without:file_logo',
            'file_logo' => 'file|required_without:logo',
            'institution' => 'nullable|string',
            'code' => 'nullable|string',
            'period' => 'required|string',
            'link' => 'nullable|url',
            'url' => 'required|alpha_dash',
            'classes' => 'required|array',
            'classes.*' => 'required|alpha_dash',
            'participants' => 'required|array',
            'participants.*' => 'required|string',
            'publications' => 'array',
            'publications.*' => 'required|integer',
            'partners' => 'array',
            'partners.*' => 'required|integer',
            'descriptions' => 'required|array',
            'descriptions.*.lang' => 'required|alpha|size:2',
            'descriptions.*.title' => 'required|string',
            'descriptions.*.text' => 'required|string',
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
        return view('admin.projects.index', [
            'config' => $this->config,
            'projects' => Project::orderBy('name')->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.projects.form', [
            'config' => $this->config,
            'project' => new Project(),
            'classes' => ProjectClass::where('lang','=','en')->get(),
            'partners' => Partner::orderBy('name')->get(),
            'action' => route('projects.store'), 
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
        $project = new Project($request->all());
        if ($request->file('file_logo')){
            $project->logo = $request->file('file_logo')->store('projects','public');
        }
        $project->class = implode('|', $request->classes);
        $project->participants = implode('|',$request->participants);
        $project->save();
        $project->partners()->sync($request->partners);
        $project->publications()->sync($request->publications);
        foreach($request->descriptions as $r){
            $project->descriptions()->save(new ProjectDescription($r));
        }
        return redirect()->action([ProjectController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project){
        return view('admin.projects.form', [
            'config' => $this->config,
            'project' => $project,
            'classes' => ProjectClass::where('lang','=','en')->get(),
            'partners' => Partner::orderBy('name')->get(),
            'action' => route('projects.update', $project->id), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project){
        $request->validate($this->get_rules($project->id));
        $project->fill($request->all());
        if ($request->file('file_logo')){
            Storage::disk('public')->delete($project->logo);
            $project->logo = $request->file('file_logo')->store('projects','public');
        }
        $project->class = implode('|', $request->classes);
        $project->participants = implode('|',$request->participants);
        $project->save();
        $project->partners()->sync($request->partners);
        $project->descriptions()->delete();
        $project->publications()->sync($request->publications);
        foreach($request->descriptions as $r){
            $project->descriptions()->save(new ProjectDescription($r));
        }
        return redirect()->action([ProjectController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project){
        Storage::disk('public')->delete($project->logo);
        $project->descriptions()->delete();
        $project->publications()->sync([]);
        $project->partners()->sync([]);
        $project->delete();
        return ['status' => 'OK', 'message' => 'The record was successfully deleted.'];
    }
}
