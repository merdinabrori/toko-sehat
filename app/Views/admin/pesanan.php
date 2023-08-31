<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<?php

function getNamaUser($data, $uid)
{
    foreach ($data as $user) {
        if ($user['uid'] == $uid) {
            return ucwords($user['username']);
        }
    }
}

function getAlamat($data, $uid)
{
    foreach ($data as $user) {
        if ($user['uid'] == $uid) {
            return ucwords($user['alamat'] . ', ' . $user['kota'] . ', ' . $user['provinsi']);
        }
    }
}
?>
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
                                    <th scope="col">Tanggal pemesanan</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Total bayar</th>
                                    <th class="text-center" scope="col">Aksi</th>
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
                                            <td><?= getNamaUser($pelanggan, $row['uid']); ?></td>
                                            <td><?= getAlamat($pelanggan, $row['uid']); ?></td>
                                            <td class="text-end">Rp<?= number_format($row['total_harga'], 2, ',', '.'); ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('admin/verifPesanan/' . $row['id']); ?>" class="btn btn-success" style="padding: -1px;" onclick="return confirm('Verifikasi pesanan ini?');">Verifikasi</a>
                                                <a href="<?= base_url('admin/cancelPesanan/' . $row['id']); ?>" class="btn btn-danger" style="padding: -1px;" onclick="return confirm('Batalkan pesanan ini?');">Batalkan</a>
                                            </td>
                                        </tr>
                                <?php $i += 1;
                                    endif;
                                endforeach; ?>
                            </tbody>
                        </table>
                        <br>
                        <hr><!-- tabel untuk pesanan dibatalkan -->
                        <h4 class="card-title" style="text-align: center;">Pesanan Dibatalkan</h4>
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal dibatalkan</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Total bayar</th>
                                    <th class="text-center" scope="col">Aksi</th>
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
                                            <td><?= getNamaUser($pelanggan, $row['uid']); ?></td>
                                            <td><?= getAlamat($pelanggan, $row['uid']); ?></td>
                                            <td class="text-end">Rp<?= number_format($row['total_harga'], 2, ',', '.'); ?></td>
                                            <td class="text-center">
                                                <?php if ($row['status'] == (-2)) : ?>
                                                    <a href="<?= base_url('admin/undoPesanan/' . $row['id']); ?>" class="btn btn-success" style="padding: -1px;" onclick="return confirm('Undo pembatalan pesanan ini?');"><i class="fas fa-undo-alt"></i></a>
                                                <?php else : ?>
                                                    <p>Pesanan dibatalkan oleh Pelanggan</p>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                <?php $i += 1;
                                    endif;
                                endforeach; ?>
                            </tbody>
                        </table>
                        <br>
                        <hr><!-- tabel untuk pesanan telah dikirim -->
                        <h4 class="card-title" style="text-align: center;">Telah Dikirim</h4>
                        <table class="table mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal verifikasi</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Total bayar</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($nota as $row) :
                                    if ($row['status'] == 2) :
                                ?>
                                        <tr style="vertical-align: middle;">
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= date('H:i:s, d-m-Y', strtotime($row['tgl'])); ?></td>
                                            <td><?= getNamaUser($pelanggan, $row['uid']); ?></td>
                                            <td><?= getAlamat($pelanggan, $row['uid']); ?></td>
                                            <td class="text-end">Rp<?= number_format($row['total_harga'], 2, ',', '.'); ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('admin/undoPesanan/' . $row['id']); ?>" class="btn btn-danger" style="padding: -1px;" onclick="return confirm('Pesanan sudah tercatat terkirim. Undo pesanan ini?');"><i class="fas fa-undo-alt"></i></a>
                                            </td>
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