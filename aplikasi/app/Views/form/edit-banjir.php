<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>Update Data Banjir</h1>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-body row">
                        <div class="col-12 col-md-4">
                            <form action="/banjir/update/<?= $banjir['id_banjir'] ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <label for="kecamatan">Nama Kecamatan</label>
                                <select name="kecamatan" id="kecamatan" class="form-select mb-2" required>
                                    <option value="<?= $banjir['id_kecamatan'] ?>" selected><?= $banjir['nama_kecamatan'] ?></option>
                                    <?php foreach($kecamatan as $kec) : ?>
                                        <option value="<?= $kec['id_kecamatan'] ?>"><?= $kec['nama_kecamatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="desa" class="form-label">Nama Desa</label>
                                <select name="desa" id="desa" class="form-select mb-2" required>
                                    <option value="<?= $banjir['id_desa'] ?>" selected><?= $banjir['nama_desa'] ?></option>
                                    
                                </select>
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control mb-2 <?= ($validation->hasError('alamat')) ? 'is-invalid' : '' ?>" placeholder="Alamat lengkap" value="<?= (old('alamat')) ? old('alamat') : $banjir['alamat'] ?>" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('alamat') ?>
                                </div>
                                <label for="tinggi">Ketinggian Banjir</label>
                                <div class="input-group mb-2">
                                    <input type="number" step="0.01" class="form-control" placeholder="ketinggian air" name="ketinggian" value="<?= (old('ketinggian')) ? old('ketinggian') : $banjir['ketinggian'] ?>" required>
                                    <span class="input-group-text">Cm</span>
                                </div>
                                <label for="lat" class="form-label">Latitude</label>
                                <input type="text" name="lat" class="form-control mb-2" id="lat" placeholder="pilih pada peta" value="<?= (old('lat')) ? old('lat') : $banjir['lat'] ?>" required>
                                <label for="long" class="form-label">Longitude</label>
                                <input type="text" name="lng" class="form-control mb-2" id="long"
                                    placeholder="longitude" value="<?= (old('lng')) ? old('lng') : $banjir['lng'] ?>" required>

                                <label for="">Gambar</label>
                                <br>
                                <div class="input-group">
                                    <img src="/gambar-upload/<?= $banjir['gambar'] ?>" alt="gambar banjir" id="gambar" class="img-preview" width="300px">
                                    <br>
                                    <div class="custom-file my-2 w-100">
                                        <input type="hidden" value="<?= $banjir['gambar'] ?>" name="gambarLama">
                                        <input type="file" accept="image/png, image/jpg, image/jpeg" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : '' ?>" id="namaGambar" name="gambar" onchange="previewImage()">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('gambar') ?>
                                        </div>
                                        <!-- <label class="custom-file-label visually-hidden" for="namaGambar">(Option) Upload Gambar ...</label> -->
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-info" onclick="mylok()">Lokasi Saya</button>
                            </form>
                        </div>
                        <div class="col-md-8 col-12 order-first order-md-last">
                            <div id="map" style="height: 450px;"></div>
                            <script>
                                var map = L.map('map');
                                map.setView([<?= $banjir['lat'] ?>, <?= $banjir['lng'] ?>], 15);
                                L.tileLayer(
                                    'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                        maxZoom: 18,
                                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                                            'Imagery © <a href="https://maps.google.com/">Google Maps</a>',
                                        tileSize: 512,
                                        zoomOffset: -1,
                                        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                                    }).addTo(map);

                                $.getJSON("/geojson/<?= $banjir['slug_kecamatan'] ?>/desa-<?= $banjir['slug_desa'] ?>.geojson", function (data) {
                                    geoLayer = L.geoJson(data, {
                                        style: function (feature) {
                                            return {
                                                
                                            }
                                        },
                                    }).addTo(map);
                                });
                                // L.Control.geocoder({
                                //     position: 'topleft'
                                // }).addTo(map);

                                map.on('click', function (e) {
                                    var coord = e.latlng.toString().split(',');
                                    var lat = coord[0].split('(');
                                    var lng = coord[1].split(')');

                                    var inputlat = document.getElementById('lat');
                                    var inputlong = document.getElementById('long');

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

                                        var inputlat = document.getElementById('lat');
                                        var inputlong = document.getElementById('lng');

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

                                L.marker([<?= $banjir['lat'] ?>, <?= $banjir['lng'] ?>], {draggable:true, clickable:true}).on('click', function(e){
                                    var coord = e.latlng.toString().split(',');
                                    var lat = coord[0].split('(');
                                    var lng = coord[1].split(')');

                                    var inputlat = document.getElementById('lat');
                                    var inputlong = document.getElementById('long');

                                    inputlat.value = lat[1];
                                    inputlong.value = lng[0];
                                }).addTo(map).bindPopup('<?= $banjir['alamat'] ?>').openPopup();

                                // script dynamic select option
                            $(document).ready(function(){
                                $('#kecamatan').change(function(){
                                    var id_kecamatan = $('#kecamatan').val();
                                    var action = 'get_desa';
                                    if(id_kecamatan != '')
                                    {
                                        $.ajax({
                                            url:"/banjir/datadesa",
                                            method:"POST",
                                            data:{id_kecamatan:id_kecamatan, action:action},
                                            dataType:"JSON",
                                            success:function(data)
                                            {
                                                var html = '<option value="" selected disabled>-- Pilih Desa --</option>';

                                                for(var i = 0; i < data.length; i++){
                                                    html += '<option value="'+data[i].id_desa+'">'+data[i].nama_desa+'</option>';
                                                }
                                                $('#desa').html(html);
                                            }
                                        });
                                    } else {
                                        $('#desa').val('');
                                    }
                                });

                                $('#desa').change(function(){
                                    var id_desa = $('#desa').val();
                                    var action = 'get_geo';

                                    if(id_desa != '')
                                    {
                                        $.ajax({
                                            url:"/banjir/datageo",
                                            method:"POST",
                                            data:{id_desa:id_desa, action:action},
                                            dataType:"JSON",
                                            success:function(data)
                                            {
                                                showDesa(data);
                                            }
                                        });

                                        function showDesa(data){
                                            $(".leaflet-interactive").remove()
                                            map.flyTo([data.lat, data.lng], 15, {
                                                animate: true,
                                                duration: 2 // in seconds
                                            });
                                            
                                            L.tileLayer(
                                                'http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                                    maxZoom: 18,
                                                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                                                        'Imagery © <a href="https://maps.google.com/">Google Maps</a>',
                                                    tileSize: 512,
                                                    zoomOffset: -1,
                                                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                                                }).addTo(map);

                                                $.getJSON("/geojson/"+data.slug_kecamatan+"/desa-"+data.slug_desa+".geojson", function (data) {
                                                    geoLayer = L.geoJson(data, {
                                                        style: function (feature) {
                                                            return {
                                                                
                                                            }
                                                        },
                                                    }).addTo(map);
                                                });

                                                // L.marker([data.lat,  data.lng]).addTo(map)
                                                // .bindPopup('Desa '+data.nama_desa)
                                                // .openPopup();
                                        }
                                    }
                                });
                            });

                            // script untuk mengaupload gambar
                            function previewImage(){
                                const namaGambar = document.querySelector('#namaGambar');
                                // const labelGambar = document.querySelector('.custom-file-label');
                                const imgPreview = document.querySelector('.img-preview');

                                // mengambil nama file gambar
                                // labelGambar.textContent = namaGambar.files[0].name;

                                // merubah gambar preview
                                const fileGambar = new FileReader();
                                fileGambar.readAsDataURL(namaGambar.files[0]);
                                
                                fileGambar.onload = function(e){
                                    imgPreview.src = e.target.result;
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