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
                <table class="table table-bordered id="tableReports">
                    <thead>
                        <tr>
                            <th>Ocorrência</th>
                            <th>Auto de infração</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    @foreach($reports as $report)
                    <tbody>
                        <tr>
                            
                            <td>{{ $report->number_BO}}</td>
                            <td>{{ $report->number_AI}}</td>
                            <td>{{ $report->name}}</td>
                            <td>{{ $report->cpf}}</td>
                            <td>
                                <a href="{{ route('generateReport', ['id' => $report->report_ID]) }}" data-toggle="tooltip" tooltip-left="Visualizar Detalhes" class="text-primary ver_embargo">
                                    <span class="fa-stack fa-sm">
                                        <i class="far fa-square fa-stack-2x"></i>
                                        <i class="fa-solid fa-file-lines fa-stack-1x"></i>
                                    </span>
                                </a>
                                <a href="#" data-toggle="tooltip" tooltip-left="Editar Embargo" class="text-warning editar_embargo">
                                    <span class="fa-stack fa-sm">
                                        <i class="far fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pencil-alt fa-stack-1x"></i>
                                    </span>
                                </a>
                                <a href="#" data-toggle="tooltip" tooltip-left="Baixar polígono do embargo" class="text-success downloadKml2">
                                    <span class="fa-stack fa-sm">
                                        <i class="far fa-square fa-stack-2x"></i>
                                        <i class="fa-solid fa-download fa-stack-1x"></i>
                                    </span>
                                </a>                       
                                <a data-toggle="tooltip" tooltip-left="Excluir embargo" class="text-danger excluir_embargo" 
                                    onclick="deleteData(#)">
                                    <span class="fa-stack fa-sm">
                                        <i class="far fa-square fa-stack-2x"></i>
                                        <i class="far fa-trash-alt fa-stack-1x"></i>
                                    </span>
                                </a>
                            </td>
                            

                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <a href="{{ route('create') }}" class="btn btn-success">Criar relatório</a>
                
            </div> 
        </div>
    </div>
</div>



@endsection
