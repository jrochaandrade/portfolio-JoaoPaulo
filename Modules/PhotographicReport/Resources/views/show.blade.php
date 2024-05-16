@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/photographicReport.css') }}">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="{{ asset('js/printThis.js') }}" defer type="module"></script>

<script src="{{ asset('js/photographicReport.js') }}" defer type="module"></script>

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
            <h2>Editar relatório</h2>
            <div class="mainReport">                
                
                <div class="report" id="report">
                    
                    
                    @foreach ($photos->chunk(3) as $page => $chunk )
                        <div class="borderPage">
                            <div class="header">
                                <!-- <img src="/images/logo4-ro.png" alt="logoPM" class="logo"> -->
                                <img src="/images/logo1.png" class="logo1" alt="logoPM">
                                <div class="head">
                                    <p>GOVERNO DO ESTADO DE RONDÔNIA</p>
                                    <p>POLICIA MILITAR DO ESTADO DE RONDÔNIA</p>
                                    <p>BATALHÃO DE POLICIA AMBIENTAL</p>
                                </div>
                                <div class="divLogos">
                                    <img src="/images/logo2.png" class="logo" alt="logoPM">
                                    <img src="/images/logo3.png" class="logo" alt="logoPM">
                                </div>
                            </div>
                            <!-- <P class="title">RELATÓRIO FOTOGRÁFICO</P> -->
                            <!-- <p class="operation">Operação Parque Estadual Guajará Mirim 01 a 17/02/2024</p> -->
                            <p class="title">{{ $report->operation }}</p>
                                <!-- <div class="pageA4 row mb-5"> -->
                            <div class="page">
                                @foreach ($chunk as $index => $photo)
                                    <div class="photo col-sm-6">
                                        <img src="{{ Storage::url($photo->path) }}" class="img-fluid" alt="Photo">
                                        <!-- <div class="rotulo">
                                            <span>Imagem {{ $index + 1}} - </span>
                                            <input type="text" class=" form-control textRotulo" value="Imagem da ocorrência">
                                        </div> -->
                                    </div>
                                @endforeach
                                <span class="footer">Página {{ $page + 1 }}/{{ $totalPages }}</span>
                            </div>
                        </div>
                        <!-- </div> -->
                    @endforeach
                </div>
                <div class="divBtn">
                    <a class="btn btn-success btnPrint" id="btnPrint">Imprimir</a>
                    <a class="btn btn-primary btnPrint" id="btnBack">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
