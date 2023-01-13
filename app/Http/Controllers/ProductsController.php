<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Product;
use Illuminate\Support\Facades\DB;
class ProductsController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function index()
    {
        $products = Product::orderby('id','desc')->get();
        return view("products.showproducts",compact("products"));
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.addproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
        'product'=>'required|min:2|max:20',
        'price'=>'required||min:1|max:20',
        'category'=>'required',
        'image'=>'required',
    ]);

    $img = $request->file('image');//$request['image'];
    if($img) {
        $imgpath = "images/products/";
        $art     = date("YmdHis").".".$img->getClientOriginalExtension();
        $img->move($imgpath, $art); 
    }
    
    $data     =request()->all();
    $product  = $data['product'];
    $price    = $data['price'];
    $category = $data['category'];
    $file     = $art;
    
    Product::create([
        "product" =>$product,
        "admin_id"=> auth()->user()->id,
        "price"   =>$price,
        "category"=>$category,
        "image"   => $file  
    ]);

    return redirect()->route("product.create")->with("status","Added New Product !");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product    = Product::findOrfail($id);
        return view('products.updateProduct',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product' =>'required|min:2|max:20',
            'price'   =>'required||min:1|max:20',
            'category'=>'required',
        ]);
        $product           = Product::find($id);
        $product->product  = $request->input('product');
        $product->price    = $request->input('price');
        $product->category = $request->input('category');
        $image             = $request->file('image');
        if($image) {
            $imgDes   = "images/products/";
            $artimage = date("YmdHis").".".$image->getClientOriginalExtension();
            $image->move($imgDes, $artimage);
            $product["image"]= $artimage; 
        }
        $product->save();
        return redirect()->route("product.edit",$id)->with('status', 'added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remove = Product::find($id);
        $remove->delete();
        return redirect()->route("dashboard")->with('delete',"Deleted successfully !!");
    }
}
