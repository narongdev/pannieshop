<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $page_size = 15;

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->simplePaginate($this->page_size);        
        return view('backend.user.index', compact('users'));
    }

    public function filter($type)
    {
        
        if($type!= 'all' && $type!=''){
            $users = User::where('usertype','=',$type)->orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }else{
            $users = User::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }
                
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        return view('backend.user.create');
    }
    
    public function store(Request $request)
    {
        $request->validate(
            [
            'username'=>'required|unique:users',
            'firstname'=>'required',
            'password'=>'required',
            'email'=>'email|unique:users',
            ],
            [
                'username.unique' => 'Username already exists!',
                'email.unique' => 'Email already exists!',
                'firstname.required' => 'Please input firstname!'
            ]
        );

        $User = new User;
        $User->username = $request->username;
        $User->password = Hash::make($request->password);
        $User->firstname = $request->firstname;
        $User->lastname = $request->lastname;
        $User->email = $request->email;
        $User->usertype = $request->usertype;
        $User->status = $request->status;

        $result = $User->save();

        if($result){
            return redirect(route('user'))->with('success','Added completed!');
        }else{
            return redirect(route('user'))->with('fail','Cannot save data!');
        }

    }

    
    public function show($id)
    {
        $users = User::find($id);
        return view('backend.user.show', compact('users',$users));
    }


    public function edit($id)
    {
        $users = User::find($id);
        return view('backend.user.edit', compact('users',$users));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate(
            [
            'email'=>'email'
            ]
        );
        
        $User = User::find($id);
        $User->username = $request->username;
        $User->firstname = $request->firstname;
        $User->lastname = $request->lastname;
        $User->email = $request->email;
        $User->usertype = $request->usertype;
        $User->status = $request->status;
        if($request->password != '') $User->password = Hash::make($request->password);

        $result = $User->save();
        
        if($result){
            return redirect(route('user'))->with('success','Update completed!');
        }else{
            return back()->with('fail','Something went wrong !');
        }

    }

    
    public function destroy($id)
    {
        $query = User::find($id)->delete();
        return redirect(route('user'))->with('danger','Deleted completed!');
    }

}
