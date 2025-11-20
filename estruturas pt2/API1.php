<?php
// Defina aqui a sua chave de API do Google Maps
$google_maps_api_key = "AIzaSyD1ymgJSOFD9yCS4hoC7hNeU8Km40bbQi0";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Mapa com Google Maps API e PHP</title>
    <style>
        /* Estilização básica do mapa */
        #map {
            height: 500px;
            width: 100%;
            border: 2px solid #333;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <h2>📍 Exemplo de Integração do Google Maps com PHP</h2>
    <div id="map"></div>

    <script>
        // Função que inicializa o mapa
        function initMap() {
            // Define as coordenadas (latitude e longitude) do local desejado
            const localizacao = { lat: -23.093289, lng: -45.7851416 }; // Caçapava, SP 

            // Cria o mapa centralizado no local
            const mapa = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: localizacao,
            });

            // Adiciona um marcador no mapa
            const marcador = new google.maps.Marker({
                position: localizacao,
                map: mapa,
                title: "Caçapava - SP",
            });
        }
    </script>

    <!-- Script da API do Google Maps (com a chave PHP inserida dinamicamente) -->
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $google_maps_api_key; ?>&callback=initMap">
    </script>
</body>
</html>
