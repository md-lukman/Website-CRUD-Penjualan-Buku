<?php
$nama_judul = "";
$nama_pengarang = "";
if (isset($_POST["judul"]) && isset($_POST["pengarang"])){
    $nama_judul = $_POST["judul"];
    $nama_pengarang = $_POST["pengarang"];
}
include "KoneksiSewaBuku.php";
$sql = "SELECT * FROM buku WHERE judul LIKE '%" . $nama_judul . "%' AND pengarang LIKE '%" . $nama_pengarang . "%' ORDER BY idBuku DESC";
$hasil = mysqli_query($koneksi, $sql);


if (!$hasil)
    die("Gagal Query..." . mysqli_error($koneksi));
?>
<a href="barang_isi.php">INPUT BUKU</a>
&nbsp; &nbsp; &nbsp;
<a href="barang_cari.php">CARI BUKU</a>
<table border="5">
    <tr>
        <th>Foto</th>
        <th>Judul Buku</th>
        <th>Prngarang</th>
        <th>Informasi</th>
    </tr>
    <?php
    $no = 0;
    while ($row = mysqli_fetch_assoc($hasil)) {
        echo "<tr>";
        echo "<td><img src='pict/" . $row['foto'] . "'width = '100'/></td>";
        echo "<td>" . $row['judul'] . "</td>";
        echo "<td>" . $row['pengarang'] . "</td>";
        echo "<td><a href='Lihat_Buku.php?id=".$row['idBuku']."' name = 'Lihat'>Lihat Buku</a></td>";
        
    }
    ?>
</table>