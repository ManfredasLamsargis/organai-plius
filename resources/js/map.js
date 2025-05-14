import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function renderMap(containerId, routeCoords = []) {
    const map = L.map(containerId).setView([54.6872, 25.2797], 6);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    if (routeCoords.length > 0) {
        L.polyline(routeCoords, { color: 'blue' }).addTo(map)
            .bindPopup("Dropshipping Route");
    }
}