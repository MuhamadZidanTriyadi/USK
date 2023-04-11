-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Apr 2023 pada 15.32
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `printer2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `foto` text DEFAULT NULL,
  `harga` int(25) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `foto`, `harga`, `stok`, `deskripsi`) VALUES
(4, 'Ace', 'ace.png', 1500000, '15', 'diskon 50%'),
(5, 'Acer', 'acer.png', 1000000, '15', '15%'),
(6, 'Lenovo Legion', 'LL.png', 1900000, '15', 'Terjangkau'),
(7, 'Tuf Gaming', 'TUF.png', 1900000, '15', '18%'),
(14, 'Predator Gaming', 'predator.png', 10000, '18', '123'),
(17, 'MSI Gaming', 'msi.png', 18000000, '18', 'Lancar'),
(18, 'Razer Gaming', 'raze.png', 15000, '14', 'Mantap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `subtotal` varchar(50) NOT NULL,
  `foto` text DEFAULT NULL,
  `status` enum('proses','ditolak','terverifikasi','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `alamat`, `no_telp`, `nama_lengkap`, `nama_produk`, `subtotal`, `foto`, `status`) VALUES
(38, '2023-04-11', 'wqkeqj', '0921', 'Dan', 'Acer', '1000000', 'acer.png', 'terverifikasi'),
(39, '2023-04-11', 'wo', '01', 'Dan', 'MSI Gaming', '18000000', 'msi.png', 'ditolak'),
(40, '2023-04-11', 'Salemba', '092221', 'Dan', 'Tuf Gaming', '3800000', 'TUF.png', 'terverifikasi'),
(41, '2023-04-11', 'waw', '092', 'Dan', 'Acer', '1000000', 'acer.png', 'terverifikasi'),
(42, '2023-04-11', 'og', '92', 'Dan', 'Lenovo Legion', '1900000', 'LL.png', 'terverifikasi'),
(53, '2023-04-11', 'Jl.Karang Anyar', '000002', 'Dan', 'Tuf Gaming', '1900000', 'TUF.png', 'proses'),
(54, '2023-04-11', 'Jl.Kartini', '087730495949', 'Fathir', 'Acer', '2000000', 'acer.png', 'proses'),
(55, '2023-04-11', 'Cempaka Putih', '087756983215', 'Samsul', 'Razer Gaming', '60000', 'raze.png', 'terverifikasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` text DEFAULT NULL,
  `roles` enum('Admin','Customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `foto`, `roles`) VALUES
(1, 'Zidan', 'Zidan', 'admin', 'Rectangle 23.png', 'Admin'),
(13, 'Dan', 'zidan', 'zidan', 'Rectangle 23.png', 'Customer'),
(14, 'Fathir', 'fathir', '123', '', 'Customer'),
(18, 'Samsul', 'samsul', '123', '', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
