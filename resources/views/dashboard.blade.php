@extends("layouts.master")

@section('linkCss')
 <link rel="stylesheet" href="/css/products/showproducts.css">
@endsection

@section('container')

  <div class="main">
    @include('layouts.status')

    <div class="skills">
      
      <div class="icon"><i class="fa fa-times-circle-o fa-3x" aria-hidden="true"></i></div>
      <div class="order_items">
        <div class="row">
          @foreach($carts as $cart)
            <div class="col-md-3">
              <div class="card">
                <div class="imgproduct"><img src="/images/products/{{$cart->image}}"></div>
                <div class="priceitem">{{$cart->product}}&nbsp; &nbsp; <span>$ {{$cart->price}}</span></div>
              </div>
            </div>
          @endforeach
        </div>
      </div>


    </div>


    <!----------------start section left side ------------------->
    @include('layouts.navbarleft')
    <!----------------start section right side ------------------->
    <div class="center">
                
      <div class="head">
        <h3>Welcome To <br> Espresso Love <img src="/images/main/icon2.png" class="icon2"></h3>

        <div class="row types">
          @if(Auth::user()->typeUser == 1)
            <select class="form-control" id="select">
              <option selected value="" style="color:#DDD">Choose the User Order</option>
              @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          </select> 
          @else
          <div class="col-md-3 active">
            <img src="/images/main/cafee.png">
            <span>Hot Drink</span>
          </div>
          <div class="col-md-3">
            <img src="/images/main/pepsi.png">
            <span>Cold Drink</span>
          </div>
          <div class="col-md-3">
            <img src="/images/main/fresh.png">
            <span>Fresh Drink</span>
          </div>
          <div class="col-md-3">
            <img src="/images/main/ice.png">
            <span>Ice Cream</span>
          </div>   
          @endif
        
        </div>
      </div>


      <div class="items">
        
          <div class="row">
            @foreach ($products as $product)
              <div class="col-md-3">
                <div class="box">
                  <div class="img"><img src="/images/products/{{$product->image}}"></div>
                  <div class="boxcontain">
                    
                    <div class="price"><span>{{$product->product}}</span><span class="dollar">$ {{$product->price}}</span></div>
                    <div class="cat">{{$product->category}}</div>
                   
                    <form action="{{route('addcart',$product->id)}}" method="POST">
                      @csrf
                      <input type="number" min="1" max="50" value="1" class="form-control" name="quantity">
                      <button type="submit" class="btn btn-primary"><i class="active fa fa-check " aria-hidden="true"></i></button>
                    </form>

                  </div>
                  
                  @if(Auth::user()->typeUser == 1)  
                  <div class="button">
                    <form action="{{route('product.destroy', $product->id)}}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn delete" ><i class=" fa fa-remove " aria-hidden="true"></i></button>
                      </form>
                      <a href="{{route('product.edit',$product->id)}}" class="btn btn-success"><i class=" fa fa-wrench " aria-hidden="true"></i></a>
                  </div>
                  @endif

                </div>   
              </div>
              @endforeach 
                  
          </div>  
      </div>
      
      
      
    </div>

        <!----------------End section center ------------------->

        <!----------------Start section check Out ------------------->
    <div class="rightside">
      <img src="images/main/ice4.png" class="ice">
      <img src="images/main/icon6.png" class="icon6">

      <div class="logo">

        <span>-50% Off </span>The Full Price of Cafe`
        <img src="images/main/ice2.png">
        @if($count > 0)
        <div class="itemscart"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>
        @endif
      </div>

      <div class="cart">
        <div class="count">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Cart[{{$count}}]
          <i class="fa fa-money" aria-hidden="true"></i>&nbsp;Total ${{$sum}}
        </div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Product</th>
              <th scope="col">quantity</th>
              <th scope="col">price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach($carts as $cart)
                <tr>
                  <td>{{$cart->product}}</td>
                  <td>
                    <form method="POST">
                      @csrf
                      @method("PUT")
                      <button class="btn btn-warning"  formaction="{{route('cart.updateIncre',$cart->id)}}"><i class="fa fa-plus" aria-hidden="true"></i></button>
                      {{$cart->quantity}}
                    <button class="btn btn-warning" formaction="{{route('cart.updateDecre',$cart->id)}}"><i class="fa fa-minus" aria-hidden="true"></i></button>
                    </form>
                  </td>
                  <td>{{$cart->price}}</td>
                  <td>                
                    <form method="POST" id="deleteitem">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" formaction="{{route('cart.destroy', $cart->id)}}"><i class=" fa fa-remove " aria-hidden="true"></i></button>
                    </form>
                  </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      <div class="foot">
        <form  action="{{route('confirm')}}" method="POST">
          @csrf
        @foreach($carts as $cart)
                    <input type="text" hidden name="product[]" value="{{$cart->product}}">
                    <input type="text" hidden name="image[]" value="{{$cart->image}}">
                    <input type="text" hidden name="quantity[]" value="{{$cart->quantity}}">
                    <input type="text" hidden name="price[]" value="{{$cart->price}}">
        @endforeach
        <textarea name="notes" class="form control" rows="4" placeholder="Write your notes"></textarea>
        <input type="text" id="user" name="user" hidden>           
        <button type="submit" class="btn btn-success">Confirm</button>
      </form>
      </div> 


    </div>
  </div>

@endsection

@section('js')
<script src="{{ asset('/js/store/jquery-3.6.0.min.js') }}"></script>

<script>
$(document).ready(function()
{
  $(".itemscart").on("click",function(){
                        $(".skills").fadeIn(2000)
                });


  $(".icon").on("click",function(){
     $(".skills").fadeOut(2000)
    });

/*---------------------end section rigtside checks--------------------*/
  $('#select').change(function() {
    $('#user').val($(this).val());
});

  $('.delete').on('click',function(e){
    e.preventDefault();
    if(confirm('Are you Sure To Delete This Item !?')){
      $(e.target).closest('form').submit();
    }
  });

});

</script>

@endsection

  

