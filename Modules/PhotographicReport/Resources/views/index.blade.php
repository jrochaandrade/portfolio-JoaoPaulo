@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
<script src="{{ asset('js/scriptsInteractiveIndex.js') }}" defer></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<!-- <script src="{{ asset('node_modules/jspdf/dist/jspdf.umd.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous"></script>


<script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>


<script src="{{ asset('node_modules/exif-js/exif.js') }}" defer></script>

<script src="{{ asset('js/reportScript.js') }}" defer type="module"></script>


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
            <h5 class="h5">
                Protótipo para geração do relatório fotográfico utilizandos no âmbito do Batalhão de Polícia Ambiental<br>
                As fotos podem ser carregadas fora de ordem desde que os metadados da imagem esteja íntegro<br><br>
                Digite um título, carregue as imagens e em seguida clique em gerar PDF<br><br>
                Obs.: Se ao baixar o PDF estiver desconfigurado, clique em gerar pdf novamente
            </h5>
            <label for="inputDesc" id="labelDescription">Título do relatório</label>
            <input type="text" class="form-control inputDesc" id="inputDesc" placeholder="Ex.: Relatório Fotográfico Missão Guardiões do Bioma 3 ET/2023 - 01 a 15/05/2023" value="Relatório fotográfico">
            <div class="divButtons">
                <label for="fileInput" class="btn btn-primary btnInput">Carregar imagens</label>
                <input type="file" id="fileInput" multiple style="display: none;">
                <button id="btnPdf" class="btn btn-success">Gerar PDF</button>
            </div>
            <div class="main" id="main">                
                <div class="page" id="page">
                    <div class="photoContainer" id="photoContainer"></div>
                </div>
            </div> 
        </div>
    </div>
</div>

@endsection