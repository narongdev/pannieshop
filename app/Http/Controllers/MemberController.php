<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public $page_size = 15;

    public function index()
    {

        $member = Member::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        return view('backend.member.index', compact('member'));
    }

    public function search($key)
    {
        // Search
        if($key!= ''){
            $member = Member::where('firstname','LIKE',"%$key%")
            ->orWhere('lastname','LIKE',"%$key%")
            ->orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }else{
            $member = Member::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }
                
        return view('backend.member.index', compact('member'));
    }

    public function create()
    {
        return view('backend.member.create');
    }
    
    public function store(Request $request)
    {
        $request->validate(
            [
            'firstname'=>'required',
            'email'=>'email|unique:members',
            ]
        );        

        $Member = new Member;
        $Member->firstname = $request->firstname;
        $Member->lastname = $request->lastname;
        $Member->address = $request->address;
        $Member->city = $request->city;
        $Member->state = $request->state;
        $Member->phone = $request->phone;
        $Member->email = $request->email;
        $Member->zip = $request->zip;
        $Member->status = $request->status;

        $result = $Member->save();

        if($result){
            return redirect(route('member'))->with('success','Added completed!');
        }else{
            return redirect(route('member'))->with('fail','Cannot save data!');
        }

    }

    
    public function show($id)
    {
        $member = Member::find($id);
        return view('backend.member.show', compact('member',$member));
    }


    public function edit($id)
    {
        $member = Member::find($id);
        return view('backend.member.edit', compact('member',$member));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate(
            [
            'firstname'=>'required',
            'email'=>'email',
            ]
        ); 

        $Member = Member::find($id);
        $Member->firstname = $request->firstname;
        $Member->lastname = $request->lastname;
        $Member->address = $request->address;
        $Member->city = $request->city;
        $Member->state = $request->state;
        $Member->phone = $request->phone;
        //$Member->email = $request->email;
        $Member->zip = $request->zip;
        $Member->status = $request->status;

        $result = $Member->save();
        
        if($result){
            return redirect(route('member'))->with('success','Update completed!');
        }else{
            return back()->with('fail','Something went wrong !');
        }

    }

    
    public function destroy($id)
    {
        $query = Member::find($id)->delete();
        return redirect(route('member'))->with('danger','Deleted completed!');
    }
}
