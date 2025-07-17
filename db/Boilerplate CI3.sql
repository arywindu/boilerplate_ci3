-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2025 at 05:47 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Boilerplate_CI3`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `tanggal_publikasi` datetime DEFAULT current_timestamp(),
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `slug`, `isi`, `gambar`, `id_kategori`, `tanggal_publikasi`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'Pengembangan AI Terbaru: Dampak pada Kehidupan Sehari-hari', 'pengembangan-ai-terbaru-dampak-pada-kehidupan-sehari-hari', '<p>Artikel ini membahas perkembangan terkini dalam kecerdasan buatan dan bagaimana teknologi tersebut mulai mengintegrasikan diri ke dalam berbagai aspek kehidupan kita, dari asisten virtual hingga mobil otonom. Implikasi etika dan sosial juga diulas.</p>', 'pengembangan-ai-terbaru-dampak-pada-kehidupan-sehari-hari_1752744117.png', 1, '2025-07-15 15:00:00', '', '', ''),
(2, 'Timnas Sepak Bola Raih Kemenangan Dramatis di Laga Persahabatan', 'timnas-sepak-bola-raih-kemenangan-dramatis-di-laga-persahabatan', '<p>Dalam pertandingan persahabatan yang mendebarkan, Timnas Indonesia berhasil mengalahkan rivalnya dengan skor tipis 3-2. Gol penentu tercipta di menit-menit akhir pertandingan, memicu sorak sorai penonton.<br><br><img src=\"http://localhost/Boilerplate_ci3/uploads/editor_images/img_editor_6879154b07268.png\" style=\"width: 600px;\"><br></p>', 'timnas-sepak-bola-raih-kemenangan-dramatis-di-laga-persahabatan_1752744109.png', 4, '2025-07-15 15:05:00', '', '', ''),
(3, 'Angka Inflasi Global Capai Level Tertinggi dalam Dekade Terakhir', 'angka-inflasi-global-capai-level-tertinggi-dalam-dekade-terakhir', '<p>Data terbaru menunjukkan bahwa inflasi di berbagai negara mencapai puncaknya dalam sepuluh tahun terakhir. Para ekonom memprediksi langkah-langkah kebijakan yang ketat akan segera diterapkan untuk menstabilkan perekonomian.</p>', 'angka-inflasi-global-capai-level-tertinggi-dalam-dekade-terakhir_1752744088.png', 3, '2025-07-15 15:10:00', '', '', ''),
(4, 'Film Horor Lokal \'Jebakan Setan\' Puncaki Box Office Minggu Ini', 'film-horor-lokal-jebakan-setan-puncaki-box-office-minggu-ini', '<p>Film horor produksi dalam negeri, \"Jebakan Setan\", berhasil menarik perhatian jutaan penonton dan menduduki posisi teratas di tangga box office, mengalahkan film-film Hollywood lainnya.a</p><p>Film horor produksi dalam negeri, \"Jebakan Setan\", berhasil menarik perhatian jutaan penonton dan menduduki posisi teratas di tangga box office, mengalahkan film-film Hollywood lainnya.a<br></p><p><img src=\"data:image/png;base64,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\" data-filename=\"Dummy Image Artikel.png\" style=\"width: 600px;\"><br><div style=\"text-align: right;\"><br></div></p><p>Film horor produksi dalam negeri, \"Jebakan Setan\", berhasil menarik perhatian jutaan penonton dan menduduki posisi teratas di tangga box office, mengalahkan film-film Hollywood lainnya.a</p><p>Film horor produksi dalam negeri, \"Jebakan Setan\", berhasil menarik perhatian jutaan penonton dan menduduki posisi teratas di tangga box office, mengalahkan film-film Hollywood lainnya.a</p><p>Film horor produksi dalam negeri, \"Jebakan Setan\", berhasil menarik perhatian jutaan penonton dan menduduki posisi teratas di tangga box office, mengalahkan film-film Hollywood lainnya.a</p><p>Film horor produksi dalam negeri, \"Jebakan Setan\", berhasil menarik perhatian jutaan penonton dan menduduki posisi teratas di tangga box office, mengalahkan film-film Hollywood lainnya.a</p><p>Film horor produksi dalam negeri, \"Jebakan Setan\", berhasil menarik perhatian jutaan penonton dan menduduki posisi teratas di tangga box office, mengalahkan film-film Hollywood lainnya.a</p>', 'film-horor-lokal-jebakan-setan-puncaki-box-office-minggu-ini_1752744051.png', 4, '2025-07-15 15:15:00', '', '', ''),
(5, 'Review Gadget Terbaru: Smartphone Lipat Generasi ke-3', 'review-gadget-terbaru-smartphone-lipat-generasi-ke-3', '<p>Kita melihat lebih dekat smartphone lipat generasi terbaru yang menjanjikan pengalaman pengguna revolusioner dengan desain yang lebih ringkas dan daya tahan baterai yang lebih baik.<br><br><br></p>\r\n<p> <iframe frameborder=\"0\" src=\"//www.youtube.com/embed/NJWDH6xRPY0\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe></p>', 'review-gadget-terbaru-smartphone-lipat-generasi-ke-3_1752744027.png', 1, '2025-07-15 15:20:00', '', '', ''),
(6, 'Xiaomi Air Purifier Compact 4', 'xiaomi-air-purifier-compact-4', '<p><span style=\"font-size: 14px;\">The standard Lorem Ipsum passage, used since the 1500s</span><br></p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"<br></p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\"><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/E4LPZl2wlHM\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br><br></p><h3 style=\"margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\">Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC</h3><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"<br><br><iframe frameborder=\"0\" src=\"//www.youtube.com/embed/E4LPZl2wlHM\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br></p><h3 style=\"margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\">1914 translation by H. Rackham</h3><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"</p><h3 style=\"margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\">Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC<br><br><img src=\"http://localhost/Boilerplate_ci3/uploads/editor_images/img_editor_6879155cb4f49.png\" style=\"width: 600px;\"><br></h3><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"</p><h3 style=\"margin: 15px 0px; padding: 0px; font-weight: 700; font-size: 14px; color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;\"=\"\">1914 translation by H. Rackham</h3><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;\"=\"\">\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"</p>', 'xiaomi-air-purifier-compact-4_1752764978.png', 1, '2025-07-17 22:09:38', 'Xiaomi Air Purifier 4 Compact', 'Xiaomi Air Purifier 4 Compact', 'Xiaomi Air Purifier 4 Compact'),
(7, 'Test sepak Bola Pria', 'test-sepak-bola-pria', '<p><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span></p><p><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\"></span></p><p><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\"></span></p><p><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\"></span></p><p><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\"></span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span><span style=\"color: rgba(33, 37, 41, 0.75); font-family: \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; font-size: 14px;\">Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.</span></p>', 'test-sepak-bola-pria_1752765978.png', 4, '2025-07-17 22:24:30', 'Gambar utama untuk artikel Anda (akan tampil di daftar artik', 'Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.', 'Gambar utama untuk artikel Anda (akan tampil di daftar artikel dan thumbnail). Max 2MB, format: JPG, JPEG, PNG, GIF. Ukuran ideal: 1200x800px.');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `slug_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `slug_kategori`) VALUES
(1, 'Teknologi', 'teknologi'),
(3, 'Politik', 'politik'),
(4, 'Hiburan', 'hiburan'),
(5, 'Fashion', 'fashion');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(2, 'admin', '0192023a7bbd73250516f069df18b500', 'Admin Baru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`),
  ADD UNIQUE KEY `slug_kategori` (`slug_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
