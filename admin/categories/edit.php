<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/middleware.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/categories/edit.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header-admin.php'); ?>

<?php
if ($cat_query && mysqli_num_rows($cat_query) > 0) {
    $post = mysqli_fetch_assoc($cat_query);
    $image = $post['image'];
    ?>
    <div class="container mt-5 pt-5 h-full-wf">
        <div class="container mb-5">
            <h2 class="mb-4">Editar categoría</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?php echo $post['id']; ?>">
                <div class="form-group mb-3">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" class="form-control" required value="<?php echo $post['name']; ?>">

                    <?php echo $nameEmptyErr; ?>
                </div>

                <div class="form-group mb-3">
                    <label for="description">Descripción:</label>
                    <textarea name="description" id="description" class="form-control" rows="5"
                        required><?php echo $post['description']; ?></textarea>
                    <?php echo $descriptionEmptyErr; ?>
                </div>
                <div class=""><img class="img-thumbnail mb-3" src="<?php echo '/uploads/'.$image; ?>" alt="" /></div>
                <div class="custom-file mb-5">
                    <input type="file" class="custom-file-input" name="file" id="file">
                    <label class="custom-file-label" for="customFile">Selecciona un archivo</label>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg">Guardar</button>
            </form>
        </div>
    </div>
    <?php
} else {
    // No post found with the given ID
    echo "Post not found.";
}
?>
<?php include('../../includes/footer.php'); ?>
<script>
    jQuery(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        jQuery(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>