@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/index/sidebarHome.css') }}">
<link rel="stylesheet" href="{{ asset('css/index/index.css') }}">
<script src="{{ asset('js/index/scriptsIndex.js') }}" defer></script>
@endsection

@section('card-body')
@include('layouts.mainMenu')
<div class="home">
    <div class="text">
        <div class="container-fluid content">
            <div class="headerIndex" id="headerIndex">
                <span class="">
                    <img id="logoIndex" src="{{ asset('images/LogoDR3-100.jpg') }}" alt="">
                </span>
                <div class="links">
                    <i class="bi bi-sun icon sun" id="sun"></i>
                    <i class="bi bi-moon icon moon" id="moon"></i>
                    <a href="#"><i class="bi bi-list btnMenu bi-3x"></i></i></a>

                </div>
            </div>
            <div class="divMain container">
                <section class="divImageMain">
                    <div class="row">
                        <div class="imageMain col-sm-6">
                            <img src="{{ asset('images/Foto-Jp-SF.png')}}" alt="">
                        </div>
                        <div class="textMain col-sm-6">
                            <h3>João Paulo da Rocha Andrade</h3>
                            <p>Formado em Análise e Desenvolvimento de Sistemas e cursando Engenharia de Software.
                                Apaixonado por tecnologia, tenho experiência em HTML, CSS, JavaScript, PHP (Laravel) e
                                SQL. Estou sempre buscando novas tecnologias e aprimorando minhas habilidades para
                                desenvolver soluções inovadoras e eficientes.</p>
                        </div>
                    </div>
                </section>
                <section class="sectionProject1">
                    <h3>Mapa interativo</h3>
                    <div class="divProjectsMain1 row">
                        <div class="divImageProject1 col-sm-7" id="divImageProject1">
                            <img src="{{ asset('images/Mapa2.png') }}" alt="">
                        </div>
                        <div class="divTextProject1 col-sm-5">
                            <p>Desenvolvi um sistema de mapa interativo em Laravel para gerenciar e visualizar dados
                                geoespaciais de embargos. A aplicação permite o upload de arquivos KML, extrai os dados
                                e coordenadas, e salva todas as informações no banco de dados. Os dados são exibidos em
                                um mapa interativo e é possível realizar busca, filtragem, CRUD de embargos, e download
                                dos dados em KML. A interface é intuitiva e responsiva, facilitando a navegação e
                                manipulação dos dados geoespaciais.</p>
                        </div>
                    </div>
                </section>
                <section class="sectionProject2">
                    <h3>Mapa interativo</h3>
                    <div class="divProjectsMain2 row">
                        <div class="divTextProject2 col-sm-5">
                            <p>Desenvolvi um sistema de mapa interativo em Laravel para gerenciar e visualizar dados
                                geoespaciais de embargos. A aplicação permite o upload de arquivos KML, extrai os dados
                                e coordenadas, e salva todas as informações no banco de dados. Os dados são exibidos em
                                um mapa interativo e é possível realizar busca, filtragem, CRUD de embargos, e download
                                dos dados em KML. A interface é intuitiva e responsiva, facilitando a navegação e
                                manipulação dos dados geoespaciais.</p>
                        </div>
                        <div class="divImageProject2 col-sm-7" id="divImageProject2">
                            <img src="{{ asset('images/Mapa2.png') }}" alt="">
                        </div>
                    </div>
                </section>

                <section class="sectionProject1">
                    <h3>Mapa interativo</h3>
                    <div class="divProjectsMain1 row">
                        <div class="divImageProject1 col-sm-7" id="divImageProject2">
                            <img src="{{ asset('images/Mapa2.png') }}" alt="">
                        </div>
                        <div class="divTextProject1 col-sm-5">
                            <p>Desenvolvi um sistema de mapa interativo em Laravel para gerenciar e visualizar dados
                                geoespaciais de embargos. A aplicação permite o upload de arquivos KML, extrai os dados
                                e coordenadas, e salva todas as informações no banco de dados. Os dados são exibidos em
                                um mapa interativo e é possível realizar busca, filtragem, CRUD de embargos, e download
                                dos dados em KML. A interface é intuitiva e responsiva, facilitando a navegação e
                                manipulação dos dados geoespaciais.</p>
                        </div>
                        
                    </div>
                </section>








            </div>
        </div>
    </div>
</div>
@endsection
