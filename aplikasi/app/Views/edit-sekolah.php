<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>Input Data Sekolah</h1>
        </div>
        <br>
        <br>
        <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('sukses'); ?>
            </div>
            <br>
        <?php endif; ?>
        <?php if(session()->getFlashdata('gagal')) : ?>
            <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('gagal'); ?>
            </div>
            <br>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-12 col-md-4">
                            <form action="<?= base_url() ?>/sekolah/update/<?= $sekolah['id_sekolah'] ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="datalama" value="<?= $sekolah['nama_sekolah'] ?>">
                                <input type="hidden" name="gambarlama" value="<?= $sekolah['gambar'] ?>">
                                <label for="gambar" class="form-label">Foto Sekolah</label>
                                <input type="file" name="gambar" class="form-control mb-2">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('gambar') ?>
                                </div>
                                <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" class="form-control mb-2 <?= ($validation->hasError('nama_sekolah')) ? 'is-invalid' : '' ?>" placeholder="Nama Sekolah" value="<?= old('nama_sekolah', $sekolah['nama_sekolah']) ?>" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama_sekolah') ?>
                                </div>
                                <label for="jenjang" class="form-label">Jenjang</label>
                                <select name="jenjang" id="jenjang" class="form-select mb-2" required>
                                    <?php foreach($jenjang as $j) : ?>
                                        <option value="<?= $j['id_jenjang'] ?>" <?= ($j['id_jenjang'] == $sekolah['id_jenjang']) ? 'selected' : '' ?>><?= $j['jenjang'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="akreditasi" class="form-label">Akreditasi Sekolah</label>
                                <input type="text" name="akreditasi" class="form-control mb-2 <?= ($validation->hasError('akreditasi')) ? 'is-invalid' : '' ?>" placeholder="Akreditasi Sekolah" value="<?= old('akreditasi', $sekolah['akreditasi']) ?>" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('akreditasi') ?>
                                </div>
                                <label for="email" class="form-label">Email Sekolah</label>
                                <input type="email" name="email" class="form-control mb-2 <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" placeholder="Email Sekolah" value="<?= old('email', $sekolah['email']) ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email') ?>
                                </div>
                                <label for="website" class="form-label">Website Sekolah</label>
                                <input type="text" name="website" class="form-control mb-2 <?= ($validation->hasError('website')) ? 'is-invalid' : '' ?>" placeholder="Website Sekolah" value="<?= old('website', $sekolah['website']) ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('website') ?>
                                </div>
                                <label for="kecamatan">Nama Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select mb-2">
                                    <option value="0" selected>Cikeusik</option>
                                </select>
                                <label for="desa" class="form-label">Nama Desa</label>
                                <select name="desa" id="desa" class="form-select mb-2" required>
                                    <?php foreach($desa as $d) : ?>
                                        <option value="<?= $d['id_desa'] ?>" <?= ($d['id_desa'] == $sekolah['id_desa']) ? 'selected' : '' ?>><?= $d['nama_desa'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control mb-2 <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" placeholder="Alamat lengkap" value="<?= old('alamat', $sekolah['alamat']) ?>" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('alamat') ?>
                                </div>
                                <label for="koord_x" class="form-label">Koord x</label>
                                <input type="text" name="koord_x" class="form-control mb-2" id="koord_x" placeholder="" value="<?= old('koord_x', $sekolah['koord_x']) ?>" required>
                                <label for="koord_y" class="form-label">Koord y</label>
                                <input type="text" name="koord_y" class="form-control mb-2" id="koord_y"
                                    placeholder="" value="<?= old('koord_y', $sekolah['koord_y']) ?>" required>
                                <br>
                                <label for="average1" class="form-label">Average 1</label>
                                <select name="average1" id="average1" class="form-select mb-2" required>
                                    <option value="<?= $sekolah['average1'] ?>" selected><?= $sekolah['average1'] ?></option>
                                    <?php foreach($dataSekolah as $s) : ?>
                                        <option value="<?= $s['nama_sekolah'] ?> [<?= $s['akreditasi'] ?>]"><?= $s['nama_sekolah'] ?> [<?= $s['akreditasi'] ?>]</option>
                                    <?php endforeach; ?>
                                </select>
                                
                                <label for="average2" class="form-label">Average 2</label>
                                <select name="average2" id="average2" class="form-select mb-2" required>
                                    <option value="<?= $sekolah['average2'] ?>" selected><?= $sekolah['average2'] ?></option>
                                    <?php foreach($dataSekolah as $s) : ?>
                                        <option value="<?= $s['nama_sekolah'] ?> [<?= $s['akreditasi'] ?>]"><?= $s['nama_sekolah'] ?> [<?= $s['akreditasi'] ?>]</option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-primary">Reset</button>
                                <a href="<?= base_url() ?>/sekolah" class="btn btn-danger">Kembali</a>
                                <!-- <button type="button" class="btn btn-info" onclick="mylok()">Lokasi Saya</button> -->
                            </form>
                        </div>
                        <div class="col-md-8 col-12 order-first order-md-last">
                            <div id="map" style="height: 450px;"></div>
                            <script>
                                var map = L.map('map');
                                map.setView([-6.767438, 105.837866], 13);
                                L.tileLayer(
                                    'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                        maxZoom: 15,
                                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                                            'Imagery © <a href="https://maps.google.com/">Google Maps</a>',
                                        tileSize: 512,
                                        zoomOffset: -1,
                                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                                    }).addTo(map);

                                $.getJSON("<?= base_url() ?>/cikeusik.geojson", function (data) {
                                    geoLayer = L.geoJson(data, {
                                        style: function (feature) {
                                            return {
                                                fillColor: "transparent"
                                            }
                                        },
                                    }).addTo(map);
                                });
                                // L.Control.geocoder({
                                //     position: 'topleft'
                                // }).addTo(map);
                                var geocodeService = L.esri.Geocoding.geocodeService();

                                map.on('click', function (e) {
                                    geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
                                        if (error) {
                                            return;
                                        }

                                        console.log(result);
                                    });
                                    // console.log(e);
                                    var coord = e.latlng.toString().split(',');
                                    var lat = coord[0].split('(');
                                    var lng = coord[1].split(')');

                                    var inputlat = document.getElementById('koord_x');
                                    var inputlong = document.getElementById('koord_y');

                                    inputlat.value = lat[1];
                                    inputlong.value = lng[0];
                                });

                                // fungsi mendapatkan posisi user
                                function mylok(){
                                    navigator.geolocation.getCurrentPosition(getPosition);
                                    
                                      var marker, circle;
                                    
                                      function getPosition(position){
                                          var lat = position.coords.latitude;
                                          var long = position.coords.longitude;
                                          var accuracy = position.coords.accuracy;

                                        var inputlat = document.getElementById('koord_x');
                                        var inputlong = document.getElementById('koord_y');

                                        inputlat.value = lat;
                                        inputlong.value = long;
                                    
                                          if(marker) {
                                              map.removeLayer(marker);
                                          }
                                    
                                          if(circle) {
                                              map.removeLayer(circle);
                                          }
                                    
                                          marker = L.marker([lat, long]).bindPopup('Lokasi Anda Saat ini')
                                          circle = L.circle([lat, long], {radius: 50})
                                    
                                          var featureGroup = L.featureGroup([marker, circle]).addTo(map)
                                          map.flyTo([lat, long], 15, {
                                                animate: true,
                                                duration: 2 // in seconds
                                            });
                                      }
                                      

                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

<?= $this->endSection(); ?>