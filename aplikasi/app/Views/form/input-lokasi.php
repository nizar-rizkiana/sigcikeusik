<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>Input Data Lokasi</h1>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <form action="<?= base_url() ?>/lokasi/save" method="post">
                                    <?= csrf_field(); ?>
                                
                                    <label for="lokasi" class="form-label">Nama Lokasi</label>
                                    <input type="text" name="lokasi" class="form-control mb-2 <?= ($validation->hasError('lokasi')) ? 'is-invalid' : '' ?>" id="lokasi"
                                        placeholder="Masukkan nama lokasi" required value="<?= old('lokasi'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('lokasi'); ?>
                                        </div>
                                    <label for="lat" class="form-label">Latitude</label>
                                    <input type="text" name="lat" class="form-control mb-2 <?= $validation->hasError('lat') ? 'is-invalid' : '' ?>" id="lat"
                                        placeholder="pilih pada peta" required value="<?= old('lat') ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('lat'); ?>
                                        </div>
                                    <label for="lng" class="form-label">Longitude</label>
                                    <input type="text" name="lng" class="form-control mb-2" id="lng"
                                        placeholder="longitude" required value="<?= old('lng') ?>">
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                                
                            </div>
                            <div class="col-8" id="container-map">
                                <div id="map" style="height: 450px;"></div>
                                <script>
                                    // var map = L.map('map-desa').setView([-6.540458, 105.702736], 12);
                                    var map = L.map('map', {
                                        center: [-6.540458, 105.702736],
                                        zoom: 13
                                    });
                                    // layer style satelit http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}
                                    var tiles = L.tileLayer(
                                        'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                            maxZoom: 18,
                                            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                                                'Imagery © <a href="https://maps.google.com/">Google Maps</a>',
                                            tileSize: 512,
                                            zoomOffset: -1,
                                            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                                        }).addTo(map);

                                
                                    
                                    L.Control.geocoder({
                                        position: 'topleft'
                                    }).addTo(map);

                                    map.on('click', function (e) {
                                        var coord = e.latlng.toString().split(',');
                                        var lat = coord[0].split('(');
                                        var lng = coord[1].split(')');

                                        var inputlat = document.getElementById('lat');
                                        var inputlong = document.getElementById('lng');

                                        inputlat.value = lat[1];
                                        inputlong.value = lng[0];
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<?= $this->endSection(); ?>