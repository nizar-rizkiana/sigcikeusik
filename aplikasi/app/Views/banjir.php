<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>
<div class="main-content">

    
    <section class="section">
        <div class="section-header">
            <h1>Data Banjir</h1>
        </div>
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInput"><i class="fas fa-plus-square"></i>&nbsp;Tambah Data Banjir</button> -->
        <a href="/input-banjir" class="btn btn-primary"><i class="fas fa-plus-square"></i>&nbsp;Tambah Data Banjir</a>
        <br>
        <br>
        <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('sukses'); ?>
            </div>
            <br>
            <br>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <form>
                        <input type="text" class="form-control" name="keyword" placeholder="Cari data banjir ...">
                    </form>
                    </div>
                    <div class="card-body p-2 p-md-4 overflow-auto">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kecamatan</th>
                                    <th>Desa</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no= 1; ?>
                                <?php foreach($banjir as $ban) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $ban['nama_kecamatan'] ?></td>
                                    <td><?= $ban['nama_desa'] ?></td>
                                    <td><?= $ban['alamat'] ?></td>
                                    <td>
                                        <?php if($ban['ketinggian'] < 50) : ?>
                                        <span class="bg-info p-2 text-white fw-bold">Rendah</span>
                                        <?php elseif($ban['ketinggian'] > 50) : ?>
                                        <span class="bg-warning p-2 text-white fw-bold">Sedang</span>
                                        <?php elseif($ban['ketinggian'] > 100) : ?>
                                        <span class="bg-danger p-2 text-white fw-bold">Tinggi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $ban['updated_at'] ?></td>
                                    <td class="py-2">
                                        <a href="/edit-banjir/<?= $ban['id_banjir'] ?>" class="btn btn-warning mb-2 me-2"><i class="fas fa-edit"></i></a>
                                        <form action="/banjir/delete/<?= $ban['id_banjir']; ?>" method="post" class="d-inline">
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
                <?= $pager->links('banjir', 'pagination'); ?>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>