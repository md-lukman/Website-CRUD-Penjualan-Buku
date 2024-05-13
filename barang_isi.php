<?php include_once('template_atas.php'); ?>
<h2>:: ISI BARANG ::</h2>
<form action="barang_simpan.php" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td>Nama Barang</td>
            <td><input type="text" name="nama"></td>
        </tr>
        <tr>
            <td>Harga Jual</td>
            <td><input type="text" name="harga"></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td><input type="text" name="stok"></td>
        </tr>
        <tr>
            <td>Gambar [max=1.5MB</td>
            <td><input type="file" name="foto"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="proses" value="Simpan">
                <input type="reset" name="reset" value="reset">
            </td>
        </tr>
    </table>
</form>
<?php include_once('template_bawah.php');?>