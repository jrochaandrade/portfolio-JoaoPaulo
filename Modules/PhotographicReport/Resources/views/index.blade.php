@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('css/report.css') }}"> -->
<link rel="stylesheet" href="{{ asset('css/photographicReport-index.css') }}">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/exif-js"></script>

<script src="{{ asset('js/photographicReport-index.js') }}" defer type="module"></script>


@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <div class="card-header">
        <div class="titleHeader">
            <h1>Visualizar todos os relatórios fotográficos</h1>
            <div class="divBtn2">                               
                <a href="{{ route('report.create') }}" class="btn btn-success btnCreate">Criar relatório</a>
            </div>
        </div>
    </div>
    <div class="text">
<<<<<<< HEAD
        <div class="container-fluid content">
            <h5 class="h5">
                Protótipo para geração do relatório fotográfico utilizandos no âmbito do Batalhão de Polícia
                Ambiental.<br><br>
                As fotos podem ser carregadas fora de ordem desde que os metadados das imagens estejam íntegros.<br><br>
                Digite qual a sua unidade, um título para o relatório, carregue as imagens, aguarde até todas as imagens
                serem carregadas
                e em seguida clique em gerar PDF.<br><br>
                Obs.: Se ao baixar o PDF estiver desconfigurado, role a página para visualizar a primeira parte do
                documento em seguinda clique em gerar pdf novamente.<br><br>
                Obs.2: Se estiver usando dispositívo móvel, utilizar o navegador em versão Desktop. 
            </h5>
            <label for="inputUnit" id="labelDescription">Unidade</label>
            <input type="text" class="form-control inputUnit" id="inputUnit"
                placeholder="Ex.: 3ª Companhia de Polícia Ambiental" value="3ª Companhia de Polícia Ambiental">
            <label for="inputDesc" id="labelDescription">Título do relatório</label>
            <input type="text" class="form-control inputDesc" id="inputDesc"
                placeholder="Ex.: Relatório Fotográfico Missão Guardiões do Bioma 3 ET/2023 - 01 a 15/05/2023"
                value="Relatório fotográfico ">
            <div class="divButtons">                
                <label for="fileInput" class="btn btn-primary btnInput">Carregar imagens</label>
                <input type="file" id="fileInput" name="images[]" multiple style="display: none;">
                <a id="btnPdf" class="btn btn-success">Gerar PDF</a>                
=======
        <div class="container-fluid content">            
            <table class="table-responsive table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Operação</th>
                            <th>Nome do Policial</th>
                            <th>Data de criação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (@$reports as $data )
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->operation }}</td>
                                <td>{{ $data->user }}</td>
                                <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y H:i') }}</td>
                                <td class="actions">
                                    <a href="{{ route('report.show', ['id'=>$data->id]) }}">
                                        <span class="fa-stack fa-sm">
                                            <i class="far fa-square fa-stack-2x"></i>
                                            <i class="fa-solid fa-eye fa-stack-1x"></i>
                                        </span>
                                    </a>
                                    <a href="{{ route('report.edit', ['id'=>$data->id]) }}" class="text-warning">
                                        <span class="fa-stack fa-sm">
                                            <i class="far fa-square fa-stack-2x"></i>
                                            <i class="fas fa-pencil-alt fa-stack-1x"></i>
                                        </span>
                                    </a>
                                    <a class="text-danger" id="btnDelete" onclick="deleteData({{ $data->id }})">
                                        <span class="fa-stack fa-sm">
                                            <i class="far fa-square fa-stack-2x"></i>
                                            <i class="far fa-trash-alt fa-stack-1x"></i>
                                        </span>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
                <div class="d-flex justify-content-end pagination">
                    {{ $reports->links('pagination::bootstrap-5') }}
                </div>             
>>>>>>> master
            </div>
            <div class="main" id="main">
                
            </div>
        </div>
    </div>
</div>

@endsection
