import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function renderMap(containerId, pickup, drop) {
    const map = L.map(containerId).setView(pickup, 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker(pickup).addTo(map).bindPopup("Pickup Point");
    L.marker(drop).addTo(map).bindPopup("Drop Point");

    L.polyline([pickup, drop], { color: 'blue' }).addTo(map);
}

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