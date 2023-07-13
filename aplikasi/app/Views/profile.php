<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
              <div class="breadcrumb-item">Profile</div>
            </div>
          </div>
          <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('sukses'); ?>
            </div>
        <?php endif; ?>
          <div class="section-body">
            <h2 class="section-title"><?= $operator['nama']; ?></h2>
            <p class="section-lead">
              Tetapkan informasi diri anda di halaman ini
            </p>
            <form action="/operator/update/<?= $operator['id_operator'] ?>" enctype="multipart/form-data" method="POST">
            <?= csrf_field(); ?>
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-8 mx-auto">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="/gambar-upload/avatar/<?= $operator['avatar'] ?>" class="rounded-circle profile-widget-picture" id="preview">
                    
                    <div class="profile profile-widget-items ps-4">
													<input type="file" accept="image/*" class="my-2 border border-primary rounded account-settings-fileinput <?= ($validation->hasError('avatar')) ? 'is-invalid' : ''; ?>" name="avatar" id="namaGambar" onchange="previewAvatar()">

												<div class="invalid-feedback">
													<?= $validation->getError('avatar'); ?>
												</div>
													<input type="hidden" name="gambarlama" value="<?= $operator['avatar']; ?>">
                    </div>
                  </div>
                  <div class="profile-widget-description">

                    <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Nama</label>
                            <input type="text" name="username" class="form-control" value="<?= $operator['nama'] ?>" required>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" value="<?= $operator['email'] ?>" required>
                            <div class="invalid-feedback">
                              <?= $validation->getError('email') ?>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-7 col-12">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?= $operator['alamat'] ?>" required>
                          </div>
                          <div class="form-group col-md-5 col-12">
                            <label>Phone</label>
                            <input type="tel" name="nomor" class="form-control <?= ($validation->hasError('nomor')) ? 'is-invalid' : '' ?>" value="<?= $operator['no_hp'] ?>" required>
                            <div class="invalid-feedback">
                              <?= $validation->getError('nomor'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-12">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" value="<?= $operator['jabatan'] ?>" required>
                          </div>
                        
                    </div>
                    <div class="card-footer text-right">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                  <!-- </div> -->
                  
                </div>
              </div>
            </div>
            </form>
          </div>
        </section>
      </div>

      <script>
        function previewAvatar(){
          const namaGambar = document.querySelector('#namaGambar');
          const imgPreview = document.querySelector('#preview');

          const fileGambar = new FileReader();
          fileGambar.readAsDataURL(namaGambar.files[0]);

          fileGambar.onload = function(e){
            imgPreview.src = e.target.result;
          }
        }
      </script>
<?= $this->endSection() ?>