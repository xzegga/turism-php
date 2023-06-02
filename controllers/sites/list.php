<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    $sql = "SELECT posts.id, posts.title, posts.status, posts.created_at, CONCAT(users.firstname, ' ' , users.lastname) as author, `categories`.`name` as category
                FROM `posts` 
                LEFT JOIN `users` ON `posts`.`author` = `users`.`id` 
                LEFT JOIN `categories` ON `posts`.`category` = `categories`.`id`";
    $query = mysqli_query($connection, $sql);
    $rowCount = mysqli_num_rows($query);

    // If query fails, show the reason
    if(!$query){
        die("SQL query failed: " . mysqli_error($connection));
    }
?>