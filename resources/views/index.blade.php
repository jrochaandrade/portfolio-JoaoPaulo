@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/homeStyle.css') }}">
@endsection

@section('card-body')



<div class="container-fluid">
    <div class="wrapper effect">
        <!-- Sidebar -->
        <aside id="sidebar" class="collapsed">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Página principal</a>
                </div>
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Ferramentas e componentes
                    </li>
                    <!-- <li class="sidebar-item">
                        <a href="" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Portfolio
                        </a>
                    </li> -->
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages" aria-expanded="false" aria-controls="pages">
                            <i class="fa-regular fa-file-lines pe-2"></i>
                            Projetos
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('mapa.index') }}" class="sidebar-link">
                                <i class="fa-regular fa-map pe-2"></i>
                                Mapa Interativo
                            </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                <i class="fa-regular fa-id-card pe-2"></i>
                                Registro de infratores
                            </a>
                            </li>
                            <!-- <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Crypto</a>
                            </li> -->
                        </ul>
                    </li>
                   <!--  <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
                            <i class="fa-solid fa-sliders pe-2"></i>
                            Dashboard
                        </a>
                        <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Dashboard Analystics</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Dashboard Ecommerce</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="fa-regular fa-user pe-2"></i>
                            Autenticação
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Sair</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Registrar</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="sidebar-header">
                        Multi Level Nav
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                            <i class="fa-solid fa-share-nodes pe-2"></i>
                            Multi Level
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                    Two Links
                                </a>
                                <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Link 1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Link 2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </aside>
        <!-- Main Component -->
        <div class="main">
            <nav class=" navbar navbar-expand px-3 border-bottom">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button" data-bs-theme="dark">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
            <main class="content px3 py-2">
                <div class="container">
                    <div class="mb-3">
                        <section>
                            <p><h2 class="fles aling-center">Desenvolvimento de Mapa Interativo</h2>

                                <!-- <h3>Introdução:</h3> -->

                                <p>
                                    Durante meu percurso como desenvolvedor, tive a oportunidade de trabalhar em um projeto empolgante que envolveu a criação de um mapa interativo altamente funcional. Esse mapa não apenas permitiu a visualização de informações geográficas, mas também ofereceu uma experiência envolvente e interativa para os usuários.
                                </p>

                                
                                <p>
                                    Desafio:
                                    O desafio central deste projeto foi transformar dados geográficos brutos em uma interface de usuário amigável e dinâmica. A principal meta era apresentar informações complexas de uma maneira acessível, ao mesmo tempo em que garantia uma experiência de usuário intuitiva e agradável.
                                </p>
                                <p>
                                    Tecnologias Utilizadas:
                                    Para alcançar esse objetivo, utilizei uma variedade de tecnologias e ferramentas, incluindo:
                                    <ul>
                                        <li  class="textList">QGIS: Usei o QGIS para processar e preparar os dados geográficos, bem como para criar camadas de mapas personalizadas.</li>
                                        <li class="textList">JavaScript: A linguagem de programação JavaScript foi a chave para a interatividade do mapa. Usei a biblioteca Leaflet.js para criar e personalizar o mapa.</li>
                                        <li class="textList">HTML/CSS: Utilizei HTML e CSS para criar a estrutura e o estilo da página web que abrigava o mapa interativo.</li>
                                        <li class="textList">Banco de Dados: Armazenei dados geográficos em um banco de dados, permitindo consultas e atualizações eficientes.</li>                                        
                                    </ul>
                                </p>
                                <p>
                                    Funcionalidades Principais:
                                    Visualização de Dados Geográficos: O mapa permitiu aos usuários visualizar dados geográficos detalhados, incluindo marcadores personalizados e camadas sobrepostas.
                                    Pesquisa Avançada: Implementei uma função de pesquisa avançada que permitiu aos usuários localizar rapidamente pontos de interesse no mapa.
                                    Interação com Marcadores: Os usuários podiam clicar em marcadores para obter informações adicionais, como descrições, imagens e links relacionados.
                                    Informações em Tempo Real: A integração de APIs proporcionou informações em tempo real, como condições meteorológicas locais, que eram exibidas diretamente no mapa.
                                </p>
                                <p>
                                    Resultados:
                                    O resultado final foi um mapa interativo que proporcionou aos usuários uma maneira fácil e envolvente de explorar informações geográficas. O projeto atendeu com sucesso aos objetivos, apresentando dados de forma clara e acessível.
                                    Conclusão:
                                    Este projeto foi um exemplo emocionante de como a tecnologia pode ser usada para simplificar dados complexos e criar uma experiência significativa para os usuários. O desenvolvimento do mapa interativo me permitiu aprimorar minhas habilidades em processamento de dados geoespaciais, programação web e integração de APIs. Estou ansioso para continuar explorando novos projetos que aproveitem o poder da tecnologia para criar soluções inovadoras.
                                </p>
                                
                        </section>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>


@endsection