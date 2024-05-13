<?php
$namacust = $_POST['namacust'];
$email = $_POST['email'];
$notelp = $_POST['notelp'];
$tanggal = $_POST['tanggal'];
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

include "KoneksiSewaBuku.php";
$simpan = true;
$mulai_transaksi = mysqli_begin_transaction($koneksi);
$sql = "INSERT into hjual (tanggal, namacust, email, notelp)
        values ('$tanggal','$namacust','$email','$notelp')";
$hasil = mysqli_query($koneksi, $sql);

if(!$hasil){
    echo " data customer gagal simpan";
    $simpan = false;
}

$idhjual = mysqli_insert_id($koneksi);
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
        $sql = "SELECT * from buku where idBuku = $idbarang";
        $hasil = mysqli_query($koneksi, $sql);
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
            $harga = $row['pengarang'];
        }
        $sql = "INSERT into djual (idhjual, idbarang, qty, harga)
                values ('$idhjual', '$idbarang', '$qty', '$harga')";
        $hasil = mysqli_query($koneksi, $sql);
        if(!$hasil){
            echo "Detail jual gagal simpan <br/>";
            $simpan = false;
            break;
        }
        $sql = "UPDATE buku set stok = $stok where idBuku = $idbarang";
        $hasil = mysqli_query($koneksi, $sql);
        if(!$hasil){
            echo "Update stok barang gagal <br/>";
            $simpan = false;
            break;
        }
    }
}

if($simpan) {
    $komit = mysqli_commit($koneksi);
} else {
    $rollback = mysqli_rollback($koneksi);
    echo "Pembelian gagal <br/>
    <input type='button' value='Kembali' onClick='self.history.back()'>";
    exit;
}
header("Location: bukti_beli_buku.php?idhjual=$idhjual");
setcookie('keranjang',$barang_pilih,time()-3600);
?>