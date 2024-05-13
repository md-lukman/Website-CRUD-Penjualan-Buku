<?php
include_once('template_atas.php');
if (!isset($_SESSION["user"])) {
    echo "Sesi Sudah Habis! <br/> <a href='login_form.php'>LOGIN LAGI</a>";
    exit;
}

echo "SELAMAT DATANG <br/>";
echo "USER: " . $_SESSION["user"] . "<br/>";
echo "NAMA: " . $_SESSION["nama_lengkap"] . "<br/>";
?>
<hr/>
<!-- <div id="menu">
    <h2>LINK</h2>
    <a href="buku_tersedia.php">Buku Yang Tersedia</a> <br/>
    <a href="beli_buku.php">Pinjam Buku</a> <br/>
    <a href="logout.php">Logout</a> <br/>
</div> -->
<?php  include_once('template_bawah.php') ?>
