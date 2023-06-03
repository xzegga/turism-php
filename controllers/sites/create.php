<?php
// Database connection
include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php');

$cat_sql = "SELECT * FROM categories";
$cat_query = mysqli_query($connection, $cat_sql);

// If query fails, show the reason
if (!$cat_query) {
    die("SQL query failed: " . mysqli_error($connection));
}


// Error & success messages
global $titleEmptyErr, $contentEmptyErr, $categoryEmptyErr, $statusEmptyErr;

// Set empty form vars for validation mapping
$_first_name = $_last_name = $_email = $_mobile_number = $_password = "";


if (isset($_POST["submit"])) {

    // File upload path
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
    $title = $_POST["title"];
    $content = $_POST["content"];
    $category = $_POST["category"];
    $author = $_POST["author"];
    $status = $_POST["status"];
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    // PHP validation
    // Verify if form values are not empty
    if (!empty($title) && !empty($content) && !empty($category) && !empty($author) && !empty($status)) {
        // check if user email already exist

        // clean the form data before sending to database
        $title = mysqli_real_escape_string($connection, $title);
        //$content = mysqli_real_escape_string($connection, $content);
        $category = mysqli_real_escape_string($connection, $category);
        $author = mysqli_real_escape_string($connection, $author);
        $status = mysqli_real_escape_string($connection, $status);

        // Store the data in db, if all the preg_match condition met
        if (!empty($_FILES["file"]["name"]) && in_array($fileType, $allowTypes)) {
            // Upload file to server
            move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        }
        // Query
        $sql = "INSERT INTO posts (title, content, author, background, category, status) VALUES ('{$title}', '{$content}', {$author}, '{$fileName}', {$category}, {$status})";

        // Create mysql query
        $sqlQuery = mysqli_query($connection, $sql);

        if (!$sqlQuery) {
            die("MySQL query failed!" . mysqli_error($connection));
        }

        // Send verification email
        if ($sqlQuery) {
            $success_msg = '¡Registro exitoso!';
            header("Location: ./index.php?success=" . urlencode($success_msg));
            exit();
        } else {
            $error_msg = '¡Ocurrio un problema al intentar guardar el nuevo sitio turístico!';
            header("Location: ./index.php?error=" . urlencode($error_msg));
            exit();
        }
    } else {
        if (empty($title)) {
            $titleEmptyErr = '<div class="alert alert-danger mt-1">
                    El título no puede estar en blanco.
                </div>';
        }
        if (empty($content)) {
            $contentEmptyErr = '<div class="alert alert-danger mt-1">
                    El contenido no puede estar en blanco.
                </div>';
        }
        if (empty($category)) {
            $categoryEmptyErr = '<div class="alert alert-danger mt-1">
                    Debe seleccionar una categoría.
                </div>';
        }
        if (empty($status)) {
            $statusEmptyErr = '<div class="alert alert-danger mt-1">
                    Debe selecionar un estado.
                </div>';
        }

    }
}
?>