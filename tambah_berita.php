<?php
// Start session untuk mengambil data user yang login
session_start();

// Cek apakah session 'username' ada
if (!isset($_SESSION['username'])) {
    // Jika tidak ada, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil nama pengguna dari session
$nama = $_SESSION['nama'];

// Tampilkan pesan hello
echo "Hello, $nama!";

?>

<html>
    <center>
        <h1>Tambah Berita</h1>
        <form action="proses_tambah_berita.php" method="POST">
            <table>
                <tr>
                    <td>Judul Berita</td>
                    <td><input type="text" name="judul" required></td>
                </tr>
                <tr>
                    <td>Isi Berita</td>
                    <td><textarea name="isi" required></textarea></td>
                </tr>
            </table>
            <input type="submit" value="Tambah Berita">
        </form>
    </center>
</html>
