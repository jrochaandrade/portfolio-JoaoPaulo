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
                <form action="{{route('generate')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="occurrenceData">
                        <h3>Dados da Ocorrência</h3>
                        <label for="inputBO">Numero da ocorrência:</label>
                        <input type="number" class="form-control" name="inputBO" id="inputBO">
                        <span for="">Tipo da ocorrência:</span>
                        <div class="divRadiosBO">
                            <input type="radio" name="typeBO" id="typeTCO" value="Termo circunstanciado de Ocorrência - TCO">
                            <label for="typeTCO">TCO</label>
                            <input type="radio" name="typeBO" id="typeCOP" value="Comunicado de Ocorrência Policial - COP">
                            <label for="typeCOP">COP</label>
                            <input type="radio" name="typeBO" id="typePA" value="Prisão e Apreensão - PA">
                            <label for="typePA">PA</label>
                        </div>
                        <label for="inputAI">Auto de Infração II:</label>
                        <input type="number" class="form-control" name="inputAI" id="inputAI">
                        <label for="valueAI">Valor do AI:</label>
                        <input type="number" class="form-control valueAI" name="valueAI" id="valueAI">
                        <label for="articleAI">Artigo usado:</label>
                        <input type="text" class="form-control articleAI" name="articleAI" id="articleAI">
                        <span>Tipo da infração:</span>
                        <select name="selectTypeAI" class="form-control" id="selectTypeAI">
                            <option value="" selected disabled>Selecione:</option>
                            <option value="logging">Desmatamento</option>
                            <option value="wood">Madeira</option>
                            <!-- <option value="openFine">Multa aberta</option>  -->
                        </select>
                        <div class="divDeforestationSize" id="divDeforestationSize">
                            <label for="deforestationSize" id="labelDeforestationSize">Tamanho do desmatamento (ha):</label>
                            <input type="number" class="form-control" name="inputDeforestationSize" id="inputDeforestationSize">
                        </div class="divlabelQuantityWood" id="divlabelQuantityWood">
                        <div class="divQuantityWood" id="divQuantityWood">
                            <label for="quantityWood" id="labelQuantityWood">Quantidade de madeira (m³):</label>
                            <input type="number" class="form-control" name="inputQuantityWood" id="inputQuantityWood">
                        </div>
                        <span for="">Possui Termo de embargo?</span>
                        <div class="divRadiosEmbargos">
                            <input type="radio" name="yesOrNoEmbargos" id="yesEmbargos"  value="yes">
                            <label for="yesEmbargos">Sim</label>
                            <input type="radio" name="yesOrNoEmbargos" id="noEmbargos" value="no" checked>
                            <label for="noEmbargos">Não</label>
                        </div>
                        <label for="inputEmbargo" class="labelEmbargo" id="labelEmbargo">Informe o numero do Termo de Embargo:</label>
                        <input type="number" class="form-control inputEmbargo" name="inputEmbargo" id="inputEmbargo">
                        <span for="">Possui Planilha de Madeira Serrada?</span>
                        <div class="divRadiosLumber">
                            <input type="radio" name="yesOrNoLumber" id="yesLumber" value="yes">
                            <label for="yesLumber">Sim</label>
                            <input type="radio" name="yesOrNoLumber" id="noLumber" value="no" checked>
                            <label for="noLumber">Não</label>
                        </div>
                        <label for="inputLumber" class="labelLumber" id="labelLumber">Informe o numero da Planilha de Madeira Serrada:</label>
                        <input type="number" class="form-control inputLumber" name="inputLumber" id="inputLumber">
                        <span for="">Possui Planilha de Madeira In-Natura?</span>
                        <div class="divRadiosNaturalWood">
                            <input type="radio" name="yesOrNoNaturalWood" id="yesNaturalWood" value="yes">
                            <label for="yesNaturalWood">Sim</label>
                            <input type="radio" name="yesOrNoNaturalWood" id="noNaturalWood" value="no" checked>
                            <label for="noNaturalWood">Não</label>
                        </div>
                        <label for="inputNaturalWood" class="labelNaturalWood" id="labelNaturalWood">Informe o numero da Planilha de Madeira In-Natura:</label>
                        <input type="number" class="form-control inputNaturalWood" name="inputNaturalWood" id="inputNaturalWood">
                        <span for="">Possui Carta Imagem?</span>
                        <div class="divRadiosImageLetter">
                            <input type="radio" name="yesOrNoImageLetter" id="yesImageLetter" value="yes">
                            <label for="yesImageLetter">Sim</label>
                            <input type="radio" name="yesOrNoImageLetter" id="noImageLetter" value="no" checked>
                            <label for="noImageLetter">Não</label>
                        </div>
                        <label for="inputImageLetter" class="labelImageLetter" id="labelImageLetter">Informe o numero da Carta Imagem:</label>
                        <input type="text" class="form-control inputImageLetter" name="inputImageLetter" id="inputImageLetter">
                    </div>
                    <div class="offenderDate">
                        <h3>Dados do envolvido/autuado</h3>
                        <label for="name">Nome do envolvido:</label>
                        <input type="text" class="form-control name" name="name" id="name">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control cpf" name="cpf" id="cpf">
                        <label for="rg">RG:</label>
                        <input type="number" class="form-control rg" name="rg" id="rg">
                        <label for="phone">Telefone:</label>
                        <input type="text" class="form-control rg" name="phone" id="phone">
                        <label for="birthday">Data de nascimento:</label>
                        <input type="text" class="form-control birthday" name="birthday" id="birthday">
                        <label for="affiliation">Filiação:</label>
                        <input type="text" class="form-control affiliation" name="affiliation" id="affiliation">
                        <label for="address">Endreço:</label>
                        <input type="text" class="form-control address" name="address" id="address">
                        <label for="location">Local do fato:</label>
                        <input type="text" class="form-control location" name="location" id="location">
                    </div>
                    <div class="historic">
                        <h3>Histórico da ocorrência</h3>
                        <label for="historic">Dos fatos:</label>
                        <textarea class="form-control" name="historic" id="historic" cols="30" rows="10"></textarea>
                    </div>
                    <div class="divImages">
                        <h3>Imagens da ocorrência</h3>
                        <label for="images1">Carregar 4 imagens:</label>
                        <input type="file" class="form-control images1" name="images1[]" id="images1" multiple>
                    </div>
                    <div class="offenderMotive">
                        <h3>Dos Motivos apresentado pelo envolvido</h3>
                        <label for="motive">Motivo:</label>
                        <input type="text" class="form-control motive" name="motive" id="motive">
                    </div>
                    <div class="mitigatingAggravating">
                        <h3>Das atenuantes e agravantes</h3>
                        <div class="mitigating">
                            <label for="mitigating">Das atenuantes:</label>
                            <span>Art. 14. São circunstâncias que atenuam a pena:</span>
                            <!-- <input type="text" class="form-control mitigating" id="mitigating"> -->
                            <!-- <select name="" class="form-control" id="" multiple>
                                <option value="" selected disabled>Selecione:</option>
                                <option value="">I - baixo grau de instrução ou escolaridade do agente;</option>
                                <option value="">II - arrependimento do infrator, manifestado pela espontânea reparação do dano, ou limitação significativa da degradação ambiental causada;</option>
                                <option value="">III - comunicação prévia pelo agente do perigo iminente de degradação ambiental;</option>
                                <option value="">IV - colaboração com os agentes encarregados da vigilância e do controle ambiental.</option>
                            </select> -->
                            <fieldset class="checkboxMitigating">
                                <label>
                                    <input type="checkbox" name="mitigating[]" value="I - baixo grau de instrução ou escolaridade do agente;"> I - baixo grau de instrução ou escolaridade do agente;
                                </label>
                                <label>
                                    <input type="checkbox" name="mitigating[]" value="II - arrependimento do infrator, manifestado pela espontânea reparação do dano, ou limitação significativa da degradação ambiental causada;"> II - arrependimento do infrator, manifestado pela espontânea reparação do dano, ou limitação significativa da degradação ambiental causada;
                                </label>
                                <label>
                                    <input type="checkbox" name="mitigating[]" value="III - comunicação prévia pelo agente do perigo iminente de degradação ambiental;"> III - comunicação prévia pelo agente do perigo iminente de degradação ambiental;
                                </label>
                                <label>
                                    <input type="checkbox" name="mitigating[]" value="IV - colaboração com os agentes encarregados da vigilância e do controle ambiental."> IV - colaboração com os agentes encarregados da vigilância e do controle ambiental.
                                </label>
                    
                            </fieldset>
                        </div>
                        <div class="aggravating">
                            <label for="aggravating">Das agravantes:</label>
                            <span>Art. 15. São circunstâncias que agravam a pena, quando não constituem ou qualificam o crime:</span>
                            <!-- <input type="text" class="form-control aggravating" id="aggravating"> -->
                            <!-- <select name="" class="form-control" id="" multiple>
                                <option value="" selected disabled>Selecione:</option>
                                <option value="">I - reincidência nos crimes de natureza ambiental;</option>
                                <option value="">II - ter o agente cometido a infração: a- para obter vantagem pecuniária;</option>
                                <option value="">II - ter o agente cometido a infração: b- coagindo outrem para a execução material da infração;</option>
                                <option value="">II - ter o agente cometido a infração: c- afetando ou expondo a perigo, de maneira grave, a saúde pública ou o meio ambiente;</option>
                                <option value="">II - ter o agente cometido a infração: d- concorrendo para danos à propriedade alheia;</option>
                            </select> -->
                            <fieldset class="checkboxAgravating">
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="I - Reincidência nos crimes de natureza ambiental;"> I - Reincidência nos crimes de natureza ambiental;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: a- para obter vantagem pecuniária;"> II - Ter o agente cometido a infração: a- para obter vantagem pecuniária;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: b- coagindo outrem para a execução material da infração;"> II - Ter o agente cometido a infração: b- coagindo outrem para a execução material da infração;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: c- afetando ou expondo a perigo, de maneira grave, a saúde pública ou o meio ambiente;"> II - Ter o agente cometido a infração: c- afetando ou expondo a perigo, de maneira grave, a saúde pública ou o meio ambiente;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: d- concorrendo para danos à propriedade alheia;"> II - Ter o agente cometido a infração: d- concorrendo para danos à propriedade alheia;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: e- atingindo áreas de unidades de conservação ou áreas sujeitas, por ato do Poder Público, a regime especial de uso;"> II - Ter o agente cometido a infração: e- atingindo áreas de unidades de conservação ou áreas sujeitas, por ato do Poder Público, a regime especial de uso;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: f- atingindo áreas urbanas ou quaisquer assentamentos humanos;"> II - Ter o agente cometido a infração: f- atingindo áreas urbanas ou quaisquer assentamentos humanos;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: g- em período de defeso à fauna;"> II - Ter o agente cometido a infração: g- em período de defeso à fauna;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: h- em domingos ou feriados;"> II - Ter o agente cometido a infração: h- em domingos ou feriados;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: i- à noite;"> II - Ter o agente cometido a infração: i- à noite;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: j- em épocas de seca ou inundações;"> II - Ter o agente cometido a infração: j- em épocas de seca ou inundações;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: l- no interior do espaço territorial especialmente protegido;"> II - Ter o agente cometido a infração: l- no interior do espaço territorial especialmente protegido;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: m- com o emprego de métodos cruéis para abate ou captura de animais;"> II - Ter o agente cometido a infração: m- com o emprego de métodos cruéis para abate ou captura de animais;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: n- mediante fraude ou abuso de confiança;"> II - Ter o agente cometido a infração: n- mediante fraude ou abuso de confiança;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: o- mediante abuso do direito de licença, permissão ou autorização ambiental;"> II - Ter o agente cometido a infração: o- mediante abuso do direito de licença, permissão ou autorização ambiental;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: p- no interesse de pessoa jurídica mantida, total ou parcialmente, por verbas públicas ou beneficiada por incentivos fiscais;"> II - Ter o agente cometido a infração: p- no interesse de pessoa jurídica mantida, total ou parcialmente, por verbas públicas ou beneficiada por incentivos fiscais;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: q- atingindo espécies ameaçadas, listadas em relatórios oficiais das autoridades competentes;"> II - Ter o agente cometido a infração: q- atingindo espécies ameaçadas, listadas em relatórios oficiais das autoridades competentes;
                                </label>
                                <label>
                                    <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: r- facilitada por funcionário público no exercício de suas funções."> II - Ter o agente cometido a infração: r- facilitada por funcionário público no exercício de suas funções.
                                </label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="administrativeAndCriminal">
                        <h3>Das medidas administrativas e criminais</h3>
                        <div>
                            <h4>Medidas administrativas:</h4>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="generateReport">Gerar Relatório</button>
                </form>
            </div> 
        </div>
    </div>
</div>



@endsection
