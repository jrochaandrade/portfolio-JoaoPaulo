<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CDN Fontawesome -->
    <script src="https://kit.fontawesome.com/01c550dd36.js" crossorigin="anonymous"></script>
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- CDN Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Alerta -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    
    <!-- Stilos Mapa Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <!-- Scripts Mapa Leaflet -->
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <!-- Adicionar estilos -->
    <link rel="stylesheet" href="{{ asset('css/styleDefault.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}"> -->
    <title>@yield('title', 'Portifólio DevRocha')</title>
    @yield('card-head')
</head>


<body id="" class="light">
    <section class="">
        <div class="card">            
            <!-- Card Body -->
            <div class="card-body" id="">                    
                @yield('card-body')
                <!-- Card Footer -->
                <div class="card-footer">
                    <p>&copy; 2024 Criado por <a href="https://github.com/jrochaandrade" target="_blank">DevRocha</a></p>
                </div>
            </div>

        </div>
    </section>
     
    <!-- Scripts para o Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    
</body>

</html>