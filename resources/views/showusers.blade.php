
@extends("layouts.master")

@section('linkCss')
 <link rel="stylesheet" href="/css/products/myorders.css">
 <link rel="stylesheet" href="/css/products/showusers.css">
@endsection

@section('container')

  <div class="main showusers">

    <!----------------start section left side ------------------->
    @include('layouts.navbarleft')
    <!----------------start section right side ------------------->

    <!----------------start section center ------------------->
    <div class="center">
      <!-----remove items----->
      <div class="remove">
        <div class="contain">
          <div class="icon"><i class="active fa fa-check " aria-hidden="true"></i></div>
          <div class="success"> Deleted Successfully </div>
          <button class="form-danger">Done</button>
        </div>    
      </div>

      <!-----remove items----->
    
    <!----------------------------end section center ------------------------------>
    <div class="items">
      <form formaction="{{route('addNewUser.showusers')}}" method="get" >
        <input type="date" name="date" class="form-control">
          <select name="searchUser" class="form-control">
            <option selected disabled>all users</option>
            @foreach($usersSelect as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          </select>
        <button type="submit" class="btn btn-success" >Search</button>
        <a href="{{route('addNewUser.showusers')}}" class="btn btn-warning">users</a>
      </form>
    </div>
      
    <div class ="row">
      @foreach($allusers as $user)
      @if($user->typeUser == 0)
        <div class="col-3" id="de-{{$user->id}}">
          <div class="card">
            <div class="backimg"><img src="/images/register/{{$user->image}}"></div>
            <div class="head"></div>
            <div class="body">
              <h5>{{$user->name}}</h5>
              <div class="created">{{$user->created_at}}</div>
              <div class="Room_No">Room_No -> &nbsp; &nbsp;{{$user->Room_No}}</div>
              <div class="Ext">Ext -> &nbsp; &nbsp;{{$user->Ext}}</div>
              <button class="btn btn-danger btnUserRemove" style="height:50%" data-id="{{$user->id}}" data-token="{{csrf_token()}}">Cancel</button>            
            </div>
          </div>
        </div>
       @endif   
      @endforeach
    </div>

  </div>

    <!----------------------------start section right ------------------------------>
    <div class="rightside">
        <div class="cardAdmin">
          <div class="backimg"><img src="/images/register/{{ Auth::user()->image}}"></div>
          <div class="body">
              <h5>Wellcome Admin : &nbsp;{{Auth::user()->name}}</h5>
              <div class="created">
                This Acount Created At <br>
                {{Auth::user()->created_at}}
              </div>
            </div>    
        </div>
      

        <!-------------------------where users--------------------->

    </div>


@endsection
<script src="{{ asset('/js/store/jquery-3.6.0.min.js') }}"></script>
<script>
  $(document).ready(function()
  {
    /*---start remove records************/
       
    $('.btn-danger').on('click', function(){
      var id =$(this).data("id");
      var token =$(this).data("token");
    $.ajax(
      {
        url: "/destroy/"+id,
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

  

