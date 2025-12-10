-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 05:01 AM
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
-- Database: `foodwaste`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `kuota` int(11) NOT NULL,
  `status` enum('Aktif','Nonaktif') NOT NULL DEFAULT 'Aktif',
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `user_id`, `nama_kegiatan`, `slug`, `deskripsi`, `tanggal`, `waktu_mulai`, `waktu_selesai`, `lokasi`, `kuota`, `status`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 4, 'sbouaadsvausd ausda sdaosdjas da sd', 'sbouaadsvausd-ausda-sdaosdjas-da-sd', 'asdoaus dausdbasd oabsjd', '2025-12-04', '18:16:00', '09:10:00', 'Malang', 12, 'Aktif', 'img/agenda/sbouaadsvausd-ausda-sdaosdjas-da-sd_1764450683.jpeg', '2025-11-29 14:11:06', '2025-11-29 14:11:23'),
(3, 4, 'hahahahahhhaaaa', 'hahahahahhhaaaa', 'asdbasoda sduahsdoasndpas diapsbdiasd babsbbbabbas ahhhh', '2025-11-08', '10:12:00', '04:18:00', 'Surabaya', 22, 'Aktif', 'img/agenda/garcia-ferandan-aldsa-sakda_1764450780.jpeg', '2025-11-29 14:13:00', '2025-12-07 13:01:04'),
(4, 4, 'sbouaadsvausdsdaosdjas da sd', 'sbouaadsvausdsdaosdjas da sd', 'asdoaus dausdbasd oabsjd', '2025-12-04', '18:16:00', '09:10:00', 'Malang', 12, 'Aktif', 'img/agenda/sbouaadsvausd-ausda-sdaosdjas-da-sd_1764450683.jpeg', '2025-11-29 14:11:06', '2025-11-29 14:11:23'),
(5, 4, 'bawahsoibdaosoasbuoa sudasdbk', 'bawahsoibdaosoasbuoa sudasdbk', 'asdbasoda sduahsdoasndpas diapsbdiasd babsbbbabbas ahhhh', '2025-11-08', '10:12:00', '04:18:00', 'Surabaya', 22, 'Nonaktif', 'img/agenda/garcia-ferandan-aldsa-sakda_1764450780.jpeg', '2025-11-29 14:13:00', '2025-11-29 19:29:07'),
(6, 4, 'sbouaadsvausd ausda sdaoasdasdsdjas da sd', 'sbouaadsvausd ausda sdaoasdasdsdjas da sd', 'asdoaus dausdbasd oabsjd', '2025-12-04', '18:16:00', '09:10:00', 'Malang', 12, 'Aktif', 'img/agenda/sbouaadsvausd-ausda-sdaosdjas-da-sd_1764450683.jpeg', '2025-11-29 14:11:06', '2025-11-29 14:11:23'),
(7, 4, 'bawahsoibdaosoasbuodbasdou aa sudasdbk', 'bawahsoibdaosoasbuodbasdou aa sudasdbk', 'asdbasoda sduahsdoasndpas diapsbdiasd babsbbbabbas ahhhh', '2025-11-08', '10:12:00', '04:18:00', 'Surabaya', 22, 'Nonaktif', 'img/agenda/garcia-ferandan-aldsa-sakda_1764450780.jpeg', '2025-11-29 14:13:00', '2025-11-29 19:29:07'),
(13, 4, 'valen', 'valen', 'dsad', '2025-12-03', '22:43:00', '23:43:00', 'Malang', 12, 'Aktif', 'img/agenda/valen_1764778591.png', '2025-12-03 08:43:21', '2025-12-03 09:16:31'),
(15, 4, 'blablabalblaa', 'blablabalblaa', '<p>asdasdnai sdb <strong>odsbasbdasd <em>bdaosbdaosdbad </em></strong><em>diasd</em> aosda<br>1. asidnaisnd<br>2. asidnnaodasd<br>3. asdoaoidsaoidaosdas</p>', '2025-12-04', '00:59:00', '01:59:00', 'Malang', 12, 'Aktif', 'img/agenda/blablabalblaa_1764784755.png', '2025-12-03 10:59:15', '2025-12-03 10:59:15'),
(16, 4, 'sbouaadsvausd ausda sdaosdjas da sd gar', 'sbouaadsvausd-ausda-sdaosdjas-da-sd-gar', '<p>asodbaosudbasdasldl</p>', '2025-12-06', '01:48:00', '01:51:00', 'Malang', 2, 'Aktif', 'img/agenda/sbouaadsvausd-ausda-sdaosdjas-da-sd-gar_1764960450.png', '2025-12-05 11:47:30', '2025-12-07 12:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `artikels`
--

CREATE TABLE `artikels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` varchar(255) NOT NULL,
  `status` enum('Published','Draft') NOT NULL DEFAULT 'Draft',
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artikels`
--

INSERT INTO `artikels` (`id`, `user_id`, `gambar`, `judul`, `deskripsi`, `kategori`, `status`, `slug`, `created_at`, `updated_at`) VALUES
(4, 4, 'img/artikel/asdasndibasidbasidbais-garcia_1764458997.png', 'asdasndibasidbasidbais garcia asda', 'dasbdoaasdl asldasdkasnd', 'edukasi', 'Published', 'asdasndibasidbasidbais-garcia-asda', '2025-11-29 16:29:57', '2025-11-29 19:15:33'),
(5, 4, 'img/artikel/asbdaoudbaso-dauosvdaosdbas-d-asipdhaisda-spdh_1764459229.png', 'asbdaoudbaso dauosvdaosdbas d asipdhaisda spdh', 'askdbapsidas daisdhasidas d-asojda sdpahsidpb', 'edukasi', 'Published', 'asbdaoudbaso-dauosvdaosdbas-d-asipdhaisda-spdh', '2025-11-29 16:33:49', '2025-12-07 12:55:22'),
(10, 4, 'img/artikel/asdasndibasidbasidbais-garcia_1764458997.png', 'garcia asda', 'dasbdoaasdl asldasdkasnd', 'edukasi', 'Published', 'garcia asda', '2025-11-29 16:29:57', '2025-11-29 19:15:33'),
(11, 4, 'img/artikel/asbdaoudbaso-dauosvdaosdbas-d-asipdhaisda-spdh_1764459229.png', 'dauosvdaosdbas d asipdhaisda spdh', 'askdbapsidas daisdhasidas d-asojda sdpahsidpb', 'edukasi', 'Published', 'dauosvdaosdbas-d-asipdhaisda-spdh', '2025-11-29 16:33:49', '2025-12-07 13:32:41'),
(12, 4, 'img/artikel/asbdaoudbaso-dauosvdaosdbas-d-asipdhaisda-spdh_1764459229.png', 'asbdaoudbasod asipdhaisda spdh', 'askdbapsidas daisdhasidas d-asojda sdpahsidpb', 'edukasi', 'Draft', 'asbdaoudbasod asipdhaisda spdh', '2025-11-29 16:33:49', '2025-11-29 19:16:29'),
(13, 4, 'img/artikel/asbdaoudbaso-dauosvdaosdbas-d-asipdhaisda-spdh_1764459229.png', 'dauosvdaosd spdh', 'askdbapsidas daisdhasidas d-asojda sdpahsidpb', 'edukasi', 'Draft', 'dauosvdaosd spdh', '2025-11-19 16:33:49', '2025-11-29 19:16:29'),
(15, 4, 'img/artikel/asdbasdvsa_1764786099.png', 'asdbasdvsa', '<p>ausvdaiusdv Vdshdad<strong>uagsduasgd<em>siuauvdausdbau<br>1. asudausdb<br></em></strong></p>', 'tips & trik', 'Published', 'asdbasdvsa', '2025-12-03 11:21:39', '2025-12-07 13:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_daur_ulang`
--

CREATE TABLE `data_daur_ulang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `data_makanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `penyedia` varchar(255) NOT NULL,
  `kategori` enum('UMKM','Restoran','Hotel','Rumah Tangga') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `berat` decimal(8,2) NOT NULL,
  `batas_waktu` time NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_daur_ulang`
--

INSERT INTO `data_daur_ulang` (`id`, `user_id`, `data_makanan_id`, `nama`, `penyedia`, `kategori`, `alamat`, `berat`, `batas_waktu`, `gambar`, `created_at`, `updated_at`) VALUES
(57, 4, NULL, 'asdad', 'asbd', 'Restoran', 'jl. tanimbar no.23', 17.00, '23:35:00', 'img/dataDaurUlang/asdad_1765024545.png', '2025-12-06 12:35:45', '2025-12-06 12:36:12'),
(58, 4, NULL, 'asdad', 'asbd', 'Restoran', 'jl. tanimbar no.23', 17.00, '23:35:00', 'img/dataDaurUlang/asdad_1765024545.png', '2025-12-06 12:35:45', '2025-12-06 12:36:12'),
(59, 4, NULL, 'asdad', 'asbd', 'Restoran', 'jl. tanimbar no.23', 17.00, '23:35:00', 'img/dataDaurUlang/asdad_1765024545.png', '2025-12-06 12:35:45', '2025-12-06 12:36:12'),
(60, 4, NULL, 'asdad', 'asbd', 'Restoran', 'jl. tanimbar no.23', 17.00, '23:35:00', 'img/dataDaurUlang/asdad_1765024545.png', '2025-12-06 12:35:45', '2025-12-06 12:36:12'),
(61, 4, NULL, 'asdad', 'asbd', 'Restoran', 'jl. tanimbar no.23', 17.00, '23:35:00', 'img/dataDaurUlang/asdad_1765024545.png', '2025-12-06 12:35:45', '2025-12-06 12:36:12'),
(62, 4, NULL, 'asdad', 'asbd', 'Restoran', 'jl. tanimbar no.23', 17.00, '23:35:00', 'img/dataDaurUlang/asdad_1765024545.png', '2025-12-06 12:35:45', '2025-12-06 12:36:12'),
(63, 4, NULL, 'asdad', 'asbd', 'Restoran', 'jl. tanimbar no.23', 17.00, '23:35:00', 'img/dataDaurUlang/asdad_1765024545.png', '2025-12-06 12:35:45', '2025-12-06 12:36:12'),
(64, 4, NULL, 'asdad', 'asbd', 'Restoran', 'jl. tanimbar no.23', 17.00, '23:35:00', 'img/dataDaurUlang/asdad_1765024545.png', '2025-12-06 12:35:45', '2025-12-06 12:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `data_expired`
--

CREATE TABLE `data_expired` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `data_makanan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_makanan`
--

CREATE TABLE `data_makanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `penyedia` varchar(255) NOT NULL,
  `kategori` enum('UMKM','Restoran','Hotel','Rumah Tangga') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `porsi` int(11) NOT NULL,
  `batas_waktu` time NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_makanan`
--

INSERT INTO `data_makanan` (`id`, `user_id`, `nama`, `penyedia`, `kategori`, `alamat`, `porsi`, `batas_waktu`, `gambar`, `created_at`, `updated_at`) VALUES
(41, 4, 'Ayam Geprek', 'Pribadi', 'Rumah Tangga', 'jl. tanimbar no.23', 1, '22:28:00', 'img/dataMakanan/ayam-geprek_1765016906.png', '2025-12-06 10:28:26', '2025-12-06 10:29:12'),
(42, 4, 'Ayam Geprek', 'Pribadi', 'Rumah Tangga', 'jl. tanimbar no.23', 1, '22:28:00', 'img/dataMakanan/ayam-geprek_1765016906.png', '2025-12-06 10:28:26', '2025-12-06 10:29:12'),
(43, 4, 'Ayam Geprek', 'Pribadi', 'Rumah Tangga', 'jl. tanimbar no.23', 1, '22:28:00', 'img/dataMakanan/ayam-geprek_1765016906.png', '2025-12-06 10:28:26', '2025-12-06 10:29:12'),
(44, 4, 'Ayam Geprek', 'Pribadi', 'Rumah Tangga', 'jl. tanimbar no.23', 1, '22:28:00', 'img/dataMakanan/ayam-geprek_1765016906.png', '2025-12-06 10:28:26', '2025-12-06 10:29:12'),
(45, 4, 'Ayam Geprek', 'Pribadi', 'Rumah Tangga', 'jl. tanimbar no.23', 1, '22:28:00', 'img/dataMakanan/ayam-geprek_1765016906.png', '2025-12-06 10:28:26', '2025-12-06 10:29:12'),
(46, 4, 'Ayam Geprek', 'Pribadi', 'Rumah Tangga', 'jl. tanimbar no.23', 1, '22:28:00', 'img/dataMakanan/ayam-geprek_1765016906.png', '2025-12-06 10:28:26', '2025-12-06 10:29:12'),
(47, 4, 'Ayam Geprek', 'Pribadi', 'Rumah Tangga', 'jl. tanimbar no.23', 1, '22:28:00', 'img/dataMakanan/ayam-geprek_1765016906.png', '2025-12-06 10:28:26', '2025-12-06 10:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `receiver_id`, `message`, `created_at`, `updated_at`, `is_read`) VALUES
(1, 6, 4, 'ahaii', '2025-12-05 11:09:57', '2025-12-08 21:29:48', 1),
(2, 6, 4, 'bisa di ambil sekarang', '2025-12-06 10:30:20', '2025-12-08 21:29:48', 1),
(3, 4, 6, 'okeii bisa', '2025-12-06 10:30:29', '2025-12-08 21:30:00', 1),
(4, 6, 4, 'otw', '2025-12-06 10:30:49', '2025-12-08 21:29:48', 1),
(7, 6, 4, 'sudah di depan rumah', '2025-12-06 11:15:18', '2025-12-08 21:29:48', 1),
(8, 4, 6, 'oiyaa mas saya keluar', '2025-12-06 11:15:41', '2025-12-08 21:30:00', 1),
(27, 6, 4, 'testes', '2025-12-08 22:22:03', '2025-12-08 22:22:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_28_214143_create_data_daur_ulang_table', 2),
(5, '2025_11_28_233116_create_data_makanan_table', 3),
(6, '2025_11_29_022319_add_user_id_to_data_makanan_table', 4),
(7, '2025_11_29_023639_create_pengambilan_makanan_table', 5),
(8, '2025_11_29_122712_add_iframe_maps_to_users_table', 6),
(9, '2025_11_29_141319_create_pengambilan_daur_ulang_table', 7),
(10, '2025_11_29_195546_create_agenda_table', 8),
(11, '2025_11_29_215103_create_artikels_table', 9),
(12, '2025_11_29_222936_add_konten_to_artikels_table', 10),
(13, '2025_12_02_165655_create_messages_table', 11),
(14, '2025_12_04_141944_add_receiver_id_to_messages_table', 12),
(15, '2025_12_06_140726_create_data_expired_table', 13),
(16, '2025_12_06_151357_add_makanan_id_to_data_daur_ulang_table', 14),
(17, '2025_12_06_162450_remove_makanan_id_to_data_daur_ulang_table', 15),
(18, '2025_12_06_163019_add_data_makanan_id_to_data_daur_ulang', 16),
(19, '2025_12_06_163503_add_data_makanan_id_to_data_expired', 17),
(20, '2025_12_06_164051_update_data_makanan_id_on_data_daur_ulang', 18),
(21, '2025_12_06_164150_update_data_makanan_id_on_data_expired', 19),
(22, '2025_12_06_164836_update_data_daur_ulang_for_safe_delete', 20),
(23, '2025_12_06_165026_update_data_expired_for_safe_delete', 21),
(24, '2025_12_09_041646_add_is_read_to_messages_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan_daur_ulang`
--

CREATE TABLE `pengambilan_daur_ulang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `data_daur_ulang_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` decimal(8,2) NOT NULL,
  `status` enum('menunggu','perjalanan','diambil') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengambilan_daur_ulang`
--

INSERT INTO `pengambilan_daur_ulang` (`id`, `user_id`, `data_daur_ulang_id`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(5, 6, 57, 4.00, 'menunggu', '2025-12-06 12:36:12', '2025-12-06 12:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan_makanan`
--

CREATE TABLE `pengambilan_makanan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `data_makanan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('menunggu','perjalanan','diambil') NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengambilan_makanan`
--

INSERT INTO `pengambilan_makanan` (`id`, `user_id`, `data_makanan_id`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(5, 6, 41, 1, 'menunggu', '2025-12-06 10:29:12', '2025-12-06 10:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2omWc4c9n3Xz0tFSBn46psUF7KnJxicnlv4GWxrt', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN01tMEpOQXFCZDdacmRyNFNGMkVKRGU5U2FIcUxJUHNlNm9MWWp2OSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImRhc2hib2FyZC5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1765232820),
('8ahe5MlcUk3pMNWdtTfe0ZultP11wN59OpIIcRaL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnBvcWNkd0hjcUlHSGptbzR1bnNnVTJLSlFoS3VLY3dGZDd6TktGUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZ2VuZGEvbWFuaWZlc3QuanNvbiI7czo1OiJyb3V0ZSI7czoxNjoiaG9tZS5hZ2VuZGEuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764475066),
('8r7PN3MXDqks6E7oCdf9k8EshAcf9ImDkZ2sTQHH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFczYkZqYlF5YXJkZGZFT0hreHBhbjZUZWN2T013bGhuMFdkUlV3TSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcnRpa2VsL21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTc6ImhvbWUuYXJ0aWtlbC5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764475040),
('AvRwDmqZZAy6JFoc9wQKNr1kgmBp0Hu7CunQa7pT', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoielBrQXJaSDBoWWR1V1NFZXM2VFlrNkZpNk5IS3RJSWRFanFsYmthcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvY2hhdC9jb250YWN0cyI7czo1OiJyb3V0ZSI7czoyMzoiZGFzaGJvYXJkLmNoYXQuY29udGFjdHMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1765232823),
('bIOSMPKnM5mbJ8PjKoI4bQnROmkMfwOCAm3u9ia1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid2VEeTUwbEZnUVJJdnVLTWRDMXFUSG0xVDJ5N3dJV0xEME5kT0phaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcnRpa2VsL21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTc6ImhvbWUuYXJ0aWtlbC5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764475037),
('bjQBxp5nGPRT9OvuUTH7TaMRPwd5TmLE17qm5mD3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVR6WDBxWUNCRjI1Z2JkUzE3bVZaZ2RZT28xSHRYS1ozdzdxeGRkUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764485420),
('CFcuNxoY0HO56BDPeRsa01uIoDi45jfuq3SriIUL', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUkY0akoybkw4V1JhaVZVMlFTcW5TbEVmUkhnRTdHZTJVbGxoV1dkTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1764485801),
('DOe1MnLrlvNZlxaC7t5N3MXGpmBm9nrzFF9x4aYU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVZydXdTUkZDN0NvbzlmeTlYSk5CTDdmQ2lsOVRZbkV1dW13WkF5ViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764484639),
('e49kci5j3aubTLNHEZ8jdqLpwFNBBE81zFEXWMjR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaWFSbGhRb2VOb1huRm5VcUVzQXpoN3k3V0w0TkFGM3lnc1hiYlBKNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjtzOjU6InJvdXRlIjtzOjEwOiJob21lLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764486270),
('eJsriyufttCqPJppHnks20xfqf5ml4VdnhMvFB5x', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaThsV2NGUFR1eHpTN1dvblVmTWxYc1JTTVlkcnRkRDVsSmRja25ZRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcnRpa2VsL21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTI6ImFydGlrZWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764474652),
('fROcNhsQPHncdhwt3HKMOJN42lNLBi0bhAUVQSEW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVhpZkRQR2VXbXlHOWhaTjFKNEV0dVVGaUxuckJacXllQVJjRnR1bCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcnRpa2VsL21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTI6ImFydGlrZWwuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764474640),
('hNtw7dc0BY7pkl8bCbW8xFlGiwATNEqjjBarD57O', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMFBjSFczS1B4a0tOMEpFOFJIVjM4dEgyZHoya1hrY2pFYjlYSzNXUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764486072),
('k3gZgoKfqjDQxjDnMWaB6sDrTeox0nx2jyTCJVtd', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSGhuUHl6WWlsRzViS0hLUXZ1S1VtaXlyZ0RUOFI1VmY3cW1SOFE5OCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1764484371),
('kHSvwGIwGJd88ufvzM3DQVwgGdqn6P8otHYuOmkR', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEtoS1pmU0xLWVFUdkZDMkxCTTQzeURnQjhpWjgwYnZoRXROT0xtNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcnRpa2VsL21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTc6ImhvbWUuYXJ0aWtlbC5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764475420),
('kMwHARbKxg7k8H3YuCvQXZZJetOfWJKuhpGzwT0c', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic1ZTZzlhczhEUklLWk5lem1RcEtIZjhQV0JsUzliUzRENnJWYnpaSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764484940),
('kuVUnOhUgAkNPcLFLoa9JmN7gYc2H8S0cgxDAQi0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHpTdUpkUmpZdHlYVWQxRnlIOVVFN1pHRjN0REc3OUREemFWcTJmayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764485441),
('L0CTwxHFdyYPquiQ1wryFofBYMw9ycE8SLRx8ICa', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGNLd0RqZXNGZ0lyNGhyQWhkaVUzNmNOSTlrNEF5VFVMTVNZTDNpcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764486380),
('N3lohyx14LGFlkvLvnLKQrtxyqhyyQrQgIF9jl3g', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmtiM0dWMkUzMkpNMTZmWUthbDRuYmdnQVdmQ3FZU2xvNnZWYmRSWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764486382),
('NTjtm24EWZGap4mTLkToW4ekchMb331OYx7xE0ik', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXNLbHFGZ3FqUFpUVXdrWWVrc01sQmE4Z2tHS2NmWnRUSDY5ZVBaZCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcnRpa2VsL21hbmlmZXN0Lmpzb24iO3M6NToicm91dGUiO3M6MTc6ImhvbWUuYXJ0aWtlbC5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764476026),
('Nv9jI5SDKWRlyrEPGc8wxKuwozFs7qrtl1gEeeFt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXBzYm9YdEJ0dlRSVTEyUjVJNmZpUnBONnFaMEZOdGFXS0lsc3ZmUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764484669),
('O4OMZt1f7erAGItb6CTPNgTjOVjpGy1QbB0ZuAn3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUkxNTB1V1A0R05KaWF1SEdObmgxbU1nZlpSWjhJWTRYc2JwaVZETiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764485981),
('rQqHuZZzrGaFdVcPBl0G57rXWEQDAJJ1jKgtsRQH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3RKSnYxU0VrbWozdWFicTQ4c3JGWE94M2hVYkM2RXAxZ290RExGVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764486297),
('SaeDlUOZkH41OCObTGWNUGQNPUdTghpUCHLYy31l', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWDlzdHRnMFZ3Y1JyZ3pUTTdWemg4aWtVUWlzSWc0SXhIcmt2Y2Z2byI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZ2VuZGEvbWFuaWZlc3QuanNvbiI7czo1OiJyb3V0ZSI7czoxNjoiaG9tZS5hZ2VuZGEuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764475096),
('W0kYioOEucF62YqrDUwTL6rYVwG0GYer2HnkjYQM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT05zVW1jTDBEc2FKNE42bWt0R2MwazZVZHRhSVRlT0tNeDhjOTdUUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZ2VuZGEvbWFuaWZlc3QuanNvbiI7czo1OiJyb3V0ZSI7czoxNjoiaG9tZS5hZ2VuZGEuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764475643),
('wUGBtY1g5w9rB4FI3Oa3NNXIb31BPRtjDFs2ye91', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlZIRUtPQ2dVY1dQcmhxTGZPQmFzNUdhNVFpcmptaGpPUjJ2V1B0WiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764485907),
('yY7FXDydbNiHRV8fbbxPSdj3amFEC9WYTvSD6gLL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekVhRzE4eWxCSHpmTU9uQmpsZTlLdFZhdDJHN0UyVmw1V3FQcFp3bCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vZmZsaW5lIjtzOjU6InJvdXRlIjtzOjExOiJsYXJhdmVscHdhLiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1764485712);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','aktivis') NOT NULL DEFAULT 'user',
  `alamat` varchar(255) DEFAULT NULL,
  `iframe_maps` text DEFAULT NULL,
  `organisasi` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL DEFAULT 'default.png',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `password`, `role`, `alamat`, `iframe_maps`, `organisasi`, `gambar`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'GARCIA FERNANDA VALENCA ARCHADEA', 'garciavalencza@gmail.com', NULL, '081339059343', '$2y$12$5ino.bys7dPsuEi3EDFqZ.kB6Kb6uBGeuzWf0Y0Sc5kqhHIGCd5wi', 'user', 'jl. tanimbar no.23', 'https://www.google.com/maps?q=jl.+tanimbar+no.23&output=embed', NULL, 'img/user/garcia-fernanda-valenca-archadea_1764773691.jpg', NULL, '2025-12-03 07:21:06', '2025-12-03 07:54:51'),
(5, 'valencza', 'valencza@gmail.com', NULL, '081339059343', '$2y$12$oYpTH.Z/hCPoaAVioF5Pee5LG5KirF24zbmmS/QSZNKVoMWDCW4DG', 'aktivis', 'CW COFFEE & EATERY Kendal Sari', 'https://www.google.com/maps?q=CW+COFFEE+%26+EATERY+Kendal+Sari&output=embed', 'pt garcia', 'img/user/default.png', NULL, '2025-11-28 19:01:41', '2025-11-29 08:30:12'),
(6, 'lenn', 'lenn@gmail.com', NULL, '08121212321', '$2y$12$jbBgvPt0O2yXSvMe3yrfh.Z/21v/6f0rg8qRyPixBUBVKiJord8Em', 'user', 'sekolah menengah kejuruan negeri 4 malang', 'https://www.google.com/maps?q=sekolah+menengah+kejuruan+negeri+4+malang&output=embed', NULL, 'img/user/default.png', NULL, '2025-11-29 05:51:56', '2025-11-29 05:54:04'),
(10, 'valen', 'valen@gmail.com', NULL, '081339828321', '$2y$12$/uiBZ8627R23nDLxkQJPRuH3WlFZ36efCSZxTEGHhbKHL5/2Xqfi6', 'user', 'Jl. Tower Gg. duren', 'https://www.google.com/maps?q=Jl.+Tower+Gg.+duren&output=embed', NULL, 'img/user/default.png', NULL, '2025-12-05 11:36:20', '2025-12-05 11:36:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agenda_slug_unique` (`slug`);

--
-- Indexes for table `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artikels_slug_unique` (`slug`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `data_daur_ulang`
--
ALTER TABLE `data_daur_ulang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_daur_ulang_data_makanan_id_foreign` (`data_makanan_id`);

--
-- Indexes for table `data_expired`
--
ALTER TABLE `data_expired`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_expired_data_makanan_id_foreign` (`data_makanan_id`);

--
-- Indexes for table `data_makanan`
--
ALTER TABLE `data_makanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_makanan_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengambilan_daur_ulang`
--
ALTER TABLE `pengambilan_daur_ulang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengambilan_daur_ulang_user_id_foreign` (`user_id`),
  ADD KEY `pengambilan_daur_ulang_data_daur_ulang_id_foreign` (`data_daur_ulang_id`);

--
-- Indexes for table `pengambilan_makanan`
--
ALTER TABLE `pengambilan_makanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengambilan_makanan_user_id_foreign` (`user_id`),
  ADD KEY `pengambilan_makanan_data_makanan_id_foreign` (`data_makanan_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `data_daur_ulang`
--
ALTER TABLE `data_daur_ulang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `data_expired`
--
ALTER TABLE `data_expired`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_makanan`
--
ALTER TABLE `data_makanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pengambilan_daur_ulang`
--
ALTER TABLE `pengambilan_daur_ulang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengambilan_makanan`
--
ALTER TABLE `pengambilan_makanan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_makanan`
--
ALTER TABLE `data_makanan`
  ADD CONSTRAINT `data_makanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengambilan_daur_ulang`
--
ALTER TABLE `pengambilan_daur_ulang`
  ADD CONSTRAINT `pengambilan_daur_ulang_data_daur_ulang_id_foreign` FOREIGN KEY (`data_daur_ulang_id`) REFERENCES `data_daur_ulang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengambilan_daur_ulang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengambilan_makanan`
--
ALTER TABLE `pengambilan_makanan`
  ADD CONSTRAINT `pengambilan_makanan_data_makanan_id_foreign` FOREIGN KEY (`data_makanan_id`) REFERENCES `data_makanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengambilan_makanan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
