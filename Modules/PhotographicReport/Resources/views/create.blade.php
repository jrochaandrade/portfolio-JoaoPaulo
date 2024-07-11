@extends('layouts.masterPage')

@section('card-head')
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('css/report.css') }}"> -->
<link rel="stylesheet" href="{{ asset('css/photographicReport-create.css') }}">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/exif-js"></script>


<script src="{{ asset('js/photographicReport-create.js') }}" defer type="module"></script>


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
        <div id="loader" style="display: none;">
            <div class="divFeedback">
                <div class="spinner"></div>
                <p class="pFeedback">Gerando o relatório, aguarde...</p>
            </div>
        </div>
        <div class="container-fluid content">
            <form action="{{ route('report.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group divLoadPhotos">
                    <div class="div_header">
                        <label for="header">Digite o texto do cabeçalho (Ex.: Governo do Estado do Amazonas) Aceita no máximo 3 quebras de linha</label>
                        <!-- <input type="text" class="form-control" name="header" id="header"> -->
                        <textarea name="header" id="header" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="div_logo">
                        <label for="logo">Carregar o logo que deve aparecer no relatório</label>
                        <input type="file" class="form-control" name="logo" id="logo">
                    </div>
                    <div class="divTitle">
                        <label for="operation">Defina o título do relatório (Ex.: Operação Protetor do Bioma 01 a
                            15/05/2024):</label>
                        <i class="bi bi-question-square btnQuestion" data-toggle="modal" data-target="#infoModal"
                            style="cursor: pointer;"></i>

                        <!-- Modal -->
                        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog"
                            aria-labelledby="infoModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="infoModalLabel">Informações sobre o relatório</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Defina um título para o relatório, deve fazer referência ao vínculo do
                                            documento, Ex.: (Missão Protetor do Bioma 01 a 15/05/2024) - (Termo
                                            circunstanciado de ocorrência 3146300142 - João das Neves).
                                        </p>
                                        <p>
                                            Selecione todas as fotos de uma vez (posterior à geração do relatório é
                                            possível
                                            incluir, substituir ou excluir imagens), se o arquivo possuir os METADADOS
                                            originais a aplicação irá organizar as imagens por ordem de data e hora,
                                            caso as
                                            fotos não possuam METADADOS originais recomendo que renomeie as fotos para
                                            ficarem na ordem que devem aparecer no relatório, pois a aplicação irá
                                            atribuir
                                            a data para a imagem na hora do carregamento.
                                        </p>
                                        <p>
                                            O relatório pode ser gerado através de dispositivos móveis, para melhor
                                            visualização do relatório coloque o
                                            navegador em versão Desktop.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="operation" id="operation"
                            value="{{ old('operation') }}" maxlength="63">
                    </div>
                    <div class="divUser">
                        <label for="user">Nome de quem gerou o relatório:</label>
                        <input type="text" class="form-control" name="user" id="user" value="{{ old('user') }}">
                    </div>
                    <div class="divPhotos">
                        <label for="photos" class="labelPhotos">Escolha as fotos (Deve ser selecionado todas as fotos de
                            uma vez):</label>
                        <input type="file" class="form-control @error('photos') is-invalid @enderror" name="photos[]"
                            id="photos" multiple accept="image/*">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Criar relatório</button>
            </form>

        </div>
        <div class="main" id="main">

        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('header');
    const maxLines = 3;
    const maxCharsPerLine = 80;

    textarea.addEventListener('input', function() {
        let lines = textarea.value.split('\n');

        // Limita o número de linhas
        if (lines.length > maxLines) {
            textarea.value = lines.slice(0, maxLines).join('\n');
            lines = textarea.value.split('\n');
        }

        // Limita o número de caracteres por linha
        for (let i = 0; i < lines.length; i++) {
            if (lines[i].length > maxCharsPerLine) {
                lines[i] = lines[i].substring(0, maxCharsPerLine);
            }
        }

        textarea.value = lines.join('\n');
    });
});

</script>


@endsection