@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/photographicReport-show.css') }}">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
    integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous">
</script>

<script src="{{ asset('js/printThis.js') }}" defer type="module"></script>

<script src="{{ asset('js/photographicReport-show.js') }}" defer type="module"></script>

@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <div class="card-header">
        <div class="titleHeader">
            <h1>Relatório Fotográfico</h1>
            <div class="divBtn2">
                <a class="btn btn-success btnPdf" ">Gerar PDF</a>
                <a class="btn btn-secondary btnPrint" ">Imprimir</a>
                <a href="{{ route('report.edit', ['id' => $report->id]) }}" class="btn btn-warning btnBack" ">Editar</a>
                <a href="{{ route('report.index') }}" class="btn btn-primary btnBack"">Voltar</a>
            </div>
        </div>
    </div>
    <div class="text">
        <div id="loader" style="display: none;">
            <div class="divFeedback">
                <div class="spinner"></div>
                <p class="pFeedback" >Gerando PDF, aguarde...</p>
            </div>
        </div>
        <div class="scrollButtons">
            <button class="scrollButton" id="scrollUp"><i class="fa-solid fa-up-long"></i></button>
            <button class="scrollButton" id="scrollDown"><i class="fa-solid fa-down-long"></i></button>
        </div>
        <div class="container-fluid content" style="padding-bottom: 10px;">
            <h2>Visualizar relatório, imprimir ou gerar PDF</h2>
            <div class="mainReport" id="mainReport"> 
                <div class="report" id="report">
                    @foreach ($photos->chunk(3) as $page => $chunk )
                        <div class="borderPage">
                            <div class="header">                                
                                <img src="{{ Storage::url($report->logo) }}" class="logo1" alt="logoPM">
                                <div class="head">
                                    <p>{!! nl2br(e($report->header)) !!}</p>                                    
                                </div>
                                <!-- <div class="divLogos">
                                    <img src="/images/logo2.png" class="logo" alt="logoPM">
                                    <img src="/images/logo3.png" class="logo" alt="logoPM">
                                </div> -->
                            </div>
                            <div class="divReport">
                                <p class="titleReport">Relatório Fotográfico: </p>
                                <p class="title">{{ $report->operation }}</p>
                            </div>                                
                            <div class="page">
                                @foreach ($chunk as $index => $photo)
                                    <div class="photo col-sm-6">
                                        <img src="{{ Storage::url($photo->path) }}" class="img-fluid" alt="Photo" loading="lazy">                                        
                                    </div>
                                @endforeach
                                <span class="footer">Página {{ $page + 1 }}/{{ $totalPages }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="divBtn">
            <a class="btn btn-success btnPdf">Gerar PDF</a>
            <a class="btn btn-secondary btnPrint">Imprimir</a>
            <a href="{{ route('report.edit', ['id' => $report->id]) }}" class="btn btn-warning btnEdit" ">Editar</a>
            <a href="{{ route('report.index') }}" class="btn btn-primary btnBack"">Voltar</a>
        </div>
    </div>
</div>

@endsection
