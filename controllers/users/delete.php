<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    if(isset($_POST["delete"])) {
        $id = $_POST["usr-id-to-delete"];

        $rm_sql = "SELECT * FROM users WHERE id = {$id}";
        $rm_query = mysqli_query($connection, $rm_sql);
        $rowCount = mysqli_num_rows($rm_query);

        // If query fails, show the reason
        if(!$rm_query){
            die("SQL query failed: " . mysqli_error($connection));
        }

        if($rowCount == 0) {
            $err_msg = '¡El Usuario seleccionado no existe!';
            header("Location: ./index.php?success=". urlencode($err_msg));
            exit();
        } else {}
            // Store the data in db, if all the preg_match condition met

            // Query
            $sql = "DELETE FROM users WHERE id={$id}";
            // Create mysql query
            $sqlQuery = mysqli_query($connection, $sql);

            if(!$sqlQuery){
                die("MySQL query failed!" . mysqli_error($connection));
            }

            // Send verification email
            if($sqlQuery) {
                $success_msg = '¡Registro eliminado con exito!';
                header("Location: ./index.php?success=". urlencode($success_msg));
                exit();
            } else {
                $err_msg = 'No se pudo eliminar el registro.';
                header("Location: ./index.php?error=". urlencode($err_msg));
                exit();
            }
    }
?>