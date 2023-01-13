<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Models\User;
use  App\Models\Product;
use  App\Models\Cart;
use  App\Models\Order;
use  App\Models\Check;

class OrdersController extends Controller
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

    public function index(){
       $allusers    = User::all();
       $usersSelect = User::all();

    /*------------------- admin control allorders----------------*/
        if(request()->date) {
            $allusers = User::with('Checks')
            ->whereDate('created_at', request()->date)
            ->get();

        } elseif( request()->searchUser){
            $allusers = User::with('Checks')
            ->where('id', request()->searchUser)
            ->get(); 
        } elseif( request()->searchUser && request()->date){
            $allusers = User::with('Checks')
            ->whereDate('created_at', request()->date)
            ->where('id', request()->searchUser)
            ->get(); 
        }
        $total_all_orders = Order::all()->sum('price');
        $quantity         = Order::all()->count('quantity');
        $users            = User::all()->count('users');
        $count_of_orders  = Check::all()->count('id');
        return view('products.allorders',compact('allusers','usersSelect', 'total_all_orders','quantity','count_of_orders',"users"));
    }


    /* function for get data orders for one user */ 
    public function myorders(){
        $user   = Auth()->user();
        $checks = Check::where('user_id', $user->id)->get();

        if(request()->date) {
            $checks = Check::
            whereDate('created_at', request()->date)
            ->where('user_id', $user->id)
            ->get();
        }
        $total_all_orders = Check::where('user_id',$user->id)->sum('price');
        $count_of_orders = Check::where('user_id',$user->id)->count('user_id');
        $quantity = Check::where('user_id',$user->id)->sum('count');
        return view('products.myorders',compact( 'user',"checks", 'total_all_orders', 'count_of_orders', 'quantity'));
    }
    /*  get data orders for one user  
=========================================2==================================================*/


/*--------------------------------------------store checks orders -------------------------------------1-*/
    public function store(Request $request){
      if ( !empty( $request->product ) )
        {
        $user   = auth()->user();
        $check  = new Check;
        if($request->user != ""){
            $check->user_id = $request->user; // $order_user->id;//$order_user     = User::find($request->user);
            $check->notes   = $request->notes;
            $check->status  = "processing";
            $check->save();       
        }
        else {
        $check->user_id = $user->id;
        $check->notes   = $request->notes;
        $check->status  = "processing";
        $check->save();
        }
        foreach($request->product as $key=>$products)
        {
            $order           = new Order;
            $order->check_id = $check->id;                                            
            $order->user_id  = $user->id;                                                     // not yet
            $order->product  = $request->product[$key];
            $order->image    = $request->image[$key];
            $order->quantity = $request->quantity[$key];
            $order->price    = $request->price[$key];
            $order->save();
        }
        $cart    = Cart::where('user_id', $user->id);
        $cart->delete();

        $total   = Order::where("check_id",$check->id)->sum('price');
        $quantity= Order::where("check_id",$check->id)->count('quantity');

        $AddTotalInChecks = Check::find($check->id);

        $AddTotalInChecks->price = $total;
        $AddTotalInChecks->count = $quantity;
        $AddTotalInChecks->save();

        return redirect()->back()->with('order', 'your Order Added successfully');

    }
        return redirect()->back();

    }

    /*---------------destroy Checks  by admin----------------*/
    public function destroy($id){
        $delete = Check::where("user_id",$id)->delete();
        return response()->json();
    }

    /*---------------updatestatus orders by admin----------------*/
    public function updatestatus(Request $request, $id){
        $update = Check::find($id);
        $update->status = $request['status'];
        $update->save();
        return redirect()->back();
    }
        /*---------------destroy orders by user----------------*/
    public function destroyOrderUser($id){
        $delete = Check::find($id)->delete();
        return response()->json();
    }
    

        /*foreach($request->product as $key=>$products) {
            $save = [
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'Room_No' => $user->Room_No,
                'Ext' => $user->Ext,
                'name'    => $request->product[$key],
                'image' => $request->image[$key],
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
                'created_at' => date("Y-m-d H:i:s", strtotime('now')),
                'updated_at' => date("Y-m-d H:i:s", strtotime('now'))
            ];
            DB::table('orders')->insert($save);
        }
            DB::table('carts')->where('user_id', $user->id)->delete();
            
            if($request->user != ""){$order->user_id  = $request->user;}
            else {$order->user_id  = $user->id;}
        */








}
