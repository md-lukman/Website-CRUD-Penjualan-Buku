<?php
 include_once('template_atas.php');
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 session_destroy();
 echo " Anda Sudah Logout <br/>";
 include_once('template_bawah.php');
?>