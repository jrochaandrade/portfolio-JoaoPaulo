@extends('layouts.masterPage')
@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/interactiveMap/interactiveMapIndex.css') }}">
<script src="{{ asset('js/scriptsInteractiveIndex.js') }}" defer></script>
<script src="{{ asset('js/interactiveMap/interactiveMapIndex.js') }}" defer></script>
@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">    
    <div class="card-header">
        <div class="titleHeader">
            <h1 class=header><strong>Mapa Interativo</strong></h1>
        </div>
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
            </form>
        </div>
    </div>
    <div class="text">
        <div class="container-fluid content">
            <div class="">
                <div id="divSearch">
                    <form action="#" method="GET" id="formSearch">
                        <div id="divInputSearch">
                            <label for="searchData">Pesquisar: <i class="fa-regular fa-circle-question text-primary" id="btnInfoCoord" title="O filtro pode ser realizado por Nome, CPF, Endereço, Cidade" ></i></label>
                            <input type="text" id="searchData" name="searchData" class="form-control" value="{{ request()->query('searchData') }}" placeHolder="Digite os dados para filtrar">
                        </div>

                        <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-magnifying-glass"></i>  Buscar Embargo</button>
                    </form>                    

                    <a href="{{ route('mapa.index') }}" class="btn btn-outline-primary clearBtn">
                        <i class="fa-solid fa-arrows-rotate"></i>
                        Limpar filtros
                    </a>
                </div>                
                <table class="table-responsive table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th>Área</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (@$polygonsData as $data)
                        <tr>
                            <td>{{ $data->id_polygon }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->cpf }}</td>
                            <td>{{ $data->address }}</td>
                            <td>{{ $data->city }}</td>
                            <td>{{ $data->area }}</td>

                            <td id="actions">
                                <a class="text-secondary" id="find" data-id="{{ $data->id_polygon }}">
                                    <span class="fa-stack fa-sm">
                                    <i class="far fa-square fa-stack-2x"></i>
                                    <i class="fa-solid fa-magnifying-glass fa-stack-1x"></i>
                                    </span>
                                </a>
                                <a href="{{ route('mapa.show', ['id'=>$data->id_polygon]) }}" title="Visualizar Embargo" class="text-primary">
                                    <span class="fa-stack fa-sm">
                                        <i class="far fa-square fa-stack-2x"></i>
                                        <i class="fa-solid fa-eye fa-stack-1x"></i>
                                    </span>
                                </a>
                                <a href="{{ route('mapa.edit', ['id'=>$data->id_polygon]) }}" class="text-warning">
                                    <span class="fa-stack fa-sm">
                                        <i class="far fa-square fa-stack-2x"></i>
                                        <i class="fas fa-pencil-alt fa-stack-1x"></i>
                                    </span>
                                </a>
                                <a href="{{ route('mapa.download', ['id'=>$data->id_polygon]) }}" class="text-success">
                                    <span class="fa-stack fa-sm">
                                        <i class="far fa-square fa-stack-2x"></i>
                                        <i class="fa-solid fa-download fa-stack-1x"></i>
                                    </span>
                                </a>
                                <a class="text-danger" id="btnDelete" onclick="deleteData({{ $data->id_polygon }})">
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
                    {{ $polygonsData->links('pagination::bootstrap-5') }}
                </div>
                <div class="btnsMap">
                    <form class="formCoordinate" id="formCoordinate">
                        <div class="btnFindCoordinate">
                            <label for="findCoordinate">Buscar coordenadas no mapa: <i class="fa-regular fa-circle-question text-primary" id="btnInfoCoord" title="Coordenadas suportadas: 12°0′24.37″S, 63°30′32.60″W / 10 25 38.156S, 62 7 46.701W / -11.27702941, -61.96444919" ></i></label>
                            <input type="text" class="form-control" name="findCoordinate" id="findCoordinate" placeHolder="Ex.: 12°0′24.37″S, 63°30′32.60″W">
                        </div>                        
                        <button type="submit" id="btnSearchCoordinate" class="btn btn-outline-success"><i class="fa-solid fa-magnifying-glass"></i>  Localizar</button>
                    </form>
                    <div>
                        <a id="refreshMap" class="btn btn-outline-primary">
                            <i class="fa-solid fa-arrows-rotate"></i>
                            Resetar mapa
                        </a>
                    </div>
                </div>
                <div class="containerMap">
                    <div id="map" class="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Converte a variável PHP em JavaScript
    let polygons = {!! json_encode($polygons) !!}
    let embargoes = {!! json_encode($allEmbargoes) !!}
</script>


@if(session('success'))
<script>
    // Script para mostrar mensagem de edição
    $(document).ready(function() {            
        Swal.fire({
            title: 'Sucesso!',
            text: 'Excluido!',
            icon: 'success',
            confirmButtonColor: '',
            confirmButtonText: 'OK'
        });            
    });
    </script>
@endif

@endsection