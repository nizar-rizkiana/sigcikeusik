<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SIG CIKEUSIK</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/fontawesome-5.15.1/css/all.min.css">
  
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/components.css">
  <link rel="stylesheet" href="<?= base_url() ?>/leaflet/leaflet.css">
  <link rel="stylesheet" href="<?= base_url() ?>/leaflet-search/src/leaflet-search.css">
  <script src="<?= base_url() ?>/assets/js/jquery-3.3.1.min.js"></script>
  
  <script src="<?= base_url() ?>/leaflet/leaflet.js"></script>

  <script src="<?= base_url() ?>/leaflet-search/src/leaflet-search.js"></script>

  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<!-- Load Esri Leaflet from CDN -->
  <script src="https://unpkg.com/esri-leaflet@3.0.8/dist/esri-leaflet.js"
    integrity="sha512-E0DKVahIg0p1UHR2Kf9NX7x7TUewJb30mxkxEm2qOYTVJObgsAGpEol9F6iK6oefCbkJiA4/i6fnTHzM6H1kEA=="
    crossorigin=""></script>

<!-- Load Esri Leaflet Geocoder from CDN -->
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.css"
    integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
    crossorigin="">
  <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.js"
    integrity="sha512-mwRt9Y/qhSlNH3VWCNNHrCwquLLU+dTbmMxVud/GcnbXfOKJ35sznUmt3yM39cMlHR2sHbV9ymIpIMDpKg4kKw=="
    crossorigin=""></script>

<style>
  .dropdown-menu.show{
    right: 0;
    left: auto;
  }
  @media screen and (max-width: 576px) {
    #map{
      height: 300px;
    }
  }
</style>

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg bg-primary"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline me-auto">
          <ul class="navbar-nav me-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-end">
          <li class="dropdown"><a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url() ?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= session()->get('username') ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="javascript:void(0)" class="dropdown-item has-icon">
                <i class="far fa-user"></i> <?= session()->get('username') ?>
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url() ?>/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url() ?>/dashboard">SIG CIKEUSIK</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url() ?>/dashboard">SC</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="<?= base_url() ?>/dashboard"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

            <li class="menu-header">Menu</li>
            <!-- <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Layout</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
              </ul>
            </li> -->
            <!-- <li>
              <a class="nav-link" href="/data-banjir"><i class="fas fa-cloud-rain"></i><span>Data Banjir</span></a>
            </li> -->
            <li>
              <a class="nav-link" href="<?= base_url() ?>/sekolah"><i class="fas fa-school"></i><span>Data Sekolah</span></a>
            </li>
            <li>
              <a class="nav-link" href="<?= base_url() ?>/jenjang"><i class="fas fa-chart-bar"></i><span>Data Jenjang</span></a>
            </li>
            <li>
              <a class="nav-link" href="<?= base_url() ?>/desa"><i class="fas fa-map-marked"></i><span>Data Desa</span></a>
            </li>
            <li>
              <a class="nav-link" href="<?= base_url() ?>/tambah-admin"><i class="fas fa-user"></i><span>Tambah admin</span></a>
            </li>
            <!-- <li>
              <a class="nav-link" href="/desa"><i class="fas fa-chart-line"></i><span>Data Desa</span></a>
            </li>
            <li>
              <a class="nav-link" href="/kecamatan"><i class="fas fa-chart-bar"></i><span>Data Kecamatan</span></a>
            </li> -->
            <!-- <li>
              <a class="nav-link" href="/tambah-operator"><i class="fas fa-user"></i><span>Tambah Operator</span></a>
            </li> -->
          </ul>
        </aside>
      </div>

      <?= $this->renderSection('content'); ?>

      <footer class="main-footer">
        <div class="footer-start">
          Copyright &copy; 2022 <div class="kbullet"></div> 
        </div>
        <div class="footer-end">
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/assets/js/popper.min.js">
  </script>
  <script src="<?= base_url() ?>/bootstrap/js/bootstrap.min.js">
  </script>
  <script src="<?= base_url() ?>/assets/js/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/moment.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/stisla.js"></script>


  <!-- Template JS File -->
  <script src="<?= base_url() ?>/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url() ?>/assets/js/page/index-0.js"></script>
  

  <script>
  

    // var marker = L.marker([51.5, -0.09]).addTo(map)
    //   .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

    // var circle = L.circle([51.508, -0.11], {
    //   color: 'red',
    //   fillColor: '#f03',
    //   fillOpacity: 0.5,
    //   radius: 500
    // }).addTo(map).bindPopup('I am a circle.');

    // var polygon = L.polygon([
    //   [51.509, -0.08],
    //   [51.503, -0.06],
    //   [51.51, -0.047]
    // ]).addTo(map).bindPopup('I am a polygon.');


    // var popup = L.popup()
    //   .setLatLng([51.513, -0.09])
    //   .setContent('I am a standalone popup.')
    //   .openOn(map);

    // function onMapClick(e) {
    //   popup
    //     .setLatLng(e.latlng)
    //     .setContent('You clicked the map at ' + e.latlng.toString())
    //     .openOn(map);
    // }

    // map.on('click', onMapClick);
  </script>
</body>

</html>