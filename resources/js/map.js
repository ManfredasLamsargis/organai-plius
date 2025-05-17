import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function renderMap(containerId, pickup, drop, routeCoords = []) {
    const map = L.map(containerId).setView(pickup, 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker(pickup).addTo(map).bindPopup("Pickup Point");
    L.marker(drop).addTo(map).bindPopup("Drop Point");

    if (routeCoords.length > 0) {
        L.polyline(routeCoords, { color: 'blue' }).addTo(map).bindPopup("Generated Route");
    }
}

window.renderMap = renderMap;

const el = document.getElementById('map');
if (el) {
    const pickup = [
        parseFloat(el.dataset.pickupLat),
        parseFloat(el.dataset.pickupLng),
    ];
    const drop = [
        parseFloat(el.dataset.dropLat),
        parseFloat(el.dataset.dropLng),
    ];
    renderMap('map', pickup, drop);
}