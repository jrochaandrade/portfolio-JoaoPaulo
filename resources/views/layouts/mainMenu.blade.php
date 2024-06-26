<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img id="logoIndex2" src="{{ asset('images/LogoDR3-100.jpg') }}" alt="">
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
            <!-- <li class="search-box" id="search-box">
                <i class="bi bi-search icon"></i>
                <form action="#" method="GET" id="formSearch" >
                    <input 
                    type="search" 
                    placeholder="Search..." 
                    class="searchData" 
                    id="searchData"
                    name="searchData"
                    value="{{ request()->query('searchData') }}">
                    <button type="submit" id="btnSearch" style="display: none;">Buscar</button>
                </form>
                <i class="bi bi-funnel filter" id="filter"></i>
            </li> -->
            <ul class="menu-links">
                <li class="nav-links">
                    <a href="{{ route('home.index') }}" class="link">   <!--{{ route('home.index') }}-->
                        <i class="bi bi-house icon"></i>
                        <span class="text nav-text">Portfolio</span>
                    </a>
                </li>
                <li class="nav-links">
                    <a href="{{ route('mapa.index') }}">
                        <i class="fa-regular fa-map icon"></i>
                        <span class="text nav-text">Mapa interativo</span>
                    </a>
                </li>
                <li class="nav-links">
                    <a href="{{ route('report.index') }}" class="link"> <!--{{ route('report.index') }}-->
                    <i class="fa-regular fa-images icon"></i>
                        <span class="text nav-text">Relatório Fotográfico</span>
                    </a>
                </li>
                <li class="nav-links">
                    <a href="{{ route('detailed') }}" class="link"> <!--{{ route('detailed') }}-->
                    <!-- <i class="fa-regular fa-address-card icon"></i> --> <!-- Cadastro infrator -->
                    <i class="fa-solid fa-file-lines icon"></i>
                    
                        <span class="text nav-text">Relatório Circunstanciado</span>
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
                @if (auth()->check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf 
                    <button class="btnLogoutHidden" type="submit" id="btnLogoutHidden"></button>
                </form>
                <a href="#" id="ancoraLogout" title="Sair">
                    <i class="bi bi-door-open icon"></i>
                    <span class="text nav-text">{{auth()->user()->name}}</span>                    
                </a>
                @else
                
                <a href="{{ route('login')}}" title="Entrar">
                    <i class="bi bi-door-open icon"></i>
                    <span class="text nav-text">Entrar</span>                    
                </a>
                @endif 
            </li>

            <li class="mode">
                <div class="moon-sun">
                    <i class="bi bi-moon icon moon"></i>
                    <i class="bi bi-sun icon sun"></i>
                </div>
                <span class="mode-text text">Dark Mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>
