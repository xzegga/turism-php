<?php
    // Enable us to use Headers
    ob_start();

    // Set sessions
    if(!isset($_SESSION)) {
        session_start();
    }

    $hostname = "";
    $username = "";
    $password = "";
    $dbname = "";

    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")
?>