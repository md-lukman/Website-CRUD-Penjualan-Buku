<?php
    $kode = $_POST['kode'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $stok = $_POST['stok'];

    $foto = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];
    $type = $_FILES['foto']['type'];

    $maxSize = 1500000;
    $typeYgBoleh = array("image/jpeg", "image/png", "image/pjpeg");

    $dirFoto = "pict";
    if(!is_dir($dirFoto))
        mkdir($dirFoto);
    $fileTujuanFoto = $dirFoto."/t".$foto;
    $dirThumb = "thumb";
    if(!is_dir($dirThumb))
        mkdir($dirThumb);
    $fileTujuanThumb= $dirThumb."/t".$foto;
    $DataValid = "YA";
    if($size > 0 ) {
        if($size > $maxSize){
            echo "Ukuran File terlaluu Besar <br/>";
            $dataValid = "TIDAK";
        }
        if(!in_array($type, $typeYgBoleh)){
            echo "File Tidak Dikenal <br/>";
            $dataValid = "TIDAK";
        }
    }
    if(strlen(trim($kode))==0){
        echo "Kode Buku Harus Diisi!<br/>";
        $DataValid = "TIDAK";
    }
    if(strlen(trim($judul))==0){
        echo "Judul Buku Harus Diisi!<br/>";
        $DataValid = "TIDAK";
    }
    if(strlen(trim($pengarang))==0){
        echo "Pengarang Buku Harus Diisi!<br/>";
        $DataValid = "TIDAK";
    }
    if(strlen(trim($penerbit))==0){
        echo "Penerbit Buku Harus Diisi!<br/>";
        $DataValid = "TIDAK";
    }
    if(strlen(trim($stok))==0){
        echo "Stok Buku Harus Diisi!<br/>";
        $DataValid = "TIDAK";
    }
    if($DataValid == "TIDAK"){
        echo "Masih ada kesalahan, silahkan perbaiki! <br>";
        echo "<input type = 'button' value = 'kembali' onClick = 'self.history.back()'>";
        exit;
    }
    include "KoneksiSewaBuku.php";
    $sql = "insert into buku 
            (kode, judul, pengarang, penerbit, stok, foto)
            values
            ('$kode','$judul','$pengarang','$penerbit','$stok','$foto')";
    $hasil = mysqli_query($koneksi,$sql);
    if(!$hasil){
        echo "Gagal Simpan, Silahkan diulangi! <br/>";
        echo mysqli_error($koneksi);
        echo "<input type='button' value='kembali' onClick = 'self.history.back()'>";
        exit;
    } else {
        echo "Simpan Data berhasil...!";
    }
    if($size > 0) {
        if(!move_uploaded_file($tmpName, $fileTujuanFoto)) {
            echo "Gagal upload gambar ... <br/>";
            echo "<a href = 'barang_tampil.php'>Daftar Barang<a/>";
            exit;
        } else {
            buat_thumbnail($fileTujuanFoto, $fileTujuanThumb);
        }
    }
    echo "<br/> File sudah di upload. <br/>";
    function buat_thumbnail($file_src, $file_dst) {
        //hapus jika thumbnail sebelumnya sudah ada
        list($w_src, $h_src, $type) = getImageSize($file_src);
        switch ($type) {
            case 1://gif -> jpg
                $img_src = imagecreatefromgif($file_src);
                break;
            case 2://jpeg -> jpg
                $img_src = imagecreatefromjpeg($file_src);
                break;  
            case 3:
                $img_src = imagecreatefrompng($file_src);
                break;
        }
        $thumb = 100; //max size untuk thumb
        if($w_src > $h_src) {
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