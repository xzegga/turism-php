<?php     
    include('./config/globals.php');
    session_start();
    session_destroy();
    header("Location: " .$site_url . "/index.php");
?>