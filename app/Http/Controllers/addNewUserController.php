<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Hash;

class addNewUserController extends Controller
{


/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
        
    public function create(){
        return view('adduser');
    }

    public function store(request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:3|confirmed',
            'Room_No' => 'required|string|min:1|max:100',
            'Ext' => 'required', 'string|min:1|max:100',
            'image' =>'required',
        ]);

        $img = $request->file('image');
        if($img) {
            $imgpath = "images/register/";
            $art = date("YmdHis").".".$img->getClientOriginalExtension();
            $img->move($imgpath, $art); 
        }

        $data     =request()->all();
        $file    = $art;
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'Room_No' => $data['Room_No'],
                'Ext' => $data['Ext'],
                'typeUser' =>$data['typeUser'],
                "image"=> $file 
            ]);

            return redirect()->back()->with("status","Added New User !");
    }


    public function showusers(){
        $allusers    = User::all();
        $usersSelect = User::all();

    /*------------------- admin control ----------------*/
        if(request()->date) {
            $allusers = User::with('Checks')
            ->whereDate('created_at', request()->date)
            ->get();

        } elseif( request()->searchUser){
            $allusers = User::with('Checks')
            ->where('id', request()->searchUser)
            ->get(); 
        } elseif( request()->searchUser && request()->date){
            $allusers = User::with('Checks')
            ->whereDate('created_at', request()->date)
            ->where('id', request()->searchUser)
            ->get(); 
        }
        return view('showusers',compact('usersSelect','allusers'));

    }

    public function destroy($id){
        $user = User::find($id);
        if($id == 1){
            return redirect()->back();
        }
        $user->delete();
        return response()->json();
    }

 










}
