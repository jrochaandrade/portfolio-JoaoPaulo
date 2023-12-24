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
                <div class="occurrenceData">
                    <h3>Dados da Ocorrência</h3>
                    <label for="inputBO">Informe o numero da ocorrência:</label>
                    <input type="number" class="form-control" name="inputBO" id="inputBO">
                    <span for="">Informe o tipo da ocorrência:</span>
                    <div class="divRadiosBO">
                        <input type="radio" name="typeBO" id="typeTCO">
                        <label for="typeTCO">TCO</label>
                        <input type="radio" name="typeBO" id="typeCOP">
                        <label for="typeCOP">COP</label>
                        <input type="radio" name="typeBO" id="typePA">
                        <label for="typePA">PA</label>
                    </div>
                    <label for="inpuAI">Informe o numero do Auto de Infração II:</label>
                    <input type="number" class="form-control" name="inputAI" id="numberAI">
                    <span for="">Possui Termo de embargo?</span>
                    <div class="divRadiosEmbargos">
                        <input type="radio" name="yesOrNoEmbargos" id="yesEmbargos">
                        <label for="yesEmbargos">Sim</label>
                        <input type="radio" name="yesOrNoEmbargos" id="noEmbargos" checked>
                        <label for="noEmbargos">Não</label>
                    </div>
                    <label for="inputEmbargo" class="labelEmbargo" id="labelEmbargo">Informe o numero do Termo de Embargo:</label>
                    <input type="number" class="form-control inputEmbargo" name="inputEmbargo" id="inputEmbargo">
                    <span for="">Possui Planilha de Madeira Serrada?</span>
                    <div class="divRadiosLumber">
                        <input type="radio" name="yesOrNoLumber" id="yesLumber">
                        <label for="yesLumber">Sim</label>
                        <input type="radio" name="yesOrNoLumber" id="noLumber" checked>
                        <label for="noLumber">Não</label>
                    </div>
                    <label for="inputLumber" class="labelLumber" id="labelLumber">Informe o numero da Planilha de Madeira Serrada:</label>
                    <input type="number" class="form-control inputLumber" name="inputLumber" id="inputLumber">
                    <span for="">Possui Planilha de Madeira In-Natura?</span>
                    <div class="divRadiosNaturalWood">
                        <input type="radio" name="yesOrNoNaturalWood" id="yesNaturalWood">
                        <label for="yesNaturalWood">Sim</label>
                        <input type="radio" name="yesOrNoNaturalWood" id="noNaturalWood" checked>
                        <label for="noNaturalWood">Não</label>
                    </div>
                    <label for="inputNaturalWood" class="labelNaturalWood" id="labelNaturalWood">Informe o numero da Planilha de Madeira In-Natura:</label>
                    <input type="number" class="form-control inputNaturalWood" name="inputNaturalWood" id="inputNaturalWood">
                    <span for="">Possui Carta Imagem?</span>
                    <div class="divRadiosImageLetter">
                        <input type="radio" name="yesOrNoImageLetter" id="yesImageLetter">
                        <label for="yesImageLetter">Sim</label>
                        <input type="radio" name="yesOrNoImageLetter" id="noImageLetter" checked>
                        <label for="noImageLetter">Não</label>
                    </div>
                    <label for="inputImageLetter" class="labelImageLetter" id="labelImageLetter">Informe o numero da Carta Imagem:</label>
                    <input type="text" class="form-control inputImageLetter" name="inputImageLetter" id="inputImageLetter">
                </div>
                <div class="offenderDate">
                    <h3>Dados do Infrator</h3>
                </div>
            </div> 
        </div>
    </div>
</div>



@endsection
