@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/createDetailedReport.css') }}">


<script src="{{ asset('js/createDetailedReport.js') }}" defer type="module"></script>

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
                    <div class="occurrenceData">
                        <h3>Dados da Ocorrência</h3>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="inputBO">Numero da ocorrência:</label>
                                <input type="number" class="form-control" name="inputBO" id="inputBO" value="314630014">
                            </div>
                            <div class="col-sm-2">
                                <span class="titleLabel">Tipo da ocorrência:</span>
                                <div class="divRadiosBO">
                                    <input type="radio" name="typeBO" id="typeTCO" value="Termo circunstanciado de Ocorrência - TCO"  checked>
                                    <label for="typeTCO" class="labelNotBold">TCO</label>
                                    <input type="radio" name="typeBO" id="typeCOP" value="Comunicado de Ocorrência Policial - COP" >
                                    <label for="typeCOP" class="labelNotBold">COP</label>
                                    <input type="radio" name="typeBO" id="typePA" value="Prisão e Apreensão - PA" >
                                    <label for="typePA" class="labelNotBold">PA</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="articleBO">Artigo Criminal:</label>
                                <input type="text" class="form-control articleBO" name="articleBO" id="articleBO" value="Art. 51">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <label for="inputAI">Auto de Infração II:</label>
                                <input type="number" class="form-control" name="inputAI" id="inputAI" value="125425">
                            </div>
                            <div class="col-sm-2">
                                <label for="valueAI">Valor do AI:</label>
                                <input type="number" class="form-control valueAI" name="valueAI" id="valueAI" value="5000">
                            </div>
                            <div class="col-sm-4">
                                <label for="articleAI">Artigo Administrativo:</label>
                                <input type="text" class="form-control articleAI" name="articleAI" id="articleAI" value="Art. 51">
                            </div>
                            <div class="col-sm-3">
                                <span class="titleLabel">Tipo da infração:</span>
                                <select name="selectTypeAI" class="form-control" id="selectTypeAI">
                                    <option value="" selected disabled>Selecione:</option>
                                    <option value="logging">Desmatamento</option>
                                    <option value="wood">Madeira</option>
                                    <!-- <option value="openFine">Multa aberta</option>  -->
                                </select>
                            </div>
                        </div>

                        <div class="row divDeforestationSize" id="divDeforestationSize">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label for="inputDeforestationSize" id="labelDeforestationSize">Tamanho do desmatamento (ha):</label>
                                            <input type="number" class="form-control" name="inputDeforestationSize" id="inputDeforestationSize" step="0.001" value="45.325">
                                        </div>
                                        <div class="col-sm-5">
                                            <span class="titleLabel">Área onde ocorreu o desmatamento:</span>                                            
                                            <div>
                                                <input type="radio" name="reserve" id="reserve" value="reserve" checked>
                                                <label for="reserve" class="labelNotBold">Reserva legal</label>
                                                <input type="radio" name="reserve" id="offReserve" value="offReserve">
                                                <label for="offReserve" class="labelNotBold">Fora da reserva legal</label>
                                                <input type="radio" name="reserve" id="regeneration" value="regeneration">
                                                <label for="regeneration" class="labelNotBold">Regeneração</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="divEmbargos" id="divEmbargos">
                                                <span class="titleLabel">Possui Embargo?</span>
                                                <div class="divRadiosEmbargos">
                                                    <input type="radio" name="yesOrNoEmbargos" id="yesEmbargos"  value="yes">
                                                    <label for="yesEmbargos" class="labelNotBold">Sim</label>
                                                    <input type="radio" name="yesOrNoEmbargos" id="noEmbargos" value="no" checked>
                                                    <label for="noEmbargos" class="labelNotBold">Não</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <span class="titleLabel">Possui Carta Imagem?</span>
                                            <div class="divRadiosImageLetter">
                                                <input type="radio" name="yesOrNoImageLetter" id="yesImageLetter" value="yes">
                                                <label for="yesImageLetter" class="labelNotBold">Sim</label>
                                                <input type="radio" name="yesOrNoImageLetter" id="noImageLetter" value="no" checked>
                                                <label for="noImageLetter" class="labelNotBold">Não</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="row">
                            <div class="col-sm-6" id="divInputEmbargo">
                                <label for="inputEmbargo" class="labelEmbargo" id="labelEmbargo">Informe o numero do Termo de Embargo:</label>
                                <input type="number" class="form-control inputEmbargo" name="inputEmbargo" id="inputEmbargo" value="163254">
                            </div>
                            <div class="col-sm-6" id="divInputImageletter">                                
                                <label for="inputImageLetter" class="labelImageLetter" id="labelImageLetter">Informe o numero da Carta Imagem:</label>
                                <input type="text" class="form-control inputImageLetter" name="inputImageLetter" id="inputImageLetter" value="JIPA-2023-JPRA025">
                            </div>
                        </div>

                        <div class="divQuantityWood" id="divQuantityWood">
                            <label for="inputQuantityWood" id="labelQuantityWood">Quantidade de madeira (m³):</label>
                            <input type="number" class="form-control" name="inputQuantityWood" id="inputQuantityWood" value="9,324">
                        </div>


                        

                        <!-- Implantar quando for colovar madeira -->
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
                        <input type="number" class="form-control inputLumber" name="inputLumber" id="inputLumber" value="111111">
                        <div id="divNaturalWood">
                            <span for="">Possui Planilha de Madeira In-Natura?</span>
                            <div class="divRadiosNaturalWood">
                                <input type="radio" name="yesOrNoNaturalWood" id="yesNaturalWood" value="yes">
                                <label for="yesNaturalWood">Sim</label>
                                <input type="radio" name="yesOrNoNaturalWood" id="noNaturalWood" value="no" checked>
                                <label for="noNaturalWood">Não</label>
                            </div>
                            <label for="inputNaturalWood" class="labelNaturalWood" id="labelNaturalWood">Informe o numero da Planilha de Madeira In-Natura:</label>
                            <input type="number" class="form-control inputNaturalWood" name="inputNaturalWood" id="inputNaturalWood" value="111111">
                        </div> -->


                        <div class="seizedObjects">
                            <span class="titleLabel">Possui objetos apreendidos?</span>
                            <div class="divRadiosSeizedObjects">
                                <input type="radio" name="yesOrNoSeizedObjects" id="yesSeizedObjects" value="yes">
                                <label for="yesSeizedObjects" class="labelNotBold">Sim</label>
                                <input type="radio" name="yesOrNoSeizedObjects" id="noSeizedObjects" value="no" checked>
                                <label for="noSeizedObjects" class="labelNotBold">Não</label>
                            </div>
                            <div id="divSeizedObjects">
                                <label for="inputTermOfSeizure" class="termOfSeizure" id="termOfSeizure">Termo de Apreensão:</label>
                                <input type="text" class="form-control inputTermOfSeizure" name="inputTermOfSeizure" id="inputTermOfSeizure" placeholder=""  value="123545">
                                <label for="inputSeizedObjects" class="seizedObjects" id="seizedObjects">Descreva os objetos apreendidos:</label>
                                <input type="text" class="form-control inputSeizedObjects" name="inputSeizedObjects" id="inputSeizedObjects" placeholder="Ex.: 01 - motosserra / 01 - Caminhão Mercedes Bens"  value="01 - Motossera Huskvarna, 01 - Trator de esteira amarelo">
                                <label for="inputDepositLocation" class="labelDepositLocation" id="labelDepositLocation">Endereço onde foi depositado:</label>
                                <input type="text" class="form-control depositLocation" name="inputDepositLocation" id="inputDepositLocation" placeholder="Ex.: Rua 31 de Março Nº 153 - Bairro Centro - Ji-Paraná/RO"  value="Rua Jasmim Nº 36 Bairro Centro - Ji-Paraná/RO">
                                <label for="inputNameFaithful" class="labelNameFaithful" id="labelNameFaithful">Nome e CPF/CNPJ fiel depositário:</label>
                                <input type="text" class="form-control inputNameFaithful" name="inputNameFaithful" id="inputNameFaithful" placeholder="Ex.: Prefeitura de Ji-Paraná - CNPJ: 00.000.000/0001-00"  value="Prefeitura de Ji-Paraná CNPJ: 01.002.543/0001-25">
                                <label for="inputNameresponsible" class="labelNameresponsible" id="labelNameresponsible">Nome e CPF do responsável pelo recebimento:</label>
                                <input type="text" class="form-control inputNameresponsible" name="inputNameresponsible" id="inputNameresponsible" placeholder="Ex.: João Pedro de Nóbrega CPF: 000.000.000-00"  value="Marcelo Antonio CPF: 126.135.464-58">

                                <div class="divImagesObjects">
                                    <!-- <h3>Imagens da ocorrência</h3> -->
                                    <label for="images1">Carregar 4 imagens, sendo 3 dos objetos apreendidos e 1 do local onde ficaram depositado:</label>
                                    <input type="file" class="form-control images1" name="images2[]" id="images2" multiple>
                                </div>
                            </div>
                            
                        </div>
                    </div>



                    
                    <div class="offenderDate">
                        <h3>Dados do envolvido/autuado</h3>

                        
                            <div class="row">
                                <div class="col-sm-7">
                                    <label for="name">Nome do envolvido:</label>
                                    <input type="text" class="form-control name" name="name" id="name" value="Carlos Neto de Lima">
                                </div>
                                <div class="col-sm-3">
                                    <label for="cpf">CPF:</label>
                                    <input type="text" class="form-control cpf" name="cpf" id="cpf" value="45678512458">
                                </div>
                                <div class="col-sm-2">
                                    <label for="rg">RG:</label>
                                    <input type="number" class="form-control rg" name="rg" id="rg" value="963254">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="phone">Telefone:</label>
                                    <input type="text" class="form-control rg" name="phone" id="phone" value="6985421547">
                                </div>
                                <div class="col-sm-2">
                                    <label for="birthday">Data de nascimento:</label>
                                    <input type="text" class="form-control birthday" name="birthday" id="birthday" value="23121988">
                                </div>
                                <div class="col-sm-7">
                                    <label for="affiliation">Filiação:</label>
                                    <input type="text" class="form-control affiliation" name="affiliation" id="affiliation" value="Pedro de Paula Neto e Maria da Flor Benedita">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="address">Endreço:</label>
                                    <input type="text" class="form-control address" name="address" id="address" value="Rua das Flores - Nº 456 - Bairro: Castanha">
                                </div>
                                <div class="col-sm-6">
                                    <label for="location">Local do fato:</label>
                                    <input type="text" class="form-control location" name="location" id="location" value="Linha 116 KM 36 GB 124 Zona Rural de Ji-Paraná/RO">
                                </div>
                            </div>
                        

                    </div>



                    <div class="historic">
                        <h3>Histórico da ocorrência</h3>
                        <label for="historic">Dos fatos:</label>
                        <textarea class="form-control" name="historic" id="historic" cols="30" rows="10">Aos (22) dias do mês de dezembro de 2023, por volta das 15 horas, esta equipe de policiais militares ambientais do BPA, juntamente com policiais do 4 BPM, em operação de Fiscalização de combate ao desmatamento e queimadas ilegais demonstrados por meio de alertas emitidos pelo Programa Brasil Mais do Ministério da Justiça e Segurança Pública, por fatos ocorridos na Linha Ponte Bonita Lote 56-B Gleba 24 no Município de Espigão do Oeste, mais precisamente nas Coordenadas Geográficas 11°15'15.03" S 60°46'22.71" W, local no qual foi emitido pelo sistema o alerta id: 3025339 sendo realizado fiscalização no local, sobrevoo com Aeronave Remotamente Pilotada (VANT) e ainda, realizado análise de imagens de satélite orbital vide Carta Imagem de Vegetação Nativa Antropizada n°: PM-94991-20231117-1152, na qual foi constatado um dano ambiental por supressão de vegetação de 120,9999 hectares em área de reserva legal ou remanescente de vegetação nativa em região classificada como Bioma Amazônico.

Em contato por telefone com o senhor Eudack José Colombi, ele afirmou ser o proprietário do imóvel em questão e disse que realmente realizou o serviço de limpeza e que possuía a escritura da terra, mas até o momento do encerramento dessa ocorrência ele não enviou por meio eletrônico conforme solicitado, afirmando apenas que estava em viagem para o Espírito Santos e que tal documento estava em posse de seu Contador na Cidade de Espigão do Oeste-RO.

Considerando que ele não se encontrava no estado de Rondônia, nem tal documentação não foi enviada e nem indicado o responsável legal, no dia 23 de dezembro procedemos com a elaboração da documentação referente ao desmatamentobem como a produçao de Auto de Infraçao para que a SEDAM lhe encaminhe posteriormente por AR. Diante disso por estar incurso no disposto do artigo 50 da Lei Federal 9.605/1998 (Destruir ou danificar florestas nativas ou plantadas ou vegetação fixadora de dunas, protetora de mangues, objeto de especial preservação) que prevê pena de- detenção, de três meses a um ano e multa, foi feito esta ocorrência e registrado na Polícia Civil para conhecimento e providencias.

Foram tomadas ainda as medidas Administrativas cabíveis conforme Termo de Embargo número 007587 e Auto de Infração Ambiental II de número 102195 por destruir 120,9999 hectares de floresta nativa em área de reserva legal que prevê multa de R$ 5.000,00 (cinco mil reais) por hectare ou fração conforme Art. 51 do Decreto Federal 6514/2008. </textarea>
                    </div>
                    <div class="divImages">
                        <h3>Imagens da ocorrência</h3>
                        <label for="images1">Carregar 4 imagens:</label>
                        <input type="file" class="form-control images1" name="images1[]" id="images1" multiple>
                    </div>
                    <div class="offenderMotive">
                        <h3>Dos Motivos apresentado pelo envolvido</h3>
                        <label for="motive">Motivo:</label>
                        <input type="text" class="form-control motive" name="motive" id="motive" value="Alegou não saber que precisava de autorização para realizar aquele desmatamento.">
                    </div>


                    <div class="mitigatingAggravating">
                        <h3>Das atenuantes e agravantes</h3>
                        <div class="mitigating">                            
                            <span  class="titleLabel">Possui atenuantes?</span>
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
                                    </label>
                                </fieldset>
                            </div>
                        </div>


                        <div class="aggravating">
                            <span for="aggravating">Possui agravantes:</span>
                            <div class="divRadiosAggravating">
                                <input type="radio" name="yesOrNoAggravating" id="yesAggravating" value="yes">
                                <label for="yesAggravating" class="labelNotBold">Sim</label>
                                <input type="radio" name="yesOrNoAggravating" id="noAggravating" value="no" checked>
                                <label for="noAggravating" class="labelNotBold">Não</label>
                            </div>
                            
                            <div id="divAggravating">
                                <p class="mb-4">Art. 15. São circunstâncias que agravam a pena, quando não constituem ou qualificam o crime:</p>
                                <fieldset class="checkboxAgravating">
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="I - Reincidência nos crimes de natureza ambiental;" class=" ms-4"> I - Reincidência nos crimes de natureza ambiental;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: a- para obter vantagem pecuniária;" class=" ms-4"> II - Ter o agente cometido a infração: a- para obter vantagem pecuniária;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: b- coagindo outrem para a execução material da infração;" class=" ms-4"> II - Ter o agente cometido a infração: b- coagindo outrem para a execução material da infração;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: c- afetando ou expondo a perigo, de maneira grave, a saúde pública ou o meio ambiente;" class=" ms-4"> II - Ter o agente cometido a infração: c- afetando ou expondo a perigo, de maneira grave, a saúde pública ou o meio ambiente;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: d- concorrendo para danos à propriedade alheia;" class=" ms-4"> II - Ter o agente cometido a infração: d- concorrendo para danos à propriedade alheia;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: e- atingindo áreas de unidades de conservação ou áreas sujeitas, por ato do Poder Público, a regime especial de uso;" class=" ms-4"> II - Ter o agente cometido a infração: e- atingindo áreas de unidades de conservação ou áreas sujeitas, por ato do Poder Público, a regime especial de uso;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: f- atingindo áreas urbanas ou quaisquer assentamentos humanos;" class=" ms-4"> II - Ter o agente cometido a infração: f- atingindo áreas urbanas ou quaisquer assentamentos humanos;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: g- em período de defeso à fauna;" class=" ms-4"> II - Ter o agente cometido a infração: g- em período de defeso à fauna;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: h- em domingos ou feriados;" class=" ms-4"> II - Ter o agente cometido a infração: h- em domingos ou feriados;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: i- à noite;" class=" ms-4"> II - Ter o agente cometido a infração: i- à noite;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: j- em épocas de seca ou inundações;" class=" ms-4"> II - Ter o agente cometido a infração: j- em épocas de seca ou inundações;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: l- no interior do espaço territorial especialmente protegido;" class=" ms-4"> II - Ter o agente cometido a infração: l- no interior do espaço territorial especialmente protegido;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: m- com o emprego de métodos cruéis para abate ou captura de animais;" class=" ms-4"> II - Ter o agente cometido a infração: m- com o emprego de métodos cruéis para abate ou captura de animais;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: n- mediante fraude ou abuso de confiança;" class=" ms-4"> II - Ter o agente cometido a infração: n- mediante fraude ou abuso de confiança;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: o- mediante abuso do direito de licença, permissão ou autorização ambiental;" class=" ms-4"> II - Ter o agente cometido a infração: o- mediante abuso do direito de licença, permissão ou autorização ambiental;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: p- no interesse de pessoa jurídica mantida, total ou parcialmente, por verbas públicas ou beneficiada por incentivos fiscais;" class=" ms-4"> II - Ter o agente cometido a infração: p- no interesse de pessoa jurídica mantida, total ou parcialmente, por verbas públicas ou beneficiada por incentivos fiscais;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: q- atingindo espécies ameaçadas, listadas em relatórios oficiais das autoridades competentes;" class=" ms-4"> II - Ter o agente cometido a infração: q- atingindo espécies ameaçadas, listadas em relatórios oficiais das autoridades competentes;
                                    </label>
                                    <label class="labelNotBold">
                                        <input type="checkbox" name="aggravating[]" value="II - Ter o agente cometido a infração: r- facilitada por funcionário público no exercício de suas funções." class=" ms-4"> II - Ter o agente cometido a infração: r- facilitada por funcionário público no exercício de suas funções.
                                    </label>
                                </fieldset>
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
                                <input type="text" class="form-control cmt" id="cmt" name="cmt" value="Alberto Martins - CB QPPM - 100095154">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitCmt">Unidade CMT:</label>
                                <input type="text" class="form-control unitCmt" name="unitCmt" id="unitCmt" value="1º PEL-PA/3ªCIA-PA/BPA (JI-PARANÁ - RO)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="mot">Motorista:</label>
                                <input type="text" class="form-control mot" id="mot" name="mot" value="Marcos Pedroso neto - CB QPPM - 100096452">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitMot">Unidade Motorista:</label>
                                <input type="text" class="form-control unitMot" name="unitMot" id="unitMot" value="1º PEL-PA/3ªCIA-PA/BPA (JI-PARANÁ - RO)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ptr1">Patrulheiro 1:</label>
                                <input type="text" class="form-control ptr1" id="ptr1" name="ptr1" value="Rogger Marcos de Paula - SD QPPM - 100098754">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitPtr1">Unidade Patrulheiro 1:</label>
                                <input type="text" class="form-control unitPtr1" name="unitPtr1" id="unitPtr1" value="1º PEL-PA/3ªCIA-PA/BPA (JI-PARANÁ - RO)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ptr2">Patrulheiro 2:</label>
                                <input type="text" class="form-control ptr2" id="ptr2" name="ptr2" value="Mauricio Neto Godoi - SD QPPM - 100098745">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitPtr2">Unidade Patrulheiro 2:</label>
                                <input type="text" class="form-control unitPtr2" name="unitPtr2" id="unitPtr2" value="1º PEL-PA/3ªCIA-PA/BPA (JI-PARANÁ - RO)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="ptr3">Patrulheiro 3:</label>
                                <input type="text" class="form-control ptr3" id="ptr3" name="ptr3" value="Murilo Gomes - SD QPPM - 10005745">
                            </div>
                            <div class="col-sm-6">
                                <label for="unitPtr3">Unidade Patrulheiro 3:</label>
                                <input type="text" class="form-control unitPtr3" name="unitPtr3" id="unitPtr3" value="1º PEL-PA/3ªCIA-PA/BPA (JI-PARANÁ - RO)">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="generateReport">Gerar Relatório</button>
                </form>
            </div> 
        </div>
    </div>
</div>



@endsection
