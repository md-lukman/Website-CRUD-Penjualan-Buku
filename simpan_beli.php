<?php
session_start();
include_once('template_atas.php');

function cekLogin() {
    if (!isset($_SESSION['user'])) {
        echo '<p style="color: white; font-weight: bold;">Anda harus login terlebih dahulu sebelum melakukan pembelian.</p>';
        exit(); 
    }
}

cekLogin();

$namacust = $_POST['namacust'];
$email = $_POST['email'];
$notelp = $_POST['notelp'];
$tanggal = date("Y-m-d");
$barang_pilih = '';
$qty = 1;
$sql='';

$DataValid = "YA";
if(strlen(trim($namacust)) == 0){
    echo "Nama harus Diisi...<br/>";
    $DataValid = "TIDAK";
}
if(strlen(trim($notelp)) == 0){
    echo "No. Telp harus Diisi...<br/>";
    $DataValid = "TIDAK";
}
if(isset($_COOKIE['keranjang'])){
    $barang_pilih = $_COOKIE['keranjang'];
} else {
    echo "Keranjang belanja Kosong <br/>";
    $DataValid = "TIDAL";
}

if($DataValid == "TIDAK") {
    echo "Masih ada kesalahan, silahkan perbaiki!<br/>";
    echo "<input type='button' value = 'kembali' onClick = 'self.history.back()'>";
    exit;
}

include "koneksi.php";
$simpan = true;
$mulai_transaksi = mysqli_begin_transaction($kon);
$sql = "INSERT into hjual (tanggal, namacust, email, notelp)
        values ('$tanggal','$namacust','$email','$notelp')";
$hasil = mysqli_query($kon, $sql);

if(!$hasil){
    echo " data customer gagal simpan";
    $simpan = false;
}

$idhjual = mysqli_insert_id($kon);
if($idhjual == 0){
    echo "Data customer tidak ada <br/>";
    $simpan = false;
}

$barang_array = explode(",", $barang_pilih);
$jumlah = count($barang_array);

if($jumlah <= 1){
    echo "Tidak ada barang yang dipilih <br/>";
    $simpan = false;
} else {
    foreach($barang_array as $idbarang){
        if($idbarang == 0){
            continue;
        }
        $sql = "SELECT * from barang where idbarang = $idbarang";
        $hasil = mysqli_query($kon, $sql);
        if(!$hasil){
            echo "Barang Tidak Ada <br/>";
            $simpan = false;
            break;
        } else {
            $row = mysqli_fetch_assoc($hasil);
            $stok = $row['stok'] - 1;
            if($stok < 0) {
                echo "Stok Barang ".$row['nama']. " Kosong <br/>";
                $simpan = false;
                break;
            }
            $harga = $row['harga'];
        }
        $sql = "INSERT into djual (idhjual, idbarang, qty, harga)
                values ('$idhjual', '$idbarang', '$qty', '$harga')";
        $hasil = mysqli_query($kon, $sql);
        if(!$hasil){
            echo "Detail jual gagal simpan <br/>";
            $simpan = false;
            break;
        }
        $sql = "UPDATE barang set stok = $stok where idbarang = $idbarang";
        $hasil = mysqli_query($kon, $sql);
        if(!$hasil){
            echo "Update stok barang gagal <br/>";
            $simpan = false;
            break;
        }
    }
}

if($simpan) {
    $komit = mysqli_commit($kon);
} else {
    $rollback = mysqli_rollback($kon);
    echo "Pembelian gagal <br/>
    <input type='button' value='Kembali' onClick='self.history.back()'>";
    exit;
}
header("Location: bukti_beli.php?idhjual=$idhjual");
setcookie('keranjang',$barang_pilih,time()-3600);
include_once('template_bawah.php');
?>