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
    
    <!-- CDN Data Table -->
    <!-- <link rel="stylesheet" href="http://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
    <!-- Adicionar estilos -->
    <!-- <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}"> -->
    <title>Meu portfolio</title>
    @yield('card-head')
</head>

<body>

    @yield('card-body')
    <!-- Scripts para o Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <!-- Jquery e script para personalizar da paginação do datatable -->
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <!-- Script Data Table -->
    <script src="http://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- <script>
        let table = new DataTable('#dataTable');
    </script> -->       
</body>

</html>