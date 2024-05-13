<div style="background: orange"> 
    <h1>INI HALAMAN DUA</h1>
    <?php
    session_start();
    echo "SELAMAT DATANG <br/>";
    echo "USER: " . $_SESSION["user"] . "<br/>";
    echo "NAMA: " . $_SESSION["nama_lengkap"] . "<br/>";
    echo "AKSES: " . $_SESSION["akses"] . "<br/>";
    ?>
</div>
