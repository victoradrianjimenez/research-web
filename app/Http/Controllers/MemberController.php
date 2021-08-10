<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Social;
use App\Models\Bio;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MemberController extends Controller{

    private function get_rules($id){
        return  [
            'url' => ['required','alpha_dash',Rule::unique('members')->ignore($id)],
            'type' => 'required|alpha_dash',
            'fullname' => 'required|string',
            'photo' => 'string|required_without:file_photo',
            'file_photo' => 'file|required_without:photo',
            'order' => 'required|integer',
            'socials' => 'array',
            'socials.*.name' => 'required|string',
            'socials.*.text' => 'required|string',
            'socials.*.link' => 'nullable|string',
            'bios' => 'required|array',
            'bios.*.lang' => 'required|alpha_dash|size:2',
            'bios.*.role' => 'required|string',
            'bios.*.short' => 'nullable|string',
            'bios.*.interests' => 'nullable|string',
            'bios.*.activities' => 'nullable|string'
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
        return view('admin.members.index', [
            'config' => $this->config,
            'members' => Member::orderBy('order')->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.members.form', [
            'config' => $this->config,
            'member' => new Member(),
            'action' => route('members.store'), 
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
        $member = new Member($request->all());
        if ($request->file('file_photo')){
            $member->photo = $request->file('file_photo')->store('members','public');
        }
        $member->save();
        foreach($request->socials as $i => $r){
            $member->socials()->save(new Social($r));
        }
        foreach($request->bios as $i => $r){
            $member->bios()->save(new Bio($r));
        }
        return redirect()->action([MemberController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member){
        return view('admin.members.form', [
            'config' => $this->config,
            'member' => $member,
            'action' => route('members.update', $member->id), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member){
        $request->validate($this->get_rules($member->id));
        $member->fill($request->all());
        if ($request->file('file_photo')){
            Storage::disk('public')->delete($member->photo);
            $member->photo = $request->file('file_photo')->store('members','public');
        }
        $member->save();
        $member->socials()->delete();
        foreach($request->socials as $i => $r){
            $member->socials()->save(new Social($r));
        }
        $member->bios()->delete();
        foreach($request->bios as $i => $r){
            $member->bios()->save(new Bio($r));
        }
        return redirect()->action([MemberController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member){
        $member->bios()->delete();
        $member->socials()->delete();
        $member->publications()->sync([]);
        Storage::disk('public')->delete($member->photo);
        $member->delete();
        return ['status' => 'OK', 'message' => 'The record was successfully deleted.'];
    }
}
