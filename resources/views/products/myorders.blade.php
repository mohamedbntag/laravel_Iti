
@extends("layouts.master")

@section('linkCss')
 <link rel="stylesheet" href="/css/products/myorders.css">
@endsection

@section('container')

  <div class="main">

    <!----------------start section left side ------------------->
    @include('layouts.navbarleft')
    <!----------------start section right side ------------------->

    <!----------------start section center ------------------->
    <div class="center">
      <!------------center form in head------------------------>
        <div class="ordersForm">
          <form formaction="{{route('orders.myorders')}}" method="get" >
            <input type="date" name="date" class="form-control">
            <button type="submit" class="btn btn-success" >Search</button>
            <a href="{{route('orders.myorders')}}" class="btn btn-warning">Orders</a>
          </form>
        </div>
      <!------------center form in head------------------------>
      <!-----remove items----->
      <div class="remove">
        <div class="contain">
          <div class="icon"><i class="active fa fa-check " aria-hidden="true"></i></div>
          <div class="success"> Deleted Successfully </div>
          <button class="form-danger">Done</button>
        </div>    
      </div>

      <!-----remove items----->
      <table class="table table-striped table-hover myorder">
        <thead>
          <tr>
            <th>#</th>
            <th>Created at</th>
            <th>quantity</th>
            <th>price</th>
            <th>show items</th>
            <th>Status </th>
          </tr>
          </tr>
        </thead>
          <?php $no = 1 ?>
            <tbody >
              @foreach($checks as $check)
                <tr style="color:black" id="de-{{$check->id}}">
                  <td><?php echo $no ?></td>
                  <td>{{$check->created_at}}</td>
                  <td>{{$check->count}}</td>
                  <td>{{$check->price}}</td>
                  <td>
                    <button class="btn btn-primary btn-showitem" style="height:50%" data-id="showitem-{{$check->id}}"><i class=" fa fa-superpowers " aria-hidden="true"></i></button>            
                  </td>
                  <td>
                    @if($check->status =="processing")
                      <button class="btn btn-danger user" style="height:50%" data-id="{{$check->id}}" data-token="{{csrf_token()}}">Cancel</button>            
                    @else
                    {{$check->status}}
                    @endif
                  </td>
                </tr>
                <?php $no++ ?>
                <!-----------------show items-------------------->
              <div id="showitem-{{$check->id}}" class="skills">

                <div class="icon"><i class="fa fa-times-circle-o fa-3x" aria-hidden="true"></i></div>
                  <div class="order_items">
                    <div class="row">
                      @foreach($check->orders as $order)
                        <div class="col-md-3">
                          <div class="card">
                            <div class="imgproduct"><img src="/images/products/{{$order->image}}"></div>
                            <div class="priceitem">{{$order->product}}&nbsp; &nbsp; <span>$ {{$order->price}}</span></div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                  @endforeach
          </tbody>
        </table>
    </div>

    <!----------------------------end section center ------------------------------>

    <!----------------------------start section right ------------------------------>
    <div class="rightside">

      @if(Auth::user()->typeUser == 1)   
        <div class="dataitem users">
          <div class="head"><span>01</span>Count Of Users</div>
          <div class="contain"><span>{{$users}}</span></div>
        </div>
      @else
      <div class="dataitem username">
        <div class="head"><span>01</span>{{Auth::user()->name}} </div>
        <div class="contain"><span>Thanks for visiting us</span></div>
      </div>
      @endif

        <div class="dataitem">
          <div class="head"><span>02</span>Total Orders</div>
          <div class="contain"><span>${{$total_all_orders}}</span></div>
        </div>

        <div class="dataitem count_orders">
          <div class="head"><span>03</span>Count Of Orders</div>
          <div class="contain"><span>{{$count_of_orders}}</span></div>
        </div>

        <div class="dataitem count">
          <div class="head"><span>04</span>Count Of Items</div>
          <div class="contain"><span>{{$quantity}}</span></div>
        </div>

        <!-------------------------where users--------------------->

    </div>


@endsection
<script src="{{ asset('/js/store/jquery-3.6.0.min.js') }}"></script>
<script>
  $(document).ready(function()
  {
    /*---start remove records************/
       
    $('.btn-danger.user').on('click', function(){
      var id =$(this).data("id");
      var token =$(this).data("token");
    $.ajax(
      {
        url: "/destroyOrderUser/"+id,
        type: "DELETE",
        dataType: "JSON",
        data: {
          "id": id,
          "_method": 'DELETE',
          "_token": token
        },
        success: function () {
         $('.remove').fadeIn(1000,function(){
          $(this).hide(2000) ; 
         }); 
         setTimeout(function() {
            $("#de-"+id).remove();
          },1000);
        }

      });
      console.log("fail");

  });

/*------------------end remove record-----------*/

$('.btn-showitem').on("click",function(){
  var showitem = $(this).data("id");

$('#'+showitem).show(3000);


$(".icon").on("click",function(){
     $(".skills").fadeOut(2000)
    });
})









  //end document
  })

</script>

  

