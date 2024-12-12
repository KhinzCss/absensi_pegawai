-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Bulan Mei 2024 pada 00.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_siswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `ID_Absensi` int(11) NOT NULL,
  `ID_Siswa` int(11) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Kehadiran` enum('Hadir','Sakit','Izin','Alfa','Lainnya') DEFAULT NULL,
  `Nisn` varchar(15) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`ID_Absensi`, `ID_Siswa`, `Tanggal`, `Kehadiran`, `Nisn`, `Foto`) VALUES
(108, 14, '2024-05-25', 'Hadir', NULL, NULL),
(109, 14, '2024-05-25', 'Hadir', NULL, NULL),
(110, 14, '2024-05-25', 'Hadir', NULL, NULL),
(111, 14, '2024-05-26', 'Hadir', NULL, NULL),
(113, 14, '2024-05-13', 'Izin', NULL, NULL),
(114, 14, '2024-05-27', 'Hadir', NULL, '66553512ca200_logo.png'),
(115, 14, '2024-05-27', 'Hadir', NULL, '665536153b685_12.png'),
(116, 14, '2024-05-27', 'Izin', NULL, '66553673ccf86_13.png'),
(117, 14, '2024-05-27', 'Sakit', NULL, '66553793e0765_logo.png'),
(118, 14, '2024-05-27', 'Sakit', NULL, '665538bf464af_logo.png'),
(119, 14, '2024-05-27', 'Hadir', NULL, '66553932550bb_logo.png'),
(120, 14, '2024-05-27', 'Hadir', NULL, '665539c2d872d_14.jpg'),
(121, 14, '2024-05-27', 'Hadir', NULL, '66553a2b1e71b_logo.png'),
(122, 14, '2024-05-27', 'Hadir', '123445', '6655414c37842_logo.png'),
(123, 14, '2024-05-27', 'Izin', '123445', '66554603c979f_logo.png'),
(124, 14, '2024-05-28', 'Izin', '123445', '6655f4145715e_logo.png'),
(125, 14, '2024-05-28', 'Izin', '123445', '6655f95d385ea_12.png'),
(126, 14, '2024-05-28', 'Izin', '123445', '6655f9c488884_14.jpg'),
(127, 15, '2024-05-23', 'Hadir', NULL, NULL),
(128, 14, '2024-05-28', 'Sakit', '123445', '66565d09ccc61_12.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`ID_Absensi`),
  ADD KEY `ID_Siswa` (`ID_Siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `ID_Absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`ID_Siswa`) REFERENCES `siswa` (`ID_Siswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
