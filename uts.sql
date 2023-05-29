-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Bulan Mei 2023 pada 15.20
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uts`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_account`
--

CREATE TABLE `master_account` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `id_name_office` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_account`
--

INSERT INTO `master_account` (`id`, `name`, `username`, `email`, `password`, `role`, `id_name_office`) VALUES
(10, 'superadmin', 'superadmin', 'superadmin@gmail.com', '$2y$10$BAz6nHU9PI66PB5nA9L...NhcRUjK8.cTz1c0DaetKKJzmevHaWj2', 'superadmin', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_office`
--

CREATE TABLE `master_office` (
  `id` int(11) NOT NULL,
  `office_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_office`
--

INSERT INTO `master_office` (`id`, `office_name`, `location`) VALUES
(1, 'Triwijaya', 'Jakarta Barat'),
(2, 'Agen makanan', 'Ampera'),
(3, 'Supply product', 'Jagakarsa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_product`
--

CREATE TABLE `master_product` (
  `id` int(11) NOT NULL,
  `photo` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `source` varchar(100) NOT NULL,
  `material` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `master_product`
--

INSERT INTO `master_product` (`id`, `photo`, `name`, `price`, `description`, `source`, `material`, `quantity`) VALUES
(6, '1684349050_0f4d59a56f267caa9e83.jpeg', 'Rendang', 12000, 'rendang merupakan masakan daging yang dimasak dalam campuran rempah-rempah yang kaya dan bumbu-bumbu aromatik yang khas. Rendang biasanya menggunakan daging sapi yang dipotong menjadi potongan kecil dan dimasak dalam campuran bumbu yang terdiri dari serai, jahe, bawang merah, bawang putih, cabai, lengkuas, daun jeruk, dan rempah-rempah lainnya.', 'Indonesia, Padang', 'daging sapi', 6),
(7, '1684384064_7bae52ca5d7009ab9d0e.jpg', 'Sate Ayam', 20000, 'Dalam hidangan ini, potongan-potongan daging ayam yang telah ditusuk dengan tusuk sate dipanggang di atas bara api atau grill. Daging ayam yang telah dibumbui dengan campuran rempah-rempah khas, seperti bawang putih, jahe, kunyit, dan kecap manis, memberikan cita rasa yang kaya dan lezat pada sate ayam.', 'Indonesia, Jawa', 'Ayam', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_sale`
--

CREATE TABLE `transaction_sale` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `id_account` int(11) NOT NULL,
  `id_office` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `master_account`
--
ALTER TABLE `master_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_account_fk` (`id_name_office`);

--
-- Indeks untuk tabel `master_office`
--
ALTER TABLE `master_office`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_product`
--
ALTER TABLE `master_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_sale`
--
ALTER TABLE `transaction_sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_sale_FK` (`id_account`),
  ADD KEY `transaction_sale_FK_1` (`id_office`),
  ADD KEY `transaction_sale_FK_2` (`id_product`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master_account`
--
ALTER TABLE `master_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `master_office`
--
ALTER TABLE `master_office`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `master_product`
--
ALTER TABLE `master_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaction_sale`
--
ALTER TABLE `transaction_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `master_account`
--
ALTER TABLE `master_account`
  ADD CONSTRAINT `master_account_fk` FOREIGN KEY (`id_name_office`) REFERENCES `master_office` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_sale`
--
ALTER TABLE `transaction_sale`
  ADD CONSTRAINT `transaction_sale_FK` FOREIGN KEY (`id_account`) REFERENCES `master_account` (`id`),
  ADD CONSTRAINT `transaction_sale_FK_1` FOREIGN KEY (`id_office`) REFERENCES `master_office` (`id`),
  ADD CONSTRAINT `transaction_sale_FK_2` FOREIGN KEY (`id_product`) REFERENCES `master_product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
