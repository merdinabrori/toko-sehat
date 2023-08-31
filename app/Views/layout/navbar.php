<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <img src="/img/logo.jpg" class="mx-auto d-block" id="profile" alt="Profil">
        <a class="navbar-brand" href="<?= base_url(); ?>"> <b>Toko Sehat</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php foreach ($tab_list as $tab => $val) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($tab == $subJudul) ? 'active disabled' : ''; ?> " href="<?= base_url($val); ?>"><?= $tab; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php if (session('id') != null || session('uid') != null) : ?>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/img/user/<?= session('foto'); ?>" class="mx-auto d-block" id="profile" alt="Profil">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark-start" aria-labelledby="navbarDarkDropdownMenuLink">
                            <?php if (session('uid') != null) : ?>
                                <li><a class="dropdown-item" href="<?= base_url('costumer'); ?>">Profil</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('costumer/keranjang'); ?>">Keranjang</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('costumer/nota'); ?>">Riwayat Pembelian</a></li>
                            <?php elseif (session('id') != null) : ?>
                                <li><a class="dropdown-item" href="<?= base_url('admin/profil'); ?>">Profil</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/pesanan'); ?>">Pesanan</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/produk'); ?>">Produk</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" onclick="return confirm('Apakah Anda yakin ingin melakukan Logout?');">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        <?php else : ?>
            <a href="<?= base_url('auth'); ?>" class="btn btn-light rounded-3" style="color: #0d6efd;">Login</a>
        <?php endif; ?>
    </div>
</nav>