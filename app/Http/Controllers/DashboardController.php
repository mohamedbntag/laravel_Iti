<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use  App\Models\Product;
use  App\Models\Cart;

class DashboardController extends Controller
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
    public function index()
    {
        $user       = auth()->user();
        $carts      = $user->carts;
        //$carts      = Cart::where('user_id', $user->id)->get();
        $count      = Cart::where('user_id', $user->id)->count();
        $sum        = Cart::where('user_id', $user->id)->sum('price');
        $products   = Product::all();
        $users      = User::all();
        return view("dashboard",compact('products','users', 'carts', 'count','sum'));
    }

    public function addcart(request $request, $id){
        $product = Product::find($id);
        $user    = Auth()->user();

        $total   = $product->price * $request->quantity;
        $cart    = new Cart;

            $cart->user_id     = $user->id;     
            $cart->product_id  = $product->id;   
            $cart->product     = $product->product;   
            $cart->image       = $product->image;   
            $cart->quantity    = $request->quantity;   
            $cart->price       = $total;
            $cart->save();   
        return redirect()->back();
    }

/*------------------------decr incre-----------------------*/

public function updateIncre($id){
    $inc         = Cart::where('id', $id)->increment('quantity');
    $cart        = Cart::find($id);
    $product     = Product::find($cart->product_id);
    $cart->price = $cart->quantity * $product->price;
    $cart->save();
    return redirect()->back();
}

public function updateDecre( $id){
    $cart        = Cart::find($id);
    if($cart->quantity <= 1){
        return redirect()->back();
    }
    $inc = Cart::where('id', $id)->decrement('quantity'); 
    $product     = Product::find($cart->product_id);
    $cart->price = $cart->quantity * $product->price;
    $cart->save();
    return redirect()->back();

}


public function cartdestroy($id){
    $cart = Cart::find($id);
    $cart->delete();
    return redirect()->back();
}




    
}
