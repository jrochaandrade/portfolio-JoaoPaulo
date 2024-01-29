$(document).ready(function() {
    // Seu código aqui, incluindo a função drawnAllPolygons()




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

/* Script para desenha os poligonos no mapa de acordo com os poligono recebidos na variável $poligonos */
drawnAllPolygons()

function drawnAllPolygons() {
    const polygonToEmbargoId = {};
    for (const unique_id in polygons) {
        if (polygons.hasOwnProperty(unique_id)) {
            const arrayCoordinates = polygons[unique_id]

            const polygonCoord = arrayCoordinates.map(coordinates => ({
                lat: coordinates.latitude,
                lng: coordinates.longitude
            }));

            const polygon = L.polygon(polygonCoord, {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0,
                weight: 2
            });

            const polygonIdClicked = arrayCoordinates[0].id

            const polygonsOfData = findPoligons(polygonIdClicked)

            // Encontre o embargo com base no ID
            const polygonEmbargo = embargoes.find(embargo => embargo.id_polygon === polygonIdClicked);

            // Chame a função showPopup passando o polígono e os dados do embargo
            showPopup(polygon, polygonEmbargo);


            // Adicione o polígono ao mapa após chamar bindPopup
            polygon.addTo(map);

            polygon.on('click', () => {                
                //polygon.openPopup();
                drawnPolygon(polygonsOfData, polygonIdClicked)
            });

            polygonToEmbargoId[polygon.getBounds().toBBoxString()] = polygonIdClicked;
        }
    }
}
/* Script para desenha os poligonos no mapa de acordo com os poligono recebidos na variável $poligonos */



/* Início do script para centralizar o mapa e dar zoom nos polígonos filtrados */
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
/* Fim do script para centralizar o mapa e dar zoom nos polígonos filtrados */



/* Inicio do script para enviar formulário de exclusão e mostar mensagem */
window.deleteData = function(report_ID) {
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#FF0000',
        cancelButtonColor: '#007bff',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sim, exclua!'
    }).then((result) => {
        if(result.value) {
            var form = $('<form>', {
                'method': 'POST',
                'action': '/delete/' + report_ID,
            });
            
            var hiddenInput = $('<input>', {
                'name': '_method',
                'type': 'hidden',
                'value': 'DELETE',
            });
            
            var hiddenToken = $('<input>', {
                'name': '_token',
                'type': 'hidden',
                'value': jQuery('meta[name="csrf-token"]').attr('content'),
            });
            
            form.append(hiddenInput).append(hiddenToken).appendTo('body').submit();
        }
    });
}
/* Fim do script para enviar formulário de exclusão e mostar mensagem */


/* Inicio do script para mostrar poligono ao clicar no botão find da tabela */
// Evento click para buscar o poligono mapa
$(document).ready(function() {
    $(document).on('click', '#find', function () {
        const dataId = $(this).data('id')
        
        // Use o id para encontar os polígonos correspondentes na variavel $polygons
        const polygonsOfData = findPoligons(dataId)

        console.log('click', dataId, polygonsOfData)

        drawnPolygon(polygonsOfData, dataId)
        
    })
})

function findPoligons(dataId) {
    console.log('find', dataId, polygons)
    const polygonsOfData = {}

    // Interar sobre os arrays aninhados
    for (const id in polygons) {
        const polygonsArray = polygons[id]
        
        for (const polygon of polygonsArray) {
            if (polygon.id === dataId) {
                // Adicionar o campo 'uniqueId ao array de polígonos
                for (const polygonosofdataId of polygonsArray) {
                    polygonosofdataId.uniqueId = id
                }
                // Usar o id unico como chave e armazenar o array
                polygonsOfData[id] = polygonsArray
            }
        }
    }
    return polygonsOfData
}

function drawnPolygon (polygonsOfData, dataId) {
    // Limpe quaisquer polígonos existente no mapa
    /* map.eachLayer((layer) =>{
        if (layer instanceof L.Polygon) {
            map.removeLayer(layer)
        }
    }) */
    map.eachLayer((layer) =>{
        if (layer.options.className === 'dynamicPolygon') {
            map.removeLayer(layer)
        }
    })


    // Interar sobre os polígonos correspondente
    for (const id in polygonsOfData) {
        const polygonArray = polygonsOfData[id]

        // Criar um array de coordenadas para o polígono
        const polygonCoordinate = polygonArray.map((poly) => {
            return { lat:poly.latitude, lng: poly.longitude }
        })

        // Criar e add o polygono no mapa
        const polygon = L.polygon(polygonCoordinate, {
            color: 'orange',
                fillColor: '#f03',
                fillOpacity: 0,
                weight: 2,
                className: 'dynamicPolygon'
        })

        const polygonIdClicked = polygonArray[0].id

        const polygonsData = embargoes.find(embargo => embargo.id_polygon === polygonIdClicked)
        
        showPopup(polygon, polygonsData);
        
        
        
        polygon.addTo(map)
        
        polygon.on('click', () => {
            //adicionarLinhaDeEmbargo(idEmbargo); reconstruir tabela
            
            //const polygonsData = findPoligons(dataId)
            //console.log(dataId, polygonsData)
            //showPopup(polygon, dataId);
            polygon.openPopup();
        });



        // Aproximar o zoom no polígono
        map.fitBounds(polygon.getBounds(), { maxZoom: 15 })
    }
}

function showPopup(polygon, embargo) {
    if (embargo) {
        polygon.bindPopup(`
            Nome: ${embargo.name}<br>
            CPF: ${embargo.cpf}<br>
            Área: ${embargo.area}<br>
            Infração: ${embargo.type_infraction}
        `);
    }
}
/* Fim do script para mostrar poligono ao clicar no botão find da tabela */


/* Início do script para resertar o mapa */
document.getElementById('refreshMap').addEventListener('click', function () {    
    drawnAllPolygons()
})
/* Fim do script para resertar o mapa */


/* Início do script para mostrar coordenadas ao clicar no mapa */
// Função para converter graus decimais em graus, minutos e segundos
function decimalToDMS(decimal, isLatitude) {
    var degrees = Math.floor(Math.abs(decimal))
    var minutes = Math.floor((Math.abs(decimal) - degrees) * 60);
    var seconds = ((Math.abs(decimal) - degrees - (minutes / 60)) * 3600).toFixed(2)

    var direction = isLatitude ? (decimal >= 0 ? "N" : "S") : (decimal >= 0 ? "E" : "W")

    return degrees + "° " + minutes + "' " + seconds + "'' " + direction
}

var popup = L.popup()

function onMapClick(e) {
    var latDMS = decimalToDMS(e.latlng.lat, true) // true indica latitude
    var lngDMS = decimalToDMS(e.latlng.lng, false) // false indica longitude

    //Clicar no mapa e mostrar coordenadas
    popup
        .setLatLng(e.latlng)
        .setContent("" + latDMS + ', ' + " " + lngDMS)
        .openOn(map)
}

map.on('click', onMapClick)
/* Fim do script para mostrar coordenadas ao clicar no mapa */



});