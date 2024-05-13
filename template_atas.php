<?php
@session_start();
$pengguna = isset($_SESSION["user"]) ? $_SESSION["user"] : "";
$nama_lengkap = isset($_SESSION["nama_lengkap"]) ? $_SESSION["nama_lengkap"] : "";
$akses = isset($_SESSION["akses"]) ? $_SESSION["akses"] : "beli";
if ($akses == "toko") {
    $nama_akses = "Operator Toko";
} else {
    $nama_akses = "Pembeli";;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APLIKASI TOKO ONLINE</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="wrap">
        <div id="header">
            <h1>Toko Online Lukman</h1>
        </div>
        <div style="clear: both"></div>
        <div id="tengah">
            <div id="info_pengguna">
                <?php
                if (!empty($pengguna)) {
                    echo "Sedang Login Sebagai : $pengguna,
                    Nama Lengkap : $nama_lengkap <br/>
                    Akses Sebagai : $nama_akses,";
                    $tampil_login = "display:none";
                    $tampil_logout = "";
                } else {
                    $tampil_login = "";
                    $tampil_logout = "display:none";
                }
                ?>
                Tanggal : <?php echo date("d F Y") ?>
            </div>
            <div id="menu">
                <div id="menu_header">Menu</div>
                <div id="menu_konten">
                    <ul>
                        <?php
                        $tampil = "";
                        if ($akses == "beli") {
                            $tampil = "display:none";
                        }
                        ?>
                        <li><a style="<?php echo $tampil ?>" href="kelola_barang.php">Kelola Barang</a></li>
                        <li><a style="<?php echo $tampil ?>" href="barang_isi.php">Input Barang</a></li>
                        <li><a href="barang_tersedia.php">Barang Tersedia</a></li>
                        <li><a href="keranjang_belanja.php">Keranjang Belanja</a></li>
                        <li><a href="beli.php">Transaksi Pembelian</a></li>
                        <li><a style="<?php echo $tampil_login ?>" href="login_form.php">Login</a></li>
                        <li><a style="<?php echo $tampil_logout ?>" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div id="konten">