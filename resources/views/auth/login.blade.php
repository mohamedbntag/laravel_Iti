@extends('layouts.master')  
@section('linkCss') <link href="/css/store/login.css" rel="stylesheet"> @endsection    
@section('container')
    @include('layouts.nav')
<div class="back">
        <div class="logo">Espresso Love</div>
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
        <div class="four"></div>
        <div class="five"></div>
        <div class="six"></div>
    </div>
    
    <div class="circle1"></div>
    <div class="circle2"></div>
    
    <div class="contain">
        
        
        <div class="main">
            <aside>
                <div class="bolits">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                </div>
                
                <div class="links">
                    <i class="fa fa-amazon" aria-hidden="true"></i>
                    <i class="fa fa-chrome" aria-hidden="true"></i>
                    <i class="fa fa-envira" aria-hidden="true"></i>
                    <div class="line"></div>
                </div>
            
            </aside>
            <!------------ end section aside------------------>
            
            <!------------ start section about me------------------>
            <div class="about_me">
                <div class="magic"><i class="fa fa-heart" aria-hidden="true"></i><span>Espresso Love</span></div>
                <div class="me">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-5 ">

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Adress">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        
    
    
    </div>
@endsection
