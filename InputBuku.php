
<h1>INPUT BUKU</h1>
<form action="simpanBuku.php" method="post" enctype="multipart/form-data">
<hr>
<table border="1">
    <tr>
        <td>Kode</td>
        <td><input type="number" name="kode"></td>
    </tr>
    <tr>
        <td>Judul Buku</td>
        <td><input type="text" name="judul"></td>
    </tr>
    <tr>
        <td>Pengarang</td>
        <td><input type="text" name="pengarang"></td>
    </tr>
    <tr>
        <td>Penerbit</td>
        <td><input type="text" name="penerbit"></td>
    </tr>
    <tr>
        <td>Jumlah Stok</td>
        <td><input type="number" name="stok"></td>
    </tr>
    <tr>
        <td>Foto Sampul</td>
        <td><input type="file" name="foto"></td>
    </tr>
</table>
<hr>
    <input type="submit" name="simpan" value="Simpan">
    <input type="reset" name="reset" value="Reset">
</form>
