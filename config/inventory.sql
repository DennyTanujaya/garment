-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 05:16 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(20) NOT NULL,
  `kode_customer` varchar(3) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `alamat_customer` varchar(300) NOT NULL,
  `no_telepon_customer` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `kode_customer`, `nama_customer`, `alamat_customer`, `no_telepon_customer`) VALUES
(1, 'THD', 'THEDA', 'JELAMBAR', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_inventaris`
--

CREATE TABLE `daftar_inventaris` (
  `id_barang` int(10) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` int(20) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `tanggal_pembelian` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `quantity` int(20) NOT NULL,
  `harga` int(20) NOT NULL,
  `createBy` varchar(50) NOT NULL,
  `createDate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(10) NOT NULL,
  `no_ktp` varchar(20) DEFAULT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `alamat_karyawan` varchar(300) DEFAULT NULL,
  `no_telepon_karyawan` int(20) DEFAULT NULL,
  `lokasi` varchar(20) DEFAULT NULL,
  `divisi` varchar(20) DEFAULT NULL,
  `sub_divisi` varchar(50) NOT NULL,
  `createBy` varchar(20) NOT NULL,
  `createDate` varchar(20) NOT NULL,
  `modifyBy` varchar(20) DEFAULT NULL,
  `modifyDate` varchar(20) DEFAULT NULL,
  `gaji_perjam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `no_ktp`, `nama_karyawan`, `alamat_karyawan`, `no_telepon_karyawan`, `lokasi`, `divisi`, `sub_divisi`, `createBy`, `createDate`, `modifyBy`, `modifyDate`, `gaji_perjam`) VALUES
(1, '3122312', 'NIE', 'CENGKARENG', 0, 'Cengkareng', 'sub_div_1', 'Other', 'Nike', '05-09-2020  03:12:58', NULL, NULL, '60000');

-- --------------------------------------------------------

--
-- Table structure for table `kasbon_bahan`
--

CREATE TABLE `kasbon_bahan` (
  `id_kasbon_bahan` int(20) NOT NULL,
  `id_karyawan` int(20) NOT NULL,
  `tanggal_kasbon` varchar(20) NOT NULL,
  `note` varchar(500) NOT NULL,
  `no_seri` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createDate` varchar(20) NOT NULL,
  `createBy` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kasbon_bahan`
--

INSERT INTO `kasbon_bahan` (`id_kasbon_bahan`, `id_karyawan`, `tanggal_kasbon`, `note`, `no_seri`, `quantity`, `jumlah`, `status`, `createDate`, `createBy`) VALUES
(1, 1, '2020-09-05', '', 'RDX/000002', '360', '', 'belum terbayar', '05-09-2020  04:29:33', 'Nike'),
(2, 1, '2020-09-29', '', 'SLX/000004', '360', '270000', 'belum terbayar', '29-09-2020  11:38:48', 'Nike');

-- --------------------------------------------------------

--
-- Table structure for table `kasbon_uang`
--

CREATE TABLE `kasbon_uang` (
  `id_kasbon` int(10) NOT NULL,
  `id_karyawan` int(20) NOT NULL,
  `tanggal_kasbon` varchar(20) NOT NULL,
  `jumlah` varchar(20) NOT NULL,
  `tenor` int(20) NOT NULL,
  `note` varchar(500) NOT NULL,
  `status` varchar(50) NOT NULL,
  `createBy` varchar(50) NOT NULL,
  `createDate` varchar(50) NOT NULL,
  `tanggal_gajian` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `noseri`
--

CREATE TABLE `noseri` (
  `id_noSeri` int(20) NOT NULL,
  `no_seri` varchar(20) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `salary_terpotong` varchar(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `noseri`
--

INSERT INTO `noseri` (`id_noSeri`, `no_seri`, `qty`, `salary_terpotong`) VALUES
(1, 'MTX/000001', '12', '12'),
(2, 'RDX/000002', '324', '495'),
(3, 'MTX/000003', '0', '50'),
(4, 'MTX/000003', '0', '0'),
(5, 'MTX/000003', '0', '0'),
(6, 'MTX/000003', '0', '0'),
(7, 'MTX/000003', '0', '0'),
(8, 'MTX/000003', '0', '0'),
(9, 'MTX/000003', '0', '0'),
(10, 'MTX/000003', '0', '0'),
(11, 'MTX/000003', '0', '0'),
(12, 'SGX/000003', '110', '0'),
(13, 'SLX/000004', '79', '360');

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id_other` int(20) NOT NULL,
  `no_po` varchar(50) DEFAULT NULL,
  `tanggal_masuk` varchar(50) DEFAULT NULL,
  `nama_bahan` varchar(50) DEFAULT NULL,
  `jenis_bahan` varchar(50) DEFAULT NULL,
  `quantity` int(50) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `warna_bahan` varchar(50) DEFAULT NULL,
  `harga_bahan` int(50) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `createBy` varchar(50) DEFAULT NULL,
  `createDate` varchar(50) DEFAULT NULL,
  `modifyBy` varchar(50) DEFAULT NULL,
  `modifyDate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(20) NOT NULL,
  `no_invoice` varchar(20) NOT NULL,
  `seller` varchar(50) NOT NULL,
  `tanggal_penjualan` varchar(20) NOT NULL,
  `id_customer` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createBy` varchar(20) NOT NULL,
  `createDate` varchar(20) NOT NULL,
  `modifyBy` varchar(20) NOT NULL,
  `modifyDate` varchar(20) NOT NULL,
  `cancellation` varchar(20) NOT NULL,
  `nama_rekening` varchar(100) NOT NULL,
  `cabang` varchar(100) NOT NULL,
  `atas_nama` varchar(100) NOT NULL,
  `nomor_rekening` int(100) NOT NULL,
  `no_surat_jalan_penjualan` varchar(50) NOT NULL,
  `note` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `no_invoice`, `seller`, `tanggal_penjualan`, `id_customer`, `status`, `createBy`, `createDate`, `modifyBy`, `modifyDate`, `cancellation`, `nama_rekening`, `cabang`, `atas_nama`, `nomor_rekening`, `no_surat_jalan_penjualan`, `note`) VALUES
(1, 'INV/2020/09/29/001', 'SENI KARYA', '2020-09-29', 1, '', 'Nike', '29-09-2020  11:44:49', '', '', '', 'BCA', 'MALL TAMAN PALEM', 'JIU NOBELLIUS', 7015333, 'SK/THD/2020/09/29/001', ''),
(2, 'INV/2020/09/29/002', 'SENI KARYA', '2020-09-29', 1, '', 'Nike', '29-09-2020  11:48:12', '', '', '', 'BCA', 'MALL TAMAN PALEM', 'JIU NOBELLIUS', 7015333, 'SK/THD/2020/09/29/002', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id_purchase_order` int(20) NOT NULL,
  `id_supplier` varchar(3) NOT NULL,
  `id_stock_barang` int(20) NOT NULL,
  `no_po` varchar(50) DEFAULT NULL,
  `tgl_pembelian` varchar(20) DEFAULT NULL,
  `tgl_masuk_barang` varchar(20) DEFAULT NULL,
  `no_surat_jalan` varchar(20) DEFAULT NULL,
  `nama_bahan` varchar(20) DEFAULT NULL,
  `jenis_bahan` varchar(10) DEFAULT NULL,
  `warna_bahan` varchar(10) DEFAULT NULL,
  `jumlah_bahan` int(10) DEFAULT NULL,
  `perKilo` varchar(10) DEFAULT NULL,
  `harga_per_kilo` int(10) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `createBy` varchar(10) DEFAULT NULL,
  `createDate` varchar(10) DEFAULT NULL,
  `modifyBy` varchar(10) DEFAULT NULL,
  `modifyDate` varchar(10) DEFAULT NULL,
  `status` int(20) NOT NULL,
  `status_pembayaran` int(5) NOT NULL,
  `status_return` varchar(30) NOT NULL,
  `no_po_supplier` varchar(50) NOT NULL,
  `status_bahan` varchar(100) NOT NULL,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id_purchase_order`, `id_supplier`, `id_stock_barang`, `no_po`, `tgl_pembelian`, `tgl_masuk_barang`, `no_surat_jalan`, `nama_bahan`, `jenis_bahan`, `warna_bahan`, `jumlah_bahan`, `perKilo`, `harga_per_kilo`, `total`, `createBy`, `createDate`, `modifyBy`, `modifyDate`, `status`, `status_pembayaran`, `status_return`, `no_po_supplier`, `status_bahan`, `notes`) VALUES
(2, 'RDX', 0, 'RDX/2020/09/05/002', '2019-05-05', '2019-05-05', 'TR/190509002', NULL, NULL, NULL, 60, '1462.2', 62874600, NULL, 'Nike', '05-09-2020', NULL, NULL, 1, 0, '0', 'TR/190509002', 'In Process CMT', ''),
(6, 'SGX', 0, 'SGX/2020/09/16/003', '2020-09-15', '2020-09-16', 'SG/20092002', NULL, NULL, NULL, 72, '2775', 78877000, NULL, 'Nike', '16-09-2020', NULL, NULL, 1, 0, '0', 'SG/20092002', 'In Process Bordir', '12 ROLL PUTIH\r\n12 ROLL MERAH\r\n12 ROLL BIRU\r\n12 ROLL UNGU\r\n12 ROLL FANTA\r\n12 ROLL HIJAU\r\n12 ROLL COKELAT TUA'),
(8, 'SLX', 0, 'SLX/2020/09/29/004', '2020-09-29', '2020-09-29', 'SIE/2020/09/29', NULL, NULL, NULL, 84, '3150', 72085622, NULL, 'Nike', '29-09-2020', NULL, NULL, 1, 0, '0', 'SIE/2020/09/29', 'In Process CMT', '12 ROLL PUTIH\r\n12 ROLL BIRU\r\n12 ROLL FANTA\r\n12 ROLL MAROON\r\n12 ROLL COKELAT TUA\r\n12 ROLL HIJAU\r\n12 ROLL UNGU');

-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE `retur` (
  `id_retur` int(20) NOT NULL,
  `id_purchase_order` int(30) NOT NULL,
  `id_supplier` int(10) NOT NULL,
  `tgl_retur` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `createBy` varchar(20) NOT NULL,
  `createDate` varchar(20) NOT NULL,
  `modifyBy` varchar(20) NOT NULL,
  `modifyDate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id_salary` int(20) NOT NULL,
  `id_karyawan` int(20) NOT NULL,
  `merek` varchar(20) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `size` varchar(20) NOT NULL,
  `no_seri` varchar(20) NOT NULL,
  `tanggal_gajian` varchar(20) NOT NULL,
  `createBy` varchar(20) NOT NULL,
  `createDate` varchar(20) NOT NULL,
  `kantong` varchar(5) NOT NULL,
  `klep` varchar(5) NOT NULL,
  `tali` varchar(5) NOT NULL,
  `stik_tangan` varchar(5) NOT NULL,
  `stik_bawah` varchar(5) NOT NULL,
  `tangan` varchar(5) NOT NULL,
  `pundak` varchar(5) NOT NULL,
  `ketek` varchar(5) NOT NULL,
  `klep_obras` varchar(5) NOT NULL,
  `samping` varchar(5) NOT NULL,
  `kaki_bawah` varchar(5) NOT NULL,
  `pasang_tali` varchar(5) NOT NULL,
  `rip_tangan` varchar(5) NOT NULL,
  `kam_tangan` varchar(5) NOT NULL,
  `kam_bawah` varchar(5) NOT NULL,
  `buang_benang_kecil` varchar(5) NOT NULL,
  `buang_benang_besar` varchar(5) NOT NULL,
  `lipat` varchar(5) NOT NULL,
  `supir` varchar(5) NOT NULL,
  `jumlah_hari` int(20) NOT NULL,
  `potong` varchar(5) NOT NULL,
  `full` varchar(10) NOT NULL,
  `gaji_bulanan` varchar(20) NOT NULL,
  `full_jahit` varchar(5) NOT NULL,
  `full_jahit_rip` varchar(5) NOT NULL,
  `full_obras` varchar(5) NOT NULL,
  `full_obras_rip` varchar(5) NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id_salary`, `id_karyawan`, `merek`, `jenis`, `quantity`, `size`, `no_seri`, `tanggal_gajian`, `createBy`, `createDate`, `kantong`, `klep`, `tali`, `stik_tangan`, `stik_bawah`, `tangan`, `pundak`, `ketek`, `klep_obras`, `samping`, `kaki_bawah`, `pasang_tali`, `rip_tangan`, `kam_tangan`, `kam_bawah`, `buang_benang_kecil`, `buang_benang_besar`, `lipat`, `supir`, `jumlah_hari`, `potong`, `full`, `gaji_bulanan`, `full_jahit`, `full_jahit_rip`, `full_obras`, `full_obras_rip`, `note`) VALUES
(1, 1, 'Seranno', 'Normal', '12', 'dewasa', 'MTX/000001', '2020-09-05', 'Nike', '05-09-2020  03:20:24', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 60, '0', '0', '3500000', '1', '0', '0', '0', ''),
(2, 1, 'Phank', 'Normal', '360', 'dewasa', 'RDX/000002', '2020-09-05', 'Nike', '05-09-2020  04:13:08', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 6000, '0', '0', '', '0', '1', '0', '0', ''),
(3, 1, 'Theda', 'Normal', '50', 'dewasa', 'MTX/000003', '2020-09-21', 'Nike', '14-09-2020  09:30:36', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 6000, '0', '0', '110000', '0', '1', '0', '1', ''),
(4, 1, 'Sielie', 'Normal', '360', 'dewasa', 'SLX/000004', '2020-09-29', 'Nike', '29-09-2020  11:35:45', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', 60, '0', '0', '', '0', '0', '0', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `salary_cmt`
--

CREATE TABLE `salary_cmt` (
  `id_salary_cmt` int(10) NOT NULL,
  `id_karyawan` varchar(50) NOT NULL,
  `no_surat_jalan` varchar(50) NOT NULL,
  `tanggal_gajian` varchar(20) NOT NULL,
  `no_seri` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `rincian_warna` varchar(300) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `quantity_masuk` varchar(29) NOT NULL,
  `tanggal_keluar` varchar(50) NOT NULL,
  `tanggal_masuk` varchar(50) NOT NULL,
  `total` int(20) NOT NULL,
  `createDate` varchar(50) NOT NULL,
  `createBy` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `perLusin` varchar(20) NOT NULL,
  `no_po` varchar(30) NOT NULL,
  `selesai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary_cmt`
--

INSERT INTO `salary_cmt` (`id_salary_cmt`, `id_karyawan`, `no_surat_jalan`, `tanggal_gajian`, `no_seri`, `description`, `warna`, `rincian_warna`, `quantity`, `quantity_masuk`, `tanggal_keluar`, `tanggal_masuk`, `total`, `createDate`, `createBy`, `status`, `perLusin`, `no_po`, `selesai`) VALUES
(1, 'PURWANTO', 'SK/BDR/2020/09/05/001', '2020-09-05', 'RDX/000002', 'KM KANAN', '', '', '360', '360', '2020-09-05', '2020-09-14', 15000, '05-09-2020  04:15:59 pm', 'Nike', 'Masuk', '30', 'RDX/2020/09/05/002', 0),
(2, 'PURWANTO', 'SK/BDR/2020/09/16/002', '', 'SGX/000003', 'KM KANAN', 'ENAM WARNA', '60', '60', '58', '2020-09-17', '2020-09-17', 15000, '16-09-2020  08:40:29 pm', 'Nike', 'Masuk', '10', 'SGX/2020/09/16/003', 0),
(3, 'PURWANTO', 'SK/BDR/2020/09/29/003', '2020-09-29', 'SLX/000004', 'KM KANAN', 'ENAM WARNA', '60', '3920', '3900', '2020-09-29', '2020-09-29', 15000, '29-09-2020  11:26:46 am', 'Nike', 'Masuk', '326,8', 'SLX/2020/09/29/004', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salary_saldo`
--

CREATE TABLE `salary_saldo` (
  `id_salary_saldo` int(10) NOT NULL,
  `jenis_kegiatan` varchar(30) NOT NULL,
  `size` varchar(20) NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `divisi` varchar(20) NOT NULL,
  `sub_divisi` varchar(20) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `createDate` varchar(30) NOT NULL,
  `createdBy` varchar(30) NOT NULL,
  `modifyDate` varchar(30) NOT NULL,
  `modifyBy` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salary_saldo`
--

INSERT INTO `salary_saldo` (`id_salary_saldo`, `jenis_kegiatan`, `size`, `lokasi`, `divisi`, `sub_divisi`, `harga`, `createDate`, `createdBy`, `modifyDate`, `modifyBy`) VALUES
(1, 'Kantong', 'ub', 'Dadap', '', '', '1500', '', '', '', ''),
(2, 'Klep', 'ub', 'Dadap', '', '', '2000', '', '', '', ''),
(3, 'Tali', 'ub', 'Dadap', '', '', '1000', '', '', '', ''),
(4, 'Stik Tangan', 'ub', 'Dadap', '', '', '1000', '', '', '', ''),
(5, 'Stik Bawah', 'ub', 'Dadap', '', '', '2000', '', '', '', ''),
(6, 'Pasang Tali', 'ub', 'Dadap', '', '', '1000', '', '', '', ''),
(7, 'Kantong', 'dewasa', 'Dadap', '', '', '1500', '', '', '', ''),
(8, 'Klep', 'dewasa', 'Dadap', '', '', '1750', '', '', '', ''),
(9, 'Tali', 'dewasa', 'Dadap', '', '', '3000', '', '', '', ''),
(10, 'Stik Tangan', 'dewasa', 'Dadap', '', '', '1000', '', '', '', ''),
(11, 'Stik Bawah', 'dewasa', 'Dadap', '', '', '1750', '', '', '', ''),
(12, 'Pasang Tali', 'dewasa', 'Dadap', '', '', '1000', '', '', '', ''),
(13, 'Kantong', 'tb', 'Dadap', '', '', '1500', '', '', '', ''),
(14, 'Klep', 'tb', 'Dadap', '', '', '1500', '', '', '', ''),
(15, 'Tali', 'tb', 'Dadap', '', '', '2500', '', '', '', ''),
(16, 'Stik Tangan', 'tb', 'Dadap', '', '', '1000', '', '', '', ''),
(17, 'Stik Bawah', 'tb', 'Dadap', '', '', '1500', '', '', '', ''),
(18, 'Pasang Tali', 'tb', 'Dadap', '', '', '500', '', '', '', ''),
(19, 'Kantong', '12', 'Dadap', '', '', '1500', '', '', '', ''),
(20, 'Klep', '12', 'Dadap', '', '', '1500', '', '', '', ''),
(21, 'Tali', '12', 'Dadap', '', '', '2500', '', '', '', ''),
(22, 'Stik Tangan', '12', 'Dadap', '', '', '750', '', '', '', ''),
(23, 'Stik Bawah', '12', 'Dadap', '', '', '1250', '', '', '', ''),
(24, 'Pasang Tali', '12', 'Dadap', '', '', '500', '', '', '', ''),
(25, 'Kantong', 'tkm', 'Dadap', '', '', '1250', '', '', '', ''),
(26, 'Klep', 'tkm', 'Dadap', '', '', '1250', '', '', '', ''),
(27, 'Tali', 'tkm', 'Dadap', '', '', '2000', '', '', '', ''),
(28, 'Stik Tangan', 'tkm', 'Dadap', '', '', '750', '', '', '', ''),
(29, 'Stik Bawah', 'tkm', 'Dadap', '', '', '1250', '', '', '', ''),
(30, 'Pasang Tali', 'tkm', 'Dadap', '', '', '500', '', '', '', ''),
(31, 'Kantong', 'tks', 'Dadap', '', '', '1000', '', '', '', ''),
(32, 'Klep', 'tks', 'Dadap', '', '', '1000', '', '', '', ''),
(33, 'Tali', 'tks', 'Dadap', '', '', '2000', '', '', '', ''),
(34, 'Stik Tangan', 'tks', 'Dadap', '', '', '750', '', '', '', ''),
(35, 'Stik Bawah', 'tks', 'Dadap', '', '', '1250', '', '', '', ''),
(36, 'Pasang Tali', 'tks', 'Dadap', '', '', '500', '', '', '', ''),
(37, 'Tangan', 'ub', 'Dadap', '', '', '500', '', '', '', ''),
(38, 'Pundak', 'ub', 'Dadap', '', '', '500', '', '', '', ''),
(39, 'Ketek', 'ub', 'Dadap', '', '', '1500', '', '', '', ''),
(40, 'Klep Obras', 'ub', 'Dadap', '', '', '1000', '', '', '', ''),
(41, 'Samping', 'ub', 'Dadap', '', '', '2000', '', '', '', ''),
(42, 'Kaki/Bawah', 'ub', 'Dadap', '', '', '1000', '', '', '', ''),
(43, 'Tangan', 'dewasa', 'Dadap', '', '', '500', '', '', '', ''),
(44, 'Pundak', 'dewasa', 'Dadap', '', '', '500', '', '', '', ''),
(45, 'Ketek', 'dewasa', 'Dadap', '', '', '1500', '', '', '', ''),
(46, 'Klep Obras', 'dewasa', 'Dadap', '', '', '1000', '', '', '', ''),
(47, 'Samping', 'dewasa', 'Dadap', '', '', '2000', '', '', '', ''),
(48, 'Kaki/Bawah', 'dewasa', 'Dadap', '', '', '1000', '', '', '', ''),
(49, 'RIP Tangan', 'dewasa', 'Dadap', '', '', '1500', '', '', '', ''),
(50, 'Tangan', 'tb', 'Dadap', '', '', '500', '', '', '', ''),
(51, 'Pundak', 'tb', 'Dadap', '', '', '500', '', '', '', ''),
(52, 'Ketek', 'tb', 'Dadap', '', '', '1250', '', '', '', ''),
(53, 'Klep Obras', 'tb', 'Dadap', '', '', '1000', '', '', '', ''),
(54, 'Samping', 'tb', 'Dadap', '', '', '1750', '', '', '', ''),
(55, 'Kaki/Bawah', 'tb', 'Dadap', '', '', '1000', '', '', '', ''),
(56, 'Tangan', '12', 'Dadap', '', '', '500', '', '', '', ''),
(57, 'Pundak', '12', 'Dadap', '', '', '500', '', '', '', ''),
(58, 'Ketek', '12', 'Dadap', '', '', '1250', '', '', '', ''),
(59, 'Klep Obras', '12', 'Dadap', '', '', '1000', '', '', '', ''),
(60, 'Samping', '12', 'Dadap', '', '', '1500', '', '', '', ''),
(61, 'Kaki/Bawah', '12', 'Dadap', '', '', '750', '', '', '', ''),
(62, 'Tangan', 'tkm', 'Dadap', '', '', '500', '', '', '', ''),
(63, 'Pundak', 'tkm', 'Dadap', '', '', '500', '', '', '', ''),
(64, 'Ketek', 'tkm', 'Dadap', '', '', '1000', '', '', '', ''),
(65, 'Klep Obras', 'tkm', 'Dadap', '', '', '1000', '', '', '', ''),
(66, 'Samping', 'tkm', 'Dadap', '', '', '1250', '', '', '', ''),
(67, 'Kaki/Bawah', 'tkm', 'Dadap', '', '', '750', '', '', '', ''),
(68, 'Tangan', 'tks', 'Dadap', '', '', '500', '', '', '', ''),
(69, 'Pundak', 'tks', 'Dadap', '', '', '500', '', '', '', ''),
(70, 'Ketek', 'tks', 'Dadap', '', '', '1000', '', '', '', ''),
(71, 'Klep Obras', 'tks', 'Dadap', '', '', '1000', '', '', '', ''),
(72, 'Samping', 'tks', 'Dadap', '', '', '1250', '', '', '', ''),
(73, 'Kaki/Bawah', 'tks', 'Dadap', '', '', '750', '', '', '', ''),
(74, 'Kam Tangan', 'ub', 'Dadap', '', '', '1000', '', '', '', ''),
(75, 'Kam Bawah', 'ub', 'Dadap', '', '', '3000', '', '', '', ''),
(76, 'Kam Tangan', 'dewasa', 'Dadap', '', '', '1000', '', '', '', ''),
(77, 'Kam Bawah', 'dewasa', 'Dadap', '', '', '2750', '', '', '', ''),
(78, 'Kam Tangan', 'tb', 'Dadap', '', '', '1000', '', '', '', ''),
(79, 'Kam Bawah', 'tb', 'Dadap', '', '', '2500', '', '', '', ''),
(80, 'Kam Tangan', '12', 'Dadap', '', '', '750', '', '', '', ''),
(81, 'Kam Bawah', '12', 'Dadap', '', '', '2000', '', '', '', ''),
(82, 'Kam Tangan', 'tkm', 'Dadap', '', '', '750', '', '', '', ''),
(83, 'Kam Bawah', 'tkm', 'Dadap', '', '', '2000', '', '', '', ''),
(84, 'Kam Tangan', 'tks', 'Dadap', '', '', '750', '', '', '', ''),
(85, 'Kam Bawah', 'tks', 'Dadap', '', '', '2000', '', '', '', ''),
(86, 'Buang Benang Besar', 'ub', 'Cengkareng', '', '', '500', '', '', '', ''),
(87, 'Buang Benang Besar', 'dewasa', 'Cengkareng', '', '', '500', '', '', '', ''),
(88, 'Buang Benang Kecil', 'tb', 'Cengkareng', '', '', '400', '', '', '', ''),
(89, 'Buang Benang Kecil', '12', 'Cengkareng', '', '', '400', '', '', '', ''),
(90, 'Buang Benang Kecil', '8', 'Cengkareng', '', '', '400', '', '', '', ''),
(91, 'Buang Benang Kecil', 'tkm', 'Cengkareng', '', '', '400', '', '', '', ''),
(92, 'Buang Benang Kecil', 'tks', 'Cengkareng', '', '', '400', '', '', '', ''),
(93, 'Lipat', 'tks', 'Cengkareng', '', '', '800', '', '', '', ''),
(94, 'Lipat', 'tkm', 'Cengkareng', '', '', '800', '', '', '', ''),
(95, 'Lipat', '8', 'Cengkareng', '', '', '800', '', '', '', ''),
(96, 'Lipat', '12', 'Cengkareng', '', '', '900', '', '', '', ''),
(97, 'Lipat', 'tb', 'Cengkareng', '', '', '900', '', '', '', ''),
(98, 'Lipat', 'dewasa', 'Cengkareng', '', '', '1000', '', '', '', ''),
(99, 'Lipat', 'ub', 'Cengkareng', '', '', '1200', '', '', '', ''),
(100, 'Supir', '', '', '', '', '50000', '', '', '', ''),
(103, 'Potong', 'ub', '', '', '', '5000', '', '', '', ''),
(104, 'Potong', 'dewasa', '', '', '', '2500', '', '', '', ''),
(105, 'Potong', '12', '', '', '', '2500', '', '', '', ''),
(106, 'Potong', '8', '', '', '', '2500', '', '', '', ''),
(107, 'Potong', 'tb', '', '', '', '2500', '', '', '', ''),
(108, 'Potong', 'tks', '', '', '', '2500', '', '', '', ''),
(109, 'Potong', 'tkm', '', '', '', '2500', '', '', '', ''),
(112, 'Harian Full', '', 'Dadap', '', '', '50000', '', '', '', ''),
(113, 'Harian', '', 'Cengkareng', 'Jahit', '', '20000', '', '', '', ''),
(114, 'Harian', '', 'Cengkareng', 'Obras', '', '20000', '', '', '', ''),
(115, 'Harian', '', 'Cengkareng', 'Potong', '', '', '', '', '', ''),
(116, 'Harian', '', 'Cengkareng', 'Packing', '', '30000', '', '', '', ''),
(117, 'Harian', '', 'Dadap', 'Potong', '', '', '', '', '', ''),
(118, 'Harian', '', 'Dadap', 'Jahit', '', '20000', '', '', '', ''),
(119, 'Harian', '', 'Dadap', 'Obras', '', '20000', '', '', '', ''),
(120, 'Harian', '', 'Cengkareng', 'Other', '', '30000', '', '', '', ''),
(121, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_1', '20000', '', '', '', ''),
(122, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_2', '20000', '', '', '', ''),
(123, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_3', '20000', '', '', '', ''),
(124, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_4', '20000', '', '', '', ''),
(125, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_5', '20000', '', '', '', ''),
(126, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_6', '20000', '', '', '', ''),
(127, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_7', '20000', '', '', '', ''),
(128, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_8', '20000', '', '', '', ''),
(129, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_9', '20000', '', '', '', ''),
(130, 'Harian', '', 'Dadap', 'Sablon', 'sub_div_10', '20000', '', '', '', ''),
(131, 'Harian Full', '', 'Cengkareng', 'Supir', '', '160000', '', '', '', ''),
(132, 'Harian', '', 'Cengkareng', 'Supir', '', '60000', '', '', '', ''),
(133, 'Full Jahit', 'ub', '', '', '', '1500', '', '', '', ''),
(134, 'Full Jahit', 'dewasa', '', '', '', '1500', '', '', '', ''),
(135, 'Full Jahit', 'tb', '', '', '', '1500', '', '', '', ''),
(136, 'Full Jahit', '12', '', '', '', '1500', '', '', '', ''),
(137, 'Full Jahit', '8', '', '', '', '1500', '', '', '', ''),
(138, 'Full Jahit', 'tkm', '', '', '', '1500', '', '', '', ''),
(139, 'Full Jahit', 'tks', '', '', '', '1500', '', '', '', ''),
(140, 'Full Jahit RIP', 'ub', '', '', '', '1500', '', '', '', ''),
(141, 'Full Jahit RIP', 'dewasa', '', '', '', '1500', '', '', '', ''),
(142, 'Full Jahit RIP', '12', '', '', '', '1500', '', '', '', ''),
(143, 'Full Jahit RIP', '8', '', '', '', '1500', '', '', '', ''),
(144, 'Full Jahit RIP', 'tkm', '', '', '', '1500', '', '', '', ''),
(145, 'Full Jahit RIP', 'tks', '', '', '', '1500', '', '', '', ''),
(146, 'Full Obras', 'ub', '', '', '', '1500', '', '', '', ''),
(147, 'Full Obras', 'dewasa', '', '', '', '1500', '', '', '', ''),
(148, 'Full Obras', 'tb', '', '', '', '1500', '', '', '', ''),
(149, 'Full Obras', '12', '', '', '', '1500', '', '', '', ''),
(150, 'Full Obras', '8', '', '', '', '1500', '', '', '', ''),
(151, 'Full Obras', 'tkm', '', '', '', '1500', '', '', '', ''),
(152, 'Full Obras', 'tks', '', '', '', '1500', '', '', '', ''),
(153, 'Full Obras RIP', 'ub', '', '', '', '1500', '', '', '', ''),
(154, 'Full Obras RIP', 'dewasa', '', '', '', '1500', '', '', '', ''),
(155, 'Full Obras RIP', 'tb', '', '', '', '1500', '', '', '', ''),
(156, 'Full Obras RIP', '12', '', '', '', '1500', '', '', '', ''),
(157, 'Full Obras RIP', '8', '', '', '', '1500', '', '', '', ''),
(158, 'Full Obras RIP', 'tkm', '', '', '', '1500', '', '', '', ''),
(159, 'Full Obras RIP', 'tks', '', '', '', '1500', '', '', '', ''),
(160, 'Full Jahit RIP', 'tb', '', '', '', '1500', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(10) NOT NULL,
  `id_purchase_order` int(10) NOT NULL,
  `no_po` varchar(20) NOT NULL,
  `no_surat_jalan` varchar(20) DEFAULT NULL,
  `tanggal_masuk` varchar(20) DEFAULT NULL,
  `nomor_seri` varchar(20) DEFAULT NULL,
  `merek_stock` varchar(20) DEFAULT NULL,
  `nama_bahan` varchar(100) DEFAULT NULL,
  `jenis_bahan` varchar(20) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `size` varchar(50) NOT NULL,
  `warna_bahan` varchar(20) DEFAULT NULL,
  `harga_bahan` int(10) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `jumlah_terjual` int(20) NOT NULL,
  `createBy` varchar(20) DEFAULT NULL,
  `createDate` varchar(20) DEFAULT NULL,
  `modifyBy` varchar(20) DEFAULT NULL,
  `modifyDate` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `id_purchase_order`, `no_po`, `no_surat_jalan`, `tanggal_masuk`, `nomor_seri`, `merek_stock`, `nama_bahan`, `jenis_bahan`, `quantity`, `size`, `warna_bahan`, `harga_bahan`, `satuan`, `no_invoice`, `jumlah_terjual`, `createBy`, `createDate`, `modifyBy`, `modifyDate`) VALUES
(4, 0, 'MTX/2020/09/16/003', NULL, '2020-09-16', 'MTX/000003', NULL, 'HANDUK', 'PE', 120, 'Dewasa', 'PUTIH', 43000, NULL, '', 0, 'Nike', '16-09-2020  12:41:21', NULL, NULL),
(5, 0, 'MTX/2020/09/16/003', NULL, '2020-09-16', 'MTX/000003', NULL, 'HANDUK', 'PE', 120, 'Dewasa', 'MAROON', 43000, NULL, '', 0, 'Nike', '16-09-2020  12:41:21', NULL, NULL),
(6, 0, 'MTX/2020/09/16/003', NULL, '2020-09-16', 'MTX/000003', NULL, 'HANDUK', 'PE', 120, 'Dewasa', 'BIRU', 43000, NULL, '', 0, 'Nike', '16-09-2020  12:41:21', NULL, NULL),
(7, 0, 'MTX/2020/09/16/003', NULL, '2020-09-16', 'MTX/000003', NULL, 'HANDUK', 'PE', 120, 'Dewasa', 'PUTIH', 43000, NULL, '', 0, 'Nike', '16-09-2020  12:41:54', NULL, NULL),
(8, 0, 'MTX/2020/09/16/003', NULL, '2020-09-16', 'MTX/000003', NULL, 'HANDUK', 'PE', 120, 'Dewasa', 'MAROON', 43000, NULL, '', 0, 'Nike', '16-09-2020  12:41:54', NULL, NULL),
(10, 0, 'MTX/2020/09/16/003', NULL, '2020-09-16', 'MTX/000003', NULL, 'HANDUK', 'PE', 180, 'Dewasa', 'PUTIH', 43000, NULL, '', 0, 'Nike', '16-09-2020  12:48:41', NULL, NULL),
(12, 0, 'SGX/2020/09/16/003', NULL, '2020-09-16', 'SGX/000003', 'Theda', 'HANDUK', 'PE', 120, 'Dewasa', 'PUTIH', 43000, 'Lusin', '', 0, 'Nike', '16-09-2020  07:38:00', 'Nike', '16-09-2020  07:39:39'),
(13, 0, 'SLX/2020/09/29/004', NULL, '2020-09-29', 'SLX/000004', '', 'HANDUK', 'PE', 4320, 'Dewasa', 'PUTIH, BIRU, FANTA, ', 43000, '', '', 0, 'Nike', '29-09-2020  11:21:28', 'Nike', '29-09-2020  11:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `stock_other`
--

CREATE TABLE `stock_other` (
  `id_stock_other` int(20) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `quantity` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(10) NOT NULL,
  `kode_supplier` varchar(3) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat_supplier` varchar(50) NOT NULL,
  `no_tlp_supplier` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`, `alamat_supplier`, `no_tlp_supplier`) VALUES
(1, 'MTX', 'MERRYTEX', 'LATUMENTEN', '02166666666'),
(2, 'RDX', 'RUDYTEX', 'BANDUNG', '0212565553'),
(3, 'SGX', 'SUGITEX', 'LATUMENTEN', '0216620774'),
(4, 'SLX', 'SIELIETEX', 'JALAN DURI RAYA NO 2001', '0215415590');

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan`
--

CREATE TABLE `surat_jalan` (
  `id_surat_jalan` int(20) NOT NULL,
  `no_surat_jalan` varchar(50) NOT NULL,
  `no_po` varchar(20) NOT NULL,
  `no_seri` varchar(20) NOT NULL,
  `tanggal_surat_jalan` varchar(10) NOT NULL,
  `nama_vendor` varchar(20) NOT NULL,
  `qty` int(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `createBy` varchar(20) NOT NULL,
  `createDate` varchar(20) NOT NULL,
  `perLusin` varchar(20) NOT NULL,
  `selesai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_jalan`
--

INSERT INTO `surat_jalan` (`id_surat_jalan`, `no_surat_jalan`, `no_po`, `no_seri`, `tanggal_surat_jalan`, `nama_vendor`, `qty`, `description`, `createBy`, `createDate`, `perLusin`, `selesai`) VALUES
(1, '0002222', 'Vendor', '101', '09/05/2020', 'JAJANG', 360, '', 'Nike', '05-09-2020  03:23:08', '', 0),
(4, '17092020', 'RDX/2020/09/05/002', '', '', '', 0, '', 'Nike', '16-09-2020  08:46:33', '', 0),
(5, '17092020', 'Vendor', '', '09/17/2020', 'CLOVER', 0, '', 'Nike', '16-09-2020  08:57:59', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan_cmt`
--

CREATE TABLE `surat_jalan_cmt` (
  `id_surat_jalan_cmt` int(10) NOT NULL,
  `id_karyawan` varchar(100) NOT NULL,
  `no_surat_jalan` varchar(100) NOT NULL,
  `tanggal_gajian` varchar(100) NOT NULL,
  `no_seri` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `warna` varchar(200) NOT NULL,
  `rincian_warna` varchar(300) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `quantity_masuk` varchar(20) NOT NULL,
  `tanggal_keluar` varchar(50) NOT NULL,
  `tanggal_masuk` varchar(50) NOT NULL,
  `total` int(20) NOT NULL,
  `createDate` varchar(50) NOT NULL,
  `createBy` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `perLusin` varchar(20) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `selesai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_jalan_cmt`
--

INSERT INTO `surat_jalan_cmt` (`id_surat_jalan_cmt`, `id_karyawan`, `no_surat_jalan`, `tanggal_gajian`, `no_seri`, `description`, `warna`, `rincian_warna`, `quantity`, `quantity_masuk`, `tanggal_keluar`, `tanggal_masuk`, `total`, `createDate`, `createBy`, `status`, `perLusin`, `no_po`, `selesai`) VALUES
(1, 'DANIEL', 'SK/CMT/2020/09/05/001', '2020-09-05', '', 'KM DEWASA SIELIE', '', '', '', '', '2020-09-05', '', 23000, '05-09-2020  04:20:12 pm', 'Nike', 'Keluar', '', 'RDX/2020/09/05/002', 0),
(2, 'DANIEL', 'SK/CMT/2020/09/14/002', '2020-09-14', 'RDX/000002', 'KM DEWASA SIELIE', 'MAROON', '36', '36', '', '2020-09-14', '', 23000, '14-09-2020  10:27:31 am', 'Nike', 'Keluar', '3', 'RDX/2020/09/05/002', 0),
(3, 'DANIEL', 'SK/CMT/2020/09/16/003', '2020-09-16', 'SGX/000003', 'KM DEWASA SABLON KELINCI', 'PUTIH', '60', '60', '55', '2020-09-16', '2020-09-16', 23000, '16-09-2020  07:43:47 pm', 'Nike', 'Masuk', '5', 'SGX/2020/09/16/003', 0),
(4, 'DANIEL', 'SK/CMT/2020/09/16/004', '2020-09-17', 'SGX/000003', 'KM DEWASA SABLON KELINCI', 'PUTIH', '60', '60', '57', '2020-09-17', '2020-09-17', 23000, '16-09-2020  07:51:39 pm', 'Nike', 'Masuk', '5', 'SGX/2020/09/16/003', 0),
(5, 'DANIEL', 'SK/CMT/2020/09/29/005', '2020-09-29', 'SLX/000004', 'KM DEWASA SIELIE', 'ENAM WARNA', '60', '360', '355', '2020-09-29', '2020-09-29', 23000, '29-09-2020  11:30:25 am', 'Nike', 'Masuk', '30', 'SLX/2020/09/29/004', 0);

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan_penjualan`
--

CREATE TABLE `surat_jalan_penjualan` (
  `id_surat_jalan_penjualan` int(50) NOT NULL,
  `no_surat_jalan` varchar(100) NOT NULL,
  `tanggal_surat_jalan` varchar(50) NOT NULL,
  `no_seri` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `harga_satuan` varchar(200) NOT NULL,
  `createBy` varchar(50) NOT NULL,
  `createDate` varchar(50) NOT NULL,
  `cancellation` varchar(10) NOT NULL,
  `modifyBy` varchar(50) NOT NULL,
  `modifyDate` varchar(50) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `perLusin` varchar(20) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `selesai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_jalan_penjualan`
--

INSERT INTO `surat_jalan_penjualan` (`id_surat_jalan_penjualan`, `no_surat_jalan`, `tanggal_surat_jalan`, `no_seri`, `quantity`, `description`, `harga_satuan`, `createBy`, `createDate`, `cancellation`, `modifyBy`, `modifyDate`, `no_invoice`, `merek`, `perLusin`, `no_po`, `selesai`) VALUES
(1, 'SK/THD/2020/09/29/001', '2020-09-29', 'SLX/000004', '60', 'KIMONO HANDUK WARNA', '35000', 'Nike', '29-09-2020  11:43:42 am', 'NO', '', '', 'INV/2020/09/29/001', 'Theda', '4200', '', 0),
(2, 'SK/THD/2020/09/29/002', '2020-09-29', 'SLX/000004', '85', 'KIMONO HANDUK WARNA', '35000', 'Nike', '29-09-2020  11:47:39 am', 'NO', '', '', 'INV/2020/09/29/002', 'Theda', '6,7', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan_sablon`
--

CREATE TABLE `surat_jalan_sablon` (
  `id_surat_jalan_sablon` int(10) NOT NULL,
  `id_karyawan` varchar(100) NOT NULL,
  `no_surat_jalan` varchar(100) NOT NULL,
  `tanggal_gajian` varchar(100) NOT NULL,
  `no_seri` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `warna` varchar(200) NOT NULL,
  `rincian_warna` varchar(300) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `quantity_masuk` varchar(20) NOT NULL,
  `tanggal_keluar` varchar(50) NOT NULL,
  `tanggal_masuk` varchar(50) NOT NULL,
  `total` int(20) NOT NULL,
  `createDate` varchar(50) NOT NULL,
  `createBy` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `perLusin` varchar(20) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `selesai` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_jalan_sablon`
--

INSERT INTO `surat_jalan_sablon` (`id_surat_jalan_sablon`, `id_karyawan`, `no_surat_jalan`, `tanggal_gajian`, `no_seri`, `description`, `warna`, `rincian_warna`, `quantity`, `quantity_masuk`, `tanggal_keluar`, `tanggal_masuk`, `total`, `createDate`, `createBy`, `status`, `perLusin`, `no_po`, `selesai`) VALUES
(1, 'ALAN', 'SK/SBL/2020/09/14/001', '2020-09-14', 'MTX/000003', 'KM DEWASA SABLON KELINCI', 'PUTIH', '', '', '750', '2020-09-14', '', 45000, '14-09-2020  09:33:59 am', 'Nike', 'Masuk', '', 'MTX/2020/09/14/003', 0),
(2, 'ALAN', 'SK/SBL/2020/09/14/002', '', 'MTX/000003', 'KM DEWASA SABLON KELINCI', 'PUTIH', '', '360', '', '2020-09-14', '', 45000, '14-09-2020  09:38:11 am', 'Nike', 'Keluar', '30', 'MTX/2020/09/14/003', 0),
(3, 'ALAN', 'SK/SBL/2020/09/14/003', '2020-09-14', 'MTX/000003', 'KM DEWASA SABLON KELINCI', 'PUTIH', '', '360', '', '2020-09-14', '', 45000, '14-09-2020  10:20:38 am', 'Nike', 'Keluar', '30', 'MTX/2020/09/14/003', 0),
(4, 'ALAN', 'SK/SBL/2020/09/14/003', '2020-09-14', '', '', '', '', '', '', '', '', 0, '14-09-2020  10:20:38 am', 'Nike', 'Keluar', '', 'MTX/2020/09/14/003', 0),
(5, 'ALAN', 'SK/SBL/2020/09/16/004', '2020-09-14', 'MTX/000003', 'KM DEWASA SABLON KELINCI', 'PUTIH', '180', '180', '', '2020-09-15', '', 45000, '16-09-2020  12:50:26 pm', 'Nike', 'Keluar', '15', 'MTX/2020/09/16/003', 0),
(6, 'ALAN', 'SK/SBL/2020/09/16/005', '2020-09-15', 'MTX/000003', 'KM DEWASA SABLON KELINCI', 'PUTIH', '3600', '3600', '', '2020-09-16', '', 45000, '16-09-2020  12:53:39 pm', 'Nike', 'Keluar', '300', 'MTX/2020/09/16/003', 0),
(7, 'ALAN', 'SK/SBL/2020/09/16/006', '2020-09-16', 'SGX/000003', 'KM DEWASA SABLON KELINCI', 'PUTIH', '120', '120', '120', '2020-09-16', '2020-09-16', 45000, '16-09-2020  07:41:50 pm', 'Nike', 'Masuk', '10', 'SGX/2020/09/16/003', 0),
(8, 'DANIEL', 'SK/SBL/2020/09/16/007', '2020-09-17', 'SGX/000003', 'KM DEWASA SABLON KELINCI', 'PUTIH', '60', '60', '60', '2020-09-17', '2020-09-17', 23000, '16-09-2020  07:48:35 pm', 'Nike', 'Masuk', '5', 'SGX/2020/09/16/003', 0),
(9, 'ALAN', 'SK/SBL/2020/09/29/008', '2020-09-29', 'SLX/000004', 'KM DEWASA SABLON KELINCI', 'PUTIH', '120', '360', '350', '2020-09-29', '', 23000, '29-09-2020  11:23:36 am', 'Nike', 'Masuk', '30', 'SLX/2020/09/29/004', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) NOT NULL,
  `nick_user` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `pass_user` varchar(50) NOT NULL,
  `rules_user` int(10) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nick_user`, `nama_user`, `email_user`, `pass_user`, `rules_user`, `status`) VALUES
(1, 'Denny Tanujaya', 'Denni Tanudjaja', 'tanujayadenny@gmail.com', 'Password1', 1, 1),
(2, 'Eunike', 'Nike', 'eunike@gmail.com', 'password123', 1, 0),
(3, 'Nobel', 'Nobel', '', 'password1', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `daftar_inventaris`
--
ALTER TABLE `daftar_inventaris`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kasbon_bahan`
--
ALTER TABLE `kasbon_bahan`
  ADD PRIMARY KEY (`id_kasbon_bahan`);

--
-- Indexes for table `kasbon_uang`
--
ALTER TABLE `kasbon_uang`
  ADD PRIMARY KEY (`id_kasbon`);

--
-- Indexes for table `noseri`
--
ALTER TABLE `noseri`
  ADD PRIMARY KEY (`id_noSeri`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id_other`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id_purchase_order`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id_salary`);

--
-- Indexes for table `salary_cmt`
--
ALTER TABLE `salary_cmt`
  ADD PRIMARY KEY (`id_salary_cmt`);

--
-- Indexes for table `salary_saldo`
--
ALTER TABLE `salary_saldo`
  ADD PRIMARY KEY (`id_salary_saldo`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indexes for table `stock_other`
--
ALTER TABLE `stock_other`
  ADD PRIMARY KEY (`id_stock_other`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD PRIMARY KEY (`id_surat_jalan`);

--
-- Indexes for table `surat_jalan_cmt`
--
ALTER TABLE `surat_jalan_cmt`
  ADD PRIMARY KEY (`id_surat_jalan_cmt`);

--
-- Indexes for table `surat_jalan_penjualan`
--
ALTER TABLE `surat_jalan_penjualan`
  ADD PRIMARY KEY (`id_surat_jalan_penjualan`);

--
-- Indexes for table `surat_jalan_sablon`
--
ALTER TABLE `surat_jalan_sablon`
  ADD PRIMARY KEY (`id_surat_jalan_sablon`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daftar_inventaris`
--
ALTER TABLE `daftar_inventaris`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_inventaris` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kasbon_bahan`
--
ALTER TABLE `kasbon_bahan`
  MODIFY `id_kasbon_bahan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kasbon_uang`
--
ALTER TABLE `kasbon_uang`
  MODIFY `id_kasbon` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `noseri`
--
ALTER TABLE `noseri`
  MODIFY `id_noSeri` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id_other` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id_purchase_order` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `id_retur` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id_salary` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salary_cmt`
--
ALTER TABLE `salary_cmt`
  MODIFY `id_salary_cmt` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary_saldo`
--
ALTER TABLE `salary_saldo`
  MODIFY `id_salary_saldo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stock_other`
--
ALTER TABLE `stock_other`
  MODIFY `id_stock_other` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  MODIFY `id_surat_jalan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_jalan_cmt`
--
ALTER TABLE `surat_jalan_cmt`
  MODIFY `id_surat_jalan_cmt` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surat_jalan_penjualan`
--
ALTER TABLE `surat_jalan_penjualan`
  MODIFY `id_surat_jalan_penjualan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_jalan_sablon`
--
ALTER TABLE `surat_jalan_sablon`
  MODIFY `id_surat_jalan_sablon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
