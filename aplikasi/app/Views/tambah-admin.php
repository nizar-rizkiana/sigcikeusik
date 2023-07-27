<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-content">

    <!-- Modal input data kecamatan -->
    <div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="modalInputLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url() ?>/auth/save" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInputLabel">Tambah Data Admin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="level" class="form-label mt-4">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Kepala Dinas</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('level'); ?>
                        </div>
                        <label for="nama_admin" class="form-label">Nama Admin</label>
                        <input type="text" name="nama_admin" class="form-control <?= ($validation->hasError('nama_admin')) ? 'is-invalid' : '' ?>" id="nama_admin" placeholder="Masukkan Nama Admin" value="<?= old('nama_admin') ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_admin'); ?>
                        </div>
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="username" placeholder="Masukkan username" value="<?= old('username') ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                        
                        <label for="password" class="form-label mt-4">Password</label>
                        <input type="text" name="password" class="form-control" id="password" placeholder="Masukkan Password" value="<?= old('password') ?>" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit data admin -->
    <?php foreach($admin as $adm) : ?>
    <div class="modal fade" id="modalEdit<?= $adm['id_admin'] ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $adm['id_admin'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url() ?>/auth/edit/<?= $adm['id_admin'] ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="password_lama" value="<?= $adm['password'] ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel<?= $adm['id_admin'] ?>">Update Data Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="level" class="form-label mt-4">Level</label>
                    <select name="level" id="level" class="form-control">
                        <option value="1" <?= ($adm['level'] == 1) ? 'selected' : '' ?>>Admin</option>
                        <option value="2" <?= ($adm['level'] == 2) ? 'selected' : '' ?>>Kepala Dinas</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('level'); ?>
                    </div>
                    <label for="nama_admin" class="form-label">Nama Admin</label>
                    <input type="text" name="nama_admin" class="form-control <?= ($validation->hasError('nama_admin')) ? 'is-invalid' : '' ?>" id="nama_admin" placeholder="Masukkan Nama Admin" value="<?= old('nama_admin', $adm['nama_admin']) ?>" required>
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_admin'); ?>
                    </div>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="username" placeholder="Masukkan username .." value="<?= (old('username')) ? old('username') : $adm['username']; ?>" required>
                    <div class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                    <label for="password" class="form-label mt-4">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password Baru" value="<?= old('password') ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <section class="section">
        <div class="section-header">
            <h1>Data Admin</h1>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInput"><i class="fas fa-plus-square"></i>&nbsp;Tambah Admin</button>
        
        <br>
        <br>
        <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('sukses'); ?>
            </div>
            <br>
            <br>
        <?php endif; ?>
        <?php if($validation->hasError('email')) : ?>
            <div class="alert alert-danger" role="alert">
                Gagal Menambahkan Data admin
            </div>
            <br>
            <br>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body p-2 p-md-4 overflow-auto">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th>Username</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($admin as $adm) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <th><?= $adm['nama_admin'] ?></th>
                                    <td><?= ($adm['level'] == 1 ) ? 'Admin' : 'Kepala Dinas' ?></td>
                                    <td><?= $adm['username'] ?></td>
                                    <td>
                                    <?php if(session()->get('level') == 1) : ?>
                                        <button type="button" class="btn btn-warning me-4" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $adm['id_admin'] ?>"><i class="fas fa-edit"></i></button>
                                        <form action="<?= base_url() ?>/auth/delete/<?= $adm['id_admin']; ?>" method="post" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?');"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- pagination -->
                

            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>