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

// MANFREDAS_TODO: show real coordinate values
if (document.getElementById('map')) {
    const pickup = [54.6872, 25.2797];
    const drop = [55.1694, 23.8813];
    renderMap("map", pickup, drop);
}