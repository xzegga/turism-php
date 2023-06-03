<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/middleware.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/users/edit.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header-admin.php'); ?>

<?php
if ($usr_query && mysqli_num_rows($usr_query) > 0) {
    $post = mysqli_fetch_assoc($usr_query);

    ?>
    <div class="container mt-5 pt-5 h-full-wf">
        <div class="container mb-5">
            <h2 class="mb-4">Editar usuario</h2>
            <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?php echo $post['id']; ?>">
                <div class="form-group mb-3">
                    <label for="firstname">Nombres:</label>
                    <input type="text" name="firstname" class="form-control" required
                        value="<?php echo $post['firstname']; ?>">
                    <?php echo $firstnameEmptyErr; ?>
                </div>
                <div class="form-group mb-3">
                    <label for="lastname">Apellidos:</label>
                    <input type="text" name="lastname" class="form-control" required
                        value="<?php echo $post['lastname']; ?>">
                    <?php echo $lastnameEmptyErr; ?>
                </div>
                <div class="form-group mb-3">
                    <label for="email">Correo Electrónico:</label>
                    <div class="form-control disabled">
                        <?php echo $post['email']; ?>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="mobilenumber">Teléfono:</label>
                    <input type="text" name="mobilenumber" class="form-control" required
                        value="<?php echo $post['mobilenumber']; ?>">
                    <?php echo $mobilenumberEmptyErr; ?>
                </div>
                <?php
                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['id']) {
                    ?>
                    <div class="form-group mb-3">
                        <label for="email">Role</label>
                        <div class="form-control disabled">
                            <?php echo $post['role']; ?>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="form-group mb-3 flex-fill">
                        <label for="role">Role:</label>
                        <select class="form-control" name="role" id="role">
                            <option value="admin" <?php if ($post['role'] == 'admin')
                                echo 'selected'; ?>>Administrador</option>
                            <option value="guest" <?php if ($post['role'] == 'guest')
                                echo 'selected'; ?>>Visitante</option>
                        </select>
                        <?php echo $roleEmptyErr; ?>
                    </div>
                    <div class="form-group mb-3 flex-fill">
                        <label for="is_active">Estado:</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="1" <?php if ($post['is_active'] == '1')
                                echo 'selected'; ?>>Activo</option>
                            <option value="0" <?php if ($post['is_active'] == '0')
                                echo 'selected'; ?>>Inactivo</option>
                        </select>
                        <?php echo $is_activeEmptyErr; ?>
                    </div>
                    <?php
                }
                ?>

                
                <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg">Guardar</button>
            </form>
        </div>
    </div>
    <?php
} else {
    // No post found with the given ID
    echo "User not found.";
}
?>
<?php include('../../includes/footer.php'); ?>