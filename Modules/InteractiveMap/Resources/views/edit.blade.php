@extends('layouts.masterPage')
@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/interactiveMap/interactiveMapEdit.css') }}">
<script src="{{ asset('js/interactiveMap/interactiveMapEdit.js') }}" defer></script>
@endsection

@section('card-body')
@include('layouts.mainMenu')
<div class="home">
    <div class="card-header">
        <h1 class="header"><strong>Editar</strong></h1>
    </div>
    <div class="text">
        <div class="container-fluid content">
            <form action="{{ route('mapa.update', ['id'=>$data->id_polygon]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    
                    <div class="col-sm-4">
                        <label for="name" class="title">Nome:</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $data->name }}">
                    </div>
                    <div class="col-sm-2">
                        <label for="CPF" class="title">CPF:</label>
                        <input type="text" id="CPF" name="cpf" class="form-control" value="{{ $data->cpf }}">
                    </div>
                    <div class="col-sm-4">
                        <label for="address" class="title">Endereço</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{ $data->address }}">
                    </div>
                    <div class="col-sm-2">
                        <label for="city" class="title">Cidade:</label>
                        <input type="text" id="city" name="city" class="form-control" value="{{ $data->city }}">
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-sm-2">
                        <label for="id_register" class="title">Carta imagem:</label>
                        <input type="text" id="id_register" name="id_register" class="form-control" value="{{ $data->id_register }}">
                    </div>
                    <div class="col-sm-2">
                        <label for="area" class="title">Área do dano (ha):</label>
                        <input type="text" id="area" name="area" class="form-control" value="{{ $data->area }}">
                    </div>
                    <div class="col-sm-2">
                        <label for="infraction_notice" class="title">Auto de infração:</label>
                        <input type="text" id="infraction_notice" name="infraction_notice" class="form-control" value="{{ $data->infraction_notice }}">
                    </div>
                    <div class="col-sm-4">
                        <label for="decree" class="title">Tipificação do Auto:</label>
                        <input type="text" id="decree" name="decree"  class="form-control" value="{{ $data->decree }}">
                    </div>
                    <div class="col-sm-2">
                        <label for="type_infraction" class="title">Tipo de infração:</label>
                        <input type="text" id="type_infraction" name="type_infraction" class="form-control" value="{{ $data->type_infraction }}">
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-sm-3">
                        <label for="embargo" class="title">Termo de embargo:</label>
                        <input type="text" id="embargo" name="embargo" class="form-control" value="{{ $data->embargo }}">
                    </div>
                    <div class="col-sm-3">
                        <label for="ocurrence" class="title">Ocorrência:</label>
                        <input type="text" id="ocurrence" name="ocurrence" class="form-control" value="{{ $data->ocurrence }}">
                    </div>
                    <div class="col-sm-3">
                        <label for="law" class="title">Tipidicação da Ocorrência:</label>
                        <input type="text" id="law" name="law" class="form-control" value="{{ $data->law }}">
                    </div>
                    <div class="col-sm-3">
                        <label for="date" class="title">Data:</label>
                        <input type="date" id="date" name="date" class="form-control" value="{{ $data->date }}">
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-sm-2">
                        <label for="team" class="title">Equipe que registrou:</label>
                        <input type="text" id="team" name="team"  class="form-control" value="{{ $data->team }}">
                    </div>
                    <div class="col-sm-3">
                        <label for="centroid" class="title">Coordenada do dano:</label>
                        <input type="text" id="centroid" name ="centroid" class="form-control" value="{{ $data->centroid }}">
                    </div>
                </div>
                
                <div class="divBtns">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{ route('mapa.index')}}" class="btn btn-primary" id="btnBack">Voltar</a>
                </div>
            </form>

        </div>
    </div>
</div>

@if(session('success'))
<script>
    // Script para mostrar mensagem de edição
    $(document).ready(function() {            
        Swal.fire({
            title: 'Sucesso!',
            text: 'Embargo atualizado com sucesso.',
            icon: 'success',
            confirmButtonColor: '',
            confirmButtonText: 'OK'
        });            
    });
    </script>
@endif

@endsection




