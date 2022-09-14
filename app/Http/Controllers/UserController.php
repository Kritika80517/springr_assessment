<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index(){
        $users = User::where('is_admin', '!=', '1')->get();
        return view('dashboard', compact('users'));
    }

    public function store(Request $request){
        $user = new User();
        $user->name =$request->name;
        $user->email =$request->email;
        $user->date_of_joining =$request->date_of_joining;
        $user->date_of_leaving =$request->date_of_leaving;
        if($request->still_work){
            $user->is_emp = 1;
        }
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file-> move(public_path('Image/'), $filename);
            $user->image= $filename;
        }
        //  dd($user);
        $user->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->back();
    }
   
}
