<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web SIGCIKEUSIK</title>
    <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/fontawesome-5.15.1/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/leaflet/leaflet.css">
    <link rel="stylesheet" href="<?= base_url() ?>/routing-machine/dist/leaflet-routing-machine.css">
    <link rel="stylesheet" href="<?= base_url() ?>/leaflet-search/src/leaflet-search.css">
    <script src="<?= base_url() ?>/assets/js/jquery-3.3.1.min.js"></script>
    
    <script src="<?= base_url() ?>/leaflet/leaflet.js"></script>
    <script src="<?= base_url() ?>/routing-machine/dist/leaflet-routing-machine.js"></script>
    <script src="<?= base_url() ?>/routing-machine/examples/Control.Geocoder.js"></script>
    <script src="<?= base_url() ?>/routing-machine/examples/config.js"></script>
    <script src="<?= base_url() ?>/leaflet-search/src/leaflet-search.js"></script>
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" /> -->
    <!-- <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <style>
    .leaflet-routing-alt{
      display: none;
    }
    .leaflet-routing-add-waypoint{
      display: none;
    }
    .leaflet-routing-geocoders::before{
      content: 'PENCARIAN RUTE TERCEPAT';
    }
    input::-webkit-input-placeholder::before {
      color:#666;
      content:"Line 1\A Line 2\A Line 3\A";
    }
    /*.leaflet-routing-container.leaflet-bar.leaflet-control{
      display: none;
    }*/
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
    /* .leaflet-routing-container.leaflet-bar.leaflet-control
    {
      display: none;
    } */
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
      <span class="fw-bold">WEB SIGCIKEUSIK</span>
      <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-align-justify"></i></button>
    </nav>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">WEB SIG CIKEUSIK</h5>
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

          <!-- <div class="accordion-item">
            <h2 class="accordion-header" id="headingpanduan">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsepanduan" aria-expanded="false" aria-controls="collapsepanduan">
            Panduan Penggunaan
            </button>
            </h2>
            <div id="collapsepanduan" class="accordion-collapse collapse" aria-labelledby="headinganduan" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <ol class="list-group list-group-numbered list-group-flush">
                  <li class="list-group-item">Langkah pertama pilih lokasi tujuan</li>
                  <li class="list-group-item">Untuk menentukan lokasi tujuan user bisa menggunakan fitur pencarian atau dengan cara klik list lokasi yang ada di sidebar</li>
                  <li class="list-group-item">Setelah menentukan tujuan, untuk memunculkan rutenya user bisa klik tombol "ke sini" di lokasi yang akan dituju</li>
                  <li class="list-group-item">Setelah itu sistem akan mencari rute tercepat dari lokasi anda saat ini menuju ke lokasi tujuan</li>
                  <li class="list-group-item">Atau user bisa langusung menentukan titik lokasi awal dan tujuan di kolom "dari" dan "menuju</li>
                  <li class="list-group-item">Setelah di isi lokasi "dari" dan "menuju" maka sistem akan menentukan jalur tercepat menuju tujuan</li>
                </ol>

              </div>
            </div>
          </div> -->
          
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            Data Sekolah
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body p-2">
                
                <div class="accordion accordion-flush" id="accordionDesa">
                  <?php foreach($desa as $d) : ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $d['id_desa'] ?>" aria-expanded="false" aria-controls="flush-collapse<?= $d['id_desa'] ?>">
                        <?= $d['nama_desa'] ?>
                      </button>
                    </h2>
                    <div id="flush-collapse<?= $d['id_desa'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionDesa">
                      <div class="accordion-body">
                      <?php if($sekolah == null) : ?>
                        <p class="text-center text-muted">Tidak Ada Data</p>
                      <?php endif; ?>
                      <?php foreach($sekolah as $sek) : ?>
                        <?php if($sek['id_desa'] == $d['id_desa']) : ?>
                        <div class="list-data p-2 mb-2" data-bs-dismiss="offcanvas" aria-label="Close" onclick="zoomTo(<?= $sek['koord_x'] ?>, <?= $sek['koord_y'] ?>)">
                          <i class="fas fa-map-marker-alt" style="font-size: 16px"></i>&nbsp;<?= $sek['nama_sekolah'] ?>
                        </div>
                        <?php endif; ?>
                      <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>

                <div class="accordion accordion-flush" id="accordionJenjang">
                  <?php foreach($jenjang as $j) : ?>
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseJ<?= $j['id_jenjang'] ?>" aria-expanded="false" aria-controls="flush-collapseJ<?= $j['id_jenjang'] ?>">
                        <?= $j['jenjang'] ?>
                      </button>
                    </h2>
                    <div id="flush-collapseJ<?= $j['id_jenjang'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionJenjang">
                      <div class="accordion-body">
                      <?php if($sekolah == null) : ?>
                        <p class="text-center text-muted">Tidak Ada Data</p>
                      <?php endif; ?>
                      <?php foreach($sekolah as $sek) : ?>
                        <?php if($sek['id_jenjang'] == $j['id_jenjang']) : ?>
                        <div class="list-data p-2 mb-2" data-bs-dismiss="offcanvas" aria-label="Close" onclick="zoomTo(<?= $sek['koord_x'] ?>, <?= $sek['koord_y'] ?>)">
                          <i class="fas fa-map-marker-alt" style="font-size: 16px"></i>&nbsp;<?= $sek['nama_sekolah'] ?>
                        </div>
                        <?php endif; ?>
                      <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
                
              </div>
          </div>
        </div>
          
        </div>
        </div>
      </div>
    </div>
    <div id="map-user"></div>
    <button type="button" id="mulai" class="btn btn-primary fixed-bottom d-none bottom-0 left-50">Mulai</button>
    <script src="<?= base_url() ?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/user-script-map.js"></script>
    <script>
      var sd = L.icon({
        iconUrl: '<?= base_url() ?>/leaflet/images/marker-red.png',
        iconSize: [30, 50]
      });
      var sltp = L.icon({
        iconUrl: '<?= base_url() ?>/leaflet/images/marker-green.png',
        iconSize: [30, 50]
      });
    var mylocation = L.icon({
      iconUrl: '<?= base_url() ?>/assets/marker/user.png',
      iconSize: [45, 45]
    });
    var markerBlue = L.icon({
      iconUrl: '<?= base_url() ?>/leaflet/images/marker-icon.png',
      // iconSize: [45, 45]
    });
    <?php foreach($sekolah as $sek) : ?>
    <?php  if($sek['jenjang'] == 'SD/MI Sederajat') : ?>
    L.marker([<?= $sek['koord_x'] ?>, <?= $sek['koord_y'] ?>], {icon: sd}).addTo(map).bindPopup('<p class="text-center fw-bold p-0 m-0"><?= $sek['nama_sekolah'] ?></p>'
    <?php endif; ?>
    <?php  if($sek['jenjang'] == 'SMP Sederajat') : ?>
    L.marker([<?= $sek['koord_x'] ?>, <?= $sek['koord_y'] ?>], {icon: sltp}).addTo(map).bindPopup('<p class="text-center fw-bold p-0 m-0"><?= $sek['nama_sekolah'] ?></p>'
    <?php endif; ?>
    <?php  if($sek['jenjang'] == 'SMA Sederajat') : ?>
    L.marker([<?= $sek['koord_x'] ?>, <?= $sek['koord_y'] ?>]).addTo(map).bindPopup('<p class="text-center fw-bold p-0 m-0"><?= $sek['nama_sekolah'] ?></p>'
    <?php endif; ?>
    +'<table class="table table-bordered">'
        +'<tr>'
            +'<td>Email</td>'
            +'<td><?= $sek['email'] ?></td>'
        +'</tr>'
        +'<tr>'
            +'<td>Alamat</td>'
            +'<td><?= $sek['alamat'] ?></td>'
        +'</tr>'
        +'<tr>'
            +'<td>Website</td>'
            +'<td><?= $sek['website'] ?></td>'
        +'</tr>'
        +'<tr>'
            +'<td>Akreditasi</td>'
            +'<td><?= $sek['akreditasi'] ?></td>'
        +'</tr>'
    +'</table>'
    +'<p class="fw-bold my-0">Terdekat 1</p>'
    +'<p class="my-0"><?= $sek['average1'] ?></p>'
    +'<p class="fw-bold my-0">Terdekat 2</p>'
    +'<p class="my-0"><?= $sek['average2'] ?></p>'
      +'<button type="button" class="btn btn-primary p-1 btn-sm w-100" onclick="return kesini(<?= $sek['koord_x'] ?>,<?= $sek['koord_y'] ?>)"><i class="fas fa-reply"></i> Ke sini</button>');
    <?php endforeach; ?>
    function localData(text, callResponse)
    {
    // data geografis desa se kabupaten pandeglang
    var data = [
    <?php foreach($sekolah as $sek) : ?>
    {"loc":[<?= $sek['koord_x'] ?>,<?= $sek['koord_y'] ?>], "title":"<?= $sek['nama_sekolah']; ?>"},
    <?php endforeach ?>
    ];
    callResponse(data);
    return {  //called to stop previous requests on map move
    abort: function() {
    console.log('aborted request:'+ text);
    }
    }
    }
    
    map.addControl( new L.Control.Search({sourceData: localData, textPlaceholder: 'Cari nama sekolah...', position: 'topright', zoom: 15}) );
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