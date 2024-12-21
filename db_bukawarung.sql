-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 03:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bukawarung`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_name`, `username`, `password`, `admin_telp`, `admin_email`, `admin_address`) VALUES
(10, '', 'amru15', '$2y$10$ZHhM3WlLz1XFotcspyFzqO4dCqmUHlPCccVvGutbP38UsbyKrnIx6', '', '', ''),
(11, 'Amru Bahrul Ulum', 'amru bahrul ulum', '$2y$10$fX5KUB18eEnA8OYgQKUES.CKtT6pTsbajSlSB7x1iFX3Cj5fsorgS', '62 812-8802-7217', 'Amrubahrululum15@gmail.com', 'Perum Villa Asri 1 Blok G No. 3  RT 003 / RW 017, Cicadas  Gunung Putri, Kabupaten Bogor'),
(12, '', 'amru alzauzi', '$2y$10$Xqf0yXzKYi4c9xcljvSF6u0d8qTzYrNELKSZxpv4MP8kk0kxJix1C', '', '', ''),
(13, 'admin', 'admin1', '$2y$10$Xewuyja9lI5EGukktx9MT.CLqO2Xq.qTbYxrJm8FJXheIKMv5mkey', '081288027217', 'namuratehniksejahtera.@gmail.com', 'jl,mercedes benz kp.pabauaran Rt.02 Rw.10'),
(14, 'Amru ulum', 'admin2', '$2y$10$z26QIFh42Z4DhIF2qs7kqugBWbh3IegF3xnbAL/AMSoBKLIpiRZc2', '081288027217', 'namuratehniksejahtera.@gmail.com', 'jl,mercedes benz kp.pabuaran Rt.02 Rw.10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`) VALUES
(3, 'Sepatu'),
(7, 'Pakaian Pria'),
(8, 'Pakaian Wanita'),
(11, 'Tas Gunung'),
(16, 'Tas'),
(17, 'Meja');

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftar`
--

CREATE TABLE `tb_daftar` (
  `username` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `data created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_description`, `product_image`, `product_status`, `data created`) VALUES
(7, 11, 'EIGER PHALANGER 35 WS CARRIER', 769014, '<p>&nbsp;</p><p>Dimension: 30 x 25 x 60 cm</p><p>Polyester 150D</p><p>Polyester 600D</p><p>Fitur:</p><p>Teknologi backsystem Fit Light.&nbsp;</p><p>Kompartemen utama.&nbsp;</p><p>Dua saku di tutup atas.</p><p>Dua saku samping.</p><p>Tali kompresi samping.&nbsp;</p><p>Pengikat trekking pole.&nbsp;</p><p>Tali dada dan hip belt.&nbsp;</p><p>Saku berbahan mesh di tali gendong.&nbsp;</p><p>Dilengkapi rain cover.&nbsp;</p><p>Tali bahu dirancang secara ergonomis agar pas dipakai mengikuti bentuk tubuh wanita.&nbsp;</p>', 'produk1734700590.jpeg', 1, '2024-12-20 13:18:30'),
(8, 11, 'EIGER PHALANGER 45 CARRIER', 894100, '<p>Phalanger 45 adalah backpack berkapasitas 45 liter yang dirancang untuk menemani kegiatan hiking Anda (1-2 hari). Untuk memberikan kenyamanan saat membawa beban, tas ini didukung oleh teknologi backsystem Fit Light. Phalanger 45 memiliki banyak tempat penyimpanan, diantaranya kompartemen utama, saku tutup atas, dan dua saku samping untuk menjaga barang bawaan Anda terorganisir dan mudah diakses. Dilengkapi juga dengan rain cover untuk menjaga barang bawaan Anda tetap terlindungi dari hujan.&nbsp;</p><p>Dimension: 30 x 27 x 67 cm</p><p>Polyester 150D</p><p>Polyester 600D</p><p>Fitur:</p><p>Teknologi backsystem Fit Light.&nbsp;</p><p>Kompartemen utama.&nbsp;</p><p>Dua saku di tutup atas.</p><p>Dua saku samping.</p><p>Tali kompresi samping.&nbsp;</p><p>Pengikat trekking pole.&nbsp;</p><p>Tali dada dan hip belt.&nbsp;</p><p>Saku berbahan mesh di tali gendong.&nbsp;</p><p>Dilengkapi rain cover.</p>', 'produk1734701245.jpeg', 1, '2024-12-20 13:27:25'),
(9, 9, 'SH118 Sandal Wanita Empuk Frog Kodok Lucu', 55315, '<p>SH118 Sandal Wanita Empuk Frog Kodok Lucu Women Slippers<br><br>Sandal yang keren, dan akan membuat penampilan anda terlihat semakin cantik dan menarik.<br>Sandal Super Empuk dan tebal ya, pasti enak dipakai…<br><br>Sandal ini membantu anda untuk melengkapi penampilan anda menjadi lebih sempurna, sandal ini tersedia berbagai warna yang dapat anda sesuaikan dengan penampilan anda.<br><br>Bahan : Karet Eva Empuk<br><br>Warna :<br>1.Black<br>2.Beige<br><br>Ukuran :<br>36-37= 23cm<br>38-39= 24cm<br>40-41= 25cm<br><br>CATATAN :<br>1. Karena stock barang kami sesuai berdasarkan sistem yang tampil, mohon pilih barang sesuai warna dan ukurannya.<br>2. Kami tidak melayani pilihan warna berdasarkan chat atau catatan transaksi.<br>3. Jika ingin membeli lebih dari 1 warna, maka pilih dulu 1 warna, masukkan keranjang, habis itu pilih warna lainnya masukkan keranjang. Setelah semua warna terpilih dan masuk ke keranjang, baru check out membayar<br>&nbsp;</p><p>&nbsp;</p><p><br>&nbsp;</p>', 'produk1734701394.jpeg', 1, '2024-12-20 15:11:03'),
(10, 8, 'Abaya Syahira Set Baju Gamis Muslim Wanita ', 123990, '<p>Keterangan Produk ☑ Bahan : Ceruty Babydoll Full Puring Aksen Payet Mutiara ☑ Ukuran : Allsize Fit XL ☑ LD : -+110 cm ☑ Panjang : -+140 cm ☑ Warna : Mocca / Hitam / Sage Green / Plum ☑ Dapat :Gamis Dua Layer ( Lepas Pasang ) • Gambar hanya Sebagai referensi kemiripan gambar dengan aslinya hanya 85-90% (perbedaan bisa di sebabkan karena pemakaian bahan ,warna ,ukuran,model,dan lainnya,harap maklum kalo ada ketidaksesuaian)&nbsp;</p>', 'produk1734701561.jpeg', 1, '2024-12-20 15:10:49'),
(11, 7, 'Tshirt FEAST - CELAMAT/CUKCES ', 250599, '<p>Kaos dengan desain terus terbaru dan ter update&nbsp; Material : Cotton combed 24s Jahitan : Rapi setandar distro dengan rib yang tebal dan nyaman&nbsp; Sablon : DTF premium yang tebal dan kuat anti luntur&nbsp;</p>', 'produk1734701916.webp', 1, '2024-12-20 15:10:24'),
(12, 7, '.Feast - Warfare - T-Shirt', 250185, '<p>Ini termasuk ukuran standar, bukan ukuran besar, harap periksa dengan baik sebelum membeli. - S : Panjang 68 cm : Lebar 45 cm Berat：40-45kg - M : Panjang 72 cm : Lebar 47 cm Berat：40-50kg - L : Panjang 73 cm : Lebar 50 cm Berat：50-60kg - XL : Panjang 74 cm : Lebar 52 cm Berat：60-70kg - XXL : Panjang 75 cm : Lebar 54.4 cm Berat：70-85kg - XXXL : Panjang 76 cm : Lebar 57 cm Berat：80-95kg (NOTE DISPENSASI KURANG / LEBIH (2cm)</p>', 'produk1734707761.webp', 1, '2024-12-20 15:16:01'),
(13, 7, ' Hindia -  T-Shirt - White Short Sleeve ', 250599, '<p>s</p>', 'produk1734709574.webp', 1, '2024-12-20 15:46:14'),
(14, 7, 'Feast - Cemetary - T-Shirt ', 250599, '<p>a</p>', 'produk1734709646.webp', 1, '2024-12-20 15:47:26'),
(15, 7, 'Tshirt FEAST - MEMENTO', 250599, '<p>T-shirt dengan design &amp; perpaduan warna sablon yang menarik , Material yang digunakan pun adalah bahan katun dengan kualitas pilihan, sehingga dapat menyerap keringat dengan baik, Sablonan sudah menggunakan DTF digital lebih awet dan detail pada Graphic sablonan. Material : Cotton Combed 24s HALUS TEBAL (100% KATUN BUKAN BAHAN CAMPURAN✅) Sablon : DTF Digital (Direct transfer film)&nbsp;</p>', 'produk1734716747.webp', 1, '2024-12-20 17:45:47'),
(16, 3, 'SALOMON XT-SLATE | BLACK/ASPHALT/FTW SILVER | SPORT STYLE', 3800000, '<p>A foray into disruptive interpretations of volume, reflecting the irregular landscapes of rocky terrain and trails. XT-SLATE features a waffled and lightweight upper providing textured protection for your feet, and an Advanced Chassis bottom unit for enhanced stability. Deatil Weight: 354 g Drop: 10 in mm Lacing system: Quicklace® Waterproofness: None Lining: Textile Inlay sole: Textile Outsole: Rubber Upper (MCL): Textile / Synthetic</p>', 'produk1734717285.webp', 1, '2024-12-20 17:56:59'),
(17, 3, 'SALOMON XT 6 | BLACK/BLACK/PHANTOM | SPORTSTYLE', 3500000, '<p>Originally launched in 2013, the XT-6 is the preferred footwear of world-class athletes for ultra-distance races under harsh conditions. It now returns with updated colors and materials, but the same level of cushioning, durability and descent-control. Weight : 365g Drop : 10 in mm Lacing system : Quicklace Waterproofness : None Outsole : Rubber</p>', 'produk1734717359.webp', 1, '2024-12-20 17:56:38'),
(18, 3, 'SALOMON XT 6 GORE-TEX | BLACK/FTW SILVER | SPORT STYLE', 4000000, '<p>A beacon of our trail legacy, the shoe destined for functional technicity has evolved into a sneaker with a cult following. Equipped for the harshest city conditions, XT-6 GORE-TEX features an innovative ePE membrane, PFC-free,and anti-debris mesh construction, as well as durable cushioning and stability no matter the distance. Detail Weight: 357 g Drop: 10 in mm Lacing system: Quicklace® Waterproofness: GORE-TEX Lining: Textile Inlay sole: Textile Outsole: Rubber Upper (MCL): Synthetic / Textile</p>', 'produk1734717509.webp', 1, '2024-12-20 17:58:29'),
(19, 3, 'SALOMON XT 6 EXPANSE | WHITE/METAL/BLACK | SPORT STYLE', 4000000, '<p>A Salomon icon that doesn’t need a preface, XT-6 descends from a long lineage of trail legends and has mastered the switch to urban landscapes. XT-6 EXPANSE brings new texture and depth to the family, with plush, heritage-inspired materials superposed through stitched panels and stitched Sensifit construction, for a more layered, retro feel. Detail Weight : 325 g Drop : 10 in mm Lacing system : Regular laces Waterproofness : None Lining : Textile Inlay sole : Textile Outsole : Rubber</p>', 'produk1734717602.webp', 1, '2024-12-20 18:03:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tb_daftar`
--
ALTER TABLE `tb_daftar`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_daftar`
--
ALTER TABLE `tb_daftar`
  MODIFY `username` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
