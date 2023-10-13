@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
@endsection


@section('card-body')
<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="{{ asset('images/LogoDR3-100.jpg') }}" alt="">
            </span>

            <div class="text header-text">
                <span class="name">Dev Rocha</span>
                <span class="profession">Desenvolvedor Web</span>
            </div>
        </div>

        <i class="fa-solid fa-chevron-right toggle"></i>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <li class="search-box">
                <i class="bi bi-search icon"></i>
                <input type="search" placeholder="Search...">
            </li>
            <ul class="menu-links">
                <li class="nav-links">
                    <a href="{{ route('home.index') }}">
                        <i class="bi bi-house icon"></i>
                        <span class="text nav-text">Portfolio</span>
                    </a>
                </li>
                <li class="nav-links">
                    <a href="#">
                        <i class="fa-regular fa-map icon"></i>
                        <span class="text nav-text">Mapa interativo</span>
                    </a>
                </li>
                <li class="nav-links">
                    <a href="#">
                        <i class="fa-regular fa-address-card icon"></i>
                        <span class="text nav-text">Cadastro de infratores</span>
                    </a>
                </li>
                <li class="nav-links">
                    <a href="#">
                        <i class="bi bi-hourglass-split icon"></i>
                        <span class="text nav-text">Em breve</span>
                    </a>
                </li>
                <li class="nav-links">
                    <a href="#">
                        <i class="bi bi-hourglass-split icon"></i>
                        <span class="text nav-text">Em breve</span>
                    </a>
                </li>  
                <li class="nav-links">
                    <a href="#">
                        <i class="bi bi-hourglass-split icon"></i>
                        <span class="text nav-text">Em breve</span>
                    </a>
                </li> 
                                               
            </ul>
        </div>
        <div class="bottom-content">
            <li class="">
                <a href="#">
                    <i class="bi bi-door-open icon"></i>
                    <span class="text nav-text">Logout</span>
                </a>
            </li>

            <li class="mode">
                <div class="moon-sun">
                    <i class="bi bi-moon icon moon"></i>
                    <i class="bi bi-sun icon sun"></i>
                </div>
                <span class="mode-text text">Dark Mode</span>

                <div class="toggle-switch">
                    <span class="switch">
                        
                    </span>
                </div>
            </li>
        </div>
    </div>
</nav>

<div class="home">
    <div class="text">
        <div class="container-fluid content">
            <div>
                <h1>Projeto Mapa interativo</h1>
                <form action="{{ route('uploadKml') }}" method="POST" data-toggle="tooltip" data-placement="right" enctype="multipart/form-data" class="d-inline-block">
                    @csrf
                    <label for="kmlFile" class="btn btn-success d-inline-block" title="Enviar os embargos no formato KML">
                        <i class="bi bi-plus-square"></i>
                        Enviar Embargo
                    </label>
                    <input type="file" name="kmlFile" id="kmlFile" style="display: none;"> <!-- jogar o estilo para o css depois -->
                </form>
            </div>
        </div>             
    </div>
</div>

<script>
    // Adicionar um ouvinte de evento para o input de arquivo
    document.getElementById('kmlFile').addEventListener('change', function () {
        // Envie o formulário quando um arquivo for selecionado
        this.closest('form').submit();
    });
</script>

<!-- <script src="{{asset('js/script.js')}}"></script> -->
@endsection
