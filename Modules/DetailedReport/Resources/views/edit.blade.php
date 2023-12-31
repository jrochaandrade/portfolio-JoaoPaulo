@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/editDetailedReport.css') }}">


<script src="{{ asset('js/editDetailedReport.js') }}" defer type="module"></script>

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
                <form action="{{ route('updateReport', ['id'=>$data->report_ID]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf                    
                    <div class="occurrenceData">
                        <h3>Dados da Ocorrência</h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="inputBO">Numero da ocorrência:</label>
                                <input type="number" class="form-control" name="number_BO" id="inputBO" value="{!!$data['number_BO']!!}">
                            </div>
                            <div class="col-sm-2">
                                <span class="titleLabel">Tipo da ocorrência:</span>
                                <div class="divRadiosBO">
                                @if ($data['type_BO'] === "Termo circunstanciado de Ocorrência - TCO")
                                    <input type="radio" name="type_BO" id="typeTCO" value="Termo circunstanciado de Ocorrência - TCO" checked>
                                    <label for="typeTCO" class="labelNotBold">TCO</label>
                                @else
                                    <input type="radio" name="type_BO" id="typeTCO" value="Termo circunstanciado de Ocorrência - TCO">
                                    <label for="typeTCO" class="labelNotBold">TCO</label>
                                @endif

                                @if ($data['type_BO'] === "Comunicado de Ocorrência Policial - COP")
                                    <input type="radio" name="type_BO" id="typeCOP" value="Comunicado de Ocorrência Policial - COP" checked>
                                    <label for="typeCOP" class="labelNotBold">COP</label>
                                @else
                                    <input type="radio" name="type_BO" id="typeCOP" value="Comunicado de Ocorrência Policial - COP">
                                    <label for="typeCOP" class="labelNotBold">COP</label>
                                @endif

                                @if ($data['type_BO'] === "Prisão e Apreensão - PA")
                                    <input type="radio" name="type_BO" id="typePA" value="Prisão e Apreensão - PA" checked>
                                    <label for="typePA" class="labelNotBold">PA</label>
                                @else
                                    <input type="radio" name="type_BO" id="typePA" value="Prisão e Apreensão - PA">
                                    <label for="typePA" class="labelNotBold">PA</label>
                                @endif


                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="articleBO">Artigo Criminal:</label>
                                <input type="text" class="form-control articleBO" name="article_BO" id="articleBO" value="{!!$data['article_BO']!!}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <label for="inputAI">Auto de Infração II:</label>
                                <input type="number" class="form-control" name="number_AI" id="inputAI" value="{!!$data['number_AI']!!}">
                            </div>
                            <div class="col-sm-2">
                                <label for="valueAI">Valor do AI:</label>
                                <input type="number" class="form-control valueAI" name="value_AI" id="valueAI" value="{!!$data['value_AI']!!}">
                            </div>
                            <div class="col-sm-4">
                                <label for="articleAI">Artigo Administrativo:</label>
                                <input type="text" class="form-control articleAI" name="article_AI" id="articleAI" value="{!!$data['article_AI']!!}">
                            </div>
                            <div class="col-sm-3">
                                <span class="titleLabel">Tipo da infração:</span>
                                @if ($data['type_AI'] === "logging")
                                <select name="type_AI" class="form-control" id="selectTypeAI">
                                    
                                    <option value="logging" selected>Desmatamento</option>
                                    <option value="wood">Madeira</option>
                                    <!-- <option value="openFine">Multa aberta</option>  -->
                                </select>
                                @else
                                <select name="type_AI" class="form-control" id="selectTypeAI">
                                    
                                    <option value="logging">Desmatamento</option>
                                    <option value="wood" selected>Madeira</option>
                                    <!-- <option value="openFine">Multa aberta</option>  -->
                                </select>
                                @endif
                            </div>
                        </div>

                        <div class="row divDeforestationSize" id="divDeforestationSize">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="inputDeforestationSize" id="labelDeforestationSize">Tamanho do desmatamento (ha):</label>
                                            <input type="number" class="form-control" name="size_deforestation" id="inputDeforestationSize" step="0.001" value="{!!$data['size_deforestation']!!}">
                                        </div>
                                        <div class="col-sm-5">
                                            <span class="titleLabel">Área onde ocorreu o desmatamento:</span>                                            
                                            <div>
                                                @if ($data['area_deforestation'] === "offReserve")
                                                <input type="radio" name="area_deforestation" id="offReserve" value="offReserve" checked>
                                                <label for="offReserve" class="labelNotBold">Fora da reserva legal</label>
                                                @else
                                                <input type="radio" name="area_deforestation" id="offReserve" value="offReserve">
                                                <label for="offReserve" class="labelNotBold">Fora da reserva legal</label>
                                                @endif

                                                @if ($data['area_deforestation'] === "reserve")
                                                <input type="radio" name="area_deforestation" id="reserve" value="reserve" checked>
                                                <label for="reserve" class="labelNotBold">Reserva legal</label>
                                                @else
                                                <input type="radio" name="area_deforestation" id="reserve" value="reserve">
                                                <label for="reserve" class="labelNotBold">Reserva legal</label>
                                                @endif
                                                
                                                @if ($data['area_deforestation'] === "regeneration")
                                                <input type="radio" name="area_deforestation" id="regeneration" value="regeneration" checked>
                                                <label for="regeneration" class="labelNotBold">Regeneração</label>
                                                @else
                                                <input type="radio" name="area_deforestation" id="regeneration" value="regeneration">
                                                <label for="regeneration" class="labelNotBold">Regeneração</label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- <div class="divEmbargos" id="divEmbargos">
                                                <span class="titleLabel">Possui Embargo?</span>
                                                <div class="divRadiosEmbargos">
                                                    <input type="radio" name="yesOrNoEmbargos" id="yesEmbargos"  value="yes">
                                                    <label for="yesEmbargos" class="labelNotBold">Sim</label>
                                                    <input type="radio" name="yesOrNoEmbargos" id="noEmbargos" value="no" checked>
                                                    <label for="noEmbargos" class="labelNotBold">Não</label>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="col-sm-2">
                                            <!-- <span class="titleLabel">Possui Carta Imagem?</span>
                                            <div class="divRadiosImageLetter">
                                                <input type="radio" name="yesOrNoImageLetter" id="yesImageLetter" value="yes">
                                                <label for="yesImageLetter" class="labelNotBold">Sim</label>
                                                <input type="radio" name="yesOrNoImageLetter" id="noImageLetter" value="no" checked>
                                                <label for="noImageLetter" class="labelNotBold">Não</label>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="row">
                            @if ($data['number_embargo'] != null)
                            <div class="col-sm-6" id="divInputEmbargo">
                                <label for="inputEmbargo" class="labelEmbargo" id="labelEmbargo">Informe o numero do Termo de Embargo:</label>
                                <input type="number" class="form-control inputEmbargo" name="number_embargo" id="inputEmbargo" value="{!!$data['number_embargo']!!}">
                            </div>
                            @endif
                            @if ($data['number_letter'] != null)
                            <div class="col-sm-6" id="divInputImageletter">                                
                                <label for="inputImageLetter" class="labelImageLetter" id="labelImageLetter">Informe o numero da Carta Imagem:</label>
                                <input type="text" class="form-control inputImageLetter" name="number_letter" id="inputImageLetter" value="{!!$data['number_letter']!!}">
                            </div>
                            @endif
                        </div>

                        
                        
                        
                        
                        <!-- Implantar quando for colovar madeira -->
                        <!-- <div class="divQuantityWood" id="divQuantityWood">
                            <label for="inputQuantityWood" id="labelQuantityWood">Quantidade de madeira (m³):</label>
                            <input type="number" class="form-control" name="inputQuantityWood" id="inputQuantityWood" value="{!!$data['article_BO']!!}">
                        </div> -->
                        <!-- <div id="divLumber">
                            <span for="">Possui Planilha de Madeira Serrada?</span>
                            <div class="divRadiosLumber">
                                <input type="radio" name="yesOrNoLumber" id="yesLumber" value="yes">
                                <label for="yesLumber">Sim</label>
                                <input type="radio" name="yesOrNoLumber" id="noLumber" value="no" checked>
                                <label for="noLumber">Não</label>
                            </div>
                        </div>
                        <label for="inputLumber" class="labelLumber" id="labelLumber">Informe o numero da Planilha de Madeira Serrada:</label>
                        <input type="number" class="form-control inputLumber" name="inputLumber" id="inputLumber" value="{!!$data['article_BO']!!}">
                        <div id="divNaturalWood">
                            <span for="">Possui Planilha de Madeira In-Natura?</span>
                            <div class="divRadiosNaturalWood">
                                <input type="radio" name="yesOrNoNaturalWood" id="yesNaturalWood" value="yes">
                                <label for="yesNaturalWood">Sim</label>
                                <input type="radio" name="yesOrNoNaturalWood" id="noNaturalWood" value="no" checked>
                                <label for="noNaturalWood">Não</label>
                            </div>
                            <label for="inputNaturalWood" class="labelNaturalWood" id="labelNaturalWood">Informe o numero da Planilha de Madeira In-Natura:</label>
                            <input type="number" class="form-control inputNaturalWood" name="inputNaturalWood" id="inputNaturalWood" value="{!!$data['article_BO']!!}">
                        </div> -->


                        <div class="seizedObjects">
                            <!-- <span class="titleLabel">Possui objetos apreendidos?</span>
                            <div class="divRadiosSeizedObjects">
                                <input type="radio" name="yesOrNoSeizedObjects" id="yesSeizedObjects" value="yes">
                                <label for="yesSeizedObjects" class="labelNotBold">Sim</label>
                                <input type="radio" name="yesOrNoSeizedObjects" id="noSeizedObjects" value="no" checked>
                                <label for="noSeizedObjects" class="labelNotBold">Não</label>
                            </div> -->
                            <div id="divSeizedObjects">
                                <label for="inputSeizedObjects" class="labelSeizedObjects" id="labelSeizedObjects">Descreva os objetos apreendidos:</label>
                                <input type="text" class="form-control inputSeizedObjects" name="seized_objects" id="inputSeizedObjects" placeholder="Ex.: 01 - motosserra / 01 - Caminhão Mercedes Bens"  value="{!!$data['seized_objects']!!}">
                                <label for="inputDepositLocation" class="labelDepositLocation" id="labelDepositLocation">Endereço onde foi depositado:</label>
                                <input type="text" class="form-control depositLocation" name="deposit_location" id="inputDepositLocation" placeholder="Ex.: Rua 31 de Março Nº 153 - Bairro Centro - Ji-Paraná/RO"  value="{!!$data['deposit_location']!!}">
                                <label for="inputNameFaithful" class="labelNameFaithful" id="labelNameFaithful">Nome e CPF/CNPJ fiel depositário:</label>
                                <input type="text" class="form-control inputNameFaithful" name="name_faithful" id="inputNameFaithful" placeholder="Ex.: Prefeitura de Ji-Paraná - CNPJ: 00.000.000/0001-00"  value="{!!$data['name_faithful']!!}">
                                <label for="inputNameresponsible" class="labelNameresponsible" id="labelNameresponsible">Nome e CPF do responsável pelo recebimento:</label>
                                <input type="text" class="form-control inputNameresponsible" name="name_responsible" id="inputNameresponsible" placeholder="Ex.: João Pedro de Nóbrega CPF: 000.000.000-00"  value="{!!$data['name_responsible']!!}">
                            </div>
                            
                        </div>
                    </div>



                    
                    <div class="offenderDate">
                        <h3>Dados do envolvido/autuado</h3>

                        
                            <div class="row">
                                <div class="col-sm-7">
                                    <label for="name">Nome do envolvido:</label>
                                    <input type="text" class="form-control name" name="name" id="name" value="{!!$data['name']!!}">
                                </div>
                                <div class="col-sm-3">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" class="form-control cpf" name="cpf" id="cpf" value="{!!$data['cpf']!!}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="rg">RG:</label>
                                    <input type="number" class="form-control rg" name="rg" id="rg" value="{!!$data['rg']!!}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="phone">Telefone:</label>
                                    <input type="text" class="form-control rg" name="phone" id="phone" value="{!!$data['phone']!!}">
                                </div>
                                <div class="col-sm-2">
                                    <label for="birthday">Data de nascimento:</label>
                                    <input type="text" class="form-control birthday" name="birthday" id="birthday" value="{!!$data['birthday']!!}">
                                </div>
                                <div class="col-sm-7">
                                    <label for="affiliation">Filiação:</label>
                                    <input type="text" class="form-control affiliation" name="affiliation" id="affiliation" value="{!!$data['affiliation']!!}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="address">Endreço:</label>
                                    <input type="text" class="form-control address" name="address" id="address" value="{!!$data['address']!!}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="location">Local do fato:</label>
                                    <input type="text" class="form-control location" name="location" id="location" value="{!!$data['location']!!}">
                                </div>
                            </div>
                        

                    </div>



                    <div class="historic">
                        <h3>Histórico da ocorrência</h3>
                        <label for="historic">Dos fatos:</label>
                        <textarea class="form-control" name="historic" id="historic" cols="30" rows="10" value="">{!!$data['historic']!!}</textarea>
                    </div>

                    



                    <div class="divImages">
                        <h3>Imagens da ocorrência</h3>
                        <label for="images1">Mudar as 4 imagens:</label>
                        <input type="file" class="form-control images1" name="images1[]" id="images1" multiple>
                    </div>
                    <div class="offenderMotive">
                        <h3>Dos Motivos apresentado pelo envolvido</h3>
                        <label for="motive">Motivo:</label>
                        <input type="text" class="form-control motive" name="motive" id="motive" value="{!!$data['motive']!!}">
                    </div>


                    <div class="mitigatingAggravating">
                        <h3>Das atenuantes e agravantes</h3>
                        <div class="mitigating">                            
                            <!-- <span  class="titleLabel">Possui atenuantes?</span>
                            <div class="divRadiosMitigating">
                                <input type="radio" name="yesOrNoMitigating" id="yesMitigating" value="yes">
                                <label for="yesMitigating" class="labelNotBold">Sim</label>
                                <input type="radio" name="yesOrNoMitigating" id="noMitigating" value="no" checked>
                                <label for="noMitigating" class="labelNotBold">Não</label>
                            </div> -->

                            <div id="divMitigating">
                                <p class="mb-3">Art. 14. São circunstâncias que atenuam a pena:</p>
                                <fieldset class="checkboxMitigating">



                                
                                
                                @foreach([
                                    "I - baixo grau de instrução ou escolaridade do agente;",
                                    "II - arrependimento do infrator, manifestado pela espontânea reparação do dano, ou limitação significativa da degradação ambiental causada;",
                                    "III - comunicação prévia pelo agente do perigo iminente de degradação ambiental;",
                                    "IV - colaboração com os agentes encarregados da vigilância e do controle ambiental."
                                ] as $option)
                                    <label class="labelNotBold">
                                        <input type="checkbox" 
                                            name="mitigating[]" 
                                            value="{{ $option }}" 
                                            class="ms-4" 
                                            {{ in_array($option, $mitigatingArray) ? 'checked' : '' }}>
                                        {{ $option }}
                                    </label>
                                @endforeach

                                





                                    <!-- <label class="labelNotBold">
                                        <input type="checkbox" name="mitigating[]" value="I - baixo grau de instrução ou escolaridade do agente;" class=" ms-4"> I - baixo grau de instrução ou escolaridade do agente;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="mitigating[]" value="II - arrependimento do infrator, manifestado pela espontânea reparação do dano, ou limitação significativa da degradação ambiental causada;" class=" ms-4"> II - arrependimento do infrator, manifestado pela espontânea reparação do dano, ou limitação significativa da degradação ambiental causada;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="mitigating[]" value="III - comunicação prévia pelo agente do perigo iminente de degradação ambiental;" class=" ms-4"> III - comunicação prévia pelo agente do perigo iminente de degradação ambiental;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="mitigating[]" value="IV - colaboração com os agentes encarregados da vigilância e do controle ambiental." class=" ms-4"> IV - colaboração com os agentes encarregados da vigilância e do controle ambiental.
                                    </label> -->
                                </fieldset>
                            </div>
                        </div>


                        <div class="aggravating">
                            <!-- <span for="aggravating">Possui agravantes:</span>
                            <div class="divRadiosAggravating">
                                <input type="radio" name="yesOrNoAggravating" id="yesAggravating" value="yes">
                                <label for="yesAggravating" class="labelNotBold">Sim</label>
                                <input type="radio" name="yesOrNoAggravating" id="noAggravating" value="no" checked>
                                <label for="noAggravating" class="labelNotBold">Não</label>
                            </div> -->
                            
                            <div id="divAggravating">
                                <p class="mb-4">Art. 15. São circunstâncias que agravam a pena, quando não constituem ou qualificam o crime:</p>
                                @foreach([
                                    "I - Reincidência nos crimes de natureza ambiental;",
                                    "II - Ter o agente cometido a infração: a- para obter vantagem pecuniária;",
                                    "II - Ter o agente cometido a infração: b- coagindo outrem para a execução material da infração;",
                                    "II - Ter o agente cometido a infração: c- afetando ou expondo a perigo, de maneira grave, a saúde pública ou o meio ambiente;",
                                    "II - Ter o agente cometido a infração: d- concorrendo para danos à propriedade alheia;",
                                    "II - Ter o agente cometido a infração: e- atingindo áreas de unidades de conservação ou áreas sujeitas, por ato do Poder Público, a regime especial de uso;",
                                    "II - Ter o agente cometido a infração: f- atingindo áreas urbanas ou quaisquer assentamentos humanos;",
                                    "II - Ter o agente cometido a infração: g- em período de defeso à fauna;",
                                    "II - Ter o agente cometido a infração: h- em domingos ou feriados;",
                                    "II - Ter o agente cometido a infração: i- à noite;",
                                    "II - Ter o agente cometido a infração: j- em épocas de seca ou inundações;",
                                    "II - Ter o agente cometido a infração: l- no interior do espaço territorial especialmente protegido;",
                                    "II - Ter o agente cometido a infração: m- com o emprego de métodos cruéis para abate ou captura de animais;",
                                    "II - Ter o agente cometido a infração: n- mediante fraude ou abuso de confiança;",
                                    "II - Ter o agente cometido a infração: o- mediante abuso do direito de licença, permissão ou autorização ambiental;",
                                    "II - Ter o agente cometido a infração: p- no interesse de pessoa jurídica mantida, total ou parcialmente, por verbas públicas ou beneficiada por incentivos fiscais;",
                                    "II - Ter o agente cometido a infração: q- atingindo espécies ameaçadas, listadas em relatórios oficiais das autoridades competentes;",
                                    "II - Ter o agente cometido a infração: r- facilitada por funcionário público no exercício de suas funções."
                                ] as $option)
                                    <label class="labelNotBold">
                                        <input type="checkbox" 
                                            name="aggravating[]" 
                                            value="{{ $option }}" 
                                            class="ms-4" 
                                            {{ in_array($option, $aggravatingArray) ? 'checked' : '' }}>
                                        {{ $option }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- <div class="administrativeAndCriminal">
                        <h3>Das medidas administrativas e criminais</h3>
                        <div>
                            <h4>Medidas administrativas:</h4>
                        </div>
                    </div> -->
                    <div class="team">
                        <h3 class="tiles2">Componentes da equipe</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cmt">Comandante - Nome completo - Graduação - RE:</label>
                                <input type="text" class="form-control cmt" id="cmt" name="name_CMT" value="{!!$data['name_CMT']!!}">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitCmt">Unidade CMT:</label>
                                <input type="text" class="form-control unitCmt" name="unit_CMT" id="unitCmt" value="{!!$data['unit_CMT']!!}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="mot">Motorista:</label>
                                <input type="text" class="form-control mot" id="mot" name="name_MOT" value="{!!$data['name_MOT']!!}">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitMot">Unidade Motorista:</label>
                                <input type="text" class="form-control unitMot" name="unit_MOT" id="unitMot" value="{!!$data['unit_MOT']!!}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ptr1">Patrulheiro 1:</label>
                                <input type="text" class="form-control ptr1" id="ptr1" name="name_PTR1" value="{!!$data['name_PTR1']!!}">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitPtr1">Unidade Patrulheiro 1:</label>
                                <input type="text" class="form-control unitPtr1" name="unit_PTR1" id="unitPtr1" value="{!!$data['unit_PTR1']!!}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ptr2">Patrulheiro 2:</label>
                                <input type="text" class="form-control ptr2" id="ptr2" name="name_PTR2" value="{!!$data['name_PTR2']!!}">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitPtr2">Unidade Patrulheiro 2:</label>
                                <input type="text" class="form-control unitPtr2" name="unit_PTR2" id="unitPtr2" value="{!!$data['unit_PTR2']!!}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ptr3">Patrulheiro 3:</label>
                                <input type="text" class="form-control ptr3" id="ptr3" name="name_PTR3" value="{!!$data['name_PTR3']!!}">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitPtr3">Unidade Patrulheiro 3:</label>
                                <input type="text" class="form-control unitPtr3" name="unit_PTR3" id="unitPtr3" value="{!!$data['unit_PTR3']!!}">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success" id="generateReport">Salvar</button>
                </form>
            </div> 
        </div>
    </div>
</div>



@endsection
