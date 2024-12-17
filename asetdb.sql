-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Feb 2024 pada 03.21
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asetdb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_user`
--

CREATE TABLE `app_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_pegawai` varchar(60) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `ktp` varchar(20) NOT NULL,
  `role` enum('1','2','3') DEFAULT NULL COMMENT '1=Aset;2=Wakasek;3=Kepsek',
  `genre` enum('1','2') DEFAULT NULL COMMENT '1=Laki-laki;2=Perempuan',
  `tgl` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `valid` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `app_user`
--

INSERT INTO `app_user` (`user_id`, `username`, `password`, `nama_pegawai`, `nik`, `ktp`, `role`, `genre`, `tgl`, `status`, `valid`, `image`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'P12323', '1235789123123124123', '1', '1', '2024-02-13 08:03:50', 1, 1, 'admin.jpg'),
(2, 'manager', '21232f297a57a5a743894a0e4a801fc3', 'Manager', '123th23', '321638201080009', '2', '2', '2024-02-13 08:08:26', 1, 1, 'default_cewe.png'),
(3, 'dirut', '21232f297a57a5a743894a0e4a801fc3', 'Dirut', '123th23', '321638201080009', '3', '2', '2024-02-13 08:11:11', 1, 1, 'default_cewe.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akulumasi_penyusutan`
--

CREATE TABLE `tbl_akulumasi_penyusutan` (
  `id` int(11) NOT NULL,
  `kriteria` varchar(70) NOT NULL,
  `bobot` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_akulumasi_penyusutan`
--

INSERT INTO `tbl_akulumasi_penyusutan` (`id`, `kriteria`, `bobot`) VALUES
(1, '1', '5'),
(2, '2', '4'),
(3, '3', '3'),
(4, '4', '2'),
(5, '>4', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bobot`
--

CREATE TABLE `tbl_bobot` (
  `id_bobot` int(11) NOT NULL,
  `nm_kriteria` varchar(50) NOT NULL,
  `bobot` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_bobot`
--

INSERT INTO `tbl_bobot` (`id_bobot`, `nm_kriteria`, `bobot`) VALUES
(1, 'Sisa Umur Ekonomis', '0.4'),
(2, 'Akulumasi Penyusutan', '0.3'),
(3, 'Nilai Buku', '0.2'),
(4, 'Kondisi Barang', '0.1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kondisi_barang`
--

CREATE TABLE `tbl_kondisi_barang` (
  `id_kb` int(11) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kondisi_barang`
--

INSERT INTO `tbl_kondisi_barang` (`id_kb`, `kriteria`, `bobot`) VALUES
(1, 'Rusak Berat', 3),
(2, 'Rusak Ringan', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_log`
--

CREATE TABLE `tbl_log` (
  `log_id` int(11) NOT NULL,
  `log_time` datetime NOT NULL,
  `log_user` varchar(100) NOT NULL,
  `log_menu` varchar(100) NOT NULL,
  `log_aksi` varchar(100) NOT NULL,
  `log_item` varchar(250) NOT NULL,
  `log_assign_to` varchar(100) NOT NULL,
  `log_assign_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_masa_manfaat`
--

CREATE TABLE `tbl_masa_manfaat` (
  `id_ms_manfaat` int(11) NOT NULL,
  `kd_ms_manfaat` int(11) NOT NULL,
  `kd_sub_ms_manfaat` int(11) NOT NULL,
  `uraian` varchar(250) NOT NULL,
  `ms_manfaat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_matriks_nilai`
--

CREATE TABLE `tbl_matriks_nilai` (
  `id_matriks` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `kd_matriks` int(11) NOT NULL,
  `kd_brg` varchar(20) NOT NULL,
  `nm_brg` varchar(250) NOT NULL,
  `kondisi_brg` int(11) NOT NULL,
  `nilai_buku` int(11) NOT NULL,
  `sisa_umr_ekonomis` int(11) NOT NULL,
  `akumulasi_penyusutan` int(11) NOT NULL,
  `status` enum('1','2','3') NOT NULL COMMENT '1=Belum;2=Hitung;3=Sudah',
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_matriks_nilai`
--

INSERT INTO `tbl_matriks_nilai` (`id_matriks`, `id_brg`, `kd_matriks`, `kd_brg`, `nm_brg`, `kondisi_brg`, `nilai_buku`, `sisa_umr_ekonomis`, `akumulasi_penyusutan`, `status`, `entry_date`) VALUES
(1, 1, 1, 'PK.00440', 'Interactive Whiteboard iTBoard 96', 3, 9, 5, 5, '2', '2024-02-13 09:20:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_matriks_nilai_while`
--

CREATE TABLE `tbl_matriks_nilai_while` (
  `id` int(11) NOT NULL,
  `id_matriks` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `kd_matriks` int(11) NOT NULL,
  `kd_brg` varchar(20) NOT NULL,
  `nm_brg` varchar(250) NOT NULL,
  `kondisi_brg` int(11) NOT NULL,
  `nilai_buku` int(11) NOT NULL,
  `sisa_umr_ekonomis` int(11) NOT NULL,
  `akumulasi_penyusutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_matriks_nilai_while`
--

INSERT INTO `tbl_matriks_nilai_while` (`id`, `id_matriks`, `id_brg`, `kd_matriks`, `kd_brg`, `nm_brg`, `kondisi_brg`, `nilai_buku`, `sisa_umr_ekonomis`, `akumulasi_penyusutan`) VALUES
(1, 1, 1, 1, 'PK.00440', 'Interactive Whiteboard iTBoard 96', 3, 9, 5, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai_buku`
--

CREATE TABLE `tbl_nilai_buku` (
  `id_nil_buku` int(11) NOT NULL,
  `kriteria` varchar(100) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_nilai_buku`
--

INSERT INTO `tbl_nilai_buku` (`id_nil_buku`, `kriteria`, `bobot`) VALUES
(1, '30.000 – 2.022.999', 8),
(2, '2.023.000 – 4.001.999', 7),
(3, '4.002.000 – 5.980.999', 6),
(4, '5.981.000 – 7.959.999', 5),
(5, '7.960.000 – 9.938.999', 4),
(6, '9.939.000 – 11.917.999', 3),
(7, '11.918.000 – 13.896.999', 2),
(8, '>13.897.000', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pemeliharaan_aset`
--

CREATE TABLE `tbl_pemeliharaan_aset` (
  `id_pemeliharaan` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `kd_brg` varchar(20) NOT NULL,
  `nm_brg` varchar(250) NOT NULL,
  `kondisi_brg` enum('1','2','3') NOT NULL COMMENT '1=Baik;2=Rusak Ringan;3=Rusak Berat',
  `harga` int(11) NOT NULL,
  `umr_ekonomis` int(11) NOT NULL,
  `nli_sisa` int(11) NOT NULL,
  `ket` varchar(250) NOT NULL,
  `stts_approval` enum('1','2','3','4','5') NOT NULL COMMENT '1=Pending;2=Internal;3=Eksternal:4=SelesaiIN;5=SelesaiEX',
  `tgl_approval` datetime NOT NULL,
  `stts_approval_kep` enum('1','2','3') NOT NULL COMMENT '1=Pending;2=Diterima;3=Ditolak',
  `tgl_approval_kep` datetime NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pemeliharaan_aset`
--

INSERT INTO `tbl_pemeliharaan_aset` (`id_pemeliharaan`, `id_brg`, `kd_brg`, `nm_brg`, `kondisi_brg`, `harga`, `umr_ekonomis`, `nli_sisa`, `ket`, `stts_approval`, `tgl_approval`, `stts_approval_kep`, `tgl_approval_kep`, `entry_date`) VALUES
(1, 1, 'PK.00440', 'Interactive Whiteboard iTBoard 96', '3', 14200000, 4, 3550000, ' ', '2', '2024-02-13 09:20:06', '2', '2024-02-13 09:20:06', '2024-02-13 08:43:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengadaan_aset`
--

CREATE TABLE `tbl_pengadaan_aset` (
  `id_brg` int(11) NOT NULL,
  `kd_brg` varchar(20) NOT NULL,
  `nm_brg` varchar(250) NOT NULL,
  `thn_pengadaan` date NOT NULL,
  `jmlh_brg` int(11) NOT NULL,
  `satuan_brg` enum('1','2','3') NOT NULL COMMENT '1=Buah;2=Unit;3=Set',
  `thn_beli` varchar(20) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `perolehan` varchar(15) NOT NULL,
  `kondisi` enum('1','2','3') NOT NULL COMMENT '1=Baik;2=Rusak RIngan:3=Rusak Berat',
  `umr_ekonomis` int(11) NOT NULL,
  `penyusutan` varchar(11) NOT NULL,
  `nli_sisa` varchar(15) NOT NULL,
  `jns_brg` enum('1','2','3','4','5') NOT NULL COMMENT '1=KIB A;2=KIB B;3=KIB C; 4=KIB D; 5= KIB E',
  `id_usulan` bigint(20) NOT NULL,
  `ket` varchar(250) NOT NULL,
  `stts_pemeliharaan` enum('1','2','3') NOT NULL COMMENT '1=Pending;2=Proses;3=Selesai',
  `stts_penghapusan` enum('1','2','3','4') NOT NULL COMMENT '1=Awal;2=Diajukan;3=Diterima;4=Ditolak',
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pengadaan_aset`
--

INSERT INTO `tbl_pengadaan_aset` (`id_brg`, `kd_brg`, `nm_brg`, `thn_pengadaan`, `jmlh_brg`, `satuan_brg`, `thn_beli`, `harga`, `perolehan`, `kondisi`, `umr_ekonomis`, `penyusutan`, `nli_sisa`, `jns_brg`, `id_usulan`, `ket`, `stts_pemeliharaan`, `stts_penghapusan`, `entry_date`) VALUES
(1, 'PK.00440', 'Interactive Whiteboard iTBoard 96', '2019-01-04', 1, '2', '2019', 14200000, 'Pembelian', '3', 4, '1', '3550000', '3', 1, 'awfbjaw', '2', '1', '2024-02-13 08:31:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penghapusan_aset`
--

CREATE TABLE `tbl_penghapusan_aset` (
  `id_penghapusan` int(11) NOT NULL,
  `kd_penghapusan` varchar(20) NOT NULL,
  `kd_brg` varchar(20) NOT NULL,
  `nm_brg` varchar(250) NOT NULL,
  `thn_perolehan` int(11) NOT NULL,
  `hrg_perolehan` int(11) NOT NULL,
  `kondisi_brg` enum('1','2','3') NOT NULL COMMENT '1=Baik;2=Rusak Ringan;3=Rusak Berat',
  `ket` varchar(250) NOT NULL,
  `stts_approval` enum('1','2','3') NOT NULL COMMENT '1=Pending;2=Diterima;3=Ditolak',
  `tgl_approval` datetime NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rengking`
--

CREATE TABLE `tbl_rengking` (
  `id_rengking` int(11) NOT NULL,
  `kd_rengking` int(11) NOT NULL,
  `rangking` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `kd_brg` varchar(20) NOT NULL,
  `nm_brg` varchar(250) NOT NULL,
  `nilai_akhir` varchar(11) NOT NULL,
  `ket` varchar(250) NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sisa_umr_ekonomis`
--

CREATE TABLE `tbl_sisa_umr_ekonomis` (
  `id_sisa` int(11) NOT NULL,
  `kriteria` varchar(100) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sisa_umr_ekonomis`
--

INSERT INTO `tbl_sisa_umr_ekonomis` (`id_sisa`, `kriteria`, `bobot`) VALUES
(1, 'Habis', 5),
(2, '<= 2 tahun', 4),
(3, '<= 5 tahun', 3),
(4, '<= 10 tahun', 2),
(5, '<= 20 tahun', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_usulan_aset`
--

CREATE TABLE `tbl_usulan_aset` (
  `id_usulan` int(11) NOT NULL,
  `kd_usulan` varchar(20) NOT NULL,
  `kd_brg` varchar(20) NOT NULL,
  `nm_brg` varchar(250) NOT NULL,
  `jns_brg` enum('1','2','3') NOT NULL COMMENT '1=KIB A;2=KIB B;3=KIB C;',
  `jmlh_brg` int(11) NOT NULL,
  `satuan_brg` enum('1','2','3') NOT NULL COMMENT '1=Buah;2=Unit;3=Set',
  `harga_brg` varchar(20) NOT NULL,
  `masa_manfaat` varchar(10) NOT NULL,
  `ket` varchar(250) NOT NULL,
  `stts_approval_wk` enum('1','2','3') NOT NULL COMMENT '1=Pending;2=Diterima;3=Ditolak',
  `tgl_approval_wk` datetime NOT NULL,
  `stts_approval_kep` enum('1','2','3') NOT NULL COMMENT '1=Pending;2=Diterima;3=Ditolak',
  `tgl_approval_kep` datetime NOT NULL,
  `stts_pengadaan` enum('1','2','3') NOT NULL COMMENT '1=Pengajuan;2=Belum;3=Sudah',
  `tgl_pengadaan` datetime NOT NULL,
  `entry_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_usulan_aset`
--

INSERT INTO `tbl_usulan_aset` (`id_usulan`, `kd_usulan`, `kd_brg`, `nm_brg`, `jns_brg`, `jmlh_brg`, `satuan_brg`, `harga_brg`, `masa_manfaat`, `ket`, `stts_approval_wk`, `tgl_approval_wk`, `stts_approval_kep`, `tgl_approval_kep`, `stts_pengadaan`, `tgl_pengadaan`, `entry_date`) VALUES
(1, '1', 'PK.00440', 'Interactive Whiteboard iTBoard 96', '3', 1, '2', '14200000', '4', 'awfawf', '2', '2024-02-13 08:09:02', '2', '2024-02-13 08:11:26', '3', '0000-00-00 00:00:00', '2024-02-13 08:07:18');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tbl_akulumasi_penyusutan`
--
ALTER TABLE `tbl_akulumasi_penyusutan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_bobot`
--
ALTER TABLE `tbl_bobot`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indeks untuk tabel `tbl_kondisi_barang`
--
ALTER TABLE `tbl_kondisi_barang`
  ADD PRIMARY KEY (`id_kb`);

--
-- Indeks untuk tabel `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indeks untuk tabel `tbl_masa_manfaat`
--
ALTER TABLE `tbl_masa_manfaat`
  ADD PRIMARY KEY (`id_ms_manfaat`);

--
-- Indeks untuk tabel `tbl_matriks_nilai`
--
ALTER TABLE `tbl_matriks_nilai`
  ADD PRIMARY KEY (`id_matriks`);

--
-- Indeks untuk tabel `tbl_matriks_nilai_while`
--
ALTER TABLE `tbl_matriks_nilai_while`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_nilai_buku`
--
ALTER TABLE `tbl_nilai_buku`
  ADD PRIMARY KEY (`id_nil_buku`);

--
-- Indeks untuk tabel `tbl_pemeliharaan_aset`
--
ALTER TABLE `tbl_pemeliharaan_aset`
  ADD PRIMARY KEY (`id_pemeliharaan`);

--
-- Indeks untuk tabel `tbl_pengadaan_aset`
--
ALTER TABLE `tbl_pengadaan_aset`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indeks untuk tabel `tbl_penghapusan_aset`
--
ALTER TABLE `tbl_penghapusan_aset`
  ADD PRIMARY KEY (`id_penghapusan`);

--
-- Indeks untuk tabel `tbl_rengking`
--
ALTER TABLE `tbl_rengking`
  ADD PRIMARY KEY (`id_rengking`);

--
-- Indeks untuk tabel `tbl_sisa_umr_ekonomis`
--
ALTER TABLE `tbl_sisa_umr_ekonomis`
  ADD PRIMARY KEY (`id_sisa`);

--
-- Indeks untuk tabel `tbl_usulan_aset`
--
ALTER TABLE `tbl_usulan_aset`
  ADD PRIMARY KEY (`id_usulan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `app_user`
--
ALTER TABLE `app_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_akulumasi_penyusutan`
--
ALTER TABLE `tbl_akulumasi_penyusutan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_bobot`
--
ALTER TABLE `tbl_bobot`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_kondisi_barang`
--
ALTER TABLE `tbl_kondisi_barang`
  MODIFY `id_kb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_masa_manfaat`
--
ALTER TABLE `tbl_masa_manfaat`
  MODIFY `id_ms_manfaat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_matriks_nilai`
--
ALTER TABLE `tbl_matriks_nilai`
  MODIFY `id_matriks` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_matriks_nilai_while`
--
ALTER TABLE `tbl_matriks_nilai_while`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai_buku`
--
ALTER TABLE `tbl_nilai_buku`
  MODIFY `id_nil_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_pemeliharaan_aset`
--
ALTER TABLE `tbl_pemeliharaan_aset`
  MODIFY `id_pemeliharaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengadaan_aset`
--
ALTER TABLE `tbl_pengadaan_aset`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_penghapusan_aset`
--
ALTER TABLE `tbl_penghapusan_aset`
  MODIFY `id_penghapusan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_rengking`
--
ALTER TABLE `tbl_rengking`
  MODIFY `id_rengking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_sisa_umr_ekonomis`
--
ALTER TABLE `tbl_sisa_umr_ekonomis`
  MODIFY `id_sisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_usulan_aset`
--
ALTER TABLE `tbl_usulan_aset`
  MODIFY `id_usulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
