@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/mapStyle.css') }}">
@endsection

@section('card-body')



<div class="container-fluid">
    <div class="wrapper effect">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Mapa Interativo</a>
                </div>
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Ferramentas e componentes
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('home.index') }}" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Portfolio
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages" aria-expanded="false" aria-controls="pages">
                            <i class="fa-regular fa-file-lines pe-2"></i>
                            Projetos
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <!-- <li class="sidebar-item">
                                <a href="#" class="sidebar-link">
                                <i class="fa-regular fa-map pe-2"></i>
                                Mapa Interativo
                            </a>
                            </li> -->
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
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="fa-regular fa-user pe-2"></i>
                            Autenticação
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Login</a>
                            </li>
                           <!--  <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Registrar</a>
                            </li> -->
                        </ul>
                    </li>
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
                <div class="container-fluid">
                    <div class="mb-3">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Distinctio veritatis nihil et, harum consequuntur ex perferendis modi voluptatem, doloremque voluptas eveniet? Distinctio laudantium velit pariatur non temporibus repudiandae molestias perspiciatis!</p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>


@endsection