<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/config/db.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/index.php'); ?>

<?php include('./includes/head.php'); ?>

<body>
  <!-- Responsive navbar-->
  <?php include('./includes/navbar.php'); ?>

  <!-- Header - set the background image for the header in the line below-->
  <header class="bg-dark py-5 hero-background hero-home-page">
    <div class="container px-3 pt-5">
      <div class="row gx-5 align-items-center justify-content-center">
        <div class="col-lg-8 col-xl-7 col-xxl-6">
          <div class="my-5 text-center text-xl-left text-lg-left">
            <span class="lead fw-normal text-white mb-4">Descubre las maravillas de</span>
            <h1 class="display-2 fw-bolder text-white mb-2">El Salvador <img
                   src="/assets/images/flag-heart.png" alt="" class="flah-sv"></h1>
            <p class="lead fw-normal text-white mb-4">
              Navega y descubre el Pulgarcito de América accediendo a sus
              bellos paisajes, playas, lugares historicos y mucho más
            </p>
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
              <a class="btn btn-primary btn-lg px-4 me-sm-3" href="/explore.php">Explora El
                Salvador</a>

            </div>
          </div>
        </div>
        <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
          <!-- <img class="img-fluid rounded-3 my-5" src="./images/foto-portada-opt.jpg" alt="..." /> -->
        </div>
      </div>
    </div>
  </header>
  <!-- Content section-->
  <section class="py-5 border-bottom" id="features">
    <div class="container px-5 my-5">
      <div class="row gx-5">
        <div class="col-lg-4 mb-5 mb-lg-0">
          <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
            <i class="bi bi-collection"></i>
          </div>
          <h2 class="h4 fw-bolder">Conoce</h2>
          <p>
            En esta sección encontrarás información sobre El Salvador, un país centroamericano
            conocido por su rica cultura, paisajes impresionantes y deliciosa gastronomía.
          </p>
          <a class="text-decoration-none" href="#!">
            Ver más información
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
        <div class="col-lg-4 mb-5 mb-lg-0">
          <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
            <i class="bi bi-building"></i>
          </div>
          <h2 class="h4 fw-bolder">Explora</h2>
          <p>
            Descubre la belleza de El Salvador, aquí encontrarás diversas categorías para explorar
            los mejores destinos turísticos del país.
          </p>
          <a class="text-decoration-none" href="/explore.php">
            Ver más información
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
        <div class="col-lg-4">
          <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
            <i class="bi bi-toggles2"></i>
          </div>
          <h2 class="h4 fw-bolder">Informate</h2>
          <p>
            Encuentra artículos interesantes y entretenidos sobre El Salvador, desde viajes y
            gastronomía hasta cultura y estilo de vida.
          </p>
          <a class="text-decoration-none" href="#!">
            Ver más información
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </section>
  <div class="album py-5 bg-light">
      <div class="container">
          <h2 class="mb-4">Explora lo más nuevo en TurismoSv</h2>
          <div class="row">
          <?php
          while ($row = mysqli_fetch_array($query)) {
            echo '<div class="col-md-4 pr-2 pl-2"><div class="card mb-4 shadow-sm">';
            echo '<div class="card-body p-1"><div class="site-image" style="background-image: url(/uploads/' . $row['background'] . '); background-size: cover">';
            echo '</div><div class="card-text mb-2 p-2">';
            echo '<h4 class="card-title">' . $row['title'] . '</h4>';
            echo '<p class="card-text">' . $row['excerpt'] . '...</p>';
            echo '<div class="chip">' . $row['category'] . '</i></div>';
            echo '</div>';
            echo '<div class="d-flex justify-content-end align-items-center">';
            echo '<div class="btn-group">';
            echo '<a type="button" class="btn btn-sm btn-outline-secondary mb-2 mr-2 ml-auto" href="site.php?id=' . $row['id'] . '">Explora...</a>';
            echo '</div></div></div></div></div>';
        }

          mysqli_free_result($query);
          ?>
          </div>
      </div>
  </div>

  <?php include('./includes/footer.php'); ?>
