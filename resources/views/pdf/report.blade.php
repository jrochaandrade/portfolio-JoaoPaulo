<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/01c550dd36.js" crossorigin="anonymous"></script>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CDN Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/styleDefault.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/detailedReport.css') }}"> -->
    <link rel="stylesheet" href="{{ public_path('css/detailedReport.css') }}">

    <title>PDF</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
            font-size: 15px;    
        }

        p {
            text-align: justify;
            line-height: 1.5;
        }

        /* .titleHeader {
            display: flex;
            justify-content: center;
        } */

        .content {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;    
        }

        .main {
            width: 884px;
            background-color: white;
            color: black;
            
            padding: 31px;
            height: 100%;
        }

        .header {
            height: 138px;
            padding: 5px;
            margin-bottom: 30px;
        }

        .logos {
            display: flex;
            justify-content: space-between;
            width: 100%;    
            padding: 10px 20px;
            height: 117px; 
        }

        .logos span {
            font-size: 15px;
            font-weight: 600;
            text-align: center;
            
        }

        .logos .logo1 {
            height: 80px;
            width: 167px;
        }

        .logos .logo2 {
            height: 72px;
            width: 70px;
            /* margin-right: 5px; */
        }

        .logos .logo3 {
            height: 72px;
            width: 70px;
            /* margin-right: 5px; */
        }

        .titleBody {
            display: flex;    
            flex-direction: column;    
            align-items: center;
            margin-bottom: 20px;
        }

        .titleBody p {
            margin-bottom: 5px;
        }

        .divDocs {
            margin-bottom: 20px;
        }

        .divDocs p {
            margin-bottom: 5px;
        }

        .dataOffender {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tableDataOffender {
            font-size: 5px;
            width: 700px;    
        }

        .tableDataOffender th, .tableDataOffender td {
            padding: 1px; /* Adapte conforme necessário para ajustar a altura das células */
            /* font-size: 13px; */
            height: 5px;
        }

        .cell{
            width: 168px;
        }

        .titles {
            font-size: 16px;
            font-weight: 600;
        }

        .titles2 {
            font-size: 15px;
            font-weight: 600;
        }

        .historic {
            white-space: pre-line;
            text-align: justify;
            line-height: 1.5;
        }

        .images {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .images img {
            width: 500px;
            height: 290px;
            margin-bottom: 10px;
            border: 1px solid black;
        }

        .team {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tableTeam {
            font-size: 5px;
            width: 100%;
            margin-bottom: 80px; 
        }

        .tableTeam th, .tableTeam td {
            padding: 1px;
            white-space: nowrap;
            padding: 0px 10px 0px 10px;    
        }

        .signature {
            display: flex;
            justify-content: center;
            text-align: center;
            flex-direction: column;
            align-items: center;
        }

        .signature p {
            margin: 0px;
        }

        .divBtn {
            display: flex;
            flex-direction: row;
        }

        .divBtn .btnPrint {
            margin-right: 5px;
        }
        

        
        @page {
            margin: 20px; 
        }
           
        
       
        
    </style>
</head>
<body>
    <div class="home">
        <!-- <div class="card-header">
            <div class="titleHeader">
                <h1>Relatório Circunstanciado</h1>
            </div>
        </div>  -->   
        <div class="text">
            <div class="container-fluid content" id="content">            
                
                <div class="main" id="main" style="width: 740px; padding: 31px; height: 100%;">                
                    <div class="header" style="height: 138px; padding: 5px; margin-bottom: 30px;">
                        <div class="logos" style="display: flex; justify-content: space-between; width: 100%; padding: 10px 20px; height: 300px;" >
                            <div style="float: left; margin-right: 10px;">
                                <img src="data:image/jpeg;base64,{{$data['logo1']}}" alt="" style="height: 80px; width: 167px;">
                            </div>
                            <div style="float: left; margin-right: 10px;">
                                <p style="text-align: center; font-weight: 600;">Secretaria de Estado da Segurança, Defesa e Cidadania<br>Polícia Militar do estado de Rondônia<br>Batalhão de Polícia Ambiental<br>3ª Companhia de Polícia Ambiental<br>Seção de Planejamento Operacional</p>
                            </div>
                            <div style="float: left; margin-right: 10px;"><img src="data:image/jpeg;base64,{{$data['logo2']}}" alt="" style="height: 72px; width: 70px;"></div>
                            <div style="float: left; margin-right: 10px;"><img src="data:image/jpeg;base64,{{$data['logo3']}}" alt="" style="height: 72px; width: 70px;"></div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="titleBody" style="text-align: center;">
                            <p style="text-align: center;">Relatório Circunstanciado</p>
                            <p style="text-align: center;">Auto de infração ambiental II - <strong>Nº {{$data['inputAI']}}</strong></p>
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
                        <div class="dataOffender" style="margin-bottom: 20px;">
                            <table class="table table-bordered tableDataOffender" style="margin-left:20px; font-size: 5px; width: 700px; border: 1px solid gray; border-collapse: collapse;" >
                                <tr>
                                    <th colspan="2" style="border-bottom: 1px solid gray">Dados do Envolvido</th>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray; text-align: left;">Nome</th>
                                    <td style="border: 1px solid gray;">{{$data['name']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray; text-align: left;">CPF</th>
                                    <td style="border: 1px solid gray;">{{$data['cpf']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray; text-align: left;">RG</th>
                                    <td style="border: 1px solid gray;">{{$data['rg']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray; text-align: left;">Telefone</th>
                                    <td style="border: 1px solid gray;">{{$data['phone']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray; text-align: left;">Data de nascimento</th>
                                    <td style="border: 1px solid gray;">{{$data['birthday']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray; text-align: left;">FiliaçãoF</th>
                                    <td style="border: 1px solid gray;">{{$data['affiliation']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray; text-align: left;">Endereço</th>
                                    <td style="border: 1px solid gray;">{{$data['address']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray; text-align: left;">Local do fato</th>
                                    <td style="border: 1px solid gray;">{{$data['location']}}</td>
                                </tr>
                            </table>
                        </div>

                        

                        <div class="historic" style="margin: 10px;text-align: justify; line-height: 1.5; margin-bottom: 30px;">
                            <p class="titles">1. Dos fatos</p>
                            @foreach ($data['historic'] as $historic)
                                <p style="text-indent: 3em;">{{$historic}}</p>
                            @endforeach
                        </div>

                        <div class="images" style="text-align: center;">
                        <img src="data:image/jpeg;base64,{{$data['image1']}}" alt="" style="text-align: center;">
                        <img src="data:image/jpeg;base64,{{$data['image2']}}" alt="">
                        <img src="data:image/jpeg;base64,{{$data['image3']}}" alt="">
                        <img src="data:image/jpeg;base64,{{$data['image4']}}" alt="">
                        </div>

                        <div class="reasons" style="margin: 10px;">
                            <p class="titles">2. Dos Motivos apresentado pelo envolvido</p>
                            <p style="margin: 10px; text-indent: 3em;">{{$data['motive']}}</p>
                        </div>

                        <div class="mitigatingAndAggravating" style="margin: 10px;">
                            <p class="titles">3. Das atenuantes e agravantes</p>
                            <div class="mitigating">
                                <p class="titles2" style="text-indent: 1em;">3.1 Das atenuantes</p>
                                @foreach ($data['mitigating'] as $mitigating)
                                    <p style="margin: 10px; text-indent: 3em;">{{$mitigating}}</p>
                                @endforeach
                            </div>
                            <div class="aggravating">
                                <p class="titles2" style="text-indent: 1em;">3.2 Das agravantes</p>
                                @foreach ($data['aggravating'] as $aggravating)
                                    <p style="margin: 10px; text-indent: 3em;">{{$aggravating}}</p>
                                @endforeach
                            </div>

                        </div>
                        <div class="administrativeAndCriminal" style="margin: 10px;">
                            <p class="titles">4. Das medidas administrativas e criminais</p>
                            <p style="margin: 10px; text-indent: 3em;">Isto posto, foram necessárias medidas administrativas e criminais que se seguem.</p>
                            <div class="administrative">
                                <p class="titles2" style="text-indent: 1em;">4.1 Das medidas administrativas</p>
                                <p style="margin: 10px; text-indent: 3em;">Como medidas adminstrativas foram lavrados:</p>
                                <p style="margin: 10px; text-indent: 3em;">Auto de infração II Nº <strong>{{$data['inputAI']}}</strong> na importância de R${{$data['valueAI']}}, por
                                {!!$data['administrative']!!}</p>

                                <p style="margin: 10px; text-indent: 3em;">{!!$data['textEmbargo']!!}</p>
                            </div>
                            <div class="criminal">
                                <p class="titles2" style="text-indent: 1em;">4.2 Das medidas criminais</p>
                                <p style="margin: 10px; text-indent: 3em;">Dessa forma, a conduta do infrator implicou, em tese, no crime previsto no {{$data['articleBO']}} da Lei Federal nº 9.605 de 12 de Fevereiro de 1998, in verbis:</p>
                                <p style="margin: 10px; text-indent: 3em;">Portanto, foi confeccionado o {{$data['typeBO']}} Nº <strong>{{$data['inputBO']}}</strong> em desfavor de {{$data['name']}}.</p>
                            </div>
                        </div>                        

                        <div class="team">
                            <table class="table table-bordered tableTeam" style="margin-left: 20px; margin-top: 30px; margin-bottom: 100px; font-size: 5px; width: 700px; border: 1px solid gray; border-collapse: collapse;" >
                                <tr>
                                    <th colspan="2" class="text-center" style="border: 1px solid gray">Componentes da equipe</th>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray;">{{$data['cmt']}}</th>
                                    <td style="border: 1px solid gray;">{{$data['unitCmt']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray;">{{$data['mot']}}</th>
                                    <td style="border: 1px solid gray;">{{$data['unitMot']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray;">{{$data['ptr1']}}</th>
                                    <td style="border: 1px solid gray;">{{$data['unitPtr1']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray;">{{$data['ptr2']}}</th>
                                    <td style="border: 1px solid gray;">{{$data['unitPtr2']}}</td>
                                </tr>
                                <tr>
                                    <th class="cell" style="border: 1px solid gray;">{{$data['ptr3']}}</th>
                                    <td style="border: 1px solid gray;">{{$data['unitPtr3']}}</td>
                                </tr>                            
                            </table>
                        </div>

                        <div class="signature">
                            <p style="text-align: center;">{{$data['cmt']}}</p>
                            <p style="text-align: center;">Relator</p>
                        </div>

                        
                    </div>
                </div> 
                
            </div>
        </div>
    </div>
</body>
</html>