<nav class="navbar admin navbar-expand-lg navbar-dark  bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/"><img src="/assets/images/logo-turismoSV.png" alt="logo" height="45" class="d-inline-block align-text-top"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
            aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-flex justify-content-end gap-2" id="navbarColor02">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/sites/index.php">Sitios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/categories/index.php">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/users/index.php">Usuarios</a>
                </li>
                <?php
                if (isset($_SESSION['email'])) {
                    ?>
                    <li class="nav-item">                        
                        <a class="nav-link pb-0 pr-0" href="/admin/users/edit.php?id=<?php echo $_SESSION['user_id']; ?>">
                            <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?? ''; ?>
                        </a>
                        <div class="p-0 m-0 d-flex justify-content-end logout">
                            <a class="nav-link p-0 m-0" href="/logout.php">Salir</a>
                        </div>
                    </li>
                    <?php
                }
                ?>                
            </ul>
        </div>
    </div>
</nav>