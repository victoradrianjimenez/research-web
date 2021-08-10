<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{

    private function get_rules($id){
        return  [
            'name' => 'required|string|max:255',
            'email' => ['required','email','max:255',Rule::unique('users')->ignore($id)],
            'password' => ['nullable','confirmed', Rules\Password::defaults()],
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
        return view('admin.users.index', [
            'config' => $this->config,
            'users' => User::paginate(100)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
        return view('admin.users.form', [
            'config' => $this->config,
            'user' => $user,
            'action' => route('users.update', $user->id), 
            'method' => 'PUT'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user){
        $request->validate($this->get_rules($user->id));
        $user->fill($request->all());
        if ($request->password){
            $user->forceFill([
                'password' => Hash::make($request->password),
            ]);
        }
        $user->save();
        return redirect()->action([UserController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){
        if (Auth::user()->id == $user->id){
            return ['status' => 'ERROR', 'message' => 'You cannot delete your own account.'];    
        }
        $user->delete();
        return ['status' => 'OK', 'message' => 'The record was successfully deleted.'];
    }
}
