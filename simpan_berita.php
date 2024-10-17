<?php
include "db.php";

if ($_POST['simpan']) {
    $judul_id   = $_POST['judul_berita_indonesia'];
    $judul_en   = $_POST['judul_berita_inggris'];
    $isi_id     = $_POST['isi_berita_indonesia'];
    $isi_en     = $_POST['isi_berita_inggris'];
    $ekstensi_diperbolehkan = array('png', 'jpg', 'pdf', 'zip');
    $nama = $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
        if ($ukuran < 1048576) { // 1 MB limit
            move_uploaded_file($file_tmp, 'berkas/' . $nama);

            $stmt = $mysqli->prepare("INSERT INTO berita (tanggal, judul_id, judul_en, isi_id, isi_en, file, status) VALUES (NOW(), ?, ?, ?, ?, ?, 'T')");
            $stmt->bind_param("sssss", $judul_id, $judul_en, $isi_id, $isi_en, $nama);

            if ($stmt->execute()) {
                echo 'Proses Upload File: Berhasil';
                echo '<a href="index.php">Kembali Ke Halaman Berita</a>';
            } else {
                echo 'Proses Upload File: Gagal';
                echo '<a href="index.php">Kembali Ke Halaman Berita</a>';
                echo '<a href="tambah_berita.html.php">Kembali Ke Form Tambah Berita</a>';
            }
        } else {
            echo 'Ukuran File Terlalu Besar';
        }
    } else {
        echo 'File yang dikirim terindikasi BERBAHAYA';
    }
}
?>
