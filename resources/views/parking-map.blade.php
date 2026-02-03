<x-app-layout>
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

  <style>
    #map {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      width: calc(100vw - 280px);
      z-index: 0;
    }

    @media (max-width: 1024px) {
      #map {
        position: relative;
        width: 100%;
        height: 100vh;
      }
    }

    .leaflet-tooltip {
      background: rgba(0, 0, 0, 0.7);
      color: #fff;
      font-size: 13px;
      font-weight: 500;
      padding: 4px 8px;
      border-radius: 4px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    .leaflet-popup-content-wrapper {
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
  </style>

  <div id="map" class="md:mt-8"></div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-textpath/leaflet.textpath.js"></script>

  <script>
    // Initialize map
    const map = L.map('map').setView([44.233053, -76.488408], 15);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Parking zones data with schedules
    const zones = [
      { 
        lat: 44.229111, lng: -76.499972, name: "Albert St", color: "#e74c3c",
        schedule: `Midnight – 10:00 AM ✅<br>10:00 AM – 11:00 AM 🚫<br>11:00 AM – 2:00 PM ✅<br>2:00 PM – 3:00 PM 🚫<br>3:00 PM – Midnight ✅`
      },
      { 
        lat: 44.230667, lng: -76.498583, name: "Frontenac St", color: "#3498db",
        schedule: `Midnight – 10:00 AM ✅<br>10:00 AM – 11:00 AM 🚫<br>11:00 AM – 2:00 PM ✅<br>2:00 PM – 3:00 PM 🚫<br>3:00 PM – Midnight ✅`
      },
      { 
        lat: 44.230556, lng: -76.496999, name: "Alfred St", color: "#2ecc71",
        schedule: `Midnight – 10:00 AM ✅<br>10:00 AM – 11:00 AM 🚫<br>11:00 AM – 2:00 PM ✅<br>2:00 PM – 3:00 PM 🚫<br>3:00 PM – Midnight ✅`
      },
      { 
        lat: 44.230419, lng: -76.494413, name: "Aberdeen St", color: "#f1c40f",
        schedule: `Midnight – 09:00 AM ✅<br>10:00 AM – 10:00 AM 🚫<br>10:00 AM – 1:00 PM ✅<br>1:00 PM – 2:00 PM 🚫<br>3:00 PM – Midnight ✅`
      },
      { 
        lat: 44.230143, lng: -76.493059, name: "Division St", color: "#9b59b6",
        schedule: `Midnight – 09:00 AM ✅<br>10:00 AM – 10:00 AM 🚫<br>10:00 AM – 1:00 PM ✅<br>1:00 PM – 2:00 PM 🚫<br>3:00 PM – Midnight ✅`
      },
      { 
        lat: 44.230121, lng: -76.489725, name: "Clergy St", color: "#34495e",
        schedule: `Midnight – 09:00 AM ✅<br>10:00 AM – 10:00 AM 🚫<br>10:00 AM – 1:00 PM ✅<br>1:00 PM – 2:00 PM 🚫<br>3:00 PM – Midnight ✅`
      }
    ];

    // Add markers with Tailwind-styled popups
    zones.forEach(zone => {
      const marker = L.marker([zone.lat, zone.lng]).addTo(map);

      const popupContent = `
        <div class="p-4 bg-white">
          <h3 class="font-bold text-lg text-gray-800 border-b pb-2 mb-2">${zone.name}</h3>
          <div class="flex items-center flex-col space-x-2 text-sm text-gray-600 mb-1">
            <span class="font-semibold text-indigo-600">Free Parking</span>
            <span class='font-bold'>Monday-Friday</span>
          </div>
          <div class="text-xs text-gray-500 bg-gray-50 p-2 rounded">
            ${zone.schedule}
          </div>
        </div>
      `;

      marker.bindPopup(popupContent);
      marker.bindTooltip(`<strong>${zone.name}</strong>`, { sticky: true });
    });

    // Street lines with colors matching markers
    const streets = [
      { coords: [[44.227389, -76.499778],[44.231472, -76.500194]], name: "Albert St.", color: "#e74c3c" },
      { coords: [[44.229861, -76.498500],[44.231528, -76.498694]], name: "Frontenac St.", color: "#3498db" },
      { coords: [[44.229917, -76.496999],[44.231528, -76.497128]], name: "Alfred St.", color: "#2ecc71" },
      { coords: [[44.231389, -76.494333],[44.229861, -76.494472]], name: "Aberdeen St.", color: "#f1c40f" },
      { coords: [[44.231159, -76.493037],[44.229763, -76.493043]], name: "Division St.", color: "#9b59b6" },
      { coords: [[44.229361, -76.489929],[44.230697, -76.489548]], name: "Clergy St.", color: "#34495e" }
    ];

    streets.forEach(s => {
      const line = L.polyline(s.coords, {
        color: s.color,
        weight: 6,
        opacity: 0.8,
        lineCap: 'round',
        lineJoin: 'round'
      }).addTo(map);

      line.setText(s.name, {
        center: true,
        repeat: false,
        attributes: { fill: '#222', 'font-size': '14px', 'font-weight': 'bold' }
      });

      line.bindPopup(`<strong>${s.name}</strong>`);
    });
  </script>
</x-app-layout>
