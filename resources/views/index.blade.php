@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/index/sidebarHome.css') }}">
<script src="{{ asset('js/index/scriptsIndex.js') }}" defer></script>
@endsection

@section('card-body')
@include('layouts.mainMenu')
<div class="home">
    <div class="text">
        <div class="container-fluid content">
            <div class="headerIndex">
                <span class="">
                    <img id="logoIndex" src="{{ asset('images/LogoDR3-100.jpg') }}" alt="">
                </span>
                <div class="links">
                    <a href="#">Meus projetos</a>
                    <a href="#">Sobre mim</a>
                    <a href="#">Contato</a>
                </div>
            </div>
            <div class="divMain container-fluid">
                <h2>testando</h2>
                <p>Durante meu percurso como desenvolvedor, tive a oportunidade de trabalhar em um projeto empolgante que envolveu a criação de um mapa interativo altamente funcional. Esse mapa não apenas permitiu a visualização de informações geográficas, mas também ofereceu uma experiência envolvente e interativa para os usuários.</p>

                
                <h3>Desafio:</h3>
                <p>
                    O desafio central deste projeto foi transformar dados geográficos brutos em uma interface de usuário amigável e dinâmica. A principal meta era apresentar informações complexas de uma maneira acessível, ao mesmo tempo em que garantia uma experiência de usuário intuitiva e agradável.
                </p>
                <h3>Tecnologias Utilizadas:</h3>
                <p>Para alcançar esse objetivo, utilizei uma variedade de tecnologias e ferramentas, incluindo:</p>
                <p>
                    <ul>
                        <li  class="textList">QGIS: Usei o QGIS para processar e preparar os dados geográficos, bem como para criar camadas de mapas personalizadas.</li>
                        <li class="textList">HTML/CSS: Utilizei HTML e CSS para criar a estrutura e o estilo da página web que abrigava o mapa interativo.</li>
                        <li class="textList">JavaScript: A linguagem de programação JavaScript foi a chave para a interatividade do mapa. Usei a biblioteca Leaflet.js para criar e personalizar o mapa.</li>
                        <li class="textList">PHP: A linguagem de programação PHP foi utilizada no FrontEnd, alimentando e realizando consultas no banco de dados.</li>
                        <li class="textList">Banco de Dados: Armazenei dados geográficos em um banco de dados, permitindo consultas e atualizações eficientes.</li>                                        
                    </ul>
                </p>

                <h3>Funcionalidades Principais:</h3>
                <p>Visualização de Dados Geográficos: O mapa permitiu aos usuários visualizar dados geográficos detalhados, incluindo marcadores personalizados e camadas sobrepostas.</p>
                <p>Pesquisa Avançada: Implementei uma função de pesquisa avançada que permitiu aos usuários localizar rapidamente pontos de interesse no mapa.</p>
                <p>Interação com Marcadores: Os usuários podiam clicar em marcadores para obter informações adicionais, como descrições, imagens e links relacionados.</p>
                <p>Informações em Tempo Real: A integração de APIs proporcionou informações em tempo real, como condições meteorológicas locais, que eram exibidas diretamente no mapa.</p>

                <h3>Resultados:</h3>
                <p>O resultado final foi um mapa interativo que proporcionou aos usuários uma maneira fácil e envolvente de explorar informações geográficas. O projeto atendeu com sucesso aos objetivos, apresentando dados de forma clara e acessível.</p>

                <h3>Conclusão:</h3>
                <p>Este projeto foi um exemplo emocionante de como a tecnologia pode ser usada para simplificar dados complexos e criar uma experiência significativa para os usuários. O desenvolvimento do mapa interativo me permitiu aprimorar minhas habilidades em processamento de dados geoespaciais, programação web e integração de APIs. Estou ansioso para continuar explorando novos projetos que aproveitem o poder da tecnologia para criar soluções inovadoras.</p>
            </div>
        </div>
    </div>
</div>
@endsection
