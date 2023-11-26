@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<script src="{{ asset('js/scriptsInteractiveIndex.js') }}" defer></script>
@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <div class="card-header">
        <h1 class=header><strong>Mapa Interativo</strong></h1>
    </div>
    <div class="text">
        <div class="container-fluid content">
            <div class="inputSend">
                <form action="{{ route('uploadKml') }}" method="POST" data-toggle="tooltip" data-placement="right"
                    enctype="multipart/form-data" class="d-inline-block">
                    @csrf
                    <label for="kmlFile" class="btn btn-success d-inline-block"
                        title="Enviar os embargos no formato KML">
                        <i class="bi bi-plus-square"></i>
                        Enviar Embargo
                    </label>
                    <input type="file" name="kmlFile" id="kmlFile" style="display: none;">
                    <!-- jogar o estilo para o css depois -->
                </form>
            </div>
            <div class="">
                <table class="table-responsive table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (@$polygonsData as $data)
                        <tr>
                            <td>{{ $data->id_polygon }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->address }}</td>
                            <td>{{ $data->city }}</td>

                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end pagination">
                    {{ $polygonsData->links('pagination::bootstrap-5') }}
                </div>
                <div class="containerMap">
                    <div id="map" class="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection