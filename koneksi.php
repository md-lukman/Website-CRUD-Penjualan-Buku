<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "toko_ol";

    $kon = mysqli_connect($host, $user, $pass);
    if(!$kon){
        die("gagal Koneksi...");
    }

    $hasil = mysqli_query($kon, "CREATE DATABASE IF NOT EXISTS $dbName");
    $hasil = mysqli_select_db($kon, $dbName);

    if(!$hasil){
        if(!$hasil)
           die("Gagal Buat Database");
    }
    $sqlTableBarang = "create table if not exists barang (
        idbarang int auto_increment not null primary key,
        nama varchar(40) not null,
        harga int not null default 0,
        stok int not null default 0,
        foto varchar(70) not null default '',
        KEY(nama))";
    mysqli_query($kon, $sqlTableBarang) or die ("gagal buat table barang");
    echo "tabel barang siap <hr/>";

    $sqlTableHjual = "CREATE TABLE IF NOT EXISTS hjual (
        idhjual int auto_increment not null primary key,
        tanggal date not null,
        namacust varchar(40) not null,
        email varchar(50) not null default '',
        notelp varchar(20) not null default '')";

    mysqli_query($kon, $sqlTableHjual) or die("gagal buat tabel header jual");

    $sqlTableDjual = "CREATE table if not exists djual (
        iddjual int auto_increment not null primary key,
        idhjual int not null,
        idbarang int not null,
        qty int not null,
        harga int not null
    )";

    mysqli_query($kon,$sqlTableDjual) or die('gagal buat table detail jual');
    
    $sqlTabelUser = "CREATE table if not exists pengguna (
        idpengguna int auto_increment not null primary key,
        user varchar(25) not null,
        password varchar(50) not null,
        nama_lengkap varchar(50) not null,
        akses varchar(10) not null)";

    mysqli_query($kon, $sqlTabelUser) or die("Gagal Buat Tabel Pengguna");

$sql = "SELECT * FROM pengguna";
$hasil = mysqli_query($kon, $sql);
$jumlah = mysqli_num_rows($hasil);

if ($jumlah == 0) {
    $sqlInsert = "INSERT INTO pengguna (user, password, nama_lengkap, akses) VALUES 
                  ('admin', MD5('admin'), 'administrator', 'toko'), 
                  ('cust', MD5('cust'), 'pelanggan', 'beli')";

    mysqli_query($kon, $sqlInsert);

    echo "Tabel Siap <hr/>";
}


   
?>