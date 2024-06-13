@extends('layouts.masterPage')

@section('card-head')
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<!-- Jequery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>

<!--select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>

<!-- inputmask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js" defer></script>

<!-- CSS create -->
<link rel="stylesheet" href="{{ asset('css/styleDefault.css') }}">
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/create/createDetailedReport.css') }}">

<!-- Js create -->
<script src="{{ asset('js/createDetailedReport.js') }}" defer type="module" defer></script>

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
                <form action="{{route('save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="occurrenceData separateDivs">
                        <h3>Dados da Ocorrência</h3>                        
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="inputBO">Numero da ocorrência:</label>
                                <input type="text"
                                    class="form-control {{ $errors->has ('number_BO') ? 'is-invalid' : '' }}"
                                    name="number_BO" id="inputBO" value="{{old('number_BO')}}" pattern="\d*">
                                @if ($errors->has('number_BO'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_BO') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-2 radiosBO">
                                <p class="titleLabel">Tipo da ocorrência:</p>
                                <div class="divRadiosBO ">
                                    <input type="radio" name="type_BO" id="typeTCO"
                                        value="Termo Circunstanciado de Ocorrência - TCO"
                                        class="{{ $errors->has('type_BO') ? 'is-invalid' : '' }}" checked>
                                    <label for="typeTCO" class="labelNotBold">TCO</label>

                                    <input type="radio" name="type_BO" id="typeCOP"
                                        value="Comunicado de Ocorrência Policial - COP"
                                        class="{{ $errors->has('type_BO') ? 'is-invalid' : '' }}">
                                    <label for="typeCOP" class="labelNotBold">COP</label>

                                    <input type="radio" name="type_BO" id="typePA" value="Prisão e Apreensão - PA"
                                        class="{{ $errors->has('type_BO') ? 'is-invalid' : '' }}">
                                    <label for="typePA" class="labelNotBold">PA</label>

                                    @if ($errors->has('type_BO'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('type_BO') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <p class="titleLabel">Artigo Criminal:</p>
                                <select class="form-select {{ $errors->has('search_article_BO') ? 'is-invalid' : '' }}"
                                    name="search_article_BO" id="search_article_BO"></select>
                                @if ($errors->has('search_article_BO'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('search_article_BO') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="inputAI">Auto de Infração II:</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('number_AI') ? 'is-invalid' : '' }}"
                                    name="number_AI" id="inputAI" value="{{old('number_AI')}}" pattern="\d*">
                                @if ($errors->has('number_AI'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_AI') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <label for="articleAI">Artigo Administrativo:</label>
                                <select
                                    class="form-select form-control {{ $errors->has('search_article') ? 'is-invalid' : '' }}"
                                    name="search_article" id="searchArticle"></select>
                                @if ($errors->has('search_article'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('search_article') }}
                                </div>
                                @endif
                            </div>

                            <div class="col-sm-4">
                                <p class="titleLabel">Unidade de medida:</p>
                                <select name="unit_measure" id="unit_measure"
                                    class="form-control articleAI {{ $errors->has('unit_measure') ? 'is-invalid' : '' }}">
                                    <option value="" selected disabled>Selecione:</option>
                                </select>
                                @if ($errors->has('unit_measure'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('unit_measure') }}
                                </div>
                                @endif
                            </div>


                        </div>

                        <div class="row divDeforestationSize" id="divDeforestationSize">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3 divDeforestation">
                                            <label for="inputDeforestationSize" id="labelDeforestationSize">Tamanho do
                                                desmate (ha):</label>
                                            <input type="number" class="form-control" name="size_deforestation"
                                                id="inputDeforestationSize" step="0.001" value="{{old('size_deforestation')}}">
                                        </div>                                        
                                        <div class="col-sm-3 divUseFire" id="divUseFire">
                                            <p class="titleLabel">Uso de fogo?</p>
                                            <div class="divRadiosUseFire">
                                                <input type="radio" name="use_fire" id="yesUseFire" value="useFire">
                                                <label for="yesUseFire" class="labelNotBold">Sim</label>
                                                <input type="radio" name="use_fire" id="noUseFire" value="noUseFire"
                                                    checked>
                                                <label for="noUseFire" class="labelNotBold">Não</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 divconservationUnit" id="divconservationUnit">
                                            <p class="titleLabel">UC ou Zona de amortecimento?</p>
                                            <div class="divRadiosconservationUnit">
                                                <input type="radio" name="conservation_unit" id="yesUc" value="useUc">
                                                <label for="yesUc" class="labelNotBold">Sim</label>
                                                <input type="radio" name="conservation_unit" id="noUc" value="noUc"
                                                    checked>
                                                <label for="noUc" class="labelNotBold">Não</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 divEmbargos" id="divEmbargos">
                                            <p class="titleLabel">Embargo?</p>
                                            <div class="divRadiosEmbargos">
                                                <input type="radio" name="yesOrNoEmbargos" id="yesEmbargos" value="yes">
                                                <label for="yesEmbargos" class="labelNotBold">Sim</label>
                                                <input type="radio" name="yesOrNoEmbargos" id="noEmbargos" value="no"
                                                    checked>
                                                <label for="noEmbargos" class="labelNotBold">Não</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 divImageLetter" id="divImageLetter">
                                            <p class="titleLabel">Carta Imagem?</p>
                                            <div class="divRadiosImageLetter">
                                                <input type="radio" name="yesOrNoImageLetter" id="yesImageLetter"
                                                    value="yes">
                                                <label for="yesImageLetter" class="labelNotBold">Sim</label>
                                                <input type="radio" name="yesOrNoImageLetter" id="noImageLetter"
                                                    value="no" checked>
                                                <label for="noImageLetter" class="labelNotBold">Não</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6" id="divInputEmbargo">
                                <label for="inputEmbargo" class="labelEmbargo" id="labelEmbargo">Informe o numero do
                                    Termo de Embargo:</label>
                                <input type="number" class="form-control inputEmbargo" name="number_embargo"
                                    id="inputEmbargo" value="{{old('number_embargo')}}">
                            </div>
                            <div class="col-sm-6" id="divInputImageletter">
                                <label for="inputImageLetter" class="labelImageLetter" id="labelImageLetter">Informe o
                                    numero da Carta Imagem:</label>
                                <input type="text" class="form-control inputImageLetter" name="number_letter"
                                    id="inputImageLetter" value="{{old('number_letter')}}">
                            </div>
                        </div>
                        <!-- Implantar quando for colovar madeira -->
                        <div id="divWood">
                            <div class="row">
                                <div class="divQuantityWood col-sm-4" id="divQuantityWood">
                                    <label for="quantityWood" id="labelQuantityWood">Quantidade de madeira (m³):</label>
                                    <input type="number" class="form-control" name="quantity_wood" id="quantityWood"
                                        value="{{old('quantity_wood')}}" step="0.001">
                                </div>
                                <div class="divRadiosLumber col-sm-4">
                                    <p class="titleLabel">Possui Planilha de Madeira Serrada?</p>
                                    <input type="radio" name="yesOrNoLumber" id="yesLumber" value="yes">
                                    <label for="yesLumber">Sim</label>
                                    <input type="radio" name="yesOrNoLumber" id="noLumber" value="no" checked>
                                    <label for="noLumber">Não</label>
                                </div>
                                <div class="divRadiosNaturalWood col-sm-4">
                                    <p class="titleLabel">Possui Planilha de Madeira In-Natura?</p>
                                    <input type="radio" name="yesOrNoNaturalWood" id="yesNaturalWood" value="yes">
                                    <label for="yesNaturalWood">Sim</label>
                                    <input type="radio" name="yesOrNoNaturalWood" id="noNaturalWood" value="no" checked>
                                    <label for="noNaturalWood">Não</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6" id="divLumber">
                                    <label for="inputLumber" class="labelLumber" id="labelLumber">Informe o numero da
                                        Planilha de Madeira Serrada:</label>
                                    <input type="number" class="form-control inputLumber" name="inputLumber"
                                        id="inputLumber" value="{{old('inputLumber')}}">
                                </div>
                                <div class="col-sm-6" id="divNaturalWood">
                                    <label for="inputNaturalWood" class="labelNaturalWood" id="labelNaturalWood">Informe
                                        o numero da Planilha de Madeira In-Natura:</label>
                                    <input type="number" class="form-control inputNaturalWood" name="inputNaturalWood"
                                        id="inputNaturalWood" value="{{old('inputNaturalWood')}}">
                                </div>
                            </div>

                            <div class="typeWood" id="typeWood">
                                <p class="titleLabel">Descreva sobre as madeiras aprendidas:</p>
                                <textarea class="form-control" name="text_type_wood" id="text_type_wood" cols="30" value="{{old('text_type_wood')}}"
                                    rows="5"
                                    placeholder="Ex.: Foi aprendido 40 metros cúbicos de madeira, sendo 10 metros cúbicos de madeira serrada, 10 metros cúbicos de madeira IN-NATURA do tipo Tóra e 20 metros cúbicos de madeira do tipo lasca."></textarea>
                                
                            </div>
                        </div>


                        <div class="seizedObjects">
                            <p class="titleLabel">Possui objetos apreendidos?</p>
                            <div class="divRadiosSeizedObjects">
                                <input type="radio" name="yesOrNoSeizedObjects" id="yesSeizedObjects" value="yes">
                                <label for="yesSeizedObjects" class="labelNotBold">Sim</label>
                                <input type="radio" name="yesOrNoSeizedObjects" id="noSeizedObjects" value="no" checked>
                                <label for="noSeizedObjects" class="labelNotBold">Não</label>
                            </div>
                            <div id="divSeizedObjects">
                                <label for="inputTermOfSeizure" class="termOfSeizure" id="termOfSeizure">Termo de
                                    Apreensão:</label>
                                <input type="text" class="form-control inputTermOfSeizure" name="term_seizure"
                                    id="inputTermOfSeizure" placeholder="" value="{{old('term_seizure')}}">
                                <label for="inputSeizedObjects" class="seizedObjects" id="seizedObjects">Descreva os
                                    objetos apreendidos:</label>
                                <input type="text" class="form-control inputSeizedObjects" name="seized_objects"
                                    id="inputSeizedObjects"
                                    placeholder="Ex.: 01 - motosserra / 01 - Caminhão Mercedes Bens"
                                    value="{{old('seized_objects')}}">
                                <label for="inputDepositLocation" class="labelDepositLocation"
                                    id="labelDepositLocation">Endereço onde foi depositado:</label>
                                <input type="text" class="form-control depositLocation" name="deposit_location"
                                    id="inputDepositLocation"
                                    placeholder="Ex.: Rua 31 de Março Nº 153 - Bairro Centro - Ji-Paraná/RO"
                                    value="{{old('deposit_location')}}">
                                <label for="inputNameFaithful" class="labelNameFaithful" id="labelNameFaithful">Nome e
                                    CPF/CNPJ fiel depositário:</label>
                                <input type="text" class="form-control inputNameFaithful" name="name_faithful"
                                    id="inputNameFaithful"
                                    placeholder="Ex.: Prefeitura de Ji-Paraná - CNPJ: 00.000.000/0001-00"
                                    value="{{old('name_faithful')}}">
                                <label for="inputNameresponsible" class="labelNameresponsible"
                                    id="labelNameresponsible">Nome e CPF do responsável pelo recebimento:</label>
                                <input type="text" class="form-control inputNameresponsible" name="name_responsible"
                                    id="inputNameresponsible"
                                    placeholder="Ex.: João Pedro de Nóbrega CPF: 000.000.000-00"
                                    value="{{old('name_responsible')}}">

                                <div class="divImagesObjects">
                                    <!-- <h3>Imagens da ocorrência</h3> -->
                                    <label for="images2">Carregar 4 imagens, sendo 3 dos objetos apreendidos e 1 do
                                        local onde ficaram depositado:</label>
                                    <input type="file" class="form-control images2" name="images2[]" id="images2"
                                        multiple>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="offenderDate separateDivs">
                        <h3>Dados do envolvido/autuado</h3>
                        <div class="row">
                            <div class="col-sm-7">
                                <label for="name">Nome do envolvido:</label>
                                <input type="text"
                                    class="form-control {{ $errors->has ('name') ? 'is-invalid': '' }} name" name="name"
                                    id="name" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <label for="cpf">CPF:</label>
                                <input type="text"
                                    class="form-control cpf {{ $errors->has('cpf') ? 'is-invalid' : '' }}" name="cpf"
                                    id="cpf" value="{{old('cpf')}}">
                                @if ($errors->has('cpf'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-2">
                                <label for="rg">RG:</label>
                                <input type="text" class="form-control rg {{ $errors->has('rg') ? 'is-invalid' : '' }}"
                                    name="rg" id="rg" value="{{old('rg')}}">
                                @if ($errors->first('rg'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rg') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="phone">Telefone:</label>
                                <input type="text"
                                    class="form-control phone {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                    name="phone" id="phone" value="{{old('phone')}}">
                                @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-2">
                                <label for="birthday">Data de nascimento:</label>
                                <input type="date"
                                    class="form-control birthday {{ $errors->has('birthday') ? 'is-invalid' : '' }}"
                                    name="birthday" id="birthday" value="{{old('birthday')}}">
                                @if ($errors->has('birthday'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('birthday') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-7">
                                <label for="affiliation">Filiação:</label>
                                <input type="text"
                                    class="form-control affiliation {{ $errors->has('affiliation') ? 'is-invalid' : '' }}"
                                    name="affiliation" id="affiliation" value="{{old('affiliation')}}">
                                @if ($errors->has('affiliation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('affiliation') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="address">Endereço do envolvido:</label>
                                <input type="text"
                                    class="form-control address {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                    name="address" id="address"
                                    value="{{old('address')}}">
                                @if ($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('address') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label for="location">Local do fato:</label>
                                <input type="text"
                                    class="form-control location {{ $errors->has('location') ? 'is-invalid' : '' }}"
                                    name="location" id="location" value="{{old('location')}}">
                                @if ($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="historic separateDivs">
                        <h3>Histórico da ocorrência</h3>
                        <label for="historic">Dos fatos:</label>
                        <textarea class="form-control {{ $errors->has('historic') ? 'is-invalid' : '' }}"
                            name="historic" id="historic" cols="30"
                            rows="10" value="{{old('historic')}}"></textarea>
                        @if ($errors->has('historic'))
                        <div class="invalid-feedback">
                            {{ $errors->first('historic') }}
                        </div>
                        @endif
                    </div>                    
                    <div class="divImages separateDivs">
                        <h3>Imagens da ocorrência</h3>
                        <label for="images1">Carregar 4 imagens:</label>
                        <input type="file"
                            class="form-control images1 {{ $errors->has('images1') ? 'is-invalid' : '' }}"
                            name="images1[]" id="images1" multiple>
                        @if ($errors->has('images1'))
                        <div class="invalid-feedback">
                            {{ $errors->first('images1') }}
                        </div>
                        @endif
                    </div>
                    <div class="offenderMotive separateDivs">
                        <h3>Dos Motivos apresentado pelo envolvido</h3>
                        <label for="motive">Motivo:</label>
                        <textarea name="motive" id="motive" cols="30" rows="5"
                            class="form-control motive {{ $errors->has('motive') ? 'is-invalid' : '' }}" value="{{old('motive')}}"></textarea>                        
                        @if ($errors->has('motive'))
                        <div class="invalid-feedback">
                            {{ $errors->first('motive') }}
                        </div>
                        @endif
                    </div>
                    <div class="mitigatingAggravating separateDivs">
                        <h3>Das atenuantes e agravantes</h3>
                        <div class="mitigating">
                            <p class="titleLabel">Possui atenuantes?</p>
                            <div class="divRadiosMitigating">
                                <input type="radio" name="yesOrNoMitigating" id="yesMitigating" value="yes">
                                <label for="yesMitigating" class="labelNotBold">Sim</label>
                                <input type="radio" name="yesOrNoMitigating" id="noMitigating" value="no" checked>
                                <label for="noMitigating" class="labelNotBold">Não</label>
                            </div>

                            <div id="divMitigating">
                                <p class="mb-3">Art. 14. São circunstâncias que atenuam a pena:</p>
                                <fieldset class="checkboxMitigating">
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="mitigating[]"
                                            value="I - baixo grau de instrução ou escolaridade do agente;"
                                            class=" ms-4"> I - baixo grau de instrução ou escolaridade do agente;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="mitigating[]"
                                            value="II - arrependimento do infrator, manifestado pela espontânea reparação do dano, ou limitação significativa da degradação ambiental causada;"
                                            class=" ms-4"> II - arrependimento do infrator, manifestado pela espontânea
                                        reparação do dano, ou limitação significativa da degradação ambiental causada;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="mitigating[]"
                                            value="III - comunicação prévia pelo agente do perigo iminente de degradação ambiental;"
                                            class=" ms-4"> III - comunicação prévia pelo agente do perigo iminente de
                                        degradação ambiental;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="mitigating[]"
                                            value="IV - colaboração com os agentes encarregados da vigilância e do controle ambiental."
                                            class=" ms-4"> IV - colaboração com os agentes encarregados da vigilância e
                                        do controle ambiental.
                                    </label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="aggravating ">
                            <p class="titleLabel">Possui agravantes?</p>
                            <div class="divRadiosAggravating">
                                <input type="radio" name="yesOrNoAggravating" id="yesAggravating" value="yes">
                                <label for="yesAggravating" class="labelNotBold">Sim</label>
                                <input type="radio" name="yesOrNoAggravating" id="noAggravating" value="no" checked>
                                <label for="noAggravating" class="labelNotBold">Não</label>
                            </div>
                            <div id="divAggravating">
                                <p class="mb-4">Art. 15. São circunstâncias que agravam a pena, quando não constituem ou
                                    qualificam o crime:</p>
                                <fieldset class="checkboxAgravating">
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="I - Reincidência nos crimes de natureza ambiental;" class=" ms-4"> I
                                        - Reincidência nos crimes de natureza ambiental;
                                    </label>
                                    <p class="labelNotBold ms-4">II - Ter o agente cometido a infração:</p>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: a- para obter vantagem pecuniária;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: a- para obter vantagem
                                        pecuniária;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: b- coagindo outrem para a execução material da infração;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: b- coagindo outrem
                                        para a execução material da infração;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: c- afetando ou expondo a perigo, de maneira grave, a saúde pública ou o meio ambiente;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: c- afetando ou expondo
                                        a perigo, de maneira grave, a saúde pública ou o meio ambiente;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: d- concorrendo para danos à propriedade alheia;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: d- concorrendo para
                                        danos à propriedade alheia;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: e- atingindo áreas de unidades de conservação ou áreas sujeitas, por ato do Poder Público, a regime especial de uso;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: e- atingindo áreas de
                                        unidades de conservação ou áreas sujeitas, por ato do Poder Público, a regime
                                        especial de uso;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: f- atingindo áreas urbanas ou quaisquer assentamentos humanos;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: f- atingindo áreas
                                        urbanas ou quaisquer assentamentos humanos;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: g- em período de defeso à fauna;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: g- em período de
                                        defeso à fauna;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: h- em domingos ou feriados;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: h- em domingos ou
                                        feriados;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: i- à noite;" class=" ms-4"> II
                                        - Ter o agente cometido a infração: i- à noite;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: j- em épocas de seca ou inundações;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: j- em épocas de seca
                                        ou inundações;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: l- no interior do espaço territorial especialmente protegido;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: l- no interior do
                                        espaço territorial especialmente protegido;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: m- com o emprego de métodos cruéis para abate ou captura de animais;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: m- com o emprego de
                                        métodos cruéis para abate ou captura de animais;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: n- mediante fraude ou abuso de confiança;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: n- mediante fraude ou
                                        abuso de confiança;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: o- mediante abuso do direito de licença, permissão ou autorização ambiental;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: o- mediante abuso do
                                        direito de licença, permissão ou autorização ambiental;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: p- no interesse de pessoa jurídica mantida, total ou parcialmente, por verbas públicas ou beneficiada por incentivos fiscais;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: p- no interesse de
                                        pessoa jurídica mantida, total ou parcialmente, por verbas públicas ou
                                        beneficiada por incentivos fiscais;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: q- atingindo espécies ameaçadas, listadas em relatórios oficiais das autoridades competentes;"
                                            class=" ms-4"> II - Ter o agente cometido a infração: q- atingindo espécies
                                        ameaçadas, listadas em relatórios oficiais das autoridades competentes;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]"
                                            value="II - Ter o agente cometido a infração: r- facilitada por funcionário público no exercício de suas funções."
                                            class=" ms-4"> II - Ter o agente cometido a infração: r- facilitada por
                                        funcionário público no exercício de suas funções.
                                    </label>
                                </fieldset>
                            </div>
                        </div>
                    </div>                   
                    <div class="team separateDivs">
                        <h3 class="tiles2">Componentes da equipe</p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="cmt">Comandante - Nome completo - Graduação - RE:</label>
                                    <input type="text"
                                        class="form-control cmt {{ $errors->has('name_CMT') ? 'is-invalid' : '' }}"
                                        id="cmt" name="name_CMT"
                                        value="{{old('name_CMT')}}">
                                    @if ($errors->has('name_CMT'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name_CMT') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label for="unitCmt">Unidade Comandante:</label>
                                    <input type="text"
                                        class="form-control unitCmt {{ $errors->has('unit_CMT') ? 'is-invalid' : '' }}"
                                        name="unit_CMT" id="unitCmt" value="{{old('unitCmt')}}">
                                    @if ($errors->has('unit_CMT'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('unit_CMT') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="mot">Motorista:</label>
                                    <input type="text"
                                        class="form-control mot {{ $errors->has('name_MOT') ? 'is-invalid' : '' }}"
                                        id="mot" name="name_MOT" value="{{old('name_MOT')}}">
                                    @if ($errors->has('name_MOT'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name_MOT') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label for="unitMot">Unidade Motorista:</label>
                                    <input type="text"
                                        class="form-control unitMot {{ $errors->has('unit_MOT') ? 'is-invalid' : '' }}"
                                        name="unit_MOT" id="unitMot" value="{{old('unitMot')}}">
                                    @if ($errors->has('unit_MOT'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('unit_MOT') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="ptr1">Patrulheiro 1:</label>
                                    <input type="text" class="form-control ptr1" id="ptr1" name="name_PTR1"
                                        value="{{old('name_PTR1')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="unitPtr1">Unidade Patrulheiro 1:</label>
                                    <input type="text" class="form-control unitPtr1" name="unit_PTR1" id="unitPtr1"
                                        value="{{old('unit_PTR1')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="ptr2">Patrulheiro 2:</label>
                                    <input type="text" class="form-control ptr2" id="ptr2" name="name_PTR2"
                                        value="{{old('name_PTR2')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="unitPtr2">Unidade Patrulheiro 2:</label>
                                    <input type="text" class="form-control unitPtr2" name="unit_PTR2" id="unitPtr2"
                                        value="{{old('unit_PTR1')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="ptr3">Patrulheiro 3:</label>
                                    <input type="text" class="form-control ptr3" id="ptr3" name="name_PTR3"
                                        value="{{old('name_PTR3')}}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="unitPtr3">Unidade Patrulheiro 3:</label>
                                    <input type="text" class="form-control unitPtr3" name="unit_PTR3" id="unitPtr3"
                                        value="{{old('unit_PTR1')}}">
                                </div>
                            </div>
                    </div>
                    <button class="btn btn-primary" id="generateReport">Gerar Relatório</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Crie uma variável global JavaScript e atribua o valor da variável PHP
var infractions = <?php echo json_encode($infractions); ?>;
</script>

@endsection