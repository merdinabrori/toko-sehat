<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container pt-3">
    <div class="row center">
        <div class="col">
            <div class="card mb-3 mt-5" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/item/<?= $item["gambar"]; ?>" class="img-fluid rounded-start border border-secondary" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title"><?= ucwords($item["nama_item"]); ?></h3>
                            <p class="card-text"><?= ucfirst($item["deskripsi"]); ?></p>
                            <h5 class="card-title"><small class="text-muted">Rp<?= number_format($item["harga"], 0, "", "."); ?> | Tersisa <?= ($item['stok'] != null || $item['stok'] > 0) ? $item['stok'] : '-'; ?></small></h5>
                            <a href="#" class="btn btn-success <?= ($item['stok'] < 0) ? 'disabled' : ''; ?>"><b>+</b> Keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>