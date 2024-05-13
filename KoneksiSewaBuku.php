<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "sewabuku";

    $koneksi = mysqli_connect($host,$user,$pass);
    if(!$koneksi){
        die("Gagal Koneksi");
    }

    $hasil = mysqli_query($koneksi, "CREATE DATABASE IF NOT EXISTS $dbName");
    $hasil = mysqli_select_db($koneksi,$dbName);

    if(!$hasil){
        if(!$hasil)
            die("Gagal Membuat Database...!");
    }
    $sqlTableBuku = "CREATE TABLE IF NOT EXISTS buku (
        idBuku int(11) primary key not null auto_increment,
        kode varchar(10) not null,
        judul varchar(40) not null,
        pengarang varchar(40) not null,
        penerbit varchar(40) not null,
        stok int(11) default 0 not null,
        foto varchar(40) not null,
        key(kode))";

    mysqli_query($koneksi,$sqlTableBuku) or die("Gagal Membuat table Buku...!");

    $sqlTableHjual = "CREATE TABLE IF NOT EXISTS hjual (
        idhjual int auto_increment not null primary key,
        tanggal date not null,
        namacust varchar(40) not null,
        email varchar(50) not null default '',
        notelp varchar(20) not null default '')";

    mysqli_query($koneksi, $sqlTableHjual) or die("gagal buat tabel header jual");

    $sqlTableDjual = "CREATE table if not exists djual (
        iddjual int auto_increment not null primary key,
        idhjual int not null,
        idbarang int not null,
        qty int not null,
        harga int not null
    )";

    mysqli_query($koneksi,$sqlTableDjual) or die('gagal buat table detail jual');

    $sqlTabelUser = "CREATE table if not exists pengguna (
        idpengguna int auto_increment not null primary key,
        user varchar(25) not null,
        password varchar(50) not null,
        nama_lengkap varchar(50) not null,
        akses varchar(10) not null)";

    mysqli_query($koneksi, $sqlTabelUser) or die("Gagal Buat Tabel Pengguna");

$sql = "SELECT * FROM pengguna";
$hasil = mysqli_query($koneksi, $sql);
$jumlah = mysqli_num_rows($hasil);

if ($jumlah == 0) {
    $sqlInsert = "INSERT INTO pengguna (user, password, nama_lengkap, akses) VALUES 
                  ('admin', MD5('admin'), 'administrator', 'toko'), 
                  ('cust', MD5('cust'), 'pelanggan', 'beli')";

    mysqli_query($koneksi, $sqlInsert);

    echo "Tabel Siap <hr/>";
}

?>