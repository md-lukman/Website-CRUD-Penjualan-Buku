<style type="text/css">
    @media print {
        #tombol {
            display: none;
        }
    }
</style>
<div id="tombol">
    <input type="button" value="Pinjam Lagi" onClick="window.location.assign('barang_tersedia.php')">
    <input type="button" value="Print" onClick="window.print()">
</div>
<?php
$idhjual = $_GET["idhjual"];
include "KoneksiSewaBuku.php";
$sqlhjual = "select * from hjual where idhjual = $idhjual";
$hasilhjual = mysqli_query($koneksi, $sqlhjual);
$rowhjual = mysqli_fetch_assoc($hasilhjual);

echo "<pre>";
echo "<h2>BUKTI PEMINJAMAN</h2>";
echo "NO. NOTA  : " . date("Ymd") . $rowhjual['idhjual'] . "<br/>";
echo "TANGGAL   : " . $rowhjual['tanggal'] . "<br/>";
echo "NAMA      : " . $rowhjual['namacust'] . "<br/>";
$sqldjual = "SELECT buku.judul, buku.pengarang, djual.idhjual FROM buku JOIN djual ON djual.idbarang = buku.idBuku WHERE djual.idhjual = $idhjual";


$hasildjual = mysqli_query($koneksi, $sqldjual);

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr>";
echo "<th> Judul Buku </th>";
echo "<th> Pengarang </th>";
echo "</tr>";
$totalharga = 0;

while ($rowdjual = mysqli_fetch_assoc($hasildjual)) {
    echo "<tr>";
    echo "<td align='left'>" . $rowdjual['judul'] . "</td>";
    echo "<td align='left'>" . $rowdjual['pengarang'] . "</td>";
    $totalharga += 1;
}

echo "<tr>";
echo "<td align='left'><strong>Total Buku</strong></td>";
echo "<td align='left'><strong>$totalharga</strong></td>";
echo "</tr>";

echo "</table>";
echo "</pre>";
