<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Nota Pembelian</title>
</head>

<body>
    <center>
        <h2>Nota Pembelian</h2>
        <h3>Toko Sehat</h3>
    </center>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col d-flex">
                <div>
                    <p><b>Nama</b></p>
                    <p><b>E-mail</b></p>
                    <p><b>No HP</b></p>
                </div>
                <div class="mx-3">
                    <p><b>:</b></p>
                    <p><b>:</b></p>
                    <p><b>:</b></p>
                </div>
                <div>
                    <p><?= $user['username']; ?></p>
                    <p><?= $user['email']; ?></p>
                    <p><?= $user['noHP']; ?></p>
                </div>
            </div>
            <div class="col d-flex">
                <div>
                    <p><b>Tanggal</b></p>
                    <p><b>ID Pay-pal</b></p>
                </div>
                <div class="mx-3">
                    <p><b>:</b></p>
                    <p><b>:</b></p>
                </div>
                <div>
                    <p><?= date("H:i:s, d/m/Y", strtotime($tgl)); ?></p>
                    <p><?= $user['paypalID']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex">
                    <div>
                        <p><b>Alamat</b></p>
                    </div>
                    <div class="mx-3">
                        <p><b>:</b></p>
                    </div>
                    <div>
                        <p><?= ucwords($user['alamat'] . ', ' . $user['kota'] . ', ' . $user['provinsi']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        $total = 0;
                        foreach ($rincian as $row) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $row['nama_item']; ?></td>
                                <td>Rp<?= number_format($row['harga_satuan'], 2, ',', '.'); ?></td>
                                <td><?= $row['jumlah']; ?></td>
                                <td>Rp<?= number_format($row['sub_harga'], 2, ',', '.'); ?></td>
                            </tr>
                        <?php $i++;
                            $total += $row['sub_harga'];
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <p><b>Total pembayaran : </b>Rp<?= number_format($total, 2, ',', '.'); ?></p>
        </div>
        <br><br><br>
        <h3 class="text-end"><u>TANDA TANGAN TOKO</u></h3>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- perintah untuk mendownload/print -->
    <script>
        window.print();
    </script>
</body>

</html>