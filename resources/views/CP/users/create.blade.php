@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('show.all.users') }}">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li>
@endsection
@section('content')
    <div class="container">
        <h3>Create New User</h3>

        <hr>
        <div class="border-bottom border-dark w-100" style="">
            <form action="{{ route('store.user.info') }}" method="POST">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="first_name" class="col-md-3 col-form-label fw-bold text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-8">
                            <div class="input-group">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" placeholder="First Name" autofocus>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" placeholder="Last Name">
                            </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-md-3 col-form-label fw-bold text-md-end">{{ __('User Name') }}</label>
                        
                        <div class="col-md-8">
                            <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-3 col-form-label fw-bold text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-3 col-form-label fw-bold text-md-end">{{ __('Password') }}</label>

                        <div class="col-md-8">
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Type a strong password" required autocomplete="new-password">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-3 col-form-label fw-bold text-md-end">{{ __('Address') }}</label>

                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <input id="address" type="text" class="form-control" value="{{old('address[street]')}}" name="address[street]" placeholder="Street" required autocomplete="address[street]">
                            </div>
                            <div class="input-group mb-3">
                                <input id="city" type="text" class="form-control" value="{{old('address[city]')}}" name="address[city]" placeholder="City" required autocomplete="address[city]">
                                <input id="state" type="text" class="form-control" value="{{old('address[state]')}}" name="address[state]" placeholder="State" required autocomplete="address[state]">
                            </div>
                            <div class="input-group mb-3">
                                <input id="postal_code" type="text" class="form-control" name="address[postal_code]" placeholder="Postal Code" required autocomplete="postal_code">
                                <select id="country"  class="form-control" value="{{old('address[country]')}}" name="address[country]">
                                    @if (!empty($countries))
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-1 justify-content-end mb-3">
                        
                            <button type="reset" class="btn btn-secondary">
                                {{ __('Reset Form') }}
                            </button>
                            <button type="button" class="btn btn-success" onclick="window.location.href='{{route('show.all.users')}}'">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add New User') }}
                            </button>
                        
                    </div>
                </form>
            </form>
        </div>
    </div>
@endsection
