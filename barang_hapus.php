<?php
include_once('template_atas.php');
$idbarang = $_GET['idbarang'];
include "koneksi.php";
$sql = "select * from barang where idbarang = '$idbarang'";
$hasil = mysqli_query($kon, $sql);
if (!$hasil) die('Gagal query...');

$data = mysqli_fetch_array($hasil);
$nama = $data['nama'];
$harga = $data['harga'];
$stok = $data['stok'];
$foto = $data['foto'];


echo "<h2>Konfirmasi Hapus</h2>";
echo "Nama Barang: " . $nama . "<br/>";
echo "Harga Barang: " . $harga . "<br/>";
echo "Stok: " . $stok . "<br/>";
echo "Foto: <img src='pict/" . $foto . "' /><br/><br/>";
echo "APAKAH DATA INI AKAN DI HAPUS? <br/>";
echo "<a href='barang_hapus.php?idbarang=$idbarang&hapus=1'> YA </a>";
echo "&nbsp;&nbsp;";
echo "<a href='barang_tampil.php'> TIDAK </a> <br/><br/>";

if (isset($_GET['hapus'])) {
    $sql = "delete from barang where idbarang = '$idbarang'";
    $hasil = mysqli_query($kon, $sql);
    if (!$hasil) {
        echo "Gagal Hapus Barang: $nama..<br/>";
        echo "<a href='barang_tampil.php'>Kembali ke Daftar Barang</a>";
    } else {
        $gbr = "pict/$foto";
        if (file_exists($gbr)) unlink($gbr);
        $gbr = "thumb/t_$foto";
        if (file_exists($gbr)) unlink($gbr);
        header('location:kelola_barang.php');
    }
}

include_once('template_bawah.php');?>
