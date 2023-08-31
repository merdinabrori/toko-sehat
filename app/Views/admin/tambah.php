<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row mx-auto" style="max-width: 80%;">
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
            <h4 class="text-center mb-3">Tambah Produk</h4>
            <hr>
            <form method="post" action="<?= base_url('admin/add'); ?>">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nama_item" class="col-sm-2 col-form-label">Nama Item</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('nama_item')) ? 'is-invalid' : ''; ?>" id="nama_item" name="nama_item" value="<?= old('nama_item'); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_item'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi"><?= old('deskripsi'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="harga" class="col-sm-2 col-form-label">Harga Satuan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : ''; ?>" id="harga" name="harga" value="<?= old('harga'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" id="kategori" name="kategori" value="<?= old('kategori'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('kategori'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stok" class="col-sm-2 col-form-label">Stok Tersisa</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" value="<?= old('stok'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('stok'); ?>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>