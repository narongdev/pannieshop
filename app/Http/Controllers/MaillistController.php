<?php

namespace App\Http\Controllers;

use App\Models\Maillist;
use Illuminate\Http\Request;

class MaillistController extends Controller
{

    public $page_size = 15;

    public function index()
    {

        $maillist = Maillist::orderBy('email', 'ASC')->simplePaginate($this->page_size);
        return view('backend.maillist.index', compact('maillist'));
    }

    public function search($key)
    {
        // Search
        if($key!= ''){
            $maillist = Maillist::where('email','LIKE',"%$key%")->orderBy('email', 'ASC')->simplePaginate($this->page_size);
        }else{
            $maillist = Maillist::orderBy('email', 'ASC')->simplePaginate($this->page_size);
        }
                
        return view('backend.maillist.index', compact('maillist'));
    }

    public function create()
    {
        return view('backend.maillist.create');
    }
    
    public function store(Request $request)
    {
        $request->validate(
            [
            'email'=>'required|email',
            ]
        );        

        $Maillist = new Maillist;
        $Maillist->email = $request->email;

        $result = $Maillist->save();

        if($result){
            return redirect(route('maillist'))->with('success','Added completed!');
        }else{
            return redirect(route('maillist'))->with('fail','Cannot save data!');
        }

    }

    
    public function show($id)
    {
        $maillist = Maillist::find($id);
        return view('backend.maillist.show', compact('maillist',$maillist));
    }


    public function edit($id)
    {
        $maillist = Maillist::find($id);
        return view('backend.maillist.edit', compact('maillist',$maillist));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate(
            [
            'email'=>'required|email',
            ]
        ); 

        $Maillist = Maillist::find($id);
        $Maillist->email = $request->email;

        $result = $Maillist->save();
        
        if($result){
            return redirect(route('maillist'))->with('success','Update completed!');
        }else{
            return back()->with('fail','Something went wrong !');
        }

    }

    
    public function destroy($id)
    {
        $query = Maillist::find($id)->delete();
        return redirect(route('maillist'))->with('danger','Deleted completed!');
    }
}
