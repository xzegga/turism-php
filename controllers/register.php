<?php
    // Database connection
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/db.php');
    include_once($_SERVER['DOCUMENT_ROOT'].'/config/globals.php');
    // Swiftmailer lib
    require_once './lib/vendor/autoload.php';

    // Error & success messages
    global $success_msg, $email_exist, $f_NameErr, $l_NameErr, $_emailErr, $_mobileErr, $_passwordErr;
    global $fNameEmptyErr, $lNameEmptyErr, $emailEmptyErr, $mobileEmptyErr, $passwordEmptyErr, $email_verify_err, $email_verify_success;

    // Set empty form vars for validation mapping
    $_first_name = $_last_name = $_email = $_mobile_number = $_password = "";

    if(isset($_POST["submit"])) {
        
        $firstname     = $_POST["firstname"];
        $lastname      = $_POST["lastname"];
        $email         = $_POST["email"];
        $mobilenumber  = $_POST["mobilenumber"];
        $password      = $_POST["password"];
        $role      = "guest";

        // check if email already exist
        $email_check_query = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$email}' ");
        $rowCount = mysqli_num_rows($email_check_query);

        
        // PHP validation
        // Verify if form values are not empty
        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($mobilenumber) && !empty($password)){        
            // check if user email already exist
            if($rowCount > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        ¡Ya existe un usuario con ese correo electrónico!
                    </div>
                ';
            } else {                
                // clean the form data before sending to database
                $_first_name = mysqli_real_escape_string($connection, $firstname);
                $_last_name = mysqli_real_escape_string($connection, $lastname);
                $_email = mysqli_real_escape_string($connection, $email);
                $_mobile_number = mysqli_real_escape_string($connection, $mobilenumber);
                $_password = mysqli_real_escape_string($connection, $password);
                $_role = mysqli_real_escape_string($connection, $role);

                // perform validation
                if(!preg_match("/^[a-zA-Z ]*$/", $_first_name)) {
                    $f_NameErr = '<div class="alert alert-danger">
                            Solo letras y espacios en blanco son permitidos.
                        </div>';
                }
                if(!preg_match("/^[a-zA-Z ]*$/", $_last_name)) {
                    $l_NameErr = '<div class="alert alert-danger">
                            Solo letras y espacios en blanco son permitidos.
                        </div>';
                }
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="alert alert-danger">
                            Formato de correo electrónico inválido.
                        </div>';
                }
                if(!preg_match("/^[0-9]{8}+$/", $_mobile_number)) {
                    $_mobileErr = '<div class="alert alert-danger">
                            Solo son permitidos numeros de 8 cifras.
                        </div>';
                }
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
                    $_passwordErr = '<div class="alert alert-danger">
                             La contraseña debe ser entre 6 y 20 caracteres de largo, contener al menos un caracter especial, minúsculas, mayúsculas y un dígito.
                        </div>';
                }

                // Store the data in db, if all the preg_match condition met
                if((preg_match("/^[a-zA-Z ]*$/", $_first_name)) && (preg_match("/^[a-zA-Z ]*$/", $_last_name)) &&
                 (filter_var($_email, FILTER_VALIDATE_EMAIL)) && (preg_match("/^[0-9]{8}+$/", $_mobile_number)) && 
                 (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $_password))){
                    //echo "we are here before";
                    // Generate random activation token
                    $token = md5(rand().time());

                    // Password hash
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);

                    // Query
                    $sql = "INSERT INTO users (firstname, lastname, email, mobilenumber, password, token, is_active,
                    date_time, role) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$mobilenumber}', '{$password_hash}', 
                    '{$token}', '0', now(), '{$role}')";

                    // Create mysql query
                    $sqlQuery = mysqli_query($connection, $sql);

                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($connection));
                    }

                    // Send verification email
                    if($sqlQuery) {
                        $msg = 'Haz clic en el enlace de activación para verificar tu correo electrónico.. <br><br>
                          <a href="' . $site_url . '/user_verificaiton.php?token='.$token.'"> Haz clic aquí para verificar el correo electrónico.</a>
                        ';

                        // Create the Transport
                        $transport = (new Swift_SmtpTransport($email_host, 465, 'ssl'))
                        ->setUsername($email_sender)
                        ->setPassword($email_password);

                        // Create the Mailer using your created Transport
                        $mailer = new Swift_Mailer($transport);

                        // Create a message
                        $message = (new Swift_Message('Por favor, verifica la dirección de correo electrónico.!'))
                        ->setFrom([$email => $firstname . ' ' . $lastname])
                        ->setTo($email)
                        ->addPart($msg, "text/html")
                        ->setBody('Hola! usuario');

                        // Send the message
                        $result = $mailer->send($message);

                        if(!$result){
                            $email_verify_err = '<div class="alert alert-danger">
                                ¡No se pudo enviar el correo electrónico de verificación!
                            </div>';
                        } else {
                            $email_verify_success = '<div class="alert alert-success">
                                ¡Se ha enviado el correo electrónico de verificación!
                            </div>';
                        }
                    }
                }
            }
        } else {
            if(empty($firstname)){
                $fNameEmptyErr = '<div class="alert alert-danger">
                    El nombre no puede estar en blanco.
                </div>';
            }
            if(empty($lastname)){
                $lNameEmptyErr = '<div class="alert alert-danger">
                    El apellido no puede estar en blanco.
                </div>';
            }
            if(empty($email)){
                $emailEmptyErr = '<div class="alert alert-danger">
                    El correo electrónico no puede estar en blanco.
                </div>';
            }
            if(empty($mobilenumber)){
                $mobileEmptyErr = '<div class="alert alert-danger">
                    El número de teléfono móvil no puede estar en blanco.
                </div>';
            }
            if(empty($password)){
                $passwordEmptyErr = '<div class="alert alert-danger">
                    La contraseña no puede estar en blanco.
                </div>';
            }
        }
    }
?>