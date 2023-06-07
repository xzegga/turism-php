
<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    if(isset($_GET['id'])) {
        $catId = $_GET['id'];
        // Get post by id
        $cat_sql = "SELECT * FROM categories WHERE id = $catId";
        $cat_query = mysqli_query($connection, $cat_sql);

        // If query fails, show the reason
        if(!$cat_query){
            die("SQL query failed: " . mysqli_error($connection));
        }

    } else {
        // No ID provided in the URL parameter
        $error_msg_post = '¡Error, debe proveer un id!';
        header("Location: ./index.php?error=". urlencode($error_msg_post));
        exit();
    }

    // Error & success messages
    global $nameEmptyErr, $descriptionEmptyErr;

    // Set empty form vars for validation mapping
    $_id = $_name = $_content = $_category = $_status = "";

    if(isset($_POST["submit"])) {
        $id        = $_POST["id"];
        $name      = $_POST["name"];
        $description    = $_POST["description"];

        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
        $fileName = !empty($_FILES["file"]["name"]) ? basename($_FILES["file"]["name"]) : "";
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        // PHP validation
        // Verify if form values are not empty
        if(!empty($name)){
            $name = mysqli_real_escape_string($connection, $name);
            $description = mysqli_real_escape_string($connection, $description);

            // Store the data in db, if all the preg_match condition met
            if (!empty($_FILES["file"]["name"]) && in_array($fileType, $allowTypes)) {
                // Upload file to server
                move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
            }

            // Query
            $sql = "UPDATE categories SET name = '{$name}', 
                    description= '{$description}' 
                    " . ($fileName != '' ? ", image = '{$fileName}'" : "") . " 
                    WHERE id = $id";
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
            if(empty($name)){
                $nameEmptyErr = '<div class="alert alert-danger mt-1">
                    El título no puede estar en blanco.
                </div>';
            }
            if(empty($description)){
                $descriptionEmptyErr = '<div class="alert alert-danger mt-1">
                    El título no puede estar en blanco.
                </div>';
            }
        }
    }
?>