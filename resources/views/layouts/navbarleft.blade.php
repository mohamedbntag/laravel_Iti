


<div class="dashboard leftside">
    <img src="/images/main/ice3.png" class="ice">

    <div class="user">
      <img src="/images/register/{{Auth::user()->image}}">
      <h6>{{Auth::user()->name}}</h6>
    </div>
    
    <div class="links">
      <a href="{{ url('/dashboard') }}" class="link active">
        <i class="active fa fa-home fa-lg " aria-hidden="true"></i>
        <span class="active">Home</span>
      </a>

      @if(Auth::user()->typeUser == 0)
        <a href="{{route('orders.myorders')}}" class="link">
          <i class="fa fa-desktop fa-lg" aria-hidden="true"></i>
          <span>Orders</span>
        </a>
       @endif
        
      @if(Auth::user()->typeUser == 1)
      <a href="{{route('orders.allorders')}}" class="link">
        <i class="fa fa-desktop fa-lg" aria-hidden="true"></i>
        <span>Orders</span>
      </a>
      <a href="{{route('product.create')}}" class="link">
        <i class="fa fa-cogs fa-lg" aria-hidden="true"></i>
        <span>Add Item</span>
      </a>
      <a href="{{route('addNewUser.create')}}" class="link">
        <i class="fa fa-user fa-lg" aria-hidden="true"></i>
        <span>Add User</span>
      </a>
      <a href="{{route('addNewUser.showusers')}}" class="link">
        <i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i>
        <span>All Users</span>
      </a>

      @endif
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav link">
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
  </a>

    </div>
    
    <div class="animate"></div>

  </div>