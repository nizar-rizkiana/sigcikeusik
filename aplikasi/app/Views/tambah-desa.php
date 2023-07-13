<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-content">

    <!-- Modal input data kecamatan -->
    <div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="modalInputLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url() ?>/desa/save" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInputLabel">Tambah Data Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="desa" class="form-label">Nama Desa</label>
                        <input type="text" name="desa" class="form-control <?= ($validation->hasError('desa')) ? 'is-invalid' : '' ?>" id="desa" placeholder="Masukkan desa" value="<?= old('desa') ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('desa'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit data desa -->
    <?php foreach($desa as $d) : ?>
    <div class="modal fade" id="modalEdit<?= $d['id_desa'] ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $d['id_desa'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url() ?>/desa/edit/<?= $d['id_desa'] ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="datalama" value="<?= $d['nama_desa'] ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel<?= $d['id_desa'] ?>">Update Data Desa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="desa" class="form-label">Nama Desa</label>
                    <input type="text" name="desa" class="form-control <?= ($validation->hasError('desa')) ? 'is-invalid' : '' ?>" id="desa" placeholder="Masukkan desa .." value="<?= (old('desa')) ? old('desa') : $d['nama_desa']; ?>" required>
                    <div class="invalid-feedback">
                        <?= $validation->getError('desa'); ?>
                    </div>
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
            <h1>Data Desa di Kec. Cikeusik</h1>
        </div>
        <?php if(session()->get('level') == 1) : ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInput"><i class="fas fa-plus-square"></i>&nbsp;Tambah Desa</button>
        <?php endif; ?>
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
                    <div class="card-body p-2 p-md-4 overflow-auto">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Desa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($desa as $d) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $d['nama_desa'] ?></td>
                                    <td>
                                        <?php if(session()->get('level') == 1) : ?>
                                        <button type="button" class="btn btn-warning me-4" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $d['id_desa'] ?>"><i class="fas fa-edit"></i></button>
                                        <form action="<?= base_url() ?>/desa/delete/<?= $d['id_desa']; ?>" method="post" class="d-inline">
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