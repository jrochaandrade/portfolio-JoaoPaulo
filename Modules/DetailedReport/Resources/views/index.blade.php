@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('css/createDetailedReport.css') }}">


<script src="{{ asset('js/createDetailedReport.js') }}" defer type="module"></script> -->

<meta http-equiv="refresh" content="; http://127.0.0.1:8000/report/detailed">

@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <div class="card-header">
        <div class="titleHeader">
            <h1>Relatório Circunstanciado</h1>
        </div>
    </div>    
    <div class="text">
        <div class="container-fluid content">            
            
            <div class="main" id="main">                
                <h1>index</h1>
                <a href="{{ route('create') }}" class="btn btn-success">Criar relatório</a>
                <a href="{{ route('generateReport') }}" class="btn btn-success">Gerar relatório</a>
            </div> 
        </div>
    </div>
</div>



@endsection
