-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Okt 2017 pada 02.40
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kurniajaya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(5) NOT NULL,
  `nama_alternatif` varchar(30) NOT NULL,
  `criteria1` double NOT NULL,
  `criteria2` double NOT NULL,
  `criteria3` double NOT NULL,
  `hasil_alternatif` double NOT NULL,
  `jum_kunjungan` int(5) NOT NULL,
  `avg_belanja` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `quantity` int(3) NOT NULL,
  `harga` int(8) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nm_barang`, `quantity`, `harga`, `satuan`) VALUES
(3, 'KULKAS', 0, 3000000, 'UNIT'),
(4, 'MESIN CUCU', 1, 2500000, 'UNIT'),
(5, 'LAMPU PHILLIPS', 35, 50000, 'UNIT'),
(6, 'RECEIVER TANAKA', 8, 300000, 'UNIT'),
(7, 'VCD', 5, 300000, 'UNIT'),
(8, 'MAJIKOM', 8, 500000, 'UNIT'),
(9, 'SALON AKTIV', 10, 350000, 'UNIT'),
(10, 'KIPAS ANGIN', 8, 450000, 'UNIT'),
(11, 'TELEVISI', 7, 1000000, 'UNIT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` varchar(20) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(4) NOT NULL,
  `harga` double(10,2) NOT NULL,
  `disc` double(5,2) NOT NULL,
  `timestmp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_barang`, `qty`, `harga`, `disc`, `timestmp`) VALUES
('TRKJ_0042', 4, 1, 2500000.00, 0.00, '2017-10-12 15:37:04'),
('TRKJ_0043', 5, 1, 50000.00, 0.00, '2017-10-12 15:40:06'),
('TRKJ_0044', 5, 1, 50000.00, 0.00, '2017-10-12 16:04:01'),
('TRKJ_0045', 5, 1, 50000.00, 0.00, '2017-10-12 16:04:36'),
('TRKJ_0046', 5, 1, 50000.00, 0.00, '2017-10-12 16:10:00'),
('TRKJ_0047', 3, 1, 3000000.00, 0.00, '2017-10-12 16:14:22');

--
-- Trigger `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `after_delete_barang` AFTER INSERT ON `detail_transaksi` FOR EACH ROW UPDATE barang SET quantity = (quantity - NEW.qty) WHERE id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hadiah`
--

CREATE TABLE `hadiah` (
  `id_hadiah` int(5) NOT NULL,
  `nama_hadiah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hadiah`
--

INSERT INTO `hadiah` (`id_hadiah`, `nama_hadiah`) VALUES
(4, 'Kulkas'),
(5, 'TV'),
(6, 'Laptop'),
(7, 'Radio'),
(8, 'Payung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hadiah_alternatif`
--

CREATE TABLE `hadiah_alternatif` (
  `id_hadiahalt` int(1) NOT NULL,
  `id_hadiah` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hadiah_alternatif`
--

INSERT INTO `hadiah_alternatif` (`id_hadiahalt`, `id_hadiah`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(10) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` double(10,2) NOT NULL,
  `disc` double(10,2) NOT NULL,
  `qty` int(4) NOT NULL,
  `timestmp` datetime NOT NULL,
  `del` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `keranjang`
--
DELIMITER $$
CREATE TRIGGER `cancel_keranjang` BEFORE DELETE ON `keranjang` FOR EACH ROW UPDATE barang SET quantity = quantity + OLD.qty WHERE id_barang = OLD.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurang_stok` BEFORE INSERT ON `keranjang` FOR EACH ROW UPDATE barang SET quantity = quantity - NEW.qty WHERE id_barang = NEW.id_barang
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `restok_keranjang` BEFORE UPDATE ON `keranjang` FOR EACH ROW UPDATE barang SET quantity = (quantity + OLD.qty) - NEW.qty WHERE id_barang = OLD.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `nm_kriteria` varchar(25) NOT NULL,
  `atribut` enum('cost','benefit','','') NOT NULL,
  `bobot` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nm_kriteria`, `atribut`, `bobot`) VALUES
(1, 'Total Belanja', 'benefit', '0.30'),
(2, 'Pembayaran', 'benefit', '0.30'),
(3, 'Loyalitas Belanja', 'benefit', '0.40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(5) NOT NULL,
  `NIK` varchar(35) DEFAULT NULL,
  `nama_pelanggan` varchar(25) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan','','') DEFAULT NULL,
  `alamat` text,
  `no_telpon` varchar(15) DEFAULT NULL,
  `status` enum('member','no_member','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `NIK`, `nama_pelanggan`, `jenis_kelamin`, `alamat`, `no_telpon`, `status`) VALUES
(1, '', 'Agung Setiadi', 'Laki-Laki', 'Kuningan', '08967845743', 'member'),
(2, '', 'Bayu Permana', 'Laki-Laki', 'Nusaherang', '088734756324', 'member'),
(3, '', 'Nano Suharno', 'Laki-Laki', 'safsg', '087946754', 'member'),
(4, '', 'Cicih Mintarsih', 'Perempuan', 'xcgbsdf', '06784567345', 'member'),
(5, '', 'Rini Sariningsih', 'Perempuan', 'safag', '078456245', 'member'),
(6, '', 'Firas', 'Laki-Laki', 'ygvuygb', '0897867867', 'member'),
(7, '', 'Saya', 'Laki-Laki', 'xfsdg', '067845373', 'member'),
(8, '', 'Kita', 'Laki-Laki', 'sdgfsdg', '0788545', 'member'),
(9, '', 'ada', 'Laki-Laki', 'fdgsdfh', '06787346234', 'member'),
(10, '', 'adaaja', 'Laki-Laki', 'sgs', '058654732', 'member'),
(11, NULL, 'Firas Luth', NULL, NULL, NULL, 'no_member'),
(12, NULL, 'Luth Firas', NULL, NULL, NULL, 'no_member'),
(13, NULL, 'lutyh', NULL, NULL, NULL, 'no_member'),
(14, NULL, 'luth', NULL, NULL, NULL, 'no_member'),
(15, NULL, 'gf', NULL, NULL, NULL, 'no_member'),
(16, NULL, 'asasf', NULL, NULL, NULL, 'no_member'),
(17, NULL, 'dfhf', NULL, NULL, NULL, 'no_member'),
(18, NULL, 'fvhsdfg', NULL, NULL, NULL, 'no_member'),
(19, NULL, 'ergsdfgsdf', NULL, NULL, NULL, 'no_member'),
(20, NULL, 'cfghf', NULL, NULL, NULL, 'no_member'),
(21, NULL, 'sdgds', NULL, NULL, NULL, 'no_member'),
(22, NULL, 'dsvd', NULL, NULL, NULL, 'no_member'),
(23, NULL, 'sdfsdf', NULL, NULL, NULL, 'no_member'),
(24, NULL, 'sgdfg', NULL, NULL, NULL, 'no_member'),
(25, NULL, 'fghfd', NULL, NULL, NULL, 'no_member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `list` varchar(30) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `nilai` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `list`, `keterangan`, `nilai`) VALUES
(6, 1, '1500000', 'Sangat Baik', 5),
(7, 1, '1000000 - 1500000', 'Baik', 4),
(8, 1, '500000 - 1000000', 'Cukup', 3),
(9, 1, '100000 - 500000', 'Buruk', 2),
(10, 1, '1000 - 100000', 'Sangat Buruk', 1),
(11, 2, 'Cash', 'Buruk', 4),
(12, 2, 'Credit', 'Baik', 2),
(13, 3, ' > 10', 'Sangat Baik', 5),
(14, 3, '8 - 9', 'Baik', 4),
(15, 3, '6 - 7', 'Cukup', 3),
(16, 3, '4 - 5', 'Buruk', 2),
(17, 3, '1 - 3', 'Sangat Buruk', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(20) NOT NULL,
  `id_pelanggan` int(5) DEFAULT NULL,
  `nama_pelanggan` varchar(25) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `status` enum('cash','credit','') NOT NULL,
  `total_harga` double(10,2) NOT NULL,
  `bayar` double(10,2) NOT NULL,
  `timestmp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `nama_pelanggan`, `tgl_transaksi`, `status`, `total_harga`, `bayar`, `timestmp`) VALUES
('TRKJ_0001', 1, 'Agung Setiadi', '2017-03-07', 'credit', 1000000.00, 500000.00, '2017-03-07 02:24:31'),
('TRKJ_0002', 1, 'Agung Setiadi', '2017-03-15', 'credit', 1000000.00, 200000.00, '2017-03-15 09:26:12'),
('TRKJ_0003', 1, 'Agung Setiadi', '2017-04-18', 'credit', 1000000.00, 100000.00, '2017-04-18 16:36:34'),
('TRKJ_0004', 1, 'Agung Setiadi', '2017-05-15', 'credit', 1000000.00, 600000.00, '2017-05-15 09:12:47'),
('TRKJ_0005', 1, 'Agung Setiadi', '2017-06-01', 'credit', 1000000.00, 450000.00, '2017-06-01 17:49:46'),
('TRKJ_0006', 1, 'Agung Setiadi', '2017-06-15', 'cash', 1000000.00, 1000000.00, '2017-06-15 09:20:29'),
('TRKJ_0007', 1, 'Agung Setiadi', '2017-06-12', 'cash', 1000000.00, 1000000.00, '2017-07-12 14:21:49'),
('TRKJ_0008', 1, 'Agung Setiadi', '2017-08-09', 'cash', 1000000.00, 1000000.00, '2017-08-09 21:55:55'),
('TRKJ_0009', 2, 'Bayu Permana', '2017-03-21', 'cash', 1300000.00, 1300000.00, '2017-03-21 08:18:43'),
('TRKJ_0010', 2, 'Bayu Permana', '2017-03-31', 'cash', 1300000.00, 1300000.00, '2017-03-31 18:24:26'),
('TRKJ_0011', 2, 'Bayu Permana', '2017-04-19', 'cash', 1300000.00, 1300000.00, '2017-04-19 12:19:45'),
('TRKJ_0012', 2, 'Bayu Permana', '2017-05-15', 'cash', 1300000.00, 1300000.00, '2017-05-15 09:24:35'),
('TRKJ_0013', 2, 'Bayu Permana', '2017-05-31', 'cash', 1300000.00, 1300000.00, '2017-05-31 14:24:37'),
('TRKJ_0014', 2, 'Bayu Permana', '2017-07-25', 'cash', 1300000.00, 1300000.00, '2017-07-25 09:23:00'),
('TRKJ_0015', 2, 'Bayu Permana', '2017-08-01', 'credit', 1300000.00, 200000.00, '2017-08-01 22:28:00'),
('TRKJ_0016', 2, 'Bayu Permana', '2017-08-03', 'credit', 1300000.00, 150000.00, '2017-08-03 10:41:18'),
('TRKJ_0017', 3, 'Nano Suharno', '2017-03-13', 'cash', 400000.00, 400000.00, '2017-03-13 10:22:23'),
('TRKJ_0018', 3, 'Nano Suharno', '2017-04-11', 'cash', 400000.00, 400000.00, '2017-04-11 00:30:46'),
('TRKJ_0019', 3, 'Nano Suharno', '2017-04-27', 'credit', 400000.00, 100000.00, '2017-04-27 00:30:18'),
('TRKJ_0020', 3, 'Nano Suharno', '2017-05-01', 'credit', 400000.00, 200000.00, '2017-05-01 07:35:37'),
('TRKJ_0021', 3, 'Nano Suharno', '2017-06-22', 'credit', 400000.00, 150000.00, '2017-06-22 07:29:11'),
('TRKJ_0022', 3, 'Nano Suharno', '2017-07-20', 'credit', 400000.00, 250000.00, '2017-07-20 11:40:23'),
('TRKJ_0023', 4, 'Cicih Mintarsih', '2017-04-03', 'cash', 400000.00, 400000.00, '2017-04-03 11:34:37'),
('TRKJ_0024', 4, 'Cicih Mintarsih', '2017-04-06', 'cash', 400000.00, 400000.00, '2017-04-06 13:41:28'),
('TRKJ_0025', 4, 'Cicih Mintarsih', '2017-04-25', 'cash', 400000.00, 400000.00, '2017-04-25 12:45:28'),
('TRKJ_0026', 4, 'Cicih Mintarsih', '2017-06-14', 'cash', 400000.00, 400000.00, '2017-06-14 15:26:00'),
('TRKJ_0027', 4, 'Cicih Mintarsih', '2017-06-03', 'cash', 400000.00, 400000.00, '2017-07-03 15:42:44'),
('TRKJ_0028', 4, 'Cicih Mintarsih', '2017-07-27', 'cash', 400000.00, 400000.00, '2017-07-27 09:29:33'),
('TRKJ_0029', 4, 'Cicih Mintarsih', '2017-08-01', 'credit', 400000.00, 100000.00, '2017-08-01 17:33:42'),
('TRKJ_0030', 4, 'Cicih Mintarsih', '2017-08-02', 'credit', 400000.00, 230000.00, '2017-08-02 14:43:30'),
('TRKJ_0031', 5, 'Rini Sariningsih', '2017-03-01', 'cash', 1200000.00, 1200000.00, '2017-03-01 05:21:21'),
('TRKJ_0032', 5, 'Rini Sariningsih', '2017-03-08', 'cash', 1200000.00, 1200000.00, '2017-03-08 17:41:24'),
('TRKJ_0033', 5, 'Rini Sariningsih', '2017-03-21', 'cash', 1200000.00, 1200000.00, '2017-03-21 14:45:31'),
('TRKJ_0034', 5, 'Rini Sariningsih', '2017-04-18', 'cash', 1200000.00, 1200000.00, '2017-04-18 14:28:47'),
('TRKJ_0035', 5, 'Rini Sariningsih', '2017-05-01', 'cash', 1200000.00, 1200000.00, '2017-05-01 13:44:45'),
('TRKJ_0036', 5, 'Rini Sariningsih', '2017-05-31', 'credit', 1200000.00, 100000.00, '2017-05-31 10:36:36'),
('TRKJ_0037', 5, 'Rini Sariningsih', '2017-07-18', 'credit', 1200000.00, 200000.00, '2017-07-18 10:20:36'),
('TRKJ_0038', 5, 'Rini Sariningsih', '2017-07-31', 'credit', 1200000.00, 4000.00, '2017-07-31 16:29:34'),
('TRKJ_0039', 5, 'Rini Sariningsih', '2017-08-01', 'credit', 1200000.00, 60000.00, '2017-08-01 18:38:43'),
('TRKJ_0040', 5, 'Rini Sariningsih', '2017-03-30', 'credit', 1200000.00, 450000.00, '2017-08-30 12:24:00'),
('TRKJ_0041', 3, 'Nano Suharno', '2017-04-04', 'cash', 0.00, 0.00, '2017-04-04 06:36:13'),
('TRKJ_0042', 11, 'Firas Luth', '2017-10-12', 'cash', 2500000.00, 2500000.00, '2017-10-12 15:38:00'),
('TRKJ_0043', 14, 'luth', '2017-10-12', 'cash', 50000.00, 60000.00, '2017-10-12 15:59:09'),
('TRKJ_0044', 16, 'asasf', '2017-10-12', 'cash', 50000.00, 10000.00, '2017-10-12 16:04:09'),
('TRKJ_0045', 20, 'cfghf', '2017-10-12', 'cash', 50000.00, 50000.00, '2017-10-12 16:09:51'),
('TRKJ_0046', 1, 'Agung Setiadi', '2017-10-12', 'cash', 50000.00, 50000.00, '2017-10-12 16:12:19'),
('TRKJ_0047', 25, 'fghfd', '2017-10-12', 'cash', 3000000.00, 3000000.00, '2017-10-12 16:15:20');

--
-- Trigger `transaksi`
--
DELIMITER $$
CREATE TRIGGER `after_delete_keranjang` AFTER INSERT ON `transaksi` FOR EACH ROW DELETE FROM keranjang WHERE del='1'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_delete_transaksi` AFTER DELETE ON `transaksi` FOR EACH ROW DELETE FROM detail_transaksi WHERE id_transaksi = OLD.id_transaksi
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `nm_user` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `level` enum('Pemilik','Admin','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nm_user`, `username`, `password`, `level`) VALUES
(2, 'Karyo', 'man', '39c63ddb96a31b9610cd976b896ad4f0', 'Pemilik'),
(7, 'Maya', 'adm', 'b09c600fddc573f117449b3723f23d64', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_transaksi`,`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `hadiah`
--
ALTER TABLE `hadiah`
  ADD PRIMARY KEY (`id_hadiah`);

--
-- Indexes for table `hadiah_alternatif`
--
ALTER TABLE `hadiah_alternatif`
  ADD PRIMARY KEY (`id_hadiahalt`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD UNIQUE KEY `id_barang_2` (`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `hadiah`
--
ALTER TABLE `hadiah`
  MODIFY `id_hadiah` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `hadiah_alternatif`
--
ALTER TABLE `hadiah_alternatif`
  MODIFY `id_hadiahalt` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
