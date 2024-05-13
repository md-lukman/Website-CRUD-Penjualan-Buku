<?php
$buku_pilih = 0;
if (isset($_COOKIE['keranjang'])) {
    $buku_pilih = $_COOKIE['keranjang'];
}
if (isset($_GET['idBuku'])) {
    $idbuku = $_GET['idBuku'];
    $buku_pilih = $buku_pilih . "," . $idbuku;
    setcookie('keranjang', $buku_pilih, time() + 3600);
}
include "KoneksiSewaBuku.php";
$sql = "SELECT * FROM buku WHERE idBuku NOT IN (" . $buku_pilih . ") AND stok > 0 ORDER BY idBuku DESC";
$hasil = mysqli_query($koneksi, $sql);

if (!$hasil) {
    die("gagal query..");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>DAFTAR BUKU TERSEDIA</h2>
    <table border="1">
        <tr>
            <th>Foto</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Operasi</th>
        </tr>
        <?php
        $no = 0;
        while ($row = mysqli_fetch_assoc($hasil)) {
            echo "<tr>";
            echo "<td><img src='pict/" . $row['foto'] . "'width = '100'/></td>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td>" . $row['pengarang'] . "</td>";
            echo "<td>";
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?idBuku=" . $row['idBuku'] . "' > PINJAM </a>";
            echo "</td>";
            echo "<tr>";
        }
        ?>
    </table>
</body>
</html>