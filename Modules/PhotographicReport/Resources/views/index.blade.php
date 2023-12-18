@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
<script src="{{ asset('js/scriptsInteractiveIndex.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous"></script>

<script src="{{ asset('node_modules/exif-js/exif.js') }}" defer></script>

<script src="{{ asset('js/reportScript.js') }}" defer></script>


@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <div class="card-header">
        <div class="titleHeader">
            <h1>Relatório Fotográfico</h1>
        </div>
    </div>
    <div class="text">
        <div class="container-fluid content">
            <label for="fileInput" class="btn btn-primary btnInput">Carregar imagens</label>
            <input type="file" id="fileInput" multiple style="display: none;">
            <button id="btnPdf" class="btn btn-success">Gerar PDF</button>

            <div class="page" id="page">
                <div class="logos">
                    <img class="logo1" src="{{ asset('images/logo1.png') }}" alt="">
                
                    <p class="title">Polícia Militar do estado de Rondônia<br>Batalhão de Polícia Ambiental</p>
                
                    <img class="logo2" src="{{ asset('images/logo2.png') }}" alt="">
                </div>
                
                <div class="photoContainer" id="photoContainer"></div>
            </div>
            
        </div>
    </div>
</div>

@endsection
