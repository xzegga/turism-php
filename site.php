<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/site.php'); ?>

<?php include('./includes/head.php'); ?>

<div class="dark-bg">
    <?php include('./includes/navbar.php'); ?>
</div>

<main>
    <?php
    if ($post_query && mysqli_num_rows($post_query) > 0) {
        // Post found, retrieve the data
        $post = mysqli_fetch_assoc($post_query);

        ?>
        <section class="jumbotron text-center header-int">
            <div class="container pt-5">
                <h1 class="jumbotron-heading text-white">
                    Descubre
                    <?php echo $post['title']; ?>
                </h1>
            </div>
        </section>
        <section>
            <article>
                <div class="container mt-5 pt-3">
                    <div class="row">
                        <!-- Contenido -->
                        <div class="col-8">
                            <?php echo $post['content']; ?>
                        </div>

                        <!-- Imagen -->
                        <div class="col-4">
                            <img class="img-thumbnail" src="/uploads/<?php echo $post['background']; ?>"
                                alt="<?php echo $post['title']; ?>">
                        </div>

                    </div>
                </div>
            </article>
        </section>
    <?php
    } else {
        // No post found with the given ID
        echo "Post not found.";
    }
    ?>
</main>