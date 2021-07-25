<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Catagory;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Orderlist;

class FrontController extends Controller
{
    
    public function homePage(Request $request)
    {
        
        if(!session()->has('sessionIP')){
            $ipAddress = $request->ip();
            session(['sessionIP' => $ipAddress]);
        }
        if(!session()->has('sessionCart')){
            session(['sessionCart' => $this->inCart()]);
        }

        /////////////////// All Catagory /////////////////////
        $Catagory = Catagory::where('status', '=', 'enable')
            ->orderBy('id', 'ASC')
            ->get();

        /////////////////// Promotion ////////////////////////

        $Promotion = Promotion::where('status', '=', 'enable')
            ->orderBy('id', 'ASC')
            ->get();

        ////////////////// Products Recommend ////////////////////////

        $RecomProduct = Product::where('status', '=', 'enable')
            ->where('recommend', '=', 'Y')
            ->orderBy('id', 'ASC')
            ->limit(8)
            ->get();
        $Rec = count($RecomProduct);

        if($Rec < 8){
            $Lim = 8;
            $Remain = $Lim - $Rec;
            // Get Id in used
            $ArrID = array();
            foreach($RecomProduct as $item){
                $ArrID[] = $item->id;
            }
            $NotIn = implode(",",$ArrID);
            
            $TopSaleProduct = DB::select("SELECT products.*,SUM(qty) as amount FROM orderproducts  
                INNER JOIN products ON orderproducts.productid=products.id
                WHERE products.id NOT IN ($NotIn) 
                GROUP BY orderproducts.productid
                ORDER BY amount DESC 
                LIMIT $Remain");
            /*
            $TopSaleProduct = DB::table('orderproducts')
                ->join('products', 'orderproducts.productid', '=', 'products.id')
                ->select(DB::raw('products.*','SUM(orderproducts.qty) as amount'))
                ->where('products.status','=','enable')
                ->whereNotIn('products.id',[$NotIn])
                ->groupBy('orderproducts.productid')
                //->orderByRaw('amount', 'DESC')
                ->limit($Remain)
                ->get();
            */

            $Top = count($TopSaleProduct);
            if($Top < $Remain){
                $SubRemain = $Remain - $Top;
                $ArrID2 = array();
                foreach($TopSaleProduct as $item){
                    $ArrID2[] = $item->id;
                }
                // Find Product to display for 8
                $RecomProductRemain = Product::where('status', '=', 'enable')
                ->where('recommend', '<>', 'Y')
                ->whereNotIn('id',$ArrID2)
                ->orderBy('id', 'ASC')
                ->limit($SubRemain)
                ->get();
            }

        }else{
            $TopSaleProduct = array();
        }

                    
        ///////////////// Featured Collections /////////////////////////

        $RecomCatagory = Catagory::where('status', '=', 'enable')
            ->where('recommend', '=', 'Y')
            ->orderBy('id', 'ASC')
            ->limit(3)
            ->get();
        $Rec = count($RecomCatagory);
        if($Rec < 3){
            $Lim = 3;
            $Remain = $Lim - $Rec;
            
            $ArrID = array();
            foreach($RecomCatagory as $row){
                $ArrID[] = $row->id;
            }

            $TopSaleCatagory = Catagory::where('status', '=', 'enable')
                ->whereNotIn('id',$ArrID)
                ->orderBy('amount', 'DESC')
                ->orderBy('clicks', 'DESC')
                ->limit($Remain)
                ->get();
        }else{

            $TopSaleCatagory = array();
        }
        
        
        ////////////////// Trending Catagories //////////////////////

        $TopClickCatagory = Catagory::where('status', '=', 'enable')
            ->orderBy('clicks', 'DESC')
            ->orderBy('amount', 'DESC')
            ->limit(6)
            ->get();



        return view('frontend.home',compact('Catagory','Promotion','RecomProduct','TopSaleProduct','RecomProductRemain','RecomCatagory','TopSaleCatagory','TopClickCatagory'));
    }

    //////////////////////////  Catagory Page /////////////////////////////

    public function catagoryPage($id)
    {
        if(!session()->has('sessionIP')){
            $ipAddress = $request->ip();
            session(['sessionIP' => $ipAddress]);
        }
        session(['sessionCart' => $this->inCart()]);

        $Products = Product::where('status', '=', 'enable')
            ->where('catagory', 'LIKE', "%$id%")
            ->orderBy('id', 'ASC')
            ->limit(15)
            ->get();
        $CatagoryName = Product::getCatName($id);
        $Catagory = Catagory::where('status', '=', 'enable')
            ->orderBy('id', 'ASC')
            ->get();
        return view('frontend.catagory', compact('Products','Catagory','CatagoryName'));
    }

    //////////////////////////  Product Page /////////////////////////////

    public function productPage($id)
    {
        if(!session()->has('sessionIP')){
            $ipAddress = $request->ip();
            session(['sessionIP' => $ipAddress]);
        }
        session(['sessionCart' => $this->inCart()]);

        $Products = Product::find($id);
        $CatagoryName = Product::getCatName($Products->catagory);
        $Catagory = Catagory::where('status', '=', 'enable')
            ->orderBy('id', 'ASC')
            ->get();
        $Relate = Product::where('status', '=', 'enable')
            ->where('catagory','LIKE',"%$Products->catagory%")
            ->where('id','<>',$Products->id)
            ->orderBy('id', 'ASC')
            ->limit(4)
            ->get();
        $Recent = Product::where('status', '=', 'enable')
            ->where('id','<>',$Products->id)
            ->orderBy('updated_at', 'DESC')
            ->limit(5)
            ->get();

        return view('frontend.products', compact('Products','Catagory','CatagoryName','Relate','Recent'));
    }

    //////////////////////////  Cart Page /////////////////////////////

    public function cartPage()
    {
        session(['sessionCart' => $this->inCart()]);
        $ProductsInCart = DB::table('carts')
            ->join('products', 'products.id', '=', 'carts.productid')
            ->select('products.*', 'carts.qty')
            ->where('ip','=',session('sessionIP'))
            ->get();

        return view('frontend.cart', compact('ProductsInCart'));
    }

    //////////////////////////  Checkout Page /////////////////////////////

    public function checkoutPage()
    {
        session(['sessionCart' => $this->inCart()]);
        $ProductsInCart = DB::table('carts')
            ->join('products', 'products.id', '=', 'carts.productid')
            ->select('products.*', 'carts.qty')
            ->where('ip','=',session('sessionIP'))
            ->get();

        if(session()->has('sessionMember')){
            $Member = Member::where("email","=",session('sessionMember'))->first();
        }else{
            $Member = array();
        }

        return view('frontend.checkout', compact('ProductsInCart','Member'));
    }

    //////////////////////////  Billing  /////////////////////////////

    public function billingInfo(Request $request)
    {

        // Billing
        $request->validate(
            [
            'firstname'=>'required',
            'lastname'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
            'phone'=>'required',
            'email'=>'email',
            ],
            [
                'firstname.required' => 'The "FIRST NAME" field is required.',
                'lastname.required' => 'The "LAST NAME" field is required.',
                'address.required' => 'The "STREET ADDRESS" field is required.',
                'city.required' => 'The "CITY" field is required.',
                'state.required' => 'The "STATE" field is required.',
                'zip.required' => 'The "ZIP" field is required.',
                'phone.required' => 'The "PHONE" field is required.',
                'email.email' => 'The "EMAIL" must be a valid email address',
            ]
        );        

        $ProductsInCart = DB::table('carts')
        ->join('products', 'products.id', '=', 'carts.productid')
        ->select('products.*', 'carts.qty')
        ->where('ip','=',session('sessionIP'))
        ->get();

        $Amount = 0;
        foreach($ProductsInCart as $item)
        {
            $Amount = $Amount + $item->qty*$item->price;
        }

        $Order = new Orderlist;

        $Order->orderno = date("ymd").'-'.date("is");
        $Order->amount = $Amount;
        $Order->firstname = $request->firstname;
        $Order->lastname = $request->lastname;
        $Order->address = $request->address;
        $Order->city = $request->city;
        $Order->state = $request->state;
        $Order->zip = $request->zip;
        $Order->phone = $request->phone;
        $Order->email = $request->email;
        $result = $Order->save();

        $OrderId = $Order->id;

        // Add to Order products
        foreach($ProductsInCart as $item)
        {
            DB::table('orderproducts')->insert([
                'orderid' => $OrderId,
                'productid' => $item->id,
                'qty' => $item->qty,
                'unitprice' => $item->price,
                'totalprice' => $item->qty*$item->price
            ]);
        }


        if($result){
             
            /// Clear Cart
            session(['sessionCart' => 0]);
            Cart::where('ip','=',session('sessionIP'))->delete();

            return redirect(route('thank'))->with('success','Added completed!');
        }else{
            return redirect(route('checkout'))->with('fail','Cannot save data!');
        }

    }

    //////////////////// Register & Login /////////////////////////

    public function register(Request $request)
    {
        $request->validate(
            [
            'email'=>'required|email|unique:members',
            'password'=>'required|min:5|max:12',
            ],
            [
                'email.required' => 'The "Email" field is required.',
                'password.required' => 'The "Password" field is required.',
                'email.unique' => 'Email already exists!',
            ]
        );        

        $Member = new Member;
        $Member->email = $request->email;
        $Member->password = Hash::make($request->password);

        $result = $Member->save();

        if($result){
            session(['sessionMember' => $request->email]);
            return redirect(route('account'))->with('success','Register completed!');
        }else{
            return redirect(route('register'))->with('fail','Cannot register!');
        }
    }

    public function login(Request $request)
    {
        $request->validate(
            [
            'lemail'=>'required|email',
            'lpassword'=>'required|min:5|max:12',
            ],
            [
                'lemail.required' => 'The "Email" field is required.',
                'lpassword.required' => 'The "Password" field is required.',
            ]
        );        

        $Member = Member::where("email","=",$request->lemail)->first();
        if($Member){
            if(Hash::check($request->lpassword,$Member->password)){
                session(['sessionMember' => $Member->email]);
                return redirect(route('account'))->with('success','Login completed!');
            }else{
                return back()->with('fail','Invalid Username or Password!');
            }
        }
    }

    public function information(Request $request)
    {
        
        $request->validate(
            [
            'firstname'=>'required',
            'lastname'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
            'phone'=>'required',
            'email'=>'email',
            ],
            [
                'firstname.required' => 'The "FIRST NAME" field is required.',
                'lastname.required' => 'The "LAST NAME" field is required.',
                'address.required' => 'The "STREET ADDRESS" field is required.',
                'city.required' => 'The "CITY" field is required.',
                'state.required' => 'The "STATE" field is required.',
                'zip.required' => 'The "ZIP" field is required.',
                'phone.required' => 'The "PHONE" field is required.',
                'email.email' => 'The "EMAIL" must be a valid email address',
            ]
        );        

        $Member = Member::find($request->memberid);

        $Member->firstname = $request->firstname;
        $Member->lastname = $request->lastname;
        $Member->address = $request->address;
        $Member->city = $request->city;
        $Member->state = $request->state;
        $Member->zip = $request->zip;
        $Member->phone = $request->phone;
        $result = $Member->save();

        if($result){
            return redirect(route('account'))->with('success','Added completed!');
        }else{
            return redirect(route('account'))->with('fail','Cannot save data!');
        }
    }

    //////////////////////////  Account  /////////////////////////////

    public function account()
    {
        if(!session()->has('sessionMember')){
            return redirect(route('register'));
        }
        $Member = Member::where('email','=',session('sessionMember'))->first();
        return view('frontend.account',compact('Member'));
    }

    public function logout()
    {
        session()->pull('sessionMember');
        return redirect(route('register'));
    }


    /////////////////////// Add to cart ////////////////////////////////

    public function inCart()
    {
        $InCart = Cart::where('ip','=',session('sessionIP'))
        ->get();
        return count($InCart);
    }

    public function addCart(Request $request)
    {
        
        // Count Item in cart
        $Result = Cart::all();
        $Count = count($Result);

        // Check in Cart
        $InCart = Cart::where('token','=',$request->token)
                ->where('productid','=',$request->productid)
                ->first();

        if($InCart){
            $id = $InCart->id; // id in cart by product
            $qty = $InCart->qty;
            $price = $InCart->price;
            $Cart = Cart::find($id);
            $Cart->qty = $qty+$request->qty;
            $result = $Cart->save();

            if($result){
                return Response()->json(["cart"=>$Count,"result"=>"Add to cart sucessfully"]);
            }else{
                return Response()->json(["cart"=>$Count,"result"=>"Add to cart fail"]);
            }
        }else{
            // Add new item in cart
            $Cart = new Cart;
            $Cart->token = $request->token;
            $Cart->productid = $request->productid;
            $Cart->ip = $request->ip();
            $Cart->qty = $request->qty;

            $result = $Cart->save();
            if($result){
                return Response()->json(["cart"=>$Count+1,"result"=>"Add to cart sucessfully"]);
            }else{
                return Response()->json(["cart"=>$Count+1,"result"=>"Add to cart fail"]);
            }
        }
        
        
    }

    public function updateCart(Request $request)
    {
        // Format "proqty" (id=qty) 3=3,2=1,4=2
        $Str = $request->proqty;
        $Arr = explode(",",$Str);
        foreach($Arr as $prod){
            list($pid,$qty) = explode("=",$prod);

            DB::table('carts')
              ->where('productid','=', $pid)
              ->where('token','=', $request->token)
              ->update(['qty' => $qty]);
        }
        return Response()->json(["result"=>"Update sucessfully"]);
    }

    public function clearcart()
    {
        session(['sessionCart' => 0]);
        Cart::where('ip','=',session('sessionIP'))->delete();
        return redirect(route('cart'));
    }

    //////////////////////////// Subscribe /////////////////////////////
    public function subscribe(Request $request)
    {
        DB::table('maillists')
        ->updateOrInsert(
            ['email' => $request->email]
        );
        return Response()->json(["result"=>"Subscribe sucessfully"]);
    }

    public function addclick(Request $request)
    {
        DB::table('catagories')->where('id','=', $request->catagory)
                    ->increment('clicks');
        return Response()->json(["result"=>"Subscribe sucessfully"]);
    }

}
