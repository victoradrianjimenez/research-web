<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller{

    private function get_rules($id){
        return  [
            'name' => 'required|string',
            'fullname' => 'required|string',
            'link' => 'nullable|url',
            'logo' => 'string|required_without:file_logo',
            'file_logo' => 'file|required_without:logo'
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
        return view('admin..partners.index', [
            'config' => $this->config,
            'partners' => Partner::orderBy('name')->paginate(100)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin..partners.form', [
            'config' => $this->config,
            'partner' => new Partner(),
            'action' => route('partners.store'), 
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
        $partner = new Partner($request->all());
        if ($request->file('file_logo')){
            $partner->logo = $request->file('file_logo')->store('partners','public');
        }
        $partner->save();
        return redirect()->action([PartnerController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner){
        return view('admin..partners.show', [
            'config' => $this->config,
            'partner' => $partner
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner){
        return view('admin..partners.form', [
            'config' => $this->config,
            'partner' => $partner,
            'action' => route('partners.update', $partner->id), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner){
        $request->validate($this->get_rules($partner->id));
        $partner->fill($request->all());
        if ($request->file('file_logo')){
            Storage::disk('public')->delete($partner->logo);
            $partner->logo = $request->file('file_logo')->store('partners','public');
        }
        $partner->save();
        return redirect()->action([PartnerController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner){
        Storage::disk('public')->delete($partner->logo);
        $partner->project()->sync([]);
        $partner->delete();
        return ['status' => 'OK', 'message' => 'The record was successfully deleted.'];
    }
}
