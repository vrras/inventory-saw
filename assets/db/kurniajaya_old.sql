-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2017 at 05:42 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kurniajaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE IF NOT EXISTS `alternatif` (
  `id_alternatif` int(5) NOT NULL,
  `nama_alternatif` varchar(30) NOT NULL,
  `criteria1` double NOT NULL,
  `criteria2` double NOT NULL,
  `criteria3` double NOT NULL,
  `hasil_alternatif` double NOT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `criteria1`, `criteria2`, `criteria3`, `hasil_alternatif`) VALUES
(222260, 'Bayu Permana', 4, 4, 1, 0.75),
(222263, 'Cicih Mintarsih', 2, 2, 1, 0.65),
(222264, 'Rini Sariningsih', 3, 4, 2, 0.9),
(222268, 'Yoka Susanto', 3, 4, 1, 0.8);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nm_barang` varchar(50) NOT NULL,
  `quantity` int(3) NOT NULL,
  `harga` int(8) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nm_barang`, `quantity`, `harga`, `satuan`) VALUES
(3, 'KULKAS', 0, 3000000, 'UNIT'),
(4, 'MESIN CUCU', 0, 2500000, 'UNIT'),
(5, 'LAMPU PHILLIPS', 36, 50000, 'UNIT'),
(6, 'RECEIVER TANAKA', 8, 300000, 'UNIT'),
(7, 'VCD', 3, 300000, 'UNIT'),
(8, 'MAJIKOM', 2, 500000, 'UNIT'),
(9, 'SALON AKTIV', 7, 350000, 'UNIT'),
(10, 'KIPAS ANGIN', 3, 450000, 'UNIT'),
(11, 'TELEVISI', 5, 1000000, 'UNIT'),
(13, 'Firas', 90, 1000000, ''),
(14, 'Firas', 100, 1000000, ''),
(15, 'Firas', 100, 1000000, '');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id_transaksi` varchar(20) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(4) NOT NULL,
  `harga` double(10,2) NOT NULL,
  `disc` double(5,2) NOT NULL,
  `timestmp` datetime NOT NULL,
  PRIMARY KEY (`id_transaksi`,`id_barang`),
  KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_barang`, `qty`, `harga`, `disc`, `timestmp`) VALUES
('TRKJ_0008', 5, 1, 50000.00, 5.00, '2017-04-19 10:45:00'),
('TRKJ_0009', 5, 3, 50000.00, 10.00, '2017-06-07 03:13:22'),
('TRKJ_0010', 4, 2, 2500000.00, 0.00, '2017-07-24 11:24:44'),
('TRKJ_0013', 4, 1, 2500000.00, 0.00, '2017-07-26 08:40:26'),
('TRKJ_0014', 5, 2, 50000.00, 0.00, '2017-07-26 08:41:40'),
('TRKJ_0015', 3, 2, 3000000.00, 10.00, '2017-07-27 09:40:06'),
('TRKJ_0016', 5, 2, 50000.00, 10.00, '2017-07-27 09:47:48'),
('TRKJ_0016', 7, 2, 300000.00, 10.00, '2017-07-27 09:47:52'),
('TRKJ_0017', 8, 1, 500000.00, 2.00, '2017-07-27 10:34:42'),
('TRKJ_0017', 10, 2, 450000.00, 9.00, '2017-07-27 10:34:38'),
('TRKJ_0017', 11, 2, 1000000.00, 5.00, '2017-07-27 10:34:33'),
('TRKJ_0018', 7, 3, 300000.00, 0.00, '2017-07-31 14:19:16'),
('TRKJ_0019', 4, 1, 2500000.00, 0.00, '2017-08-06 21:01:44'),
('TRKJ_0020', 3, 1, 3000000.00, 0.00, '2017-08-19 16:03:14'),
('TRKJ_0020', 4, 1, 2500000.00, 0.00, '2017-08-19 16:03:25'),
('TRKJ_0020', 5, 5, 50000.00, 0.00, '2017-08-19 16:03:36'),
('TRKJ_0020', 8, 5, 500000.00, 0.00, '2017-08-19 16:03:47'),
('TRKJ_0020', 10, 2, 450000.00, 0.00, '2017-08-19 16:04:08'),
('TRKJ_0021', 5, 1, 50000.00, 0.00, '2017-08-20 00:33:26'),
('TRKJ_0022', 6, 2, 300000.00, 0.00, '2017-08-20 00:52:59'),
('TRKJ_0023', 8, 2, 500000.00, 0.00, '2017-08-20 02:17:47'),
('TRKJ_0023', 9, 3, 350000.00, 0.00, '2017-08-20 02:17:57'),
('TRKJ_0024', 13, 5, 1000000.00, 0.00, '2017-08-20 02:18:57'),
('TRKJ_0025', 11, 2, 1000000.00, 0.00, '2017-08-20 02:19:53'),
('TRKJ_0026', 10, 3, 450000.00, 0.00, '2017-08-20 02:20:44'),
('TRKJ_0027', 7, 2, 300000.00, 0.00, '2017-08-20 02:52:42'),
('TRKJ_0028', 13, 5, 1000000.00, 10.00, '2017-08-20 10:13:16'),
('TRKJ_0029', 11, 1, 1000000.00, 0.00, '2017-08-20 21:50:31');

--
-- Triggers `detail_transaksi`
--
DROP TRIGGER IF EXISTS `after_delete_barang`;
DELIMITER //
CREATE TRIGGER `after_delete_barang` AFTER INSERT ON `detail_transaksi`
 FOR EACH ROW UPDATE barang SET quantity = (quantity - NEW.qty) WHERE id_barang = NEW.id_barang
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE IF NOT EXISTS `keranjang` (
  `id_barang` int(11) NOT NULL,
  `harga` double(10,2) NOT NULL,
  `disc` double(10,2) NOT NULL,
  `qty` int(4) NOT NULL,
  `timestmp` datetime NOT NULL,
  `del` int(1) NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `keranjang`
--
DROP TRIGGER IF EXISTS `cancel_keranjang`;
DELIMITER //
CREATE TRIGGER `cancel_keranjang` BEFORE DELETE ON `keranjang`
 FOR EACH ROW UPDATE barang SET quantity = quantity + OLD.qty WHERE id_barang = OLD.id_barang
//
DELIMITER ;
DROP TRIGGER IF EXISTS `kurang_stok`;
DELIMITER //
CREATE TRIGGER `kurang_stok` BEFORE INSERT ON `keranjang`
 FOR EACH ROW UPDATE barang SET quantity = quantity - NEW.qty WHERE id_barang = NEW.id_barang
//
DELIMITER ;
DROP TRIGGER IF EXISTS `restok_keranjang`;
DELIMITER //
CREATE TRIGGER `restok_keranjang` BEFORE UPDATE ON `keranjang`
 FOR EACH ROW UPDATE barang SET quantity = (quantity + OLD.qty) - NEW.qty WHERE id_barang = OLD.id_barang
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(5) NOT NULL AUTO_INCREMENT,
  `nm_kriteria` varchar(25) NOT NULL,
  `atribut` enum('cost','benefit','','') NOT NULL,
  `bobot` varchar(5) NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(5) NOT NULL AUTO_INCREMENT,
  `NIK` varchar(35) DEFAULT NULL,
  `nama_pelanggan` varchar(25) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan','','') DEFAULT NULL,
  `alamat` text,
  `no_telpon` varchar(15) DEFAULT NULL,
  `status` enum('member','no_member','','') NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=222298 ;

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
(222295, '678567865785675', 'dsfghdsfg', 'Laki-Laki', 'sdfgsdfgsdf', '098567673456', 'member'),
(222296, NULL, 'Alkarjo', NULL, NULL, NULL, 'no_member'),
(222297, NULL, 'Saya Tau', NULL, NULL, NULL, 'no_member');

--
-- Triggers `pelanggan`
--
DROP TRIGGER IF EXISTS `insert_alternatif`;
DELIMITER //
CREATE TRIGGER `insert_alternatif` AFTER INSERT ON `pelanggan`
 FOR EACH ROW INSERT INTO alternatif (id_pelanggan) VALUES (NEW.id_pelanggan)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rangking`
--

CREATE TABLE IF NOT EXISTS `rangking` (
  `id_pelanggan` int(5) NOT NULL,
  `id_kriteria` int(5) NOT NULL,
  `nilai_rangking` double NOT NULL,
  `nilai_normalisasi` double NOT NULL,
  `bobot_normalisasi` double NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE IF NOT EXISTS `subkriteria` (
  `id_subkriteria` int(5) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(5) NOT NULL,
  `list` varchar(30) NOT NULL,
  `keterangan` varchar(25) NOT NULL,
  `nilai` int(8) NOT NULL,
  PRIMARY KEY (`id_subkriteria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` varchar(20) NOT NULL,
  `id_pelanggan` int(5) DEFAULT NULL,
  `nama_pelanggan` varchar(25) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `status` enum('cash','credit','') NOT NULL,
  `total_harga` double(10,2) NOT NULL,
  `bayar` double(10,2) NOT NULL,
  `timestmp` datetime NOT NULL,
  PRIMARY KEY (`id_transaksi`)
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
('TRKJ_0018', 222293, 'Inggit Putri', '2017-07-31', 'cash', 900000.00, 900000.00, '2017-07-31 14:19:58'),
('TRKJ_0019', 222296, 'Alkarjo', '2017-08-06', 'cash', 2500000.00, 2500000.00, '2017-08-06 21:02:30'),
('TRKJ_0020', 222297, 'Saya Tau', '2017-08-19', 'cash', 9150000.00, 9150000.00, '2017-08-19 16:04:37'),
('TRKJ_0021', 222260, 'Bayu Permana', '2017-08-20', 'cash', 50000.00, 50000.00, '2017-08-20 00:34:40'),
('TRKJ_0022', 222264, 'Rini Sariningsih', '2017-08-20', 'cash', 600000.00, 600000.00, '2017-08-20 00:53:21'),
('TRKJ_0023', 222260, 'Bayu Permana', '2017-08-20', 'cash', 2050000.00, 2050000.00, '2017-08-20 02:18:27'),
('TRKJ_0024', 222260, 'Bayu Permana', '2017-08-20', 'credit', 5000000.00, 1000000.00, '2017-08-20 02:19:18'),
('TRKJ_0025', 222264, 'Rini Sariningsih', '2017-08-20', 'credit', 2000000.00, 500000.00, '2017-08-20 02:20:21'),
('TRKJ_0026', 222264, 'Rini Sariningsih', '2017-08-20', 'credit', 1350000.00, 350000.00, '2017-08-20 02:21:05'),
('TRKJ_0027', 222264, 'Rini Sariningsih', '2017-08-20', 'cash', 600000.00, 600000.00, '2017-08-20 02:53:02'),
('TRKJ_0028', 222268, 'Yoka Susanto', '2017-08-20', 'cash', 4500000.00, 4500000.00, '2017-08-20 10:13:40'),
('TRKJ_0029', 222263, 'Cicih Mintarsih', '2017-08-20', 'credit', 1000000.00, 500000.00, '2017-08-20 21:51:00');

--
-- Triggers `transaksi`
--
DROP TRIGGER IF EXISTS `after_delete_keranjang`;
DELIMITER //
CREATE TRIGGER `after_delete_keranjang` AFTER INSERT ON `transaksi`
 FOR EACH ROW DELETE FROM keranjang WHERE del='1'
//
DELIMITER ;
DROP TRIGGER IF EXISTS `after_delete_transaksi`;
DELIMITER //
CREATE TRIGGER `after_delete_transaksi` AFTER DELETE ON `transaksi`
 FOR EACH ROW DELETE FROM detail_transaksi WHERE id_transaksi = OLD.id_transaksi
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(20) NOT NULL AUTO_INCREMENT,
  `nm_user` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `level` enum('Pemilik','Admin','') NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nm_user`, `username`, `password`, `level`) VALUES
(1, 'Maya', 'adm', 'b09c600fddc573f117449b3723f23d64', 'Admin'),
(2, 'Karyo', 'man', '39c63ddb96a31b9610cd976b896ad4f0', 'Pemilik');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
