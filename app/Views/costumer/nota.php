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
                    <?php if ($nota != null) :  ?>
                        <h4 class="card-title" style="text-align: center;">Dalam Proses</h4>
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Rincian</th>
                                    <th scope="col">Total bayar</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($nota as $row) :
                                    if ($row['status'] == 1) :
                                ?>
                                        <tr style="vertical-align: middle;">
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= date('H:i:s, d-m-Y', strtotime($row['tgl'])); ?></td>
                                            <td>
                                                <?php foreach ($items as $item) {
                                                    if ($item['id_nota'] == $row['id']) {
                                                        echo $item['nama_item'] . ', jumlah : ' . $item['jumlah'];
                                                        echo '<br>';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>Rp<?= number_format($row['total_harga'], 2, ',', '.'); ?></td>
                                            <td>Pesanan Anda dalam proses</td>
                                            <td>
                                                <a href="<?= base_url('costumer/hapusNota/' . $row['id']); ?>" class="btn btn-danger" style="padding: -1px;" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">Batalkan Pesanan</a>
                                            </td>
                                        </tr>
                                <?php $i += 1;
                                    endif;
                                endforeach; ?>
                            </tbody>
                        </table>
                        <br>
                        <hr><!-- tabel untuk pesanan telah dikirim -->
                        <h4 class="card-title" style="text-align: center;">Pesanan Telah Dikirim</h4>
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col"></th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Rincian</th>
                                    <th scope="col">Total bayar</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($nota as $row) :
                                    if ($row['status'] == 2) :
                                ?>
                                        <tr style="vertical-align: middle;">
                                            <th scope="row"><?= $i; ?></th>
                                            <td><a href="<?= base_url('costumer/cetakNota/' . $row['id']); ?>" class="btn btn-success">Cetak nota</a></td>
                                            <td><?= date('H:i:s, d-m-Y', strtotime($row['tgl'])); ?></td>
                                            <td>
                                                <?php foreach ($items as $item) {
                                                    if ($item['id_nota'] == $row['id']) {
                                                        echo $item['nama_item'] . ', jumlah : ' . $item['jumlah'];
                                                        echo '<br>';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>Rp<?= number_format($row['total_harga'], 2, ',', '.'); ?></td>
                                            <td>Pesanan Anda telah dikirim</td>
                                        </tr>
                                <?php $i += 1;
                                    endif;
                                endforeach; ?>
                            </tbody>
                        </table>
                        <br>
                        <hr><!-- tabel untuk pesanan yang dibatalkan -->
                        <h4 class="card-title" style="text-align: center;">Pesanan Dibatalkan</h4>
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Rincian</th>
                                    <th scope="col">Total bayar</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($nota as $row) :
                                    if ($row['status'] < 0) :
                                ?>
                                        <tr style="vertical-align: middle;">
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= date('H:i:s, d-m-Y', strtotime($row['tgl'])); ?></td>
                                            <td>
                                                <?php foreach ($items as $item) {
                                                    if ($item['id_nota'] == $row['id']) {
                                                        echo $item['nama_item'] . ', jumlah : ' . $item['jumlah'];
                                                        echo '<br>';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>Rp<?= number_format($row['total_harga'], 2, ',', '.'); ?></td>
                                            <td><?= ($row['status'] == (-1)) ? 'Pesanan dibatalkan' : 'Pesanan dibatalkan karena stok produk habis'; ?></td>
                                        </tr>
                                <?php $i += 1;
                                    endif;
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