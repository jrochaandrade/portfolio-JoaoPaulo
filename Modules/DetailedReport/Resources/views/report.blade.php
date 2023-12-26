@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/detailedReport.css') }}">

<script src="{{ asset('js/detailedReport.js') }}" defer type="module"></script>


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
                <div class="header">
                    <div class="logos">
                        <img src="{{ asset('images/logo1.png') }}" alt="logo01" class="logo1">
                        <span>Secretaria de Estado da Segurança, Defesa e Cidadania<br>Polícia Militar do estado de Rondônia<br>Batalhão de Polícia Ambiental<br>3ª Companhia de Polícia Ambiental<br>Seção de Planejamento Operacional</span>
                        <img src="{{ asset('images/logo2.png') }}" alt="logo02" class="logo2">
                        <img src="{{ asset('images/logo3.png') }}" alt="logo03" class="logo3">
                    </div>
                </div>
                <div class="body">
                    <div class="titleBody">
                        <p>Relatório Circunstanciado</p>
                        <p>Auto de infração ambiental II - <strong>Nº {{$data['inputAI']}}</strong></p>
                    </div>
                    <div class="divDocs">
                        <p>Auto de Infração Ambiental II - <strong>Nº {{$data['inputAI']}}</strong></p>

                        <p>{{$data['typeBO']}} <strong>Nº {{$data['inputBO']}}</strong></p>
                        
                        @if ($data['inputEmbargo'])
                        <p>Termo de Embargo - <strong>Nº {{$data['inputEmbargo']}}</strong></p>
                        @endif
                        
                        @if ($data['inputLumber'])
                        <p>Planilha de Madeira Serrada - <strong>Nº {{$data['inputLumber']}}</strong></p>
                        @endif
                        
                        @if ($data['inputNaturalWood'])
                        <p>Planilha de Madeira <em>In-Natura</em> - <strong>Nº {{$data['inputNaturalWood']}}</strong></p>
                        @endif
                        
                        @if ($data['inputImageLetter'])
                        <p>Carta Imagem - <strong>Nº {{$data['inputImageLetter']}}</strong></p>
                        @endif 
                    </div>
                    <div class="dataOffender">
                        <table class="table table-bordered tableDataOffender">
                            <tr>
                                <th colspan="2" class="text-center">Dados do Envolvido</th>
                            </tr>
                            <tr>
                                <th class="cell">Nome</th>
                                <td>{{$data['name']}}</td>
                            </tr>
                            <tr>
                                <th class="cell">CPF</th>
                                <td>{{$data['cpf']}}</td>
                            </tr>
                            <tr>
                                <th class="cell">RG</th>
                                <td>{{$data['rg']}}</td>
                            </tr>
                            <tr>
                                <th class="cell">Telefone</th>
                                <td>{{$data['phone']}}</td>
                            </tr>
                            <tr>
                                <th class="cell">Data de nascimento</th>
                                <td>{{$data['birthday']}}</td>
                            </tr>
                            <tr>
                                <th class="cell">FiliaçãoF</th>
                                <td>{{$data['affiliation']}}</td>
                            </tr>
                            <tr>
                                <th class="cell">Endereço</th>
                                <td>{{$data['address']}}</td>
                            </tr>
                            <tr>
                                <th class="cell">Local do fato</th>
                                <td>{{$data['location']}}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="historic">
                        <p class="titles">1. Dos fatos</p>
                        <p>{{$data['historic']}}</p>
                    </div>

                    <div class="images">
                    <img src="data:image/jpeg;base64,{{$data['image1']}}" alt="">
                    </div>

                </div>
            </div> 
        </div>
    </div>
</div>



@endsection
