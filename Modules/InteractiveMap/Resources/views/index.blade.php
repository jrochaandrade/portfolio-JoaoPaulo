@extends('layouts.masterPage')

@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<script src="{{ asset('js/scriptsInteractiveIndex.js') }}" defer></script>
@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">    
    <div class="card-header">
        <div class="titleHeader">
            <h1 class=header><strong>Mapa Interativo</strong></h1>
        </div>
        <div class="inputSend">
            <form action="{{ route('uploadKml') }}" method="POST" data-toggle="tooltip" data-placement="right"
                enctype="multipart/form-data" class="d-inline-block">
                @csrf
                <label for="kmlFile" class="btn btn-success d-inline-block"
                    title="Enviar os embargos no formato KML">
                    <i class="bi bi-plus-square"></i>
                    Enviar Embargo
                </label>
                <input type="file" name="kmlFile" id="kmlFile" style="display: none;">
                <!-- jogar o estilo para o css depois**-->
            </form>
        </div>
    </div>
    <div class="text">
        <div class="container-fluid content">
            <div class="">                
                <a href="{{ route('mapa.index') }}" class="btn btn-primary clearBtn">
                    <i class="bi bi-arrow-clockwise"></i>
                    Limpar filtros
                </a>
                <table class="table-responsive table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th>Área</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (@$polygonsData as $data)
                        <tr>
                            <td>{{ $data->id_polygon }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->cpf }}</td>
                            <td>{{ $data->address }}</td>
                            <td>{{ $data->city }}</td>
                            <td>{{ $data->area }}</td>

                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end pagination">
                    {{ $polygonsData->links('pagination::bootstrap-5') }}
                </div>
                <div class="containerMap">
                    <div id="map" class="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /* Script para criar mapa Leaflet */
    let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    })
    let google = L.tileLayer(' https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 19,
        attribution: '© google', 
    })

    let googleSatelite = L.tileLayer(' https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 19,
        attribution: '© google', 
    })

    let esriSatellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        maxZoom: 19,
        attribution: '© arcgisonline.com - Esri', 
    })

    let baseMaps = {
        "OpenStreetMap": osm,            
        "Google": google,
        "Google Satélite": googleSatelite,
        "ESRI Satélite": esriSatellite
    }

    // Carregar mapa
    let map = L.map('map', {
        center: [-10.93441238, -63.36372516],
        zoom: 7,
        layers: [google]
    })

    L.control.layers(baseMaps).addTo(map)
    /* Fim script para criar mapa Leaflet */
</script>
<script>
    // Converte a variável PHP em JavaScript
    let polygons = {!! json_encode($polygons) !!}
    let embargoes = {!! json_encode($embargoes) !!}
    
    // Desenha os poligonos no mapa de acordo com os poligono recebidos na variável $poligonos
    // A variável vem da função index, que chama a função searchCoordinates
    const polygonToEmbargoId = {}
    
    for (const uniqueId in polygons) {
        if (polygons.hasOwnProperty(uniqueId)) {
            const arrayCoordinates = polygons[uniqueId]

            const polygonCoord = arrayCoordinates.map(coordinates => ({
                lat: coordinates.latitude,
                lng: coordinates.longitude
            }))

            const polygon = L.polygon(polygonCoord, {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0,
                weight: 2
            }).addTo(map)

            polygon.on('click', () => {
                const polygonIdClicked = arrayCoordinates[0].id
                
                // Chamar função para refazer a tabela posteriormente
                // Encontre o embargo com Base no ID
                const polygonEmbargo = embargoes.find(embargo => embargo.id_polygon === polygonIdClicked)                
                
                if (polygonEmbargo) {
                    polygon.bindPopup(`
                    Nome: ${polygonEmbargo.name}<br>
                    CPF: ${polygonEmbargo.cpf}<br>
                    Área: ${polygonEmbargo.area}<br>
                    Infração: ${polygonEmbargo.type_infraction}
                    `)
                }
                
            })
            
            polygonToEmbargoId[polygon.getBounds().toBBoxString()] = arrayCoordinates[0].id
            
        }
    }
</script>
<script>
    /* Script para centralizar o mapa e dar zoom nos polígonos filtrados */
    let bounds = new L.LatLngBounds()

    // Intere sobre os polígonos e adicione suas coordenadas à extensão
    for (const uniqueId in polygons) {
        const arrayPolygons = polygons[uniqueId]

        for (const coordinate of arrayPolygons) {
            bounds.extend(new L.LatLng(coordinate.latitude, coordinate.longitude))
        }
    }

    // Centralizar o mapa na extensão dos polígonos
    map.setView(bounds.getCenter())

    // Ajuste o mapa para a extensão dos polígonos com um nível de zoom adequado
    map.fitBounds(bounds)

    // Defina um zoom máximo para evitar zoom excessivo
    const maxZoom = 15
    if (map.getZoom() > maxZoom) {
        map.setZoom(maxZoom)
    }
</script>
@endsection