@extends('layouts.master')
@section('linkCss') 
    <link rel="stylesheet" href="/css/products/myorders.css">
    <link href="/css/store/reg2.css" rel="stylesheet">
@endsection  

@section('container')
<div class="main">

    <!----------------start section left side ------------------->
    @include('layouts.navbarleft')
    <!----------------start section right side ------------------->

    <!----------------start section center ------------------->
    <div class="center userCenter">

<div class="contain">
    <div class="row" style='height: 100%'>
        <div class="col-md-6 leftside">
            <div class="circle circle1"></div>
            <div class="circle circle2"></div>

            <div class="shapes">
                <div class="shape shape1"></div>
                <div class="shape shape2"></div>
                <div class="shape shape3"></div>
            </div>
            <div class="store">Espresso Love</div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('addNewUser.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="Room_No" class="col-md-4 col-form-label text-md-end">Room No</label>

                            <div class="col-md-6">
                                <input id="Room_No" type="number" min="1" max="100" class="form-control @error('Room_No') is-invalid @enderror" name="Room_No" value="{{ old('Room_No') }}" required autocomplete="Room_No">

                                @error('Room_No')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Ext" class="col-md-4 col-form-label text-md-end">Ext.</label>

                            <div class="col-md-6">
                                <input id="Ext" type="text" min="1" max="10" class="form-control @error('Ext') is-invalid @enderror" name="Ext" value="{{ old('Ext') }}" required autocomplete="Ext">

                                @error('Ext')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="typeUser" class="col-md-4 col-form-label text-md-end">Type Of User</label>

                            <div class="col-md-6">
                                <select name="typeUser" class="form-control" >
                                    <option selected value="0">Choose type of User</option>
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                                @error('typeUser')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
