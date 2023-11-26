const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar"),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwtich = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

    window.addEventListener("resize", checkWindowSize);

// Evento click botão fechar ou abrir sidebar
toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});



/* Scrit  para fechar sidebar quando tela for menor que 768 */
function checkWindowSize() {
    console.log("Função checkWindowSize está sendo executada.");
    if (window.innerWidth <= 768) {
        if (!sidebar.classList.contains("close")) {
            closeSidebar();
        }
    } else {
        if (!sidebar.classList.contains("close")) {
            openSidebar();
        }
        
    }
}
// Função para fechar o sidebar
function closeSidebar() {
    sidebar.classList.add("close");
}
// Função para abrir o sidebar
function openSidebar() {
    sidebar.classList.remove("close");
}
/* Fim script para fechar sidebar quando a tela for menor que 768 */



// Feche o sidebar quando a página for carregada pela primeira vez
closeSidebar();



/* Script para mudar o tema */
modeSwtich.addEventListener("click", function () {

    document.body.classList.toggle('dark')
    document.body.classList.toggle('light')
    
    //body.classList.toggle("dark");
    const currentTheme = body.classList.contains('dark') ? 'dark' : 'light';
    localStorage.setItem('theme', currentTheme);
    
    if(body.classList.contains("dark")){
        modeText.innerText = "Light Mode"
    }else{
        modeText.innerText = "Dark Mode"
    }
});

/* Fim do script para mudar o tema */


    
/* Script para manter o tema */
// Função para verificar e aplicar o tema salvo no armazenamento local
function applySavedTheme() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        body.classList.add('dark');
    } else {
        body.classList.add('light');
    }
}
applySavedTheme()
/* Fim script para manter o tema */


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
