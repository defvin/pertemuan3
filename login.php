<?php
// Start session untuk menyimpan informasi user setelah login
session_start();

// Periksa apakah form login telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Koneksi ke database
    $host = "localhost"; // sesuaikan dengan host Anda
    $user = "root"; // sesuaikan dengan username database Anda
    $password = ""; // sesuaikan dengan password database Anda
    $dbname = "db_berita"; // sesuaikan dengan nama database Anda

    // Buat koneksi
    $conn = new mysqli($host, $user, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna berdasarkan username
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Cek apakah ada hasil dari query
    if ($result->num_rows > 0) {
        // Pengguna ditemukan, set session dan arahkan ke tambah_berita.php
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];  // Simpan username dalam session
        $_SESSION['nama'] = $row['nama'];  // Simpan nama dalam session
        header("Location: tambah_berita.php");  // Arahkan ke tambah_berita.php
        exit();
    } else {
        // Jika username atau password salah
        echo "Username atau password salah!";
    }

    // Tutup koneksi
    $conn->close();
}
?>

<html>
    <center>
        <h1>FORM LOGIN</h1>
        <hr>
        <form method="POST">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input name="username" size="10" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" size="10" required></td>
                </tr>
            </table>
            <hr>
            <input type="submit" value="LOGIN">
            <a href="daftar_admin.php">Daftar</a>
        </form>
    </center>
</html>
