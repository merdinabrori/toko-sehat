-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Okt 2021 pada 18.24
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko-sehat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pw` varchar(256) NOT NULL,
  `foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `pw`, `foto`) VALUES
(1, 'admin', 'admin@toko.sehat.com', '$2y$10$UFlDFruUUeIJOz9FxIBqKey0joLRH7j63PS93CkCbQ5vxjIkFgfo2', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `costumer`
--

CREATE TABLE `costumer` (
  `uid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pw` varchar(256) NOT NULL,
  `dob` date NOT NULL,
  `gender` int(1) NOT NULL COMMENT '1 untuk male, 0 untuk female',
  `alamat` varchar(256) NOT NULL,
  `provinsi` varchar(150) NOT NULL,
  `kota` varchar(150) NOT NULL,
  `noHP` varchar(12) NOT NULL,
  `paypalID` varchar(200) DEFAULT NULL,
  `foto` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `costumer`
--

INSERT INTO `costumer` (`uid`, `username`, `email`, `pw`, `dob`, `gender`, `alamat`, `provinsi`, `kota`, `noHP`, `paypalID`, `foto`) VALUES
(1, 'costumer 1', 'costumer1@gmail.com', '$2y$10$AraCwXZJgY4I4qFoLlQkE.xaEe0kd2rqcs9PGVyYhm8xKPS8KfR8.', '1993-08-11', 1, 'Jalan semarang 27', 'Jawa Timur', 'Surabaya', '081234567890', 'costumer1@gmail.com', 'default.jpg'),
(2, 'costumer 2', 'costumer2@gmail.com', '$2y$10$IDI8kzgK4dhf84paOt/A7Oks2Y4mfCWXRQUtWn18VhhnQV4FU/B0a', '2021-10-14', 0, 'Jalan Gedung Cowek 21', 'Jawa Timur', 'Surabaya', '081234567891', 'costumer2@gmail.com', 'default.jpg'),
(3, 'Muhammad Ali', 'ali@gmail.com', '$2y$10$Wu0tIwOWq8RjXCnu.9lIK.Y8to.aXofTmdMKkcOW0w9aiMf/85u1O', '1987-07-22', 1, 'Jalan Kenjeran 31', 'Jawa Timur', 'Jember', '081234567887', 'ali@gmail.com', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `nama_item` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`id`, `nama_item`, `deskripsi`, `harga`, `kategori`, `stok`, `gambar`) VALUES
(1, 'korset lutut regular', 'alat bantu lutut untuk meredakan rasa sakit.', 50000, 'korset', 5, 'korset-lutut-reguler.jpg'),
(2, 'korset lutut genomotion', 'alat bantu lutut dilengkapi dengan teknologi infra merah untuk meredakan rasa sakit dan melancarkan peredaran darah', 95000, 'korset', 7, 'actimove-genumotion.png'),
(5, 'tongkat duduk', 'tongkat untuk membantu jalan dilengkapi kursi lipat.', 150000, 'alat bantu jalan', 4, 'tongkat-duduk.jpg'),
(6, 'alat bantu jalan 4 kaki', 'alat bantu jalan dengan 4 kaki penyokong.', 350000, 'alat bantu jalan', 6, 'alat-bantu-jalan-abj-41-0.jpg'),
(7, 'tongkat ketiak', 'tongkat dengan bahan ringan dan kuat untuk membantu mobilitas Anda. Produk dijual secara sepasang.', 200000, 'alat bantu jalan', 3, 'tongkat-ketiak-abj-43.jpg'),
(8, 'tongkat siku', 'tongkat pembantu mobilitas anda dengan pegangan yang lebih nyaman untuk cedera jangka panjang. Harga tertera merupakan harga per buah.', 300000, 'alat bantu jalan', 6, 'tongkat-siku-abj-44.jpg'),
(9, 'kursi roda baja', 'kursi roda dengan bahan baja ringan.', 900000, 'kursi roda', 3, 'kursi-roda-galaxis-sm-8002.jpg'),
(10, 'kursi roda cerebral palsy', 'kursi roda untuk membantu aktivitas dan terapi bagi pasien cerebral palsy. Dilengkapi dengan sabuk untuk menahan tubuh.', 6500000, 'kursi roda', 2, 'kursi-roda-cerebral-palsy.jpg'),
(11, 'responder bag', 'tas selempang dengan kapasitas 50 Liter untuk membawa alat p3k.', 225000, 'p3k', 8, 'responder-bag-promo-murah.png'),
(12, 'anesthesia unit', 'satu set alat bantu membawa pasien dalam berbagai kondisi. Dilengkapi pompa manual.', 72000000, 'p3k', 5, 'vaccum-splint-ems001-size-m-dengan-pompa.png'),
(13, 'Arm sling', 'kain segitiga penopang lengan.', 17000, 'p3k', 25, 'arm-sling-ji-co.jpg'),
(14, 'oxygen resuscitator kit', 'satu set alat bantu pernapasan oxygen. sudah termasuk regulator dan 3 masker oxygen.', 5000000, 'p3k', 4, 'basic-oxygen-resuscitator-kit-bss.jpg'),
(15, 'mega medic bag', 'tas medis dengan kapasitas 40 Liter kedap air.', 199000, 'p3k', 7, 'bls-kit-with-dyna-med-mega-medic-bag.png'),
(16, 'termometer makanan', 'membantu mengukur suhu saat memasak sehingga suhu yang digunakan pas. dapat dilipat sehingga mudah disimpan', 54000, 'termometer', 4, 'extech-tm-55-termometer-makanan-waterproof-lipat.png'),
(17, 'termometer digital', NULL, 26000, 'termometer', 21, 'avico-thermometer-digital-flexible.jpg'),
(18, 'termometer infrared', 'termometer dengan infrared untuk mendeteksi suhu tubuh.', 300000, 'termometer', 17, 'termometer-aicare.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_harga` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 untuk keranjang aktif, 2 untuk keranjang yang telah di checkout'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keranjang`
--

INSERT INTO `keranjang` (`id`, `uid`, `id_item`, `jumlah`, `sub_harga`, `status`) VALUES
(2, 1, 13, 2, 34000, 2),
(3, 1, 15, 1, 199000, 2),
(4, 1, 2, 1, 95000, 2),
(6, 1, 9, 1, 900000, 2),
(7, 1, 5, 1, 150000, 2),
(9, 1, 17, 1, 26000, 2),
(10, 1, 16, 2, 108000, 2),
(11, 1, 14, 1, 5000000, 2),
(12, 1, 7, 1, 200000, 2),
(13, 1, 16, 2, 108000, 2),
(15, 1, 5, 1, 150000, 2),
(16, 1, 8, 1, 300000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `id` int(11) NOT NULL,
  `list_krjg` varchar(256) NOT NULL COMMENT 'berisi id keranjang dengan pemisah semicolon',
  `uid` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '1 untuk processing, 2 untuk shipping, -1 untuk canceled by user, -2 untuk canceled by admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id`, `list_krjg`, `uid`, `total_harga`, `tgl`, `status`) VALUES
(1, '2;3;4;', 1, 200000, '2021-10-25 08:41:54', -1),
(2, '6;7;', 1, 1050000, '2021-10-24 20:49:51', 2),
(3, '9;', 1, 26000, '2021-10-25 23:02:40', -2),
(4, '10;11;12;', 1, 5308000, '2021-10-25 10:36:38', -1),
(5, '13;15;', 1, 258000, '2021-10-25 22:34:29', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `costumer`
--
ALTER TABLE `costumer`
  ADD PRIMARY KEY (`uid`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`,`id_item`),
  ADD KEY `krjg_fk_2` (`id_item`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `costumer`
--
ALTER TABLE `costumer`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `krjg_fk_1` FOREIGN KEY (`uid`) REFERENCES `costumer` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krjg_fk_2` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_fk_1` FOREIGN KEY (`uid`) REFERENCES `costumer` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
