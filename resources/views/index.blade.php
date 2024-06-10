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
                <section class="sectionProject1 hidden">
                    <h3>Mapa interativo</h3>
                    <div class="divProjectsMain1 row">
                        <div class="divImageProject1 col-sm-8">
                            <div class="slider" id="slider">
                                <div class="slides" id="slides">
                                    <input type="radio" name="radioBtn" id="radio1">
                                    <input type="radio" name="radioBtn" id="radio2">
                                    <input type="radio" name="radioBtn" id="radio3">
                                    <input type="radio" name="radioBtn" id="radio4">

                                    <div class="slide first">
                                        <img class="projectImage1" src="{{ asset('images/Mapa1.png') }}" alt="" loading="lazy">
                                    </div>
                                    <div class="slide"> 
                                        <img class="projectImage1" src="{{ asset('images/Mapa2.png') }}" alt="" loading="lazy">
                                    </div>
                                    <div class="slide">
                                        <img class="projectImage1" src="{{ asset('images/Mapa3.png') }}" alt="" loading="lazy">
                                    </div>
                                    <div class="slide">
                                        <img class="projectImage1" src="{{ asset('images/Mapa4.png') }}" alt="" loading="lazy">
                                    </div>

                                    <div class="navigationAuto">
                                        <div class="autoBtn1"></div>
                                        <div class="autoBtn2"></div>
                                        <div class="autoBtn3"></div>
                                        <div class="autoBtn4"></div>
                                    </div>
                                </div>

                                <div class="manualNavigation">
                                    <label for="radio1" class="manualBtn"></label>
                                    <label for="radio2" class="manualBtn"></label>
                                    <label for="radio3" class="manualBtn"></label>
                                    <label for="radio4" class="manualBtn"></label>
                                </div>

                            </div>
                        </div>
                        <div class="divTextProject1 col-sm-4">
                            <p>Desenvolvi um sistema de mapa interativo em Laravel para gerenciar e visualizar dados
                                geoespaciais de embargos. A aplicação permite o upload de arquivos KML, extrai os dados
                                e coordenadas, e salva todas as informações no banco de dados. Os dados são exibidos em
                                um mapa interativo e é possível realizar busca, filtragem, CRUD de embargos, e download
                                dos dados em KML. A interface é intuitiva e responsiva, facilitando a navegação e
                                manipulação dos dados geoespaciais.</p>
                        </div>
                    </div>
                </section>
                <section class="sectionProject2 hidden">
                    <h3>Mapa interativo</h3>
                    <div class="divProjectsMain2 row">
                        <div class="divTextProject2 col-sm-4">
                            <p>Desenvolvi um sistema de mapa interativo em Laravel para gerenciar e visualizar dados
                                geoespaciais de embargos. A aplicação permite o upload de arquivos KML, extrai os dados
                                e coordenadas, e salva todas as informações no banco de dados. Os dados são exibidos em
                                um mapa interativo e é possível realizar busca, filtragem, CRUD de embargos, e download
                                dos dados em KML. A interface é intuitiva e responsiva, facilitando a navegação e
                                manipulação dos dados geoespaciais.</p>
                        </div>
                        <div class="divImageProject2 col-sm-8">
                            <!-- <img class="projectImage1" src="{{ asset('images/Mapa2.png') }}" alt=""> -->
                            <div class="slider" id="slider">
                                <div class="slides" id="slides">
                                    <input type="radio" name="radioBtn2" id="radio2-1">
                                    <input type="radio" name="radioBtn2" id="radio2-2">
                                    <input type="radio" name="radioBtn2" id="radio2-3">
                                    <input type="radio" name="radioBtn2" id="radio2-4">

                                    <div class="slide first">
                                        <img class="projectImage1" src="{{ asset('images/Mapa1.png') }}" alt="" loading="lazy">
                                    </div>
                                    <div class="slide">
                                        <img class="projectImage1" src="{{ asset('images/Mapa2.png') }}" alt="" loading="lazy">
                                    </div>
                                    <div class="slide">
                                        <img class="projectImage1" src="{{ asset('images/Mapa3.png') }}" alt="" loading="lazy">
                                    </div>
                                    <div class="slide">
                                        <img class="projectImage1" src="{{ asset('images/Mapa4.png') }}" alt="" loading="lazy">
                                    </div>

                                    <div class="navigationAuto">
                                        <div class="autoBtn1"></div>
                                        <div class="autoBtn2"></div>
                                        <div class="autoBtn3"></div>
                                        <div class="autoBtn4"></div>
                                    </div>
                                </div>

                                <div class="manualNavigation">
                                    <label for="radio2-1" class="manualBtn"></label>
                                    <label for="radio2-2" class="manualBtn"></label>
                                    <label for="radio2-3" class="manualBtn"></label>
                                    <label for="radio2-4" class="manualBtn"></label>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection