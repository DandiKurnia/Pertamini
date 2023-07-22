-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jul 2023 pada 20.25
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mypertamina`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bbm`
--

CREATE TABLE `bbm` (
  `id` int(13) NOT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `harga` int(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bbm`
--

INSERT INTO `bbm` (`id`, `jenis`, `harga`) VALUES
(1, 'Pertamax', 12500),
(2, 'Pertalite', 10000),
(3, 'Pertamax Turbo', 136000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(13) NOT NULL,
  `users_id` int(13) DEFAULT NULL,
  `bbm_id` int(13) DEFAULT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `jumlah_liter` float(10,2) DEFAULT NULL,
  `jumlah_uang` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id`, `users_id`, `bbm_id`, `tanggal_pembelian`, `jumlah_liter`, `jumlah_uang`) VALUES
(1, 3, 1, '2023-07-21', 8.00, 100000),
(2, 3, 2, '2023-07-21', 10.00, 100000),
(3, 3, 1, '2023-07-21', 1.00, 10000),
(4, 3, 1, '2023-07-21', 1.00, 10000),
(5, 3, 1, '2023-07-21', 1.60, 20000),
(6, 3, 1, '2023-07-21', 0.80, 10000),
(7, 1, 3, '2023-07-21', 1.47, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','pengguna') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `tgl_lahir`, `password`, `level`) VALUES
(1, 'Victor Coleman', '123', '2015-03-25', '$2y$10$23cQlybSRqBc/tlQxTuklOfjlAvgioKAe48omRDQBDrRAdVHrmh7K', 'admin'),
(2, 'Hillary Malone', 'kebak', '1975-06-09', '$2y$10$QRG5g3iNaHwhSw0RNY41T.RwbPKrB2X5tf43UYkGnrqggWNBGlcb2', NULL),
(3, 'dandikurnia', 'dandikurnia', '2023-07-20', '$2y$10$sbszdIVCjmTWErmZl30.wO7VUGFLeJGYul1EY7XnKZKmvcyhQ6n3a', 'admin'),
(4, 'dandikurnia', 'dandi132', '2023-07-20', '$2y$10$Z0YlalvyK7nPyoGtb4z5B.K/X0aK0waYHvpJ/6YzQwKncXaNaUduy', 'admin'),
(5, 'Finn Murphy', 'dodely', '1997-12-11', '$2y$10$pBLJk8XNiKm9katxwTeHi.K/5FRjAippm.D44VYATbyIYaPhkVeAG', NULL),
(6, 'Zephania Mason', 'gojabixak', '2005-08-28', '$2y$10$Dh7D6N8.leHmza1BvChuPuACuY2Igrks.Q//dabTmszNywo/Qrs.6', NULL),
(7, 'Brody Contreras', 'fuvugu', '2014-06-27', '$2y$10$XLiMeD6Gy20jds7HBKzcU.myoJNu.DXLyN84tSn4mJ2ayTgys1G6e', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bbm`
--
ALTER TABLE `bbm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_fk` (`users_id`),
  ADD KEY `bbm_fk` (`bbm_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bbm`
--
ALTER TABLE `bbm`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `bbm_fk` FOREIGN KEY (`bbm_id`) REFERENCES `bbm` (`id`),
  ADD CONSTRAINT `users_fk` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
