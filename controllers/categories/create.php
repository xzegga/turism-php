<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    // Error & success messages
    global $nameEmptyErr;

    
    if(isset($_POST["submit"])) {

        $name      = $_POST["name"];

        // PHP validation
        // Verify if form values are not empty
        if(!empty($name)){
            // check if user email already exist

            // clean the form data before sending to database
            $name = mysqli_real_escape_string($connection, $name);
            // Query
            $sql = "INSERT INTO categories (name) VALUES ('{$name}')";

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
                    El nombre no puede estar en blanco.
                </div>';
            }

        }
    }
?>