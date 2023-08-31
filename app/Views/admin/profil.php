<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container pt-3">
    <div class="row center">
        <div class="col">
            <div class="card mb-3 mt-5" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/user/<?= $user['foto']; ?>" class="img-fluid rounded-start border border-secondary" style="border-radius: 50%;" alt="<?= ucwords($user['username']); ?>">
                    </div>
                    <div class="col-md-8 my-auto">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th>Username</th>
                                    <td>: <?= ucwords($user['username']); ?></td>
                                </tr>
                                <tr>
                                    <th>E-mail</th>
                                    <td>: <?= $user['email']; ?></td>
                                </tr>
                            </table>
                            <div class="d-grid gap-2 col-4 mx-auto">
                                <a href="<?= base_url('costumer/ubahProfil'); ?>" class="btn btn-primary rounded-3">Ubah data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>