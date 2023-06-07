
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

    // Error & success messages
    global $titleEmptyErr, $contentEmptyErr, $categoryEmptyErr, $statusEmptyErr, $excerptEmptyErr;;

    // Set empty form vars for validation mapping
    $_id = $_title = $_content = $_category = $_status = "";

    if(isset($_POST["submit"])) {

        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
        $fileName = !empty($_FILES["file"]["name"]) ? basename($_FILES["file"]["name"]) : "";
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $id         = $_POST["id"];
        $title      = $_POST["title"];
        $content    = $_POST["content"];
        $category   = $_POST["category"];
        $status     = $_POST["status"];
        $excerpt = $_POST["excerpt"];
        
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        
        // PHP validation
        // Verify if form values are not empty
        if(!empty($title) && !empty($content) && !empty($category) && ($status != 0 || $status != 1)){
            // check if user email already exist

            // clean the form data before sending to database
            $title = mysqli_real_escape_string($connection, $title);
            $content = mysqli_real_escape_string($connection, $content);
            $category = mysqli_real_escape_string($connection, $category);
            $status = mysqli_real_escape_string($connection, $status);
            $excerpt = mysqli_real_escape_string($connection, $excerpt);

            // Store the data in db, if all the preg_match condition met
            if (!empty($_FILES["file"]["name"]) && in_array($fileType, $allowTypes)) {
                // Upload file to server
                move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
            }
            // Query
            $sql = "UPDATE posts SET 
                title = '{$title}',
                content = '{$content}',
                category = {$category},
                " . ($fileName != '' ? "background = '{$fileName}'," : "") . "
                status = {$status},
                excerpt = '{$excerpt}'
            WHERE id = $postId";
            // Create mysql query
            $sqlQuery = mysqli_query($connection, $sql);

            if(!$sqlQuery){
                die("MySQL query failed!" . mysqli_error($connection));
            }

            // Send verification email
            if($sqlQuery) {
                $success_msg = '¡Registro modificado con exito!';
                header("Location: ./index.php?success=". urlencode($success_msg));
                exit();
            } else {
                $error_msg = 'Error al modificar!';
                header("Location: ./index.php?error=". urlencode($error_msg));
                exit();
            }
        } else {
            if(empty($title)){
                $titleEmptyErr = '<div class="alert alert-danger mt-1">
                    El título no puede estar en blanco.
                </div>';
            }
            if(empty($content)){
                $contentEmptyErr = '<div class="alert alert-danger mt-1">
                    El contenido no puede estar en blanco.
                </div>';
            }
            if(empty($category)){
                $categoryEmptyErr = '<div class="alert alert-danger mt-1">
                    Debe seleccionar una categoría.
                </div>';
            }
            if(empty($status)){
                $statusEmptyErr = '<div class="alert alert-danger mt-1">
                    Debe selecionar un estado.
                </div>';
            }

        }
    }
?>