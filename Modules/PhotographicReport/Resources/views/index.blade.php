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
        <div class="container-fluid content"> 
            <form action="#" method="GET" id="form_search">
                <div class="div_search">
                    <div class="div_input_search" id="div_input_search">
                        <label for="search_data">Pesquisar:</label>
                        <input type="text" class="form-control" id="search_data" name="search_data" value="{{ request()->query('search_data') }}" placeholder="Realizar busca por ID, Operação ou Nome do Policial">
                    </div>
                    <div class="div_btns">
                        <button type="submit" class="btn btn-outline-success">Buscar relatório</button>
                        <a href="{{ route('report.index') }}" class="btn btn-outline-primary">Limpar Filtro</a>
                    </div>
                </div>
            </form>
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
            </div>
            <div class="main" id="main">
                
            </div>
        </div>
    </div>
</div>

@endsection
