<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    $sql = "SELECT id, name, description, image FROM `categories`";
    $query = mysqli_query($connection, $sql);
    $rowCount = mysqli_num_rows($query);

    // If query fails, show the reason
    if(!$query){
        die("SQL query failed: " . mysqli_error($connection));
    }
?>