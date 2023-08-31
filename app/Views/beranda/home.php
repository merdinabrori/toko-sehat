<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container pt-3">
    <div class="row mb-3">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success py-1 mt-2" role="alert" id="ban-login">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif ?>
        <div class="col">
            <h1>Daftar Produk</h1>
        </div>
        <!-- <div class="col-sm1">
            <ul class="list-inline my-1">
                <li class="list-inline-item"><button class="btn btn-secondary">ahoy</button></li>
                <li class="list-inline-item"><button class="btn btn-secondary">ahoy</button></li>
                <li class="list-inline-item">ahoy</li>
                <li class="list-inline-item">ahoy</li>
                <li class="list-inline-item">ahoy</li>
            </ul>
        </div> -->
    </div>
    <div class="row" id="daftar-menu">
        <?php foreach ($items as $row) : ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="/img/item/<?= $row["gambar"]; ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= ucwords($row["nama_item"]); ?></h5>
                        <p class="card-text"><?= ($row["deskripsi"]) ? ucfirst($row["deskripsi"]) : '-'; ?></p>
                        <h5>Rp<?= number_format($row["harga"], 0, "", "."); ?> | Tersisa <?= ($row['stok'] != null || $row['stok'] > 0) ? $row['stok'] : '-'; ?></h5>
                        <a href="<?= base_url("produk/" . $row['id']); ?>" class="btn btn-primary <?= ($row['stok'] < 0) ? 'disabled' : ''; ?>">Detail</a>
                        <?php if (session('uid') == null) : ?>
                            <a href="<?= base_url('auth'); ?>" class="btn btn-success" onclick="return confirm('Untuk melakukan transaksi Anda perlu melalkukan Login. Lakukan Login?');"><b>+</b> Keranjang</a>
                        <?php else : ?>
                            <a href="<?= base_url('costumer/tambahKeranjang/' . $row['id']); ?>" class="btn btn-success" onclick="return confirm('Anda yakin ingin membeli produk ini?');"><b>+</b> Keranjang</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection(); ?>