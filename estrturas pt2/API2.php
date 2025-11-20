<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mapa Completo com Leaflet</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>

    <!-- Leaflet Routing Machine CSS (para rotas) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css"/>

    <!-- Leaflet Geosearch CSS (para buscar endereço) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch/dist/geosearch.css">

    <style>
        #map {
            height: 600px;
            width: 100%;
            border-radius: 10px;
            border: 2px solid #333;
        }
    </style>
</head>
<body>

<h2>🌍 Mapa Completo com Leaflet (todos os recursos)</h2>
<div id="map"></div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Routing Machine (rotas) -->
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<!-- Geocoding / Buscar endereço -->
<script src="https://unpkg.com/leaflet-geosearch/dist/bundle.min.js"></script>

<script>
    // Localização inicial (São Paulo)
    const inicio = [-23.55052, -46.633308];

    // Criar mapa
    const mapa = L.map('map').setView(inicio, 12);

    // ===== ESTILOS DE MAPA =====
    const ruas = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(mapa);

    const ruasEscuras = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png', {
        attribution: '© CartoDB'
    });

    const satelite = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0','mt1','mt2','mt3']
    });

    // Troca de camadas
    L.control.layers({
        "Ruas": ruas,
        "Ruas - Escuro": ruasEscuras,
        "Satélite": satelite
    }).addTo(mapa);


    // ===== MÚLTIPLOS MARCADORES =====
    const locais = [
        { nome: "São Paulo - SP", coords: [-23.55052, -46.633308] },
        { nome: "Avenida Paulista", coords: [-23.561684, -46.655981] },
        { nome: "Praça da Sé", coords: [-23.550305, -46.634468] }
    ];

    locais.forEach(loc => {
        L.marker(loc.coords).addTo(mapa)
            .bindPopup(`<b>${loc.nome}</b>`);
    });


    // ===== MARCADOR ARRASTÁVEL =====
    const marcadorArrastavel = L.marker(inicio, { draggable: true })
        .addTo(mapa)
        .bindPopup("Arraste este marcador!");

    marcadorArrastavel.on("dragend", () => {
        const pos = marcadorArrastavel.getLatLng();
        marcadorArrastavel.bindPopup(`Nova posição:<br>Lat: ${pos.lat}<br>Lng: ${pos.lng}`).openPopup();
    });


    // ===== ROTA ENTRE DOIS PONTOS =====
    L.Routing.control({
        waypoints: [
            L.latLng(-23.55052, -46.633308),
            L.latLng(-23.561684, -46.655981)
        ],
        lineOptions: {
            styles: [{ color: 'blue', weight: 4 }]
        },
        createMarker: () => null // remove marcadores automáticos
    }).addTo(mapa);


    // ===== BUSCA POR ENDEREÇO =====
    const provider = new window.GeoSearch.OpenStreetMapProvider();

    const searchControl = new window.GeoSearch.GeoSearchControl({
        provider: provider,
        style: 'bar',
        showMarker: true,
        showPopup: true,
        marker: {
            color: 'red'
        }
    });

    mapa.addControl(searchControl);


    // ===== BOTÃO DE LOCALIZAÇÃO (GPS) =====
    mapa.locate({ setView: false });

    L.control.locate = function () {
        const control = L.control({ position: 'topleft' });
        control.onAdd = function () {
            const btn = L.DomUtil.create('button', 'localizar-btn');
            btn.innerHTML = "📍";
            btn.title = "Minha localização";

            btn.onclick = () => {
                mapa.locate({ setView: true, maxZoom: 15 });
            };

            return btn;
        };
        return control;
    };

    L.control.locate().addTo(mapa);

    mapa.on("locationfound", e => {
        L.marker(e.latlng).addTo(mapa)
            .bindPopup("Você está aqui!")
            .openPopup();
    });

</script>

</body>
</html>


