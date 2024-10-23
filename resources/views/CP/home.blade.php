@extends('layouts.app')
@section('crumbs')
    <li class="breadcrumb-item active"><a>Dashboard Home</a></li>
    {{-- <li class="breadcrumb-item"><a href="#">Library</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data</li> --}}
@endsection
@section('content')
    <div class="container">
        <h3>Dashboard Home</h3>

        <h4><i class="fa fa-users"></i> Users </h4>
        <hr>
        <ul>
            <li><a href="{{ route('show.all.users') }}">All Users</a></li>
        </ul>

    </div>
@endsection
