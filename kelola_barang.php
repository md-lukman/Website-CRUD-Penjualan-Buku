<?php
include_once('template_atas.php');
$barang_pilih = 0;
if (isset($_COOKIE['keranjang'])) {
  $barang_pilih = $_COOKIE['keranjang'];
}

if (isset($_GET['idbarang'])) {
  $idbarang = $_GET['idbarang'];
  $barang_pilih = $barang_pilih . "," . $idbarang;
  setcookie('keranjang', $barang_pilih, time() + 3600);
}
include "koneksi.php";
$sql = "SELECT * FROM barang WHERE idbarang NOT IN (" . $barang_pilih . ") AND stok > 0 ORDER BY idbarang DESC";
$hasil = mysqli_query($kon, $sql);


if (!$hasil) {
  die("Gagal query.." . mysqli_error($kon));
}
?>
<h2>KERANJANG BELANJA</h2>
<table border="1">
  <tr>
    <th>Foto</th>
    <th>Nama Barang</th>
    <th>Harga Jual</th>
    <th>Stok</th>
    <th>Operasi</th>
  </tr>
  <?php
  $no = 0;
  while ($row = mysqli_fetch_assoc($hasil)) {
    echo "<tr>";
    echo "<td><img src='pict/" . $row['foto'] . "'width = '100'/></td>";
    echo "<td>" . $row['nama'] . "</td>";
    echo "<td>" . $row['harga'] . "</td>";
    echo "<td>" . $row['stok'] . "</td>";
    echo "<td>";
    echo "<a href='barang_edit.php?idbarang=" . $row['idbarang'] . "'>
        EDIT
      </a>";
    echo "<a href='barang_hapus.php?idbarang=" . $row['idbarang'] . "'>
        HAPUS
      </a>";
    echo "</td>";
    echo "<tr>";
  }
  ?>
</table>
<?php include_once('template_bawah.php');?>