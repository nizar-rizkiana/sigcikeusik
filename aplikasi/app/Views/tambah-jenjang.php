<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-content">

    <!-- Modal input data kecamatan -->
    <div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="modalInputLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url() ?>/jenjang/save" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInputLabel">Tambah Data Jenjang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="jenjang" class="form-label">Nama jenjang</label>
                        <input type="text" name="jenjang" class="form-control <?= ($validation->hasError('jenjang')) ? 'is-invalid' : '' ?>" id="jenjang" placeholder="Masukkan jenjang" value="<?= old('jenjang') ?>" required>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jenjang'); ?>
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

    <!-- Modal edit data jenjang -->
    <?php foreach($jenjang as $d) : ?>
    <div class="modal fade" id="modalEdit<?= $d['id_jenjang'] ?>" tabindex="-1" aria-labelledby="modalEditLabel<?= $d['id_jenjang'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url() ?>/jenjang/edit/<?= $d['id_jenjang'] ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="datalama" value="<?= $d['jenjang'] ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel<?= $d['id_jenjang'] ?>">Update Data jenjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="jenjang" class="form-label">Nama jenjang</label>
                    <input type="text" name="jenjang" class="form-control <?= ($validation->hasError('jenjang')) ? 'is-invalid' : '' ?>" id="jenjang" placeholder="Masukkan jenjang .." value="<?= (old('jenjang')) ? old('jenjang') : $d['jenjang']; ?>" required>
                    <div class="invalid-feedback">
                        <?= $validation->getError('jenjang'); ?>
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
            <h1>Data jenjang</h1>
        </div>
        <?php if(session()->get('level') == 1) : ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInput"><i class="fas fa-plus-square"></i>&nbsp;Tambah jenjang</button>
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
                                    <th>Nama jenjang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($jenjang as $d) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $d['jenjang'] ?></td>
                                    <td>
                                        <?php if(session()->get('level') == 1) : ?>
                                        <button type="button" class="btn btn-warning me-4" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $d['id_jenjang'] ?>"><i class="fas fa-edit"></i></button>
                                        <form action="<?= base_url() ?>/jenjang/delete/<?= $d['id_jenjang']; ?>" method="post" class="d-inline">
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