<?php
include "KoneksiSewaBuku.php";
if(isset($_POST['idBuku'])){
    $id = $_POST['idBuku'];
} else {
    $id = "";
}
$sql = "SELECT * FROM buku WHERE idBuku = '$id'";
$hasil = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($hasil);
$kode = $row['kode'];
$judul = $row['judul'];
$pengarang = $row['pengarang'];
$penerbit = $row['penerbit'];
$stok = $row['stok'];




if (!$hasil)
    die("Gagal Query..." . mysqli_error($koneksi));
?>
<a href="barang_isi.php">INPUT BUKU</a>
&nbsp; &nbsp; &nbsp;
<a href="barang_cari.php">CARI BUKU</a>
<table border="1">
    <tr><td></td></tr>
    <tr>
        <th>Kode Buku</th>
        <td><?php echo $row?></td>
    </tr>
    <tr>
        <th>Judul Buku</th>
    </tr>
    <tr>
        <th>Pengarang</th>
    </tr>
    <tr>
        <th>Penerbit</th>
    </tr>

</table>
