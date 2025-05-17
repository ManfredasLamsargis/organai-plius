<!-- Head -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<div id="map" style="height: 500px; width: 800px; align-content: center;"></div>
<script>
    const map = L.map('map').setView([54.6872, 25.2797], 6); // Example: Vilnius

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Example route (polyline)
    const routeCoords = [
        [54.6872, 25.2797], // Start
        [55.1694, 23.8813], // Midpoint
        [56.946, 24.1059]   // End
    ];

    L.polyline(routeCoords, { color: 'blue' }).addTo(map)
        .bindPopup("Dropshipping Route");
</script>