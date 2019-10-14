-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2017 at 05:23 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cicilan`
--

CREATE TABLE `cicilan` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `tipe` varchar(30) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `tanggal_mulai_diterima` date NOT NULL,
  `tanggal_akhir_diterima` date NOT NULL,
  `kuota_terpakai` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `periode` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuti`
--

INSERT INTO `cuti` (`id`, `id_karyawan`, `id_divisi`, `cabang`, `level`, `tipe`, `tanggal_mulai`, `tanggal_selesai`, `tanggal_mulai_diterima`, `tanggal_akhir_diterima`, `kuota_terpakai`, `status`, `keterangan`, `periode`) VALUES
(2, 111, 5, 'Jakarta', 4, 'Urusan Pribadi', '2017-03-18', '2017-03-20', '2017-03-18', '2017-03-19', 2, 'Diterima', 'Liburan', 'Maret_2017'),
(3, 116, 2, 'Jakarta', 4, 'Urusan Pribadi', '2017-03-02', '2017-03-10', '0000-00-00', '0000-00-00', 0, 'Menunggu', 'Liburan', 'Maret_2017');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kenaikkan`
--

CREATE TABLE `kenaikkan` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  `presentase` int(5) NOT NULL,
  `presentase_diterima` int(3) NOT NULL,
  `status` varchar(20) NOT NULL,
  `isApply` varchar(20) NOT NULL,
  `alasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kenaikkan`
--

INSERT INTO `kenaikkan` (`id`, `id_karyawan`, `id_divisi`, `cabang`, `level`, `tanggal`, `presentase`, `presentase_diterima`, `status`, `isApply`, `alasan`) VALUES
(2, 111, 5, 'Jakarta', 1, '2017-03-17', 10, 0, 'Diterima', 'belum', 'saya sudah bekerja dengan baik');

-- --------------------------------------------------------

--
-- Table structure for table `klaim`
--

CREATE TABLE `klaim` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lap_absensi`
--

CREATE TABLE `lap_absensi` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `datang_timezone_1` time NOT NULL,
  `pulang_timezone_1` time NOT NULL,
  `datang_timezone_2` time NOT NULL,
  `pulang_timezone_2` time NOT NULL,
  `terlambat` int(11) NOT NULL,
  `pulang_awal` int(11) NOT NULL,
  `absen` int(11) NOT NULL,
  `lembur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lap_absensi`
--

INSERT INTO `lap_absensi` (`id`, `id_karyawan`, `nama`, `departemen`, `tanggal`, `datang_timezone_1`, `pulang_timezone_1`, `datang_timezone_2`, `pulang_timezone_2`, `terlambat`, `pulang_awal`, `absen`, `lembur`) VALUES
(3313, 111, 'Andreas', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3314, 111, 'Andreas', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3315, 111, 'Andreas', 'IT', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3316, 111, 'Andreas', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3317, 111, 'Andreas', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3318, 111, 'Andreas', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3319, 111, 'Andreas', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3320, 111, 'Andreas', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3321, 111, 'Andreas', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3322, 111, 'Andreas', 'IT', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3323, 111, 'Andreas', 'IT', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3324, 111, 'Andreas', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3325, 111, 'Andreas', 'IT', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3326, 111, 'Andreas', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3327, 111, 'Andreas', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3328, 111, 'Andreas', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3329, 112, 'Feri', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3330, 112, 'Feri', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3331, 112, 'Feri', 'IT', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3332, 112, 'Feri', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3333, 112, 'Feri', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3334, 112, 'Feri', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3335, 112, 'Feri', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3336, 112, 'Feri', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3337, 112, 'Feri', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3338, 112, 'Feri', 'IT', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3339, 112, 'Feri', 'IT', '2017-01-15', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 0, 480, 0),
(3340, 112, 'Feri', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3341, 112, 'Feri', 'IT', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3342, 112, 'Feri', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3343, 112, 'Feri', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3344, 112, 'Feri', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3345, 123, 'Vina', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3346, 123, 'Vina', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3347, 123, 'Vina', 'IT', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3348, 123, 'Vina', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3349, 123, 'Vina', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3350, 123, 'Vina', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3351, 123, 'Vina', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3352, 123, 'Vina', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3353, 123, 'Vina', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3354, 123, 'Vina', 'IT', '2017-01-14', '08:24:00', '12:02:00', '13:05:00', '17:01:00', 24, 0, 0, 0),
(3355, 123, 'Vina', 'IT', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3356, 123, 'Vina', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3357, 123, 'Vina', 'IT', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3358, 123, 'Vina', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3359, 123, 'Vina', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3360, 123, 'Vina', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3361, 115, 'Adhy', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3362, 115, 'Adhy', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3363, 115, 'Adhy', 'IT', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3364, 115, 'Adhy', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3365, 115, 'Adhy', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3366, 115, 'Adhy', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3367, 115, 'Adhy', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3368, 115, 'Adhy', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3369, 115, 'Adhy', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3370, 115, 'Adhy', 'IT', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3371, 115, 'Adhy', 'IT', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3372, 115, 'Adhy', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3373, 115, 'Adhy', 'IT', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3374, 115, 'Adhy', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3375, 115, 'Adhy', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3376, 115, 'Adhy', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3377, 113, 'AG', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3378, 113, 'AG', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3379, 113, 'AG', 'IT', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3380, 113, 'AG', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3381, 113, 'AG', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3382, 113, 'AG', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3383, 113, 'AG', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3384, 113, 'AG', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3385, 113, 'AG', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3386, 113, 'AG', 'IT', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3387, 113, 'AG', 'IT', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3388, 113, 'AG', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3389, 113, 'AG', 'IT', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3390, 113, 'AG', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3391, 113, 'AG', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3392, 113, 'AG', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3393, 114, 'Mai', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3394, 114, 'Mai', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3395, 114, 'Mai', 'IT', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3396, 114, 'Mai', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3397, 114, 'Mai', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3398, 114, 'Mai', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3399, 114, 'Mai', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3400, 114, 'Mai', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3401, 114, 'Mai', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3402, 114, 'Mai', 'IT', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3403, 114, 'Mai', 'IT', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3404, 114, 'Mai', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3405, 114, 'Mai', 'IT', '2017-01-19', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, 0, 480, 0),
(3406, 114, 'Mai', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3407, 114, 'Mai', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3408, 114, 'Mai', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3409, 116, 'Lily', 'Finance', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3410, 116, 'Lily', 'Finance', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3411, 116, 'Lily', 'Finance', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3412, 116, 'Lily', 'Finance', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3413, 116, 'Lily', 'Finance', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3414, 116, 'Lily', 'Finance', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3415, 116, 'Lily', 'Finance', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3416, 116, 'Lily', 'Finance', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3417, 116, 'Lily', 'Finance', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3418, 116, 'Lily', 'Finance', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3419, 116, 'Lily', 'Finance', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3420, 116, 'Lily', 'Finance', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3421, 116, 'Lily', 'Finance', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3422, 116, 'Lily', 'Finance', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3423, 116, 'Lily', 'Finance', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3424, 116, 'Lily', 'Finance', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3425, 117, 'Nurul', 'HRD', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3426, 117, 'Nurul', 'HRD', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3427, 117, 'Nurul', 'HRD', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3428, 117, 'Nurul', 'HRD', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3429, 117, 'Nurul', 'HRD', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3430, 117, 'Nurul', 'HRD', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3431, 117, 'Nurul', 'HRD', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3432, 117, 'Nurul', 'HRD', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3433, 117, 'Nurul', 'HRD', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3434, 117, 'Nurul', 'HRD', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3435, 117, 'Nurul', 'HRD', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3436, 117, 'Nurul', 'HRD', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3437, 117, 'Nurul', 'HRD', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3438, 117, 'Nurul', 'HRD', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3439, 117, 'Nurul', 'HRD', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3440, 117, 'Nurul', 'HRD', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3441, 118, 'Fajar', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3442, 118, 'Fajar', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3443, 118, 'Fajar', 'IT', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3444, 118, 'Fajar', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3445, 118, 'Fajar', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3446, 118, 'Fajar', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3447, 118, 'Fajar', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3448, 118, 'Fajar', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3449, 118, 'Fajar', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3450, 118, 'Fajar', 'IT', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3451, 118, 'Fajar', 'IT', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3452, 118, 'Fajar', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3453, 118, 'Fajar', 'IT', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3454, 118, 'Fajar', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3455, 118, 'Fajar', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3456, 118, 'Fajar', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3457, 119, 'Bagus', 'HRD', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3458, 119, 'Bagus', 'HRD', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3459, 119, 'Bagus', 'HRD', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3460, 119, 'Bagus', 'HRD', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3461, 119, 'Bagus', 'HRD', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3462, 119, 'Bagus', 'HRD', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3463, 119, 'Bagus', 'HRD', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3464, 119, 'Bagus', 'HRD', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3465, 119, 'Bagus', 'HRD', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3466, 119, 'Bagus', 'HRD', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3467, 119, 'Bagus', 'HRD', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3468, 119, 'Bagus', 'HRD', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3469, 119, 'Bagus', 'HRD', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3470, 119, 'Bagus', 'HRD', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3471, 119, 'Bagus', 'HRD', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3472, 119, 'Bagus', 'HRD', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3473, 120, 'Jane', 'Finance', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3474, 120, 'Jane', 'Finance', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3475, 120, 'Jane', 'Finance', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3476, 120, 'Jane', 'Finance', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3477, 120, 'Jane', 'Finance', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3478, 120, 'Jane', 'Finance', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3479, 120, 'Jane', 'Finance', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3480, 120, 'Jane', 'Finance', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3481, 120, 'Jane', 'Finance', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3482, 120, 'Jane', 'Finance', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3483, 120, 'Jane', 'Finance', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3484, 120, 'Jane', 'Finance', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3485, 120, 'Jane', 'Finance', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3486, 120, 'Jane', 'Finance', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3487, 120, 'Jane', 'Finance', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3488, 120, 'Jane', 'Finance', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3489, 121, 'Rizky', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3490, 121, 'Rizky', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3491, 121, 'Rizky', 'IT', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3492, 121, 'Rizky', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3493, 121, 'Rizky', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3494, 121, 'Rizky', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3495, 121, 'Rizky', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3496, 121, 'Rizky', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3497, 121, 'Rizky', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3498, 121, 'Rizky', 'IT', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3499, 121, 'Rizky', 'IT', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3500, 121, 'Rizky', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3501, 121, 'Rizky', 'IT', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3502, 121, 'Rizky', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3503, 121, 'Rizky', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3504, 121, 'Rizky', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3505, 122, 'Ali', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3506, 122, 'Ali', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3507, 122, 'Ali', 'IT', '2017-01-05', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3508, 122, 'Ali', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3509, 122, 'Ali', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3510, 122, 'Ali', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3511, 122, 'Ali', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3512, 122, 'Ali', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3513, 122, 'Ali', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3514, 122, 'Ali', 'IT', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3515, 122, 'Ali', 'IT', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3516, 122, 'Ali', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3517, 122, 'Ali', 'IT', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3518, 122, 'Ali', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3519, 122, 'Ali', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3520, 122, 'Ali', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3521, 124, 'Hafiz', 'IT', '2017-01-01', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3522, 124, 'Hafiz', 'IT', '2017-01-04', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3523, 124, 'Hafiz', 'IT', '2017-01-05', '08:04:00', '00:00:00', '00:00:00', '00:00:00', 0, 0, 480, 0),
(3524, 124, 'Hafiz', 'IT', '2017-01-06', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3525, 124, 'Hafiz', 'IT', '2017-01-07', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3526, 124, 'Hafiz', 'IT', '2017-01-08', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3527, 124, 'Hafiz', 'IT', '2017-01-11', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3528, 124, 'Hafiz', 'IT', '2017-01-12', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3529, 124, 'Hafiz', 'IT', '2017-01-13', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3530, 124, 'Hafiz', 'IT', '2017-01-14', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3531, 124, 'Hafiz', 'IT', '2017-01-15', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3532, 124, 'Hafiz', 'IT', '2017-01-18', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3533, 124, 'Hafiz', 'IT', '2017-01-19', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3534, 124, 'Hafiz', 'IT', '2017-01-20', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3535, 124, 'Hafiz', 'IT', '2017-01-21', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0),
(3536, 124, 'Hafiz', 'IT', '2017-01-22', '08:04:00', '12:02:00', '13:05:00', '17:01:00', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lembur`
--

CREATE TABLE `lembur` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `level` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  `periode` varchar(50) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `uraian` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lembur`
--

INSERT INTO `lembur` (`id`, `id_karyawan`, `id_divisi`, `cabang`, `level`, `tanggal`, `periode`, `tipe`, `uraian`, `status`) VALUES
(1, 111, 5, 'Jakarta', 4, '2017-03-27', 'Maret 2017', 'perintah', 'Mengerjakan Deadline', 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `libur`
--

CREATE TABLE `libur` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `ulangi` varchar(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `isi` varchar(200) NOT NULL,
  `isRead` varchar(10) NOT NULL,
  `level` int(11) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `cabang` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pengirim` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `id_penerima`, `isi`, `isRead`, `level`, `divisi`, `cabang`, `tanggal`, `id_pengirim`, `nama`, `lokasi`) VALUES
(9, 0, 'Andreas melakukan pengajuan kenaikkan', 'y', 1, '0', 'Jakarta', '2017-03-17', 111, 'Andreas', '?modul=kenaikkan&act=detailKenaikkan&id=2'),
(10, 111, 'Pengajuan kenaikkan anda Menunggu', 'n', 4, '', 'Jakarta', '2017-03-17', 122, 'Andreas', '?modul=karyawanKenaikkan&act=detailKenaikkan&id=2'),
(11, 111, 'Pengajuan kenaikkan anda Diterima', 'y', 4, '', 'Jakarta', '2017-03-17', 122, 'Andreas', '?modul=karyawanKenaikkan&act=detailKenaikkan&id=2'),
(12, 0, 'Andreas melakukan pengajuan cuti', 'y', 3, '5', 'Jakarta', '2017-03-17', 111, 'Andreas', '?modul=cuti&act=detailCuti&id=2'),
(13, 111, 'Tanggal cuti Diterima oleh Andreas', 'y', 4, 'id_divisi', 'Jakarta', '2017-03-17', 0, 'Andreas', '?modul=karyawanCuti&act=detailCuti&id=2'),
(14, 0, 'Andreas melakukan pengajuan pinjaman', 'y', 1, '0', 'Jakarta', '2017-03-17', 111, 'Andreas', '?modul=pinjaman&act=detailPinjaman&id=3'),
(15, 111, 'Pengajuan pinjaman anda Diterima', 'y', 4, '', 'Jakarta', '2017-03-17', 122, 'Andreas', '?modul=karyawanPinjaman&act=detailPinjaman&id=3'),
(16, 0, 'Lily melakukan pengajuan cuti', 'n', 3, '2', 'Jakarta', '2017-03-26', 116, 'Lily', '?modul=cuti&act=detailCuti&id=3');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_divisi` int(3) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `komunikasi_kerjasama` int(2) NOT NULL,
  `pemahaman_penguasaan` int(2) NOT NULL,
  `kehadiran_karyawan` int(2) NOT NULL,
  `motivasi_kerja` int(2) NOT NULL,
  `pengembangan_diri` int(2) NOT NULL,
  `pencapaian_target` int(2) NOT NULL,
  `penghargaan_sanksi` int(2) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `periode_penilaian` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_karyawan`, `id_divisi`, `cabang`, `komunikasi_kerjasama`, `pemahaman_penguasaan`, `kehadiran_karyawan`, `motivasi_kerja`, `pengembangan_diri`, `pencapaian_target`, `penghargaan_sanksi`, `grade`, `periode_penilaian`) VALUES
(111, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 'A', '');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jml_pinjam` int(11) NOT NULL,
  `jml_pinjam_diterima` int(11) NOT NULL,
  `sisa_pinjaman` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `presentase_angsuran` int(11) NOT NULL,
  `kepentingan` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `status_request` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_karyawan`, `id_divisi`, `cabang`, `level`, `tanggal`, `jml_pinjam`, `jml_pinjam_diterima`, `sisa_pinjaman`, `status`, `presentase_angsuran`, `kepentingan`, `keterangan`, `status_request`) VALUES
(3, 111, 5, 'Jakarta', 1, '2017-03-17', 2000000, 2000000, 0, '', 0, 'Penting', 'Kontrakan Rumah', 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id_salary` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `gaji_pokok` int(12) NOT NULL,
  `tunjangan_operasional` int(11) NOT NULL,
  `bonus` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `level` int(10) NOT NULL,
  `nett_salary` int(11) NOT NULL,
  `bulan_tahun` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slip_gaji`
--

CREATE TABLE `slip_gaji` (
  `id` int(11) NOT NULL,
  `id_salary` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stat_absensi`
--

CREATE TABLE `stat_absensi` (
  `id` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `terlambat` int(11) NOT NULL,
  `pulang_awal` int(11) NOT NULL,
  `lembur` int(5) NOT NULL,
  `jml_hari_masuk` int(11) NOT NULL,
  `absen` int(11) NOT NULL,
  `periode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stat_absensi`
--

INSERT INTO `stat_absensi` (`id`, `id_karyawan`, `cabang`, `nama`, `departemen`, `terlambat`, `pulang_awal`, `lembur`, `jml_hari_masuk`, `absen`, `periode`) VALUES
(115, 111, 'Jakarta', 'Andreas', 'IT', 0, 0, 3, 20, 0, 'Januari_2017'),
(116, 112, 'Jakarta', 'Feri', 'IT', 0, 0, 0, 19, 1, 'Januari_2017'),
(117, 123, 'Jakarta', 'Vina', 'IT', 1, 0, 0, 20, 0, 'Januari_2017'),
(118, 115, 'Jakarta', 'Adhy', 'IT', 0, 0, 0, 20, 0, 'Januari_2017'),
(119, 113, 'Jakarta', 'AG', 'IT', 0, 0, 0, 19, 1, 'Januari_2017'),
(120, 114, 'Jakarta', 'Mai', 'IT', 0, 0, 0, 20, 0, 'Januari_2017'),
(121, 116, 'Jakarta', 'Lily', 'Finance', 0, 0, 0, 20, 0, 'Januari_2017'),
(122, 117, 'Jakarta', 'Nurul', 'HRD', 0, 0, 0, 20, 0, 'Januari_2017'),
(123, 118, 'Jakarta', 'Fajar', 'IT', 0, 0, 0, 20, 0, 'Januari_2017'),
(124, 119, 'Jakarta', 'Bagus', 'HRD', 0, 0, 0, 20, 0, 'Januari_2017'),
(125, 120, 'Jakarta', 'Jane', 'Finance', 0, 0, 0, 20, 0, 'Januari_2017'),
(126, 121, 'Jakarta', 'Rizky', 'IT', 0, 0, 0, 20, 0, 'Januari_2017'),
(127, 122, 'Jakarta', 'Ali', 'IT', 0, 0, 0, 20, 0, 'Januari_2017'),
(128, 124, 'Jakarta', 'Hafiz', 'IT', 0, 0, 0, 19, 1, 'Januari_2017');

-- --------------------------------------------------------

--
-- Table structure for table `tll`
--

CREATE TABLE `tll` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `id_salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id_User` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Tgl_Lahir` date NOT NULL,
  `Nama` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `Tgl_Join` date NOT NULL,
  `Jabatan` varchar(20) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `cabang` varchar(50) NOT NULL,
  `Level` int(11) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `tanggungan` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_User`, `Email`, `Password`, `Tgl_Lahir`, `Nama`, `status`, `Tgl_Join`, `Jabatan`, `id_divisi`, `no_rekening`, `cabang`, `Level`, `gaji_pokok`, `tipe`, `tanggungan`) VALUES
(111, 'andreas@gmail.com', 'andreas', '2016-10-14', 'Andreas', 'kawin', '2016-10-11', 'Staff', 5, '435545354', 'Jakarta', 4, 5000000, 'Reguler', 0),
(112, 'feri@gmail.com', 'feri', '2016-10-14', 'Feri', 'kawin', '2016-10-11', 'Kepala Divisi', 5, '435545352', 'Jakarta', 3, 10000000, 'Reguler', 0),
(113, 'ag@gmail.com', 'ag', '2016-10-14', 'Argun', 'belum kawin', '2016-10-11', 'Staff', 2, '435545312', 'Jakarta', 4, 5000000, 'Reguler', 0),
(114, 'mai@gmail.com', 'mai', '2016-10-14', 'Mai', 'kawin', '2016-10-11', 'Kepala Divisi', 2, '435545351', 'Jakarta', 3, 10000000, 'Reguler', 0),
(115, 'adhy@gmail.com', 'adhy', '2016-10-14', 'Adhy', 'belum kawin', '2016-10-11', 'Kepala Divisi', 3, '435545351', 'Jakarta', 3, 9000000, 'Reguler', 0),
(116, 'lily@gmail.com', 'lily', '2016-10-14', 'Lily', 'kawin', '2016-10-11', 'Staff', 2, '435545351', 'Jakarta', 4, 3000000, 'Reguler', 0),
(117, 'nurul@gmail.com', 'nurul', '2016-10-14', 'Nurul', 'kawin', '2016-10-11', 'Kepala Cabang', 0, '435545351', 'Jakarta', 2, 1500000, 'Reguler', 0),
(118, 'fajar@gmail.com', 'fajar', '2016-10-14', 'Fajar', 'kawin', '2016-10-11', 'Staff', 1, '435545351', 'Jakarta', 4, 4000000, 'Reguler', 0),
(119, 'bagus@gmail.com', 'bagus', '2017-02-08', 'Bagus', 'belum kawin', '0000-00-00', 'Kepala Divisi', 1, '334894832', 'Jakarta', 3, 0, 'Reguler', 0),
(120, 'jane@gmail.com', 'jane', '2016-10-14', 'Jahe', 'kawin', '2016-10-11', 'Staff', 4, '435545351', 'Jakarta', 4, 10000000, 'Reguler', 0),
(121, 'rizky@gmail.com', 'rizky', '2016-10-14', 'Rizky', 'kawin', '2016-10-11', 'Kepala Divisi', 4, '435545351', 'Jakarta', 3, 12000000, 'Reguler', 0),
(122, 'ali@gmail.com', 'ali', '2016-10-14', 'ali', 'kawin', '2016-10-11', 'manager', 0, '435545351', 'Jakarta', 1, 20000000, 'Reguler', 0),
(123, 'vina@gmail.com', 'vina', '2016-10-14', 'Vina', 'kawin', '2016-10-11', 'Staff', 3, '435545351', 'Jakarta', 4, 10000000, 'Reguler', 0),
(124, 'hafiz@gmail.com', 'hafiz', '2016-10-14', 'Hafiz', 'kawin', '2016-10-11', 'Staff', 5, '435545351', 'Jakarta', 4, 0, 'NonReguler', 0),
(1789456746, 'kadiv@gmail.com', 'kadiv', '2017-02-08', 'MASRO', 'kawin', '0000-00-00', 'Kepala Divisi', 2, '', 'Jakarta', 3, 0, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cicilan`
--
ALTER TABLE `cicilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kenaikkan`
--
ALTER TABLE `kenaikkan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klaim`
--
ALTER TABLE `klaim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lap_absensi`
--
ALTER TABLE `lap_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `libur`
--
ALTER TABLE `libur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id_salary`);

--
-- Indexes for table `slip_gaji`
--
ALTER TABLE `slip_gaji`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stat_absensi`
--
ALTER TABLE `stat_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tll`
--
ALTER TABLE `tll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_User`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cicilan`
--
ALTER TABLE `cicilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kenaikkan`
--
ALTER TABLE `kenaikkan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `klaim`
--
ALTER TABLE `klaim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lap_absensi`
--
ALTER TABLE `lap_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3537;
--
-- AUTO_INCREMENT for table `lembur`
--
ALTER TABLE `lembur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `libur`
--
ALTER TABLE `libur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id_salary` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slip_gaji`
--
ALTER TABLE `slip_gaji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stat_absensi`
--
ALTER TABLE `stat_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `tll`
--
ALTER TABLE `tll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1789456747;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
