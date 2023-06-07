<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/middleware.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/categories/create.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header-admin.php'); ?>

<div class="container mt-5 pt-5 h-full-wf">
    <div class="container mb-5">
        <h2 class="mb-4">Crear una nueva categoría</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="author" id="author" value="<?php echo $_SESSION['user_id'] ?? ''; ?>">
            <div class="form-group mb-3">
                <label for="name">Nombre:</label>
                <input type="text" name="name" class="form-control" required
                    value="<?php echo $_POST["name"] ?? ''; ?>">

                <?php echo $nameEmptyErr; ?>
            </div>
            <div class="form-group mb-3">
                <label for="description">Descripción:</label>
                <textarea name="description" id="description" class="form-control" rows="5"
                    required><?php echo $_POST["description"] ?? ''; ?></textarea>
                <?php echo $descriptionEmptyErr; ?>
            </div>
            <div class="custom-file mb-5">
                <input type="file" class="custom-file-input" name="file" id="file">
                <label class="custom-file-label" for="customFile">Selecciona un archivo</label>
            </div>
            <button type="submit" name="submit" id="submit"
                class="btn btn-outline-primary btn-lg btn-block">Guardar</button>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php'); ?>
<script>
    jQuery(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        jQuery(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>