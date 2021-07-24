<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public $page_size = 10;

    public function index()
    {

        $promotion = Promotion::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        return view('backend.promotion.index', compact('promotion'));
    }

    public function search($key)
    {
        // Search
        if($key!= ''){
            $promotion = Promotion::where('promotion','LIKE',"%$key%")->orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }else{
            $promotion = Promotion::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }
                
        return view('backend.promotion.index', compact('promotion'));
    }

    public function create()
    {
        return view('backend.promotion.create');
    }
    
    public function store(Request $request)
    {
        $request->validate(
            [
            'promotion'=>'required',
            ]
        );        

        $Promotion = new Promotion;
        $Promotion->promotion = $request->promotion;
        $Promotion->content = $request->content;
        $Promotion->status = $request->status;

        $result = $Promotion->save();

        if($result){
            return redirect(route('promotion'))->with('success','Added completed!');
        }else{
            return redirect(route('promotion'))->with('fail','Cannot save data!');
        }

    }

    
    public function show($id)
    {
        $promotion = Promotion::find($id);
        return view('backend.promotion.show', compact('promotion',$promotion));
    }


    public function edit($id)
    {
        $promotion = Promotion::find($id);
        return view('backend.promotion.edit', compact('promotion',$promotion));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate(
            [
            'promotion'=>'required',
            ]
        ); 

        $Promotion = Promotion::find($id);
        $Promotion->promotion = $request->promotion;
        $Promotion->content = $request->content;
        $Promotion->status = $request->status;

        $result = $Promotion->save();
        
        if($result){
            return redirect(route('promotion'))->with('success','Update completed!');
        }else{
            return back()->with('fail','Something went wrong !');
        }

    }

    
    public function destroy($id)
    {
        $query = Promotion::find($id)->delete();
        return redirect(route('promotion'))->with('danger','Deleted completed!');
    }
}
