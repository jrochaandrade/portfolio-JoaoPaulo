@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
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
            <h1>Relatório Fotográfico</h1>
        </div>
    </div>
    <div class="text">
        <div class="container-fluid content">
            <h2>Criar relatório fotográfico</h2>
            <form action="{{ route('photos.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group divLoadPhotos">
                    <div class="divTitle">
                        <label for="operation">Defina o título do relatório (Ex.: Relatório Fotográfico - Operação Protetor do Bioma 01 a 15/05/2024):</label>
                        <input type="text" class="form-control" name="operation" id="operation" value="Relatório fotográfico - ">
                    </div>
                    <div class="divPhotos">
                        <label for="photos" class="btn btn-primary labelPhotos">Escolha as fotos:</label>
                        <input type="file" class="form-control" name="photos[]" id="photos" multiple hidden>
                    </div>
                </div>
                <!-- <button type="submit" class="btn btn-primary">Carregar fotos</button> -->
            </form>
            <table class="table-responsive table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Operação</th>
                            <th>Data de criação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (@$reports as $data )
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->operation }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
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
