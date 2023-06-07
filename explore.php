<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/explore.php'); ?>

<?php include('./includes/head.php'); ?>


    <div class="dark-bg">
        <?php include('./includes/navbar.php'); ?>
    </div>


    <main role="main">

        <section class="jumbotron text-center header-int">
            <div class="container pt-5">
                <h1 class="jumbotron-heading text-white">Explora El Salvador</h1>
                <p class="lead text-white">Descubre la belleza de El Salvador, aquí encontrarás diversas categorías para
                    explorar los mejores destinos turísticos del país.</p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    echo '<div class="col-md-3 pr-2 pl-2"><div class="card mb-4 shadow-sm">';
                    echo '<div class="card-body p-1"><div class="site-image" style="background-image: url(/uploads/' . $row['image'] . '); background-size: cover">';
                    echo '</div><div class="card-text mb-2 p-2">';
                    echo '<h4 class="card-title">' . $row['name'] . '</h4>';
                    echo '<p class="card-text">' . substr($row['description'], 0, 100) . '...</p>';
                    echo '</div>';
                    echo '<div class="d-flex justify-content-end align-items-center">';
                    echo '<div class="btn-group">';
                    echo '<a type="button" class="btn btn-sm btn-outline-secondary mb-2 mr-2 ml-auto" href="categoria.php?catId=' . $row['id'] . '">Explora...</a>';
                    echo '</div></div></div></div></div>';
                }

                mysqli_free_result($query);
                ?>
                </div>
            </div>
        </div>

    </main>


    <?php include('./includes/footer.php'); ?>