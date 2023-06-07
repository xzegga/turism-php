
<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    $cat_sql = "SELECT * FROM categories";
    $cat_query = mysqli_query($connection, $cat_sql);

    // If query fails, show the reason
    if(!$cat_query){
        die("SQL query failed: " . mysqli_error($connection));
    }

    if(isset($_GET['id'])) {
        $postId = $_GET['id'];
        // Get post by id
        $post_sql = "SELECT * FROM posts WHERE id = $postId";
        $post_query = mysqli_query($connection, $post_sql);

        // If query fails, show the reason
        if(!$post_query){
            die("SQL query failed: " . mysqli_error($connection));
        }

    } else {
        // No ID provided in the URL parameter
        $error_msg_post = '<div class="alert alert-success">¡Error, debe proveer un id!</div>';
        header("Location: ./index.php?error=". urlencode($error_msg_post));
        exit();
    }

?>