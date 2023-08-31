<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container pt-3">
    <div class="row">
        <div class="col">
            <div class="card mt-5" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Hubungi Kami</h5>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <ul class="list" style="width: 35%; margin-left: -2rem;">
                        <li class="list"><i class="fas fa-phone-alt"></i> Telp. +62 822 4465 7351</li>
                        <li class="list"><i class="fab fa-facebook-square"></i> Toko Sehat</li>
                        <li class="list"><i class="fab fa-twitter"></i> @toko_sehat</li>
                        <li class="list"><i class="fab fa-instagram"></i> @toko.sehat</li>
                    </ul>
                    <h5 class="card-title mt-4">Lokasi Kami</h5>
                    <p class="card-text">Ruko Manyar Mas B7 no. 27, Menur Pumpungan, Kec. Sukolilo, Kota SBY, Jawa Timur 60118.</p>
                    <p class="card-text" style="margin-top: -1rem;">Buka <b>Senin - Sabtu</b>, hari libur nasional tutup.</p>
                    <p class="card-text" style="margin-top: -1rem;">07.00 - 21.00</p>
                    <!-- <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>