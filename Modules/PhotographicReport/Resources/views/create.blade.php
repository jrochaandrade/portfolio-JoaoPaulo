@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
<link rel="stylesheet" href="{{ asset('css/photographicReport-create.css') }}">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/exif-js"></script>

<script src="{{ asset('js/photographicReport-index.js') }}" defer type="module"></script>


@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <div class="card-header">
        <div class="titleHeader">
            <h1>Criar relatório fotográfico</h1>
            <div class="divBtn2">                               
                <a href="{{ route('report.index') }}" class="btn btn-primary btnBack">Voltar</a>
            </div>
        </div>
    </div>
    <div class="text">
        <div class="container-fluid content">
            <p>Defina um título para o relatório, deve fazer referencia ao vínculo do documento, Ex.: (Missão Protetor do Bioma 01 a 15/05/2024) - (Termo circunstanciado de ocorrência 3146300142 - João das Neves)</p>
            <p>Selecione todas as fotos de uma vez (posterior a geração do relatório é possivel incluir, substituir ou excluir imagens), se o arquivo possuir os METADADOS originais a aplicação ira organizar as imagens por ordem de data e hora, caso as fotos não possuirem METADADOS originais recomendo que renomei as fotos para ficarem na ordem que deve aparecer no relatório, pois a aplicação ira atribuir a data para a imagem na hora do carregamento.</p>
            <p>Para preservar os METADADOS originais da imagem existem várias formas, copie as imagem direto do Smartphone para o computador, enviei pelo aplicativo Whatsapp como ARQUIVO, envie pelo aplicativo Telegram, envio atravém de nuvem entre outros.</p>
            <p>O relatório pode ser gerado através de dispositivos móveis, para melhor visualização do relatório coloque o navegado em versão Descktop.</p>
            <form action="{{ route('report.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group divLoadPhotos">
                    <div class="divTitle">
                        <label for="operation">Defina o título do relatório (Ex.: Operação Protetor do Bioma 01 a 15/05/2024):</label>
                        <input type="text" class="form-control" name="operation" id="operation" maxlength="63">
                    </div>
                    <div class="divUser">
                        <label for="user">Nome do policial que gerou o relatório:</label>
                        <input type="text" class="form-control" name="user" id="user">
                    </div>
                    <div class="divPhotos">
                        <label for="photos" class=" labelPhotos">Escolha as fotos (Deve ser selecionado todas as fotos de uma vez):</label>
                        <input type="file" class="form-control" name="photos[]" id="photos" multiple>
                    </div>
                </div>
                <!-- <button type="submit" class="btn btn-primary">Carregar fotos</button> -->
            </form>
                         
            </div>
            <div class="main" id="main">
                
            </div>
        </div>
    </div>
</div>

@endsection
