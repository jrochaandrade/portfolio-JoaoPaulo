@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/report.css') }}">

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
    integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" crossorigin="anonymous">
</script>


<!-- <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script> -->


<!-- <script src="{{ asset('node_modules/exif-js/exif.js') }}" defer></script> -->
<script src="https://cdn.jsdelivr.net/npm/exif-js"></script>

<!-- <script src="{{ asset('js/reportScript.js') }}" defer type="module"></script> -->


@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <div class="card-header">
        <div class="titleHeader">
            <h1>Relatório Fotográfico</h1>
        </div>
    </div>
    <div class="text">
        <div class="container-fluid content">
            <h2>Carregar fotos</h2>
            <form action="{{ route('photos.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="operation">Nome da operação:</label>
                    <input type="text" class="form-control" name="operation" id="operation">
                    <label for="photos">Escolha as fotos:</label>
                    <input type="file" class="form-control" name="photos[]" id="photos" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Carregar fotos</button>
            </form>
            <table class="table-responsive table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Operação</th>
                            <th>Data de criação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (@$reports as $data )
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->operation }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <a href="{{ route('report.show', ['id'=>$data->id]) }}">
                                        <span class="fa-stack fa-sm">
                                            <i class="far fa-square fa-stack-2x"></i>
                                            <i class="fa-solid fa-eye fa-stack-1x"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
                <div class="d-flex justify-content-end pagination">
                    {{ $reports->links('pagination::bootstrap-5') }}
                </div>             
            </div>
            <div class="main" id="main">
                
            </div>
        </div>
    </div>
</div>

@endsection
