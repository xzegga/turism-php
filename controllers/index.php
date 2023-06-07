<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    $sql = "SELECT posts.id, posts.title, posts.excerpt, posts.background, categories.name as category
                FROM posts 
                LEFT JOIN categories ON posts.category = categories.id 
                WHERE posts.status = 1 LIMIT 0, 3";

    $query = mysqli_query($connection, $sql);
    $rowCount = mysqli_num_rows($query);

    // If query fails, show the reason
    if(!$query){
        die("SQL query failed: " . mysqli_error($connection));
    }
?>