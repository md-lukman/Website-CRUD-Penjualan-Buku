<?php
session_start();
$pengguna = $_POST['pengguna'];
$kata_kunci = md5($_POST['kata_kunci']);
$dataValid = "YA";

if (strlen(trim($pengguna)) == 0) {
    echo "User Harus Diisi! <br />";
    $dataValid = "TIDAK";
}

if (strlen(trim($kata_kunci)) == 0) {
    echo "Password Harus Diisi! <br />";
    $dataValid = "TIDAK";
}

if ($dataValid == "TIDAK") {
    echo "Masih Ada Kesalahan, silahkan perbaiki! </br>";
    echo "<input type='button' value='Kembali' onClick='self.history.back()'>";
    exit;
}

include "KoneksiSewaBuku.php";

$sql = "SELECT * FROM pengguna WHERE user='" . $pengguna . "' AND password='" . $kata_kunci . "' limit 1";
$hasil = mysqli_query($koneksi, $sql) or die('Gagal Akses! <br/>');
$jumlah = mysqli_num_rows($hasil);

if ($jumlah > 0) {
    $row = mysqli_fetch_assoc($hasil);
    $_SESSION["akses"] = $row["akses"];
    $_SESSION["user"] = $row["user"];
    $_SESSION["nama_lengkap"] = $row["nama_lengkap"];
    header("Location: halaman_awal.php");
} else {
    echo "User atau Password salah! <br/>";
    echo "<input type='button' value='Kembali' onclick='self.history.back()'>";
}
?>
