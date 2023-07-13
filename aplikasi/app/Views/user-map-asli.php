<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web GIS</title>
    <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fontawesome-5.15.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/leaflet/leaflet.css">
    <link rel="stylesheet" href="<?= base_url() ?>/routing-machine/dist/leaflet-routing-machine.css">
    <link rel="stylesheet" href="<?= base_url() ?>/leaflet-search/src/leaflet-search.css">
    <script src="<?= base_url() ?>/assets/js/jquery-3.3.1.min.js"></script>
    
    <script src="<?= base_url() ?>/leaflet/leaflet.js"></script>
    <script src="<?= base_url() ?>/routing-machine/dist/leaflet-routing-machine.js"></script>
    <script src="<?= base_url() ?>/routing-machine/examples/Control.Geocoder.js"></script>
    <script src="<?= base_url() ?>/leaflet-search/src/leaflet-search.js"></script>
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" /> -->
    <!-- <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <style>
    .leaflet-routing-container.leaflet-bar.leaflet-control{
      display: none;
    }
    /* .leaflet-routing-container.leaflet-bar.leaflet-control{
    margin-top: 70px;
    } */
    .leaflet-control-zoom.leaflet-bar.leaflet-control{
      margin-top: 70px;
    }
    .leaflet-top.leaflet-right{
      margin-top: 70px;
    }
    #sidebar{
    position: absolute;
    right: -400px;
    background-color: white;
    border: solid 2px rgba(0,0,0, .3);
    top: 0;
    transition: 1s ease all;
    }
    #sidebar.show{
    right: -10px;
    }
    #map-user{
    height: 100vh;
    }
    .list-group .list-group-item i{
    font-size: 20px;
    }
    .list-data:hover{
      cursor: pointer;
      background-color: rgba(0, 0, 0, 0.05);
    }
    @media screen and (max-width: 576px){
    #map-user{
    height: 95vh;
    }
    .leaflet-control-geocoder.leaflet-bar.leaflet-control{
    margin-bottom: 40px;
    }
    .leaflet-bottom.leaflet-left{
    margin-bottom: 20px;
    }
    .leaflet-control-geocoder-form{
    width: 200px;
    }
    .leaflet-control-zoom.leaflet-bar.leaflet-control{
    display: none;
    }
    #offcanvasRight{
    width:  85%;
    }
    }
    </style>
  </head>
  <body>
    <nav class="fixed-top d-flex p-2 justify-content-between align-items-center bg-white px-2 px-md-4 shadow">
      <span class="fw-bold">WEBGIS</span>
      <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-align-justify"></i></button>
    </nav>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">WEBGIS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body p-0">
        <div class="accordion accordion-flush mb-5" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Tentang
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <p style="text-align: justify">Sistem Informasi Geografis yang berfungsi untuk mencari dan menentukan jalur tercepat ke suatu tempat, sistem akan menampilkan beberapa jalur menuju ke tempat tujuan kemudian akan mencari best route atau rute terbaik dan tercepat ditandai dengan jalur berwarna hijau</p>

              </div>
            </div>
          </div>
          
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            List Lokasi
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body p-2">
                <?php if($lokasi == null) : ?>
                  <p class="text-center text-muted">Tidak Ada Data</p>
                <?php endif; ?>
                <?php foreach($lokasi as $lok) : ?>
                  <div class="list-data p-2 mb-2" data-bs-dismiss="offcanvas" aria-label="Close" onclick="zoomTo(<?= $lok['lat'] ?>, <?= $lok['lng'] ?>)">
                    <i class="fas fa-map-marker-alt" style="font-size: 16px"></i>&nbsp;<?= $lok['nama_lokasi'] ?>
                  </div>
                <?php endforeach; ?>
              </div>
          </div>
        </div>
          
        </div>
        </div>
      </div>
    </div>
    <div id="map-user"></div>
    <script src="<?= base_url() ?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/user-script-map.js"></script>
    <script>
    
    var mylocation = L.icon({
      iconUrl: '<?= base_url() ?>/assets/marker/user.png',
      iconSize: [45, 45]
    });
    
    <?php foreach($lokasi as $lok) : ?>
    L.marker([<?= $lok['lat'] ?>, <?= $lok['lng'] ?>]).addTo(map).bindPopup('<p class="text-center fw-bold p-0 m-0"> <?= $lok['nama_lokasi'] ?> </p><br> <button type="button" class="btn btn-primary p-1 btn-sm" onclick="return kesini(<?= $lok['lat'] ?>, <?= $lok['lng'] ?>)"><i class="fas fa-reply"></i> Ke sini</button>');
    <?php endforeach; ?>
    function localData(text, callResponse)
    {
    // data geografis desa se kabupaten pandeglang
    var data = [
    <?php foreach($lokasi as $lok) : ?>
    {"loc":[<?= $lok['lat'] ?>,<?= $lok['lng'] ?>], "title":"<?= $lok['nama_lokasi']; ?>"},
    <?php endforeach ?>
    ];
    callResponse(data);
    return {  //called to stop previous requests on map move
    abort: function() {
    console.log('aborted request:'+ text);
    }
    }
    }
    
    map.addControl( new L.Control.Search({sourceData: localData, textPlaceholder: 'Cari nama lokasi...', position: 'topright', zoom: 15}) );
    // L.control.side({position: 'topright'}).addTo(map);
    
    // L.control.logo({position: 'topleft'}).addTo(map);
    
    // fungsi untuk zoom ke daerah yang di pilih
    function zoomTo(lat, lng){
      map.flyTo([lat, lng], 17, {
          animate: true,
          duration: 2 // in seconds
      });
    }
    </script>
  </body>
</html>