// style marker
var banjirIcon = L.icon({
    iconUrl: '/assets/marker/banjir.png',
    iconSize: [30, 45], // size of the icon
    });
var evakuasiIcon = L.icon({
    iconUrl: '/assets/marker/evakuasi.png',
    iconSize: [30, 45], // size of the icon
    });
var sd = L.icon({
  iconUrl: '<?= base_url() ?>/assets/marker/marker-red.png',
  iconSize: [45, 45]
});
var sltp = L.icon({
  iconUrl: '<?= base_url() ?>/assets/marker/marker-green.png',
  iconSize: [45, 45]
});

var popup = L.popup();

var peta1 = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});

var peta2 = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});


var peta3 = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
});

var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoibml6YXItcml6a2lhbmEiLCJhIjoiY2wxZnVtcHlyMHd6cTNvbG43OTFyaG5jayJ9.IkFoyKWm81q0rTYe53warA', {
    
    id: 'mapbox/dark-v10'
});

// perbedaan pada parameter lyrs
// Hybrid: s,h;
// Satellite: s;
// Streets: m;
// Terrain: p;

var baseMaps = {
    "Streets": peta1,
    "Satelite": peta2,
    "Hybrid": peta3,
    "Dark": peta4,
};

var map = L.map('map-user');
map.setView([-6.767438, 105.837866], 13);

// L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
//     // attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
//     maxZoom: 18,
//     id: 'mapbox/streets-v11',
//     tileSize: 512,
//     zoomOffset: -1,
//     accessToken: 'pk.eyJ1Ijoibml6YXItcml6a2lhbmEiLCJhIjoiY2wxZnVtcHlyMHd6cTNvbG43OTFyaG5jayJ9.IkFoyKWm81q0rTYe53warA'
// }).addTo(map);

L.tileLayer(
'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 18,
    tileSize: 512,
    zoomOffset: -1,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
}).addTo(map);

$.getJSON("cikeusik.geojson", function (data) {
    geoLayer = L.geoJson(data, {
        style: function(feature){
            return {
                fillColor: "transparent"
            }
        },
    }).addTo(map);
});

// control sidebar


function kesini(lat,lng)
{
    navigator.geolocation.getCurrentPosition(getPosition)
    if(!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!")
    } else {
        setInterval(() => {
            navigator.geolocation.getCurrentPosition(updatePosition)
        }, 3000);
    }
    
    var marker, circle;
    
    function getPosition(position){
          // console.log(position)
        lokasiUser = position.coords;
        var lat = position.coords.latitude
        var long = position.coords.longitude
        var accuracy = position.coords.accuracy
    
        if(marker) {
            map.removeLayer(marker)
        }
    
        if(circle) {
            map.removeLayer(circle)
        }
    
        marker = L.marker([lat, long], {icon: mylocation}).bindPopup('Lokasi Anda Saat ini')
        circle = L.circle([lat, long], {radius: 50})
    
        var featureGroup = L.featureGroup([marker, circle]).addTo(map)
    
        map.fitBounds(featureGroup.getBounds())
    }

    function updatePosition(position){
        lokasiUser = position.coords;
        var lat = position.coords.latitude
        var long = position.coords.longitude
        var accuracy = position.coords.accuracy
    
        if(marker) {
            map.removeLayer(marker)
        }
    
        if(circle) {
            map.removeLayer(circle)
        }
    
        marker = L.marker([lat, long], {icon: mylocation}).bindPopup('Lokasi Anda Saat ini')
        circle = L.circle([lat, long], {radius: 50})
    
        var featureGroup = L.featureGroup([marker, circle]).addTo(map)
        console.log(lat);
    }

    
    setTimeout(function(){
        var wp1 = new L.Routing.Waypoint(L.latLng(lokasiUser.latitude, lokasiUser.longitude));
        var wp2 = new L.Routing.Waypoint(L.latLng(lat, lng));

        control.setWaypoints([
            L.latLng(lokasiUser.latitude, lokasiUser.longitude),
            L.latLng(lat, lng)
            ]);
        control.addTo(map);
        var latlng = L.latLng(lat, lng);
        control.spliceWaypoints(control.getWaypoints().length - 1, 1, latlng);
        marker = L.marker([lat, lng], {icon: mylocation}).bindPopup('Lokasi Anda Saat ini')
    }, 3000);

}

//contorl routing jalur evakuasi
var control = L.Routing.control({
    waypoints: [
        L.latLng(null, null),
        L.latLng(null, null),
    ],
    router: L.Routing.mapbox('pk.eyJ1Ijoibml6YXItcml6a2lhbmEiLCJhIjoiY2wxZnVtcHlyMHd6cTNvbG43OTFyaG5jayJ9.IkFoyKWm81q0rTYe53warA'),
    routeWhileDragging: true,
    reverseWaypoints: true,
    showAlternatives: true,
    altLineOptions: {
        styles: [
            {color: 'black', opacity: 0.15, weight: 9},
            {color: 'white', opacity: 0.8, weight: 6},
            {color: 'blue', opacity: 0.5, weight: 2}
        ]
    }
});





// fungsi mendapatkan posisi user
function mylok(){
    navigator.geolocation.getCurrentPosition(getPosition);
    
      var marker, circle;
    
      function getPosition(position){
          var lat = position.coords.latitude;
          var long = position.coords.longitude;
          var accuracy = position.coords.accuracy;
    
          if(marker) {
              map.removeLayer(marker);
          }
    
          if(circle) {
              map.removeLayer(circle);
          }
    
          marker = L.marker([lat, long], {icon: mylocation}).bindPopup('Lokasi Anda Saat ini')
          circle = L.circle([lat, long], {radius: 50})
    
          var featureGroup = L.featureGroup([marker, circle]).addTo(map)
    
          map.fitBounds(featureGroup.getBounds())
          map.removeControl(stopButton);

          stopBtn = L.control.stop({position: 'bottomleft'}).addTo(map);
      }
      

}
//end mendapatkan posisi user

