<?php
$daftarProv = [
    'Aceh', 'Sumatera Utara', 'Kepulauan Riau', 'Lampung', 'DKI Jakarta', 'Banten', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur', 'Bali', 'Nusa Tenggara Timur', 'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Timur', 'Sulawesi Barat', 'Sulawesi Tengah', 'Maluku', 'Maluk Utara', 'Papua', 'Papua Barat'
];

$daftarKota = ['Banda Aceh', 'Medan', 'Padang', 'Pangkal Pinang', 'Jakarta', 'Bandung', 'Semarang', 'Yogyakarta', 'Surabaya'];
?>
<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mx-auto">
    <div class="row center">
        <div class="col">
            <div class="card mb-3 mt-5 p-2" style="max-width: 60%;">
                <h1 class="mb-3" style="text-align: center; color: black; margin-top: -0.1rem;">Registrasi Akun</h1>
                <form method="post" action="<?= base_url('auth/valRegis'); ?>">
                    <?= csrf_field(); ?>
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username'); ?>" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pw" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control <?= ($validation->hasError('pw')) ? 'is-invalid' : ''; ?>" id="pw" name="pw">
                            <div class="invalid-feedback">
                                <?= $validation->getError('pw'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="pw2" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-10 mt-2">
                            <input type="password" class="form-control <?= ($validation->hasError('pw2')) ? 'is-invalid' : ''; ?>" id="pw2" name="pw2">
                            <div class="invalid-feedback">
                                <?= $validation->getError('pw2'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="dob" class="col-sm-2 col-form-label">Tanggal lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control <?= ($validation->hasError('dob')) ? 'is-invalid' : ''; ?>" id="dob" name="dob" value="<?= old('dob'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('dob'); ?>
                            </div>
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="1" checked>
                                <label class="form-check-label" for="male">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="0">
                                <label class="form-check-label" for="female">
                                    Wanita
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" cols="30" rows="3"><?= old('alamat'); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-10">
                            <input list="provinsi" type="text" class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" name="provinsi" value="<?= old('provinsi'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('provinsi'); ?>
                            </div>
                            <datalist id="provinsi">
                                <?php foreach ($daftarProv as $prov) : ?>
                                    <option value="<?= $prov; ?>"></option>
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kota" class="col-sm-2 col-form-label">Kabupaten/ Kota</label>
                        <div class="col-sm-10 mt-2">
                            <input list="kota" type="text" class="form-control <?= ($validation->hasError('kota')) ? 'is-invalid' : ''; ?>" name="kota" value="<?= old('kota'); ?>">
                            <datalist id="kota">
                                <?php foreach ($daftarKota as $kot) : ?>
                                    <option value="<?= $kot; ?>"></option>
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="noHP" class="col-sm-2 col-form-label">Nomor HP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($validation->hasError('noHP')) ? 'is-invalid' : ''; ?>" id="noHP" name="noHP" value="<?= old('noHP'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('noHP'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="paypal" class="col-sm-2 col-form-label">Pay-pal ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control  <?= ($validation->hasError('paypal')) ? 'is-invalid' : ''; ?>" id="paypal" name="paypal" value="<?= old('paypal'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('paypal'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>