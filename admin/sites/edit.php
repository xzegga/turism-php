<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/middleware.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/sites/edit.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header-admin.php'); ?>

<?php
if ($post_query && mysqli_num_rows($post_query) > 0) {
    // Post found, retrieve the data
    $post = mysqli_fetch_assoc($post_query);
    $categoryId = $post['id'];
    // Output the post details
    ?>
    <div class="container mt-5 pt-5 h-full-wf">
        <div class="container mb-5">
            <h2 class="mb-4">Editar Sitio</h2>
            <form action="" method="post">
                <div class="form-group mb-3">
                    <label for="title">Título:</label>
                    <input type="text" name="title" class="form-control" required
                        value="<?php echo $post['title']; ?>">

                    <?php echo $titleEmptyErr; ?>
                </div>
                <div class="form-group mb-3">
                    <label for="content">Contenido:</label>
                    <textarea name="content" id="content" class="form-control" rows="5" required>
                        <?php echo $post['content']; ?>
                     </textarea>
                    <?php echo $contentEmptyErr; ?>
                </div>
                <div class="d-flex  gap-3">
                    <div class="form-group mb-3 flex-fill">
                        <label for="category-select">Categoría:</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">Selecciona</option>
                            <?php while ($row = mysqli_fetch_assoc($cat_query)): ?>
                                <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $post['category']) echo 'selected';?>><?php echo $row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <?php echo $categoryEmptyErr; ?>
                    </div>
                    <div class="form-group mb-3 flex-fill">
                        <label for="category-select">Estado:</label>
                        <select class="form-control" name="status" id="status">
                            <option value="1" <?php if ($post['status'] == 1) echo 'selected';?>>Activo</option>
                            <option value="0" <?php if ($post['status'] == 0) echo 'selected';?>>Inactivo</option>
                        </select>
                        <?php echo $statusEmptyErr; ?>
                    </div>
                </div>

                <button type="submit" name="submit" id="submit"
                    class="btn btn-outline-primary btn-lg btn-block">Guardar</button>
            </form>
        </div>
    </div>
    <?php
} else {
    // No post found with the given ID
    echo "Post not found.";
}
?>

<script src="https://cdn.tiny.cloud/1/j6u0iqyksp4920vxhw3bye8qjd2jdxec2gn4espnoflxjo0u/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'code anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'code undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ]
    });
</script>
<?php include('../../includes/footer.php'); ?>