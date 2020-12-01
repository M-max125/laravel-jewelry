<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('userProfile')->with('user',auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $input = $request->except('password','password_confirmation');
        
        if(!$request->filled('password')){
            
           $user->fill($input)->save();
           return back()->with('success_message','Profile updated successfully!');
        }
        $user->password = bcrypt($request->password);
        $user->fill($input)->save();
        return back()->with('success_message','Profile ( and password )updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadAvatar(Request $request)
    {
        if($request->hasFile('avatar')){
           $filename = $request->avatar->getClientOriginalName();
            $this->removeOldAvatar();
           $request->avatar->storeAs('images/avatar',$filename,'public');
           auth()->user()->update(['avatar' => $filename]);
           
        }
        return redirect()->back();
       
    }

    protected function removeOldAvatar(){
        
        if(auth()->user()->avatar){
            Storage::delete('/public/images/avatar/'.auth()->user()->avatar);
        }
    }

    
}
