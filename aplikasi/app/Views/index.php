<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-school"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Sekolah</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_sekolah; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-map"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Desa</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_desa; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-chart-bar"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Jenjang</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_jenjang; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Admin</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_admin; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </section>
      </div>
<?php $this->endSection(); ?>