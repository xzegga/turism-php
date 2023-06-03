<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    $sql = "SELECT id, firstname, lastname, email, mobilenumber, is_active, role
                FROM `users` ORDER BY id DESC";
    $query = mysqli_query($connection, $sql);
    $rowCount = mysqli_num_rows($query);

    // If query fails, show the reason
    if(!$query){
        die("SQL query failed: " . mysqli_error($connection));
    }
?>