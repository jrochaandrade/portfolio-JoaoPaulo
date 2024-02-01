@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('css/createDetailedReport.css') }}">


 -->
<script src="{{ asset('js/indexDetailedReport.js') }}" defer type="module"></script>
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
                <a href="{{ route('create') }}" class="btn btn-success mb-5">Criar relatório</a>
                <table class="table table-responsive table-striped id="tableReports">
                <thead>
                        <tr>
                            <th>ID</th>
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
                            
                            <td>{{ $report->report_ID}}</td>
                            <td>{{ $report->number_BO}}</td>
                            <td>{{ $report->number_AI}}</td>
                            <td>{{ $report->name}}</td>
                            <td>{{ $report->cpf}}</td>
                            <td>
                                <a href="{{ route('generateReport', ['id' => $report->report_ID]) }}" title="Gerar Relatório" class="text-primary"><span class="fa-stack fa-sm"><i class="far fa-square fa-stack-2x"></i><i class="fa-solid fa-file-lines fa-stack-1x"></i></span></a>
                                <a href="{{ route('editReport', ['id' => $report->report_ID]) }}" data-toggle="tooltip" title="Editar Relatório" class="text-warning"><span class="fa-stack fa-sm"><i class="far fa-square fa-stack-2x"></i><i class="fas fa-pencil-alt fa-stack-1x"></i></span></a>
                                
                                <a data-toggle="tooltip" title="Excluir Relatório" class="text-danger" id="btnDelete" onclick="deleteData({{ $report->report_ID }})">
                                    <span class="fa-stack fa-sm"><i class="far fa-square fa-stack-2x"></i>
                                        <i class="far fa-trash-alt fa-stack-1x"></i>
                                    </span>
                                </a>
                            </td>


                            

                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <div class="d-flex justify-content-end pagination">
                    {{ $reports->links('pagination::bootstrap-5') }}
                </div>
                
            </div> 
        </div>
    </div>
</div>





@endsection

