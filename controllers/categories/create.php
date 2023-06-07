<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    // Error & success messages
    global $nameEmptyErr, $descriptionEmptyErr;

    
    if(isset($_POST["submit"])) {

        $name           = $_POST["name"];
        $description    = $_POST["description"];

        // File upload path
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        
        // PHP validation
        // Verify if form values are not empty
        if(!empty($name)){
            // clean the form data before sending to database
            $name = mysqli_real_escape_string($connection, $name);
            $description = mysqli_real_escape_string($connection, $description);

            if (!empty($_FILES["file"]["name"]) && in_array($fileType, $allowTypes)) {
                // Upload file to server
                move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
            }

            // Query
            $sql = "INSERT INTO categories (name, description, image) VALUES ('{$name}', '{$description}', '{$fileName}')";

            // Create mysql query
            $sqlQuery = mysqli_query($connection, $sql);

            if(!$sqlQuery){
                die("MySQL query failed!" . mysqli_error($connection));
            }

            // Send verification email
            if($sqlQuery) {
                $success_msg = '¡Registro exitoso!';
                header("Location: ./index.php?success=". urlencode($success_msg));
                exit();
            } else {
                $error_msg = '¡Ocurrio un problema al intentar guardar la nueva categoría!';
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