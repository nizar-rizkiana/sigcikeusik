<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>Data Lokasi</h1>
        </div>
        <a href="<?= base_url() ?>/input-lokasi" class="btn btn-primary"><i class="fas fa-plus-square"></i>&nbsp;Tambah Data Lokasi</a>
        <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success w-100 mt-4" role="alert">
                <?= session()->getFlashdata('sukses') ?>
            </div>
        <?php endif; ?>
        <br>
        <br>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <form>
                        <input type="text" class="form-control" name="keyword" placeholder="Cari data lokasi ...">
                    </form>
                    </div>
                    <div class="card-body p-2 p-md-4 overflow-auto">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lokasi</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($lokasi as $lok) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $lok['nama_lokasi'] ?></td>
                                    <td><?= $lok['lat'] ?></td>
                                    <td><?= $lok['lng'] ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>/edit-lokasi/<?= $lok['id_lokasi']; ?>" class="btn btn-warning me-0 me-md-4 my-2 my-md-0 "><i class="fas fa-edit"></i></a>
                                        <form action="<?= base_url() ?>/lokasi/delete/<?= $lok['id_lokasi']; ?>" method="post" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?');"><i class="fas fa-trash-alt"></i></button>
                                        </form>
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