<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/middleware.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/sites/create.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header-admin.php'); ?>

<div class="container mt-5 pt-5 h-full-wf">
    <div class="container mb-5">
        <h2 class="mb-4">Crear nuevo sitios turístico</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="author" id="author" value="<?php echo $_SESSION['user_id'] ?? ''; ?>">
            <div class="form-group mb-3">
                <label for="title">Título:</label>
                <input type="text" name="title" class="form-control" required
                    value="<?php echo $_POST["title"] ?? ''; ?>">

                <?php echo $titleEmptyErr; ?>
            </div>
            
            <div class="form-group mb-3">
                <label for="excerpt">Descripcion corta (100 caracteres):</label>
                <input type="text" name="excerpt" class="form-control" required maxlength="100"
                    value=" <?php if (isset($_POST["excerpt"])) echo $_POST["excerpt"]; ?>">
                <?php echo $excerptEmptyErr; ?>
            </div>
            <div class="form-group mb-3">
                <label for="content">Contenido:</label>
                <textarea name="content" id="content" class="form-control" rows="5" required>
                    <?php if (isset($_POST["content"]))
                        echo $_POST["content"]; ?>
                </textarea>
                <?php echo $contentEmptyErr; ?>
            </div>
            <div class="d-flex  gap-3">
                <div class="form-group mb-3 flex-fill mr-2">
                    <label for="category-select">Categoría:</label>
                    <select class="form-control" id="category" name="category">
                        <option value="">Selecciona</option>
                        <?php while ($row = mysqli_fetch_assoc($cat_query)): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <?php echo $categoryEmptyErr; ?>
                </div>
                <div class="form-group mb-3 flex-fill ml-2">
                    <label for="category-select">Estado:</label>
                    <select class="form-control" name="status" id="status">
                        <option value="">Selecciona</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <?php echo $statusEmptyErr; ?>
                </div>

            </div>
            <div class="custom-file mb-5">
                <input type="file" class="custom-file-input" name="file" id="file">
                <label class="custom-file-label" for="customFile">Selecciona un archivo</label>
            </div>
            <button type="submit" name="submit" id="submit"
                class="btn btn-outline-primary btn-lg">Guardar</button>
        </form>
    </div>
</div>
<script src="https://cdn.tiny.cloud/1/j6u0iqyksp4920vxhw3bye8qjd2jdxec2gn4espnoflxjo0u/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
<?php include('../../includes/footer.php'); ?>
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

    jQuery(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        jQuery(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
