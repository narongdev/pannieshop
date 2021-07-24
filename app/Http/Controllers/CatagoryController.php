<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use Illuminate\Http\Request;

class CatagoryController extends Controller
{

    public $upload_folder = 'catagory/';
    public $page_size = 5;

    public function index()
    {

        $catagory = Catagory::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        return view('backend.catagory.index', compact('catagory'));
    }

    public function filter($recommend)
    {
        // Filter
        if($recommend!= 'all' && $recommend!= ''){
            $catagory = Catagory::where('recommend','=',$recommend)->orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }else{
            $catagory = Catagory::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }
                
        return view('backend.catagory.index', compact('catagory'));
    }

    public function create()
    {
        return view('backend.catagory.create');
    }
    
    public function store(Request $request)
    {
        $request->validate(
            [
            'catagory'=>'required|unique:catagories',
            'image' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
            ],
            [
                'catagory.unique' => 'Catagory already exists!',
            ]
        );

        // Upload Image
        $img = $request->file('image');
        $fullpath = '';
        if($img != ''){
            $oriName = $img->getClientOriginalName();
            $imageFile = date("his").'_'.preg_replace('/[^a-z0-9.]+/', '_', strtolower($oriName));
            $fullpath = $this->upload_folder.$imageFile;
            $img->move($this->upload_folder,$imageFile);
        }

        $Catagory = new Catagory;
        $Catagory->catagory = $request->catagory;
        $Catagory->description = $request->description;
        $Catagory->image = $fullpath;
        $Catagory->recommend = $request->recommend;
        $Catagory->status = $request->status;

        $result = $Catagory->save();

        if($result){
            return redirect(route('catagory'))->with('success','Added completed!');
        }else{
            return redirect(route('catagory'))->with('fail','Cannot save data!');
        }

    }

    
    public function show($id)
    {
        $catagory = Catagory::find($id);
        return view('backend.catagory.show', compact('catagory',$catagory));
    }


    public function edit($id)
    {
        $catagory = Catagory::find($id);
        return view('backend.catagory.edit', compact('catagory',$catagory));
    }

    
    public function update(Request $request, $id)
    {
        
        $request->validate(
            [
            'image' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
            ],
            [
                'catagory.unique' => 'Catagory already exists!',
            ]
        );

        // Upload Image
        $img = $request->file('image');
        $fullpath = '';
        if($img != ''){
            $oriName = $img->getClientOriginalName();
            $imageFile = date("his").'_'.preg_replace('/[^a-z0-9.]+/', '_', strtolower($oriName));
            $fullpath = $this->upload_folder.$imageFile;
            $img->move($this->upload_folder,$imageFile);
        }

        $Catagory = Catagory::find($id);
        $Catagory->catagory = $request->catagory;
        $Catagory->description = $request->description;
        $Catagory->recommend = $request->recommend;
        if($img != '') $Catagory->image = $fullpath;
        $Catagory->status = $request->status;

        $result = $Catagory->save();
        
        if($result){
            return redirect(route('catagory'))->with('success','Update completed!');
        }else{
            return back()->with('fail','Something went wrong !');
        }

    }

    
    public function destroy($id)
    {
        $query = Catagory::find($id)->delete();
        return redirect(route('catagory'))->with('danger','Deleted completed!');
    }
}
