<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Catagory;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public $upload_folder = 'products/';
    public $page_size = 10;

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        $catagory = Catagory::where('status', 'enable')->orderBy('clicks', 'DESC')->get();
        return view('backend.products.index', compact('products','catagory'));
    }

    public function filter($recommend)
    {
        // Filter
        if($recommend!= 'all' && $recommend!= ''){
            $products = Product::where('recommend','=',$recommend)->orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }else{
            $products = Product::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }
        $catagory = Catagory::where('status', 'enable')->orderBy('clicks', 'DESC')->get();
                
        return view('backend.products.index', compact('products','catagory'));
    }

    public function filtercat($cat)
    {
        // Catagory
        if($cat!= 'all' && $cat!= ''){
            $products = Product::where('catagory','LIKE',"%$cat%")->orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }else{
            $products = Product::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }
        $catagory = Catagory::where('status', 'enable')->orderBy('clicks', 'DESC')->get();
                
        return view('backend.products.index', compact('products','catagory'));
    }

    public function create()
    {
        $catagory = Catagory::where('status', 'enable')->get();
        return view('backend.products.create',compact('catagory'));
    }
    
    public function store(Request $request)
    {
        $request->validate(
            [
            'products'=>'required',
            'image' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
            ],
            [
                'products.unique' => 'Product already exists!',
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

        $Product = new Product;
        $Product->products = $request->products;
        $Product->description = $request->description;
        $Product->image = $fullpath;
        $Product->recommend = $request->recommend;
        $Product->price = $request->price;
        $Product->stock = $request->stock;
        $Product->catagory = implode(",",$request->catagory);
        $Product->feature = $request->feature;
        $Product->status = $request->status;

        $result = $Product->save();

        if($result){
            return redirect(url('backend/products/catagory/'.$Product->catagory))->with('success','Added completed!');
        }else{
            return redirect(route('products'))->with('fail','Cannot save data!');
        }

    }
    
    public function show($id)
    {
        $products = Product::find($id);
        $catagory = Product::getCatName($products->catagory);
        return view('backend.products.show', compact('products','catagory'));
    }


    public function edit($id)
    {
        $products = Product::find($id);
        $catagory = Catagory::where('status', 'enable')->get();
        return view('backend.products.edit', compact('products','catagory'));
    }

    
    public function update(Request $request, $id)
    {
        
        $request->validate(
            [
            'image' =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
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

        $Product = Product::find($id);
        $Product->products = $request->products;
        $Product->description = $request->description;
        $Product->recommend = $request->recommend;
        $Product->price = $request->price;
        $Product->stock = $request->stock;
        if($img != '') $Product->image = $fullpath;
        $Product->catagory = implode(",",$request->catagory);
        $Product->feature = $request->feature;
        $Product->status = $request->status;

        $result = $Product->save();
        
        if($result){
            return redirect(url('backend/products/catagory/'.$Product->catagory))->with('success','Update completed!');
        }else{
            return back()->with('fail','Something went wrong !');
        }

    }

    
    public function destroy($id)
    {
        $query = Product::find($id)->delete();
        return redirect(route('products'))->with('danger','Deleted completed!');
    }
}
