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
                    <?php if ($keranjang != null) :  ?>
                        <h4 class="card-title" style="text-align: center;">Daftar Keranjang</h4>
                        <form action="<?= base_url('costumer/checkout'); ?>" method="POST">
                            <table class="table mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Harga satuan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga x Jumlah</th>
                                        <th scope="col">Checkbox</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($keranjang as $row) :
                                    ?>
                                        <tr style="vertical-align: middle;">
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $items[$i - 1][$row['id']]; ?></td>
                                            <td>Rp<?= number_format($items[$i - 1]['harga'], 2, ',', '.'); ?></td>
                                            <td><?= $row['jumlah']; ?></td>
                                            <td>Rp<?= number_format($row['sub_harga'], 2, ',', '.'); ?></td>
                                            <td>
                                                <!-- <div class="form-check"> -->
                                                <input class="form-check-input mt-2" type="checkbox" value="<?= $row['id']; ?>" name="<?= $row['id']; ?>" id="<?= $row['id']; ?>" checked>
                                                <label class="form-check-label" for="<?= $row['id']; ?>">Bayar? | </label>
                                                <a href="<?= base_url('costumer/hapusKeranjang/' . $row['id']); ?>" class="btn btn-danger" style="padding: -1px;" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');"><i class="fas fa-trash-alt"></i></a>
                                                <!-- </div> -->
                                            </td>
                                        </tr>
                                    <?php $i += 1;
                                    endforeach; ?>
                                </tbody>
                            </table>
                            <div class="d-grid">
                                <button type="" class="btn btn-primary" <?= ($keranjang != null) ? "it's not null" : "disabled"; ?> onclick="return confirm('Apakah Anda yakin ingin melakukan pembayaran terhadap produk ini?');">Checkout</button>
                            </div>
                        </form>
                    <?php else : ?>
                        <h4 class="card-title" style="text-align: center;">Daftar Keranjang Kosong.</h4>
                        <br>
                        <h6 class="card-title" style="text-align: center;">Silahkan berbelanja pada beranda.</h6>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>