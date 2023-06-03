
<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');

    if(isset($_GET['id'])) {
        $postId = $_GET['id'];
        // Get post by id
        $usr_sql = "SELECT id, firstname, lastname, email, mobilenumber, is_active, role FROM users WHERE id = $postId";
        $usr_query = mysqli_query($connection, $usr_sql);

        // If query fails, show the reason
        if(!$usr_query){
            die("SQL query failed: " . mysqli_error($connection));
        }

    } else {
        // No ID provided in the URL parameter
        $error_msg_post = 'El usuario no existe';
        header("Location: ./index.php?error=". urlencode($error_msg_post));
        exit();
    }

    // Error & success messages
    global $firstnameEmptyErr, $lastnameEmptyErr, $mobilenumberEmptyErr,  $roleEmptyErr, $is_activeEmptyErr;

    // Set empty form vars for validation mapping
    $_firstname = $_lastname = $_email = $_mobilenumber = $_role = $is_active = "";

    if(isset($_POST["submit"])) {
        $id             = $_POST["id"];
        $firstname      = $_POST["firstname"];
        $lastname       = $_POST["lastname"];
        $mobilenumber   = $_POST["mobilenumber"];

        if($_SESSION['user_id'] == $_POST["id"]) {
            $role       = $_SESSION['role'];
            $is_active  = $_SESSION['is_active'];
        } else {
            $role = $_POST["role"];
            $is_active  = $_POST["is_active"];
        }
        // PHP validation
        // Verify if form values are not empty
        if(!empty($firstname) && !empty($lastname) && !empty($mobilenumber)){
            // clean the form data before sending to database
            $_first_name = mysqli_real_escape_string($connection, $firstname);
            $_last_name = mysqli_real_escape_string($connection, $lastname);
            $_mobile_number = mysqli_real_escape_string($connection, $mobilenumber);
            $_role = mysqli_real_escape_string($connection, $role);
            $_is_active = mysqli_real_escape_string($connection, $is_active);

            // Store the data in db, if all the preg_match condition met
            // Query
            $sql = "UPDATE users SET
                firstname = '{$firstname}',
                lastname = '{$lastname}',
                mobilenumber = '{$mobilenumber}',
                role = '{$role}',
                is_active = {$is_active}
            WHERE id = $id";
            echo $sql;
            // Create mysql query
            $sqlQuery = mysqli_query($connection, $sql);

            if(!$sqlQuery){
                die("MySQL query failed!" . mysqli_error($connection));
            }

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
            if(empty($firstname)){
                $titleEmptyErr = '<div class="alert alert-danger mt-1">
                    El nombre no puede estar en blanco.
                </div>';
            }
            if(empty($lastname)){
                $contentEmptyErr = '<div class="alert alert-danger mt-1">
                    El apellido no puede estar en blanco.
                </div>';
            }
            if(empty($mobilenumber)){
                $categoryEmptyErr = '<div class="alert alert-danger mt-1">
                    El teléfono no puede estar en blanco.
                </div>';
            }
            if(empty($role)){
                $categoryEmptyErr = '<div class="alert alert-danger mt-1">
                    Debe seleccionar un rol.
                </div>';
            }
            if(empty($is_active)){
                $statusEmptyErr = '<div class="alert alert-danger mt-1">
                    Debe selecionar un estado.
                </div>';
            }

        }
    }
?>