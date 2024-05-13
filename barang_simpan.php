<?php
include_once('template_atas.php');
if (isset($_POST['idbarang'])) {
    $idbarang = $_POST['idbarang'];
    $foto_lama = $_POST['foto_lama'];
    $simpan = "EDIT";
} else {
    $simpan = "BARU";
}


$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

$foto = $_FILES['foto']['name'];
$tmpName = $_FILES['foto']['tmp_name'];
$size = $_FILES['foto']['size'];
$type = $_FILES['foto']['type'];

$maxSize = 1500000;
$typeYgBoleh = array("image/jpeg", "image/png", "image/pjpeg");

$dirFoto = "pict";
if (!is_dir($dirFoto))
    mkdir($dirFoto);
$fileTujuanFoto = $dirFoto . "/" . $foto;

$dirThumb = "thumb";
if ((!is_dir($dirThumb)))
    mkdir($dirThumb);
$fileTujuanThumb = $dirThumb . "/t" . $foto;
$dataValid = "YA";

if ($size > 0) {
    if ($size > $maxSize) {
        echo "Ukuran File terlalu Besar <br/>";
        $dataValid = "TIDAK";
    }
    if (!in_array($type, $typeYgBoleh)) {
        echo "File Tidak Dikenal <br/>";
        $dataValid = "TIDAK";
    }
}
if (strlen(trim($nama)) == 0) {
    echo "Nama Barang Harus Diisi! <br/>";
    $dataValid = "TIDAK";
}
if (strlen(trim($harga)) == 0) {
    echo "Harga Barang Harus Diisi! <br/>";
    $dataValid = "TIDAK";
}
if (strlen(trim($stok)) == 0) {
    echo "stok Barang Harus Diisi! <br/>";
    $dataValid = "TIDAK";
}
if ($dataValid == "TIDAK") {
    echo "Masih ada kesalahan, silahkan perbaiki! <br>";
    echo "<input type = 'button' value = 'kembali' onClick = 'self.history.back()'>";
    exit;
}
include "koneksi.php";
if ($simpan == "EDIT") {
    if ($size == 0) {
        $foto = $foto_lama;
    }
    $sql = "update barang set nama = '$nama', harga = '$harga', stok = '$stok', foto = '$foto' where idbarang = $idbarang ";
} else {
    $sql = "insert into barang
    (nama,harga,stok,foto)
    values
    ('$nama',$harga,$stok,'$foto')";
}

$hasil = mysqli_query($kon, $sql);
if (!$hasil) {
    echo "Gagal Simpan, Silahkan diulangi! <br/>";
    echo mysqli_error($kon);
    echo "<br/> <input type='button' value = 'kembali' onClick = 'self.history.back()'>";
    exit;
} else {
    echo "Simpan data Berhasil";
}
if ($size > 0) {
    if (!move_uploaded_file($tmpName, $fileTujuanFoto)) {
        echo "Gagal Upload gambar...<br/>";
        echo "<a href = 'barang_tampil.php'>Daftar Barang</a>";
        exit;
    } else {
        buat_thumbnail($fileTujuanFoto, $fileTujuanThumb);
    }
}
header('location:kelola_barang.php');
function buat_thumbnail($file_src, $file_dst)
{
    //hapus jika thumbnail sebelumnya sudah ada
    list($w_src, $h_src, $type) = getImageSize($file_src);
    switch ($type) {
        case 1: //gif -> jpg
            $img_src = imagecreatefromgif($file_src);
            break;
        case 2: // jpeg -> jpg
            $img_src = imagecreatefromjpeg($file_src);
            break;
        case 3: // png -> jpg
            $img_src = imagecreatefrompng($file_src);
            break;
    }
    $thumb = 100; //max. size untuk thumb
    if ($w_src > $h_src) {
        $w_dst = $thumb; //landscape
        $h_dst = round($thumb / $w_src * $h_src);
    } else {
        $h_dst = round($thumb / $h_src * $w_src); // postrait
        $w_dst = $thumb;
    }
    $img_dst = imagecreatetruecolor($w_dst, $h_dst); // resaple
    imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $w_dst, $h_dst, $w_src, $h_src);
    imagejpeg($img_dst, $file_dst); //simpan thumbnail
    //bersihkan memori
    imagedestroy($img_src);
    imagedestroy($img_src);
}
?>
<hr>
<?php include_once('template_bawah.php');?>