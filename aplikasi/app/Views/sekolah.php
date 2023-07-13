<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>Data Sekolah</h1>
        </div>
        <?php if(session()->get('level') == 1) : ?>
            <a href="<?= base_url() ?>/tambah-sekolah" class="btn btn-primary"><i class="fas fa-plus-square"></i>&nbsp;Tambah Sekolah</a>
        <?php endif; ?>
        <a href="<?= base_url() ?>/cetak" class="btn btn-warning"><i class="fas fa-print"></i>&nbsp;Cetak Data</a>
        
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
                                    <th>Nama Sekolah</th>
                                    <th>Jenjang</th>
                                    <th>Akreditasi</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($sekolah as $s) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $s['nama_sekolah'] ?></td>
                                    <td><?= $s['jenjang'] ?></td>
                                    <td><?= $s['akreditasi'] ?></td>
                                    <td><?= $s['alamat'] ?></td>
                                    <td>
                                        <?php if(session()->get('level') == 1) : ?>
                                        <a href="<?= base_url() ?>/sekolah/edit/<?= $s['id_sekolah'] ?>" class="btn btn-warning me-4"><i class="fas fa-edit"></i></a>
                                        <form action="<?= base_url() ?>/sekolah/delete/<?= $s['id_sekolah']; ?>" method="post" class="d-inline">
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