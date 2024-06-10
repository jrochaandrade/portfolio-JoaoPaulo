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
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-sm-2">
                        <label for="CPF" class="title">CPF:</label>
                        <input type="text" id="CPF" name="cpf" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" value="{{ $data->cpf }}">
                        @if($errors->has('cpf'))
                            <div class="invalid-feedback">
                                {{$errors->first('cpf')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label for="address" class="title">Endereço</label>
                        <input type="text" id="address" name="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ $data->address }}">
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{$errors->first('address')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <label for="city" class="title">Cidade:</label>
                        <input type="text" id="city" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" value="{{ $data->city }}">
                        @if($errors->has('city'))
                            <div class="invalid-feedback">
                                {{$errors->first('city')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-sm-2">
                        <label for="id_register" class="title">Carta imagem:</label>
                        <input type="text" id="id_register" name="id_register" class="form-control {{ $errors->has('id_register') ? 'is-invalid' : '' }}" value="{{ $data->id_register }}">
                        @if($errors->has('id_register'))
                            <div class="invalid-feedback">
                                {{$errors->first('id_register')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <label for="area" class="title">Área do dano (ha):</label>
                        <input type="text" id="area" name="area" class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" value="{{ $data->area }}">
                        @if($errors->has('area'))
                            <div class="invalid-feedback">
                                {{$errors->first('area')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <label for="infraction_notice" class="title">Auto de infração:</label>
                        <input type="text" id="infraction_notice" name="infraction_notice" class="form-control {{ $errors->has('infraction_notice') ? 'is-invalid' : '' }}" value="{{ $data->infraction_notice }}">
                        @if($errors->has('infraction_notice'))
                            <div class="invalid-feedback">
                                {{$errors->first('infraction_notice')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <label for="decree" class="title">Tipificação do Auto:</label>
                        <input type="text" id="decree" name="decree"  class="form-control {{ $errors->has('decree') ? 'is-invalid' : '' }}" value="{{ $data->decree }}">
                        @if($errors->has('decree'))
                            <div class="invalid-feedback">
                                {{$errors->first('decree')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-2">
                        <label for="type_infraction" class="title">Tipo de infração:</label>
                        <input type="text" id="type_infraction" name="type_infraction" class="form-control {{ $errors->has('type_infraction') ? 'is-invalid' : '' }}" value="{{ $data->type_infraction }}">
                        @if($errors->has('type_infraction'))
                            <div class="invalid-feedback">
                                {{$errors->first('type_infraction')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-sm-3">
                        <label for="embargo" class="title">Termo de embargo:</label>
                        <input type="text" id="embargo" name="embargo" class="form-control {{ $errors->has('embargo') ? 'is-invalid' : '' }}" value="{{ $data->embargo }}">
                        @if($errors->has('embargo'))
                            <div class="invalid-feedback">
                                {{$errors->first('embargo')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="ocurrence" class="title">Ocorrência:</label>
                        <input type="text" id="ocurrence" name="ocurrence" class="form-control {{ $errors->has('ocurrence') ? 'is-invalid' : '' }}" value="{{ $data->ocurrence }}">
                        @if($errors->has('ocurrence'))
                            <div class="invalid-feedback">
                                {{$errors->first('ocurrence')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="law" class="title">Tipificação da Ocorrência:</label>
                        <input type="text" id="law" name="law" class="form-control {{ $errors->has('law') ? 'is-invalid' : '' }}" value="{{ $data->law }}">
                        @if($errors->has('law'))
                            <div class="invalid-feedback">
                                {{$errors->first('law')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="date" class="title">Data:</label>
                        <input type="date" id="date" name="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" value="{{ $data->date }}">
                        @if($errors->has('date'))
                            <div class="invalid-feedback">
                                {{$errors->first('date')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-sm-2">
                        <label for="team" class="title">Equipe que registrou:</label>
                        <input type="text" id="team" name="team"  class="form-control {{ $errors->has('team') ? 'is-invalid' : '' }}" value="{{ $data->team }}">
                        @if($errors->has('team'))
                            <div class="invalid-feedback">
                                {{$errors->first('team')}}
                            </div>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <label for="centroid" class="title">Coordenada do dano:</label>
                        <input type="text" id="centroid" name ="centroid" class="form-control {{ $errors->has('centroid') ? 'is-invalid' : '' }}" value="{{ $data->centroid }}">
                        @if($errors->has('centroid'))
                            <div class="invalid-feedback">
                                {{$errors->first('centroid')}}
                            </div>
                        @endif
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




