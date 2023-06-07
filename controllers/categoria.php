<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    if(isset($_GET['catId'])) {
        $catId = $_GET['catId'];
        // Get post by id
        $cat_sql = "SELECT id, name, description, image FROM `categories` WHERE id = " . $catId . "";
        $cat_query = mysqli_query($connection, $cat_sql);

        // If query fails, show the reason
        if(!$cat_query){
            die("SQL query failed: " . mysqli_error($connection));
        }

        $sql = "SELECT id, title, content, status, created_at, background, excerpt
                FROM `posts` 
                WHERE category = " . $catId . " AND status = 1";

        $query = mysqli_query($connection, $sql);
        $rowCount = mysqli_num_rows($query);

        // If query fails, show the reason
        if(!$query){
            die("SQL query failed: " . mysqli_error($connection));
        }

    } else {
        // No ID provided in the URL parameter
        $error_msg_post = '¡Error, debe proveer un id de categoría!';
        header("Location: ./index.php?error=". urlencode($error_msg_post));
        exit();
    }

?>