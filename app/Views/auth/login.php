<?= $this->extend('layout/template_auth'); ?>

<?= $this->section('content'); ?>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Pesan -->
        <?php if (session()->getFlashdata('regisSuc')) : ?>
            <div class="alert alert-success py-1 m-0" role="alert" id="ban-login">
                <?= session()->getFlashdata('regisSuc'); ?>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('fail')) : ?>
            <div class="alert alert-danger py-1 m-0" role="alert" id="ban-login">
                <?= session()->getFlashdata('fail'); ?>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('loginFailed')) : ?>
            <div class="alert alert-danger py-1 m-0" role="alert" id="ban-login">
                <?= session()->getFlashdata('loginFailed'); ?>
            </div>
        <?php endif ?>

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="/img/logo.jpg" id="icon" alt="User Icon" style="max-width: 27%;" />
            <p>Selamat Datang di Toko Sehat</p>
        </div>

        <!-- Login Form -->
        <form method="POST" action="<?= base_url('auth/valLogin') ?>">
            <?= csrf_field(); ?>
            <input type="text" id="login" class="fadeIn second" name="email" placeholder="E-mail" autofocus>
            <input type="password" id="password" class="fadeIn third" name="pw" placeholder="Password">
            <button type="submit" class="fadeIn fourth btn btn-primary my-2">Login</button>
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="<?= base_url('auth/registrasi'); ?>">Tidak punya akun? Daftar disini</a>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>