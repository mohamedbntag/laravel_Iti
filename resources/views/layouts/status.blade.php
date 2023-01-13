
@if(session('status'))
    <div class="alert status"
     style="
              color: #ff00b1;
              background-image: linear-gradient(45deg, #48e148, #b5ecf7);
              border-color: #badbcc;
              font-size: 1.5vw;
              font-weight: 650;
              text-align: center;
              position: relative;
              z-index: 99;
              width: 47%;
              left: 50%;
              top: 0;
              transform: translate(-50%);
       
       ">
        {{session('status')}}</div>
@endif

@if(session('delete'))
    <div class="alert status"
     style="
              color: #ffffff;
              background-image: linear-gradient(45deg, #e14848, #ddbc26);
              border-color: #badbcc;
              font-size: 1.5vw;
              font-weight: 650;
              text-align: center;
              position: absolute;
              z-index: 99;
              width: 47%;
              left: 50%;
              top: 0;
              transform: translate(-50%);">
        {{session('delete')}}</div>
@endif



@if(session('order'))
    <div class="alert status"
     style="
              color: #ff00b1;
              background-image: linear-gradient(45deg, #48e1c0, #b9ff59);
              border-color: #badbcc;
              font-size: 1.5vw;
              font-weight: 650;
              text-align: center;
              position: absolute;
              z-index: 99;
              width: 47%;
              left: 50%;
              top: 0;
              transform: translate(-50%);
       
       ">
        {{session('order')}}<img src="/images/main/icon2.png" class="icon2"></div>
@endif