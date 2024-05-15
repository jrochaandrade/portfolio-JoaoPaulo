@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/photographicReport.css') }}">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
    integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous">
</script>


<!-- <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script> -->


<!-- <script src="{{ asset('node_modules/exif-js/exif.js') }}" defer></script> -->
<script src="{{ asset('js/printThis.js') }}" defer type="module"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/exif-js"></script> -->

<script src="{{ asset('js/photographicReport.js') }}" defer type="module"></script>
<!-- <script src="{{ asset('js/reportScript.js') }}" defer type="module"></script> -->


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
                <!-- <div class="report" id="report">
                    <img src="/images/logo2.png" alt="logoPM">
                    <img src="/images/logo3.png" alt="logoPM">
                </div> -->
                
                <div class="report" id="report">
                    <div class="header">
                        <!-- <img src="/images/logo4-ro.png" alt="logoPM" class="logo"> -->
                        <img src="/images/logo2.png" class="logo" alt="logoPM">
                        <div class="head">
                            <p>GOVERNO DO ESTADO DE RONDÔNIA</p>
                            <p>SECRETARIA DE ESTADO DA SEGURANÇA, DEFESA E CIDADANIA</p>
                            <p>POLICIA MILITAR DO ESTADO DE RONDÔNIA</p>
                            <p>BATALHÃO DE POLICIA AMBIENTAL</p>
                        </div>
                        <img src="/images/logo3.png" class="logo" alt="logoPM">
                    </div>
                    <P class="title">RELATÓRIO FOTOGRÁFICO</P>
                    <p class="operation">Operação Parque Estadual Guajará Mirim 01 a 17/02/2024</p>
                    <div class="firstPageA4 row mb-5">
                        <div class="page">
                            @foreach ($firstPagePhotos as $index => $photo)
                                <div class="photo col-sm-6">
                                    <img src="{{ Storage::url($photo->path) }}" class="img-fluid" alt="Photo">
                                    <div class="rotulo">
                                        <!-- <span class="textRotulo">Imagem 01 - Testando o rótulo da foto</span> -->
                                        <span>Imagem {{ $index + 1}} - </span>
                                        <input type="text" class="form-control textRotulo" value="Imagem da ocorrência">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @foreach ($otherPhotos->chunk(6) as $chunk )
                        <div class="pageA4 row mb-5">
                            <div class="page">
                                @foreach ($chunk as $index => $photo)
                                    <div class="photo col-sm-6">
                                        <img src="{{ Storage::url($photo->path) }}" class="img-fluid" alt="Photo">
                                        <div class="rotulo">
                                            <!-- <span class="textRotulo">Imagem 01 - Testando o rótulo da foto</span> -->
                                            <span>Imagem {{ $index + 1}} - </span>
                                            <input type="text" class=" form-control textRotulo" value="Imagem da ocorrência">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <a id="btnPrint" class="btn btn-success">Gerar PDF</a>
            </div>
        </div>
    </div>
</div>

@endsection
