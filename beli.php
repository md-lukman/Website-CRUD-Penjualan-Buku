<?php include_once('template_atas.php'); ?>
<h2>DATA PEMBELI BARANG</h2>
<form action="simpan_beli.php" method="POST">
    <table border="0">
    <tr>
        <td>Nama</td>
        <td>: <input type="text" name="namacust"/></td>
    </tr>
    <tr>
        <td>Email</td>
        <td>: <input type="email" name="email"/></td>
    </tr>
    <tr>
        <td>No. Telp</td>
        <td>: <input type="text" name="notelp"/></td>
    </tr>
    <tr>
        <td colspan="2" align="right">
        <input type="submit" value="Simpan"></td>
    </tr>
    </table>
</form>
<?php
    include_once("keranjang_belanja.php");
    include_once('template_bawah.php');
?>