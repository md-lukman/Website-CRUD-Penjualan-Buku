<?php
$barang_pilih = 0;
if (isset($_COOKIE['keranjang'])) {
    $barang_pilih = $_COOKIE['keranjang'];
  }


  if (isset($_GET['idBuku'])) {
    $idbarang = $_GET['idBuku'];
    $barang_pilih = str_replace((",".$idbarang),"",$barang_pilih);
    setcookie('keranjang', $barang_pilih, time() + 3600);
    echo "RUN";
}

include "KoneksiSewaBuku.php";

$sql = "SELECT * FROM buku WHERE idBuku IN (" . $barang_pilih . ") ORDER BY idBuku desc";


$hasil = mysqli_query($koneksi, $sql);
if (!$hasil)
    die("Gagal query..");
?>

<h2>KERANJANG PEMINJAMAN</h2>
<table border="1">
    <tr>
        <th>Foto</th>
        <th>Judul</th>
        <th>Pengarang</th>
        <!-- <th>Operasi</th> -->
    </tr>
    <?php
        $no = 0;
        while ($row = mysqli_fetch_assoc($hasil)) {
            echo "<tr>";
            echo "<td><img src='pict/" . $row['foto'] . "'width = '100'/></td>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td>" . $row['pengarang'] . "</td>";
            // echo "<td>";
            // // echo "<a href='" . $_SERVER['PHP_SELF'] . "?idBuku=" . $row['idBuku'] . "' > BATAL </a>";
            // echo "</td>";
            echo "<tr>";
        }
        ?>
</table>
