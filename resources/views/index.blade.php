@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/sidebarHome.css') }}">
@endsection

@section('card-body')
@include('layouts.mainMenu')
<div class="home">
    <div class="text">
        <div class="container-fluid content">
            <h1>Em desenvolvimento!</h1> 
            <img src="{{asset('gifs/const.gif')}}" alt="">
        </div>
    </div>
</div>
@endsection
