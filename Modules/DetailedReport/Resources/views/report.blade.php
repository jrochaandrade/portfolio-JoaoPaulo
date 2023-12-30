@extends('layouts.masterPage')

@section('title', 'Polícia Militar Ambiental')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/detailedReport.css') }}">

<script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.3.4/purify.min.js"></script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous"></script>

<script src="{{ asset('js/printThis.js') }}" defer type="module"></script>
<script src="{{ asset('js/detailedReport.js') }}" defer type="module"></script>


@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <!-- <div class="card-header">
        <div class="titleHeader">
            <h1>Relatório Circunstanciado</h1>
        </div>
    </div>  -->   
    <div class="text">
        <div class="container-fluid content" id="content">            
            
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
                        <p>Auto de infração ambiental II - <strong>Nº {{$data['number_AI']}}</strong></p>
                    </div>
                    <div class="divDocs">
                        <p>Auto de Infração Ambiental II - <strong>Nº {{$data['number_AI']}}</strong></p>

                        <p>{{$data['type_BO']}} <strong>Nº {{$data['number_BO']}}</strong></p>
                        
                        @if ($data['number_embargo'])
                        <p>Termo de Embargo - <strong>Nº {{$data['number_embargo']}}</strong></p>
                        @endif
                        
                        <!-- @if ($data['inputLumber'])
                        <p>Planilha de Madeira Serrada - <strong>Nº {{$data['inputLumber']}}</strong></p>
                        @endif -->
                        
                        <!-- @if ($data['inputNaturalWood'])
                        <p>Planilha de Madeira <em>In-Natura</em> - <strong>Nº {{$data['inputNaturalWood']}}</strong></p>
                        @endif -->
                        
                        @if ($data['number_letter'])
                        <p>Carta Imagem - <strong>Nº {{$data['number_letter']}}</strong></p>
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
                                <th class="cell">Filiação</th>
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
                        @foreach ($data['historicParagraphs'] as $historic)
                            <p class="indent">{{$historic}}</p>
                        @endforeach
                    </div>

                    

                    <div class="images">
                    <img src="data:image/jpeg;base64,{{$data['image1']}}" alt="">
                    <img src="data:image/jpeg;base64,{{$data['image2']}}" alt="">
                    <img src="data:image/jpeg;base64,{{$data['image3']}}" alt="">
                    <img src="data:image/jpeg;base64,{{$data['image4']}}" alt="">
                    </div>

                    <div class="reasons">
                        <p class="titles">2. Dos Motivos apresentado pelo envolvido</p>
                        <p class="pIndent">{{$data['motive']}}</p>
                    </div>

                    <div class="mitigatingAndAggravating">
                        <p class="titles">3. Das atenuantes e agravantes</p>
                        <div class="mitigating">
                            <p class="titles2">3.1 Das atenuantes</p>
                            @foreach ($data['mitigatingArray'] as $mitigating)
                                <p class="pIndent">{{$mitigating}}</p>
                            @endforeach
                        </div>
                        <div class="aggravating">
                            <p class="titles2">3.2 Das agravantes</p>
                            @foreach ($data['aggravatingArray'] as $aggravating)
                                <p class="pIndent">{{$aggravating}}</p>
                            @endforeach
                        </div>

                        <div class="administrativeAndCriminal">
                            <p class="titles">4. Das medidas administrativas e criminais</p>
                            <p class="pIndent">Isto posto, foram necessárias medidas administrativas e criminais que se seguem.</p>
                            <div class="administrative">
                                <p class="titles2">4.1 Das medidas administrativas</p>
                                <p class="pIndent">Como medidas adminstrativas foram lavrados:</p>
                                <p class="pIndent">Auto de infração II Nº <strong>{{$data['number_AI']}}</strong> na importância de R${{$data['value_AI']}}, por
                                {!!$data['text_administrative']!!}</p>

                                <p class="pIndent">{!!$data['text_embargo']!!}</p>
                            </div>
                            <div class="criminal">
                                <p class="titles2">4.2 Das medidas criminais</p>
                                <p class="pIndent">Dessa forma, a conduta do infrator implicou, em tese, no crime previsto no {{$data['article_BO']}} da Lei Federal nº 9.605 de 12 de Fevereiro de 1998, in verbis:</p>
                                <p class="pIndent">Portanto, foi confeccionado o {{$data['type_BO']}} Nº <strong>{{$data['number_BO']}}</strong> em desfavor de {{$data['name']}}.</p>
                            </div>
                        </div>                        
                    </div>

                    <div class="team">
                        <table class="table table-bordered tableTeam">
                            <tr>
                                <th colspan="2" class="text-center">Componentes da equipe</th>
                            </tr>
                            <tr>
                                <th class="cell">{{$data['name_CMT']}}</th>
                                <!-- <td>{{$data['unitCmt']}}</td> -->
                            </tr>
                            <tr>
                                <th class="cell">{{$data['name_MOT']}}</th>
                                <!-- <td>{{$data['unitMot']}}</td> -->
                            </tr>
                            <tr>
                                <th class="cell">{{$data['name_PTR1']}}</th>
                                <!-- <td>{{$data['unitPtr1']}}</td> -->
                            </tr>
                            <tr>
                                <th class="cell">{{$data['name_PTR2']}}</th>
                                <!-- <td>{{$data['unitPtr2']}}</td> -->
                            </tr>
                            <tr>
                                <th class="cell">{{$data['name_PTR3']}}</th>
                                <!-- <td>{{$data['unitPtr3']}}</td> -->
                            </tr>                            
                        </table>
                    </div>

                    <div class="signature">
                        <p>{{$data['name_CMT']}}</p>
                        <p>Relator</p>
                    </div>

                    
                </div>
            </div> 
            <div class="divBtn">
                <button class="btn btn-primary btnPrint" id="btnPrint">Imprimir</button>
                <!-- <button class="btn btn-success btnPfd" id="btnPdf">Gerar PDF</button> -->
                <!-- <a href="{{ route('generate.pdf') }}">Gerar pdf</a> -->
                <a href="{{ url('report/pdf') }}" class="btn btn-success btnCreatePDF" >Gerar pdf</a>
                <button class="btn btn-secondary" id="btnBack">Voltar</button>
            </div>
        </div>
    </div>
</div>



@endsection
