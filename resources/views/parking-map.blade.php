<x-app-layout>
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<style>
  #map {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;        /* 🔑 this gives full height */
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
</style>



 <div id="map" class="md:mt-8"></div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <!-- Leaflet TextPath plugin for line labels -->
  <script src="https://unpkg.com/leaflet-textpath/leaflet.textpath.js"></script>
  
  <script>
    // 1️⃣ Initialize map
    const map = L.map('map').setView([44.233053, -76.488408], 15);
  
    // 2️⃣ Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);
  
    // 3️⃣ Add markers with tooltip (hover) and popup (click)
    const markers = [
      {
        lat: 44.225444,
        lng: -76.501215,
        tooltip: 'Albert St. Free Parking <br> Mon-Fri <br> 11am-5pm',
        popup: 'Albert St. Free Parking <br> Mon-Fri <br> 11am-5pm'
      }
    ];
  
    markers.forEach(m => {
      const marker = L.marker([m.lat, m.lng]).addTo(map);
      marker.bindTooltip(m.tooltip, { sticky: true });
      marker.bindPopup(m.popup);
    });
  
    // 4️⃣ Draw a street line with a tooltip
    const streetLine = L.polyline([
      [44.229444, -76.501550],
      [44.2225, -76.501025]
    ], {
      color: 'red',
      weight: 6,
      opacity: 0.8,
      lineCap: 'round',
      lineJoin: 'round'
    }).addTo(map);
  
    // Add street name on the line
    streetLine.setText('Queen Stree Hello from here mate t', {
      center: true,
      repeat: false,
      attributes: {
        fill: '#222',
        'font-size': '14px',
        'font-weight': 'bold'
      }
    });
  
    // Optional: add popup on the line as well
    streetLine.bindPopup('Queen Street, Kingston, ON');
  
  </script>

</x-app-layout>  
