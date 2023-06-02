<?php
    $port = "";
    $hostname = "";
    $site_directory = "";

    $site_url = "http://" . $hostname . ($port != '' ? ":" . $port : '') . ($site_directory != '' ? "/" . $site_directory : '') ;

    $email_host="";
    $email_sender="";
    $email_password="";

    // TinyMCE editor
    $config = array();
    $config["apiKey"] = "";
?>