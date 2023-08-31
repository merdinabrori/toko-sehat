<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container pt-3">
    <div class="row">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success py-1 mt-2" role="alert" id="ban-login">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php elseif (session()->getFlashdata('fail')) : ?>
            <div class="alert alert-danger py-1 mt-2" role="alert" id="ban-login">
                <?= session()->getFlashdata('fail'); ?>
            </div>
        <?php endif ?>
        <div class="col">
            <div class="card mt-5" style="width: 100%;">
                <div class="card-body">
                    <?php if ($items != null) :  ?>
                        <h4 class="card-title" style="text-align: center;">Dalam Proses</h4>
                        <a href="<?= base_url('admin/tambahProduk'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Produk</a>
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"></th>
                                    <th scope="col">Nama produk</th>
                                    <th scope="col">Harga satuan</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($items as $row) :
                                ?>
                                    <tr style="vertical-align: middle;">
                                        <th scope="row"><?= $i; ?></th>
                                        <td>
                                            <a href="<?= base_url('admin/ubahProduk/' . $row['id']); ?>" class="btn btn-success"><i class="fas fa-pen"></i></a>
                                            <a href="<?= base_url('admin/hapusProduk/' . $row['id']); ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                        <td><?= $row['nama_item']; ?></td>
                                        <td><?= $row['harga']; ?></td>
                                        <td><?= $row['kategori']; ?></td>
                                        <td>Tersisa : <?= $row['stok']; ?></td>
                                    </tr>
                                <?php $i += 1;
                                endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <h4 class="card-title" style="text-align: center;">Riwayat Pembelian Kosong.</h4>
                        <br>
                        <h6 class="card-title" style="text-align: center;">Silahkan berbelanja pada beranda.</h6>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>