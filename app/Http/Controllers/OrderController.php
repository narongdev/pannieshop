<?php

namespace App\Http\Controllers;

use App\Models\Orderlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public $page_size = 15;

    public function index()
    {

        $order = Orderlist::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        return view('backend.order.index', compact('order'));
    }

    public function search($key)
    {
        // Search
        if($key!= ''){
            $order = Orderlist::where('firstname','LIKE',"%$key%")
            ->orWhere('lastname','LIKE',"%$key%")
            ->orderBy('id', 'DESC')
            ->simplePaginate($this->page_size);
        }else{
            $order = Orderlist::orderBy('id', 'DESC')->simplePaginate($this->page_size);
        }
                
        return view('backend.order.index', compact('order'));
    }

    public function create()
    {
        return view('backend.order.create');
    }
    
    public function store(Request $request)
    {
        $request->validate(
            [
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'email',
            ]
        );        

        $Order = new Orderlist;
        $Order->orderno = date("ymd").'-'.date("is");
        $Order->firstname = $request->firstname;
        $Order->lastname = $request->lastname;
        $Order->address = $request->address;
        $Order->phone = $request->phone;
        $Order->email = $request->email;
        $Order->zip = $request->zip;
        $Order->payment = $request->payment;
        $Order->amount = $request->amount;

        $result = $Order->save();

        if($result){
            return redirect(route('order'))->with('success','Added completed!');
        }else{
            return redirect(route('order'))->with('fail','Cannot save data!');
        }

    }

    
    public function show($id)
    {
        $order = Orderlist::find($id);
        $products = DB::table('orderproducts')
                ->join('products', 'products.id', '=', 'orderproducts.productid')
                ->where('orderproducts.orderid', '=', $id)
                ->select('orderproducts.*', 'products.products')
                ->get();
        return view('backend.order.show', compact('order','products'));
    }


    public function edit($id)
    {
        $order = Orderlist::find($id);
        $products = DB::table('orderproducts')
                ->join('products', 'products.id', '=', 'orderproducts.productid')
                ->where('orderproducts.orderid', '=', $id)
                ->select('orderproducts.*', 'products.products')
                ->get();
        return view('backend.order.edit', compact('order','products'));
    }

    
    public function update(Request $request, $id)
    {

        $Order = Orderlist::find($id);
        $Order->payment = $request->payment;
        $result = $Order->save();

        // Stock & Total Amount Update
        if($request->payment=='paid'){
            $products = DB::table('orderproducts')
                ->join('products', 'orderproducts.productid', '=', 'products.id')
                ->select('orderproducts.*', 'products.catagory')
                ->where('orderproducts.orderid', '=', $id)
                ->get();
            foreach($products as $row){
                // Upate Stock
                DB::table('products')->where('id','=', $row->productid)
                    ->decrement('stock', $row->qty);
                // Update Total Amount
                $Cat = $row->catagory;
                $ArrCat = explode(",",$Cat);
                $Total = $row->totalprice;
                DB::table('catagories')->whereIn('id', [$ArrCat])
                ->increment('amount', $Total);
            }
        }
        
        if($result){
            return redirect(route('order'))->with('success','Update completed!');
        }else{
            return back()->with('fail','Something went wrong !');
        }

    }

    
    public function destroy($id)
    {
        $query = Orderlist::find($id)->delete();
        return redirect(route('order'))->with('danger','Deleted completed!');
    }
}
