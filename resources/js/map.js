import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function renderMap(containerId, pickup, drop, route = []) {
    const map = L.map(containerId);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker(pickup).addTo(map).bindPopup("Pickup Point");
    L.marker(drop).addTo(map).bindPopup("Drop Point");

    if (route.length > 0) {
        L.polyline(route, { color: 'blue' }).addTo(map);
        map.fitBounds(route, { padding: [50, 50] });
    } else {
        L.polyline([pickup, drop], { color: 'gray', dashArray: '4' }).addTo(map);
        const bounds = L.latLngBounds([pickup, drop]);
        map.fitBounds(bounds, { padding: [50, 50] });
    }
}

window.renderMap = renderMap;