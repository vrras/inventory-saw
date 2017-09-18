-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2017 at 08:42 AM
-- Server version: 10.1.19-MariaDB
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
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_pelanggan` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `id_subkriteria` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_pelanggan`, `id_kriteria`, `id_subkriteria`) VALUES
(222294, 0, 0),
(222295, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nm_barang` varchar(50) NOT NULL,
  `quantity` int(3) NOT NULL,
  `harga` int(8) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nm_barang`, `quantity`, `harga`, `satuan`) VALUES
(3, 'KULKAS', 1, 3000000, 'UNIT'),
(4, 'MESIN CUCU', 2, 2500000, 'UNIT'),
(5, 'LAMPU PHILLIPS', 46, 50000, 'UNIT'),
(6, 'RECEIVER TANAKA', 10, 300000, 'UNIT'),
(7, 'VCD', 5, 300000, 'UNIT'),
(8, 'MAJIKOM', 9, 500000, 'UNIT'),
(9, 'SALON AKTIV', 10, 350000, 'UNIT'),
(10, 'KIPAS ANGIN', 8, 450000, 'UNIT'),
(11, 'TELEVISI', 8, 1000000, 'UNIT');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
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
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_barang`, `qty`, `harga`, `disc`, `timestmp`) VALUES
('TRKJ_0010', 4, 2, 2500000.00, 0.00, '2017-07-24 11:24:44'),
('TRKJ_0013', 4, 1, 2500000.00, 0.00, '2017-07-26 08:40:26'),
('TRKJ_0014', 5, 2, 50000.00, 0.00, '2017-07-26 08:41:40'),
('TRKJ_0015', 3, 2, 3000000.00, 10.00, '2017-07-27 09:40:06'),
('TRKJ_0016', 5, 2, 50000.00, 10.00, '2017-07-27 09:47:48'),
('TRKJ_0016', 7, 2, 300000.00, 10.00, '2017-07-27 09:47:52'),
('TRKJ_0017', 8, 1, 500000.00, 2.00, '2017-07-27 10:34:42'),
('TRKJ_0017', 10, 2, 450000.00, 9.00, '2017-07-27 10:34:38'),
('TRKJ_0017', 11, 2, 1000000.00, 5.00, '2017-07-27 10:34:33'),
('TRKJ_0018', 7, 3, 300000.00, 0.00, '2017-07-31 14:19:16');

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `after_delete_barang` AFTER INSERT ON `detail_transaksi` FOR EACH ROW UPDATE barang SET quantity = (quantity - NEW.qty) WHERE id_barang = NEW.id_barang
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_barang` int(11) NOT NULL,
  `harga` double(10,2) NOT NULL,
  `disc` double(10,2) NOT NULL,
  `qty` int(4) NOT NULL,
  `timestmp` datetime NOT NULL,
  `del` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `keranjang`
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
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(5) NOT NULL,
  `nm_kriteria` varchar(25) NOT NULL,
  `atribut` enum('cost','benefit','','') NOT NULL,
  `bobot` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nm_kriteria`, `atribut`, `bobot`) VALUES
(1, 'Total Belanja', 'cost', '0.30'),
(2, 'Pembayaran', 'benefit', '0.50'),
(3, 'Loyalitas Kunjungan', 'benefit', '0.20');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
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
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `NIK`, `nama_pelanggan`, `jenis_kelamin`, `alamat`, `no_telpon`, `status`) VALUES
(222260, '2147483647', 'Bayu Permana', 'Laki-Laki', 'Perumahan Griya Bojong Indah', '089666677711', 'member'),
(222261, '0', 'adif julia a', 'Laki-Laki', 'Desa Masndalajaya', '4555789', 'member'),
(222262, '345667791', 'Nano Suharno', 'Laki-Laki', 'Desa Mekarmulya No.45', '097436189', 'member'),
(222263, '2147483647', 'Cicih Mintarsih', 'Perempuan', 'Desa Mekarmulya no.25', '5567899222', 'member'),
(222264, '2147483647', 'Rini Sariningsih', 'Perempuan', 'Desa Sukamulya', '889999333', 'member'),
(222265, '0', 'Ikin Rojikin', 'Laki-Laki', 'Desa Subang', '123667899', 'no_member'),
(222268, '3208090711940004', 'Yoka Susanto', 'Laki-Laki', 'Desa sengkahan no.13', '089777666777', 'member'),
(222294, '2147483647', 'Agung Setiadi', 'Laki-Laki', 'Desa Lengkong no.13 dusun pahing ', '12345', 'member'),
(222295, '678567865785675', 'dsfghdsfg', 'Laki-Laki', 'sdfgsdfgsdf', '098567673456', 'member');

--
-- Triggers `pelanggan`
--
DELIMITER $$
CREATE TRIGGER `insert_alternatif` AFTER INSERT ON `pelanggan` FOR EACH ROW INSERT INTO alternatif (id_pelanggan) VALUES (NEW.id_pelanggan)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rangking`
--

CREATE TABLE `rangking` (
  `id_rangking` int(5) NOT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `nilai` int(35) NOT NULL,
  `tanggal` date NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `list` varchar(30) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `nilai` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `list`, `keterangan`, `nilai`) VALUES
(6, 1, '1500000', 'Sangat Baik', 5),
(7, 1, '1000000 - 1500000', 'Baik', 4),
(8, 1, '500000 - 1000000', 'Cukup', 3),
(9, 1, '100000 - 500000', 'Buruk', 2),
(10, 1, '1000 - 100000', 'Sangat Buruk', 1),
(11, 2, 'Cash', 'Baik', 4),
(12, 2, 'Credit', 'Buruk', 2),
(13, 3, '> 10', 'Sangat Baik', 5),
(14, 3, '8 - 9', 'Baik', 4),
(15, 3, '6 - 7', 'Cukup', 3),
(16, 3, '4 - 5', 'Buruk', 2),
(17, 3, '1 - 3', 'Sangat Buruk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
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
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `nama_pelanggan`, `tgl_transaksi`, `status`, `total_harga`, `bayar`, `timestmp`) VALUES
('TRKJ_0010', 222284, 'gg', '2017-07-24', 'cash', 0.00, 5000000.00, '2017-07-24 11:24:53'),
('TRKJ_0013', 222290, 'Siapa', '2017-07-26', 'cash', 2500000.00, 2500000.00, '2017-07-26 08:40:40'),
('TRKJ_0014', 222259, 'Agung Setiadi', '2017-07-26', 'cash', 100000.00, 200000.00, '2017-07-26 08:42:06'),
('TRKJ_0015', 222291, 'Aldi Sevy', '2017-07-27', 'cash', 5400000.00, 6000000.00, '2017-07-27 09:40:31'),
('TRKJ_0016', 222292, 'Firas Baru', '2017-07-27', 'cash', 630000.00, 700000.00, '2017-07-27 09:48:07'),
('TRKJ_0017', 222293, 'Inggit Putri', '2017-07-27', 'cash', 3209000.00, 3300000.00, '2017-07-27 10:35:16'),
('TRKJ_0018', 222293, 'Inggit Putri', '2017-07-31', 'cash', 900000.00, 900000.00, '2017-07-31 14:19:58');

--
-- Triggers `transaksi`
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `nm_user` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `level` enum('Pemilik','Admin','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nm_user`, `username`, `password`, `level`) VALUES
(1, 'Maya', 'adm', 'b09c600fddc573f117449b3723f23d64', 'Admin'),
(2, 'Karyo', 'man', '39c63ddb96a31b9610cd976b896ad4f0', 'Pemilik');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_barang`);

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
-- Indexes for table `rangking`
--
ALTER TABLE `rangking`
  ADD PRIMARY KEY (`id_rangking`);

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
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222296;
--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
