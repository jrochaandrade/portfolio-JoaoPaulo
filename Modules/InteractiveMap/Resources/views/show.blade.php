@extends('layouts.masterPage')
@section('card-head')
<link rel="stylesheet" href="{{ asset('css/secondarySidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/interactiveMap/interactiveMapShow.css') }}">
@endsection

@section('card-body')
@include('layouts.mainMenu')

<div class="home">
    <div class="card-header">
        <div class="titleHeader">
            <h1 class="header"><strong>Detalhes do embargo</strong></h1>
            <div>
                <a href="{{ route('mapa.download', ['id'=>$data->id_polygon]) }}" class="btn btn-success" id="btnDownload"><i class="fa-solid fa-download"></i>  Baixar KML</a>
                <a href="{{ route('mapa.edit', ['id'=>$data->id_polygon]) }}" class="btn btn-warning" id="btnEdit"><i class="fa-solid fa-pen-to-square"></i>  Editar</a>
            </div>
        </div>
    </div>
    <div class="text">
        <div class="containe-fluid content">
            <div class="separateDivs">
                <div class="details">
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Carta imagem:</span>
                            {{ $data->id_register }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Nome:</span>
                            {{ $data->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">CPF:</span>
                            {{ $data->cpf }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Endereço:</span>
                            {{ $data->address }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Cidade:</span>
                            {{ $data->city }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Área do dano:</span>
                            {{ $data->area }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Auto de infração:</span>
                            {{ $data->infraction_notice }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Tipificação Adm.:</span>
                            {{ $data->decree }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Termo de Embargo:</span>
                            {{ $data->embargo }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Ocorrência:</span>
                            {{ $data->ocurrence }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Tipificação Criminal:</span>
                            {{ $data->law }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Tipo de infração:</span>
                            {{ $data->type_infraction }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Data:</span>
                            {{ $data->date }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Equipe:</span>
                            {{ $data->team }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="title">Centroide:</span>
                            {{ $data->centroid }}
                        </div>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa-solid fa-left-long"></i>  Voltar</a>
                </div>
                <div class="containerMap">
                    <div class="map" id="map"></div>
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
        layers: [googleSatelite]
    })

    L.control.layers(baseMaps).addTo(map)
    /* Fim script para criar mapa Leaflet */
</script>

<script>
    /* Inicio do script para mostrar os poligonos no mapa */
    let polygons = {!! json_encode($polygons) !!}
    let data = {!! json_encode($data) !!}

    console.log(polygons)

    // Desenhar os poligonos no mapa de acordo com os dados recebidos na variavel polygons
    const polygonToDataId = {}

    for (const uniqueId in polygons) {
        if (polygons.hasOwnProperty(uniqueId)) {
            const arrayCoordinates = polygons[uniqueId]

            console.log('coor', arrayCoordinates)

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


            polygonToDataId[polygon.getBounds().toBBoxString()] = arrayCoordinates[0].id
        }
    }

    /* Fim do script para mostar os poligonos no mapa */
</script>

<script>
    /* Inicio do script para centralizar o mapa no poligono */
    let bounds = new L.LatLngBounds()

    // Intera sobre os poligonos e adciona as suas coordenadas à extensão
    for (const uniqueId in polygons) {
        const arrayPolygons = polygons[uniqueId]

        for (const coordinate of arrayPolygons) {
            bounds.extend(new L.LatLng(coordinate.latitude, coordinate.longitude))
        }
    }

    // Centralizar o mapa na extensaão dos poligonos
    map.setView(bounds.getCenter())

    // Ajusta o mapa para a extensão dos poligonso com um nível de zoom adequado
    map.fitBounds(bounds)

    // Define um zoom máximo para evitar zoom excessivo 
    const maxZoom = 15
    if (map.getZoom() > maxZoom) {
        map.setZoom(maxZoom)
    }
    
    /* Fim do script para centralizar o mapa no poligono */
</script>


@endsection