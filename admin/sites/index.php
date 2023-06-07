<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/middleware.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/sites/list.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/sites/delete.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header-admin.php'); ?>

<div class="container mt-5 pt-5 h-full-wf">
    <h2>Listado de Sitios Turísticos</h2>
    <div class="d-flex justify-content-end gap-2">
        <a href="./create.php" class="btn btn-primary">Crear nuevo</a>
    </div>

    <br><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Categoría</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td class='d-flex justify-content-end gap-2'>
                            <a href='./edit.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm mr-2'>Edit</a>
                            <button data-id='" . $row['id'] . "' type='button' class='btn btn-danger btn-sm ml-2 delete-button'  data-toggle='modal' data-target='#exampleModal'>Delete</button>
                        </td>";
                echo "</tr>";
            }

            mysqli_free_result($query);
            ?>
        </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea eliminar el sitio seleccionado?
                </div>
                <div class="modal-footer">
                    <form action="" method="post">
                        <input type="text" name="site-id-to-delete" class="site-id-to-delete" value="" hidden>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="delete" class="btn btn-danger confirm-delete">Eliminar
                            Sitio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="toast-container position-absolute" style="z-index: 9999; right: 20px; top: 60px">
        <!-- Error toast -->
        <div class="toast bg-danger text-white" data-delay="3500" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong class="mr-auto">Ocurrió un error al intentar borrar el Sitio Seleccionado!</strong>
            </div>
        </div>
    </div>
    <div class="toast-container position-absolute" style="z-index: 9999; right: 20px; top: 60px">
        <!-- Success toast -->
        <div class="toast bg-success text-white" data-delay="3500" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong class="mr-auto">Operación realizada con éxito.!</strong>
            </div>
        </div>
    </div>
</div>
<?php include('../../includes/footer.php'); ?>
<script>
    const btns = document.querySelectorAll(".delete-button");
    if (btns) {
        btns.forEach(btn => {
            btn.addEventListener("click", (e) => {
                const id = e.target.dataset.id;
                const idToDelete = document.querySelector(".site-id-to-delete");
                idToDelete.setAttribute("value", id);
            });
        });
    }
    jQuery('document').ready(function () {
        let urlParams = new URLSearchParams(window.location.search);
        let error = urlParams.get('error');
        let success = urlParams.get('success');
        if (error) {
            // Show error toast
            jQuery('.toast.bg-danger').toast('show');
        } else if (success) {
            console.log('success');
            // Show success toast
            jQuery('.toast.bg-success').toast('show');
        }
    });
</script>