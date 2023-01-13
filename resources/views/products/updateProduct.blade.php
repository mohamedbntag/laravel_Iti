@extends("layouts.master")
@section('title') Add Product @endsection
@section('linkCss')
  <link rel="stylesheet" href="/css/products/myorders.css">
  <link rel="stylesheet" href="/css/products/addproduct.css">
@endsection

@section('container')
<div class="main">

  <!----------------start section left side ------------------->
  @include('layouts.navbarleft')
  <!----------------start section right side ------------------->

  <!----------------start section center ------------------->
  <div class="center productCenter">

<div class="contain">
  <div class="leftSide">

    <h1>Add New Product</h1>
    <div class="icon"><i class="fa fa-bars fa-lg" aria-hidden="true"></i></div>
    <div class="square"><i class="fa fa-free-code-camp" aria-hidden="true"></i></div>
  
    <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
          <input type="text" name="product" class="form-control" id="product" value="{{$product->product}}"  placeholder="product">
        
          @error('product')
          <div style="color:red">{{$message}}</div>
        @enderror
      </div>   
          
        
        <div class="form-group">
          <input type="number" name="price" class="form-control" id="price"  value="{{$product->price}}" placeholder="price  .... EGP">
          @error('price')
          <div style="color:red">{{$message}}</div>
            @enderror
        </div>
        
  
      <div class="form-group">
        <select class="form-select" aria-label="Default select example" name="category">
          <option selected value="{{$product->category}}">{{$product->category}}</option> 
          <option value="Hot Drink">Hot Drink</option> 
          <option value="Cold Drink">Cold Drink</option> 
          <option value="Fresh Drink">Fresh Drink</option> 
          <option value="Fresh Drink">Ice Cream</option> 
        </select>
        @error('category')
          <div style="color:red">{{$message}}</div>
        @enderror
      </div>

    <div class="form-group">
      <input type="file" name="image" class="form-control" id="image">
      @error('image')
          <div style="color:red">{{$message}}</div>
        @enderror
    </div>
      <button type="submit" class="btn">ADD</button>
    </form>
  </div>
  <div class="rightside">
    <div class="aside"></div>
    <div class="info">
      <img class="drink1" src="/images/products/{{$product->image}}">

      <div class="icons">
        <i class="fa fa-facebook fa-lg"></i>
        <i class="fa fa-twitter fa-lg"></i>
        <i class="fa fa-youtube fa-lg"></i>
      </div>
    </div>
  </div>
</div>
  </div>
  </div>
@endsection

  

