<?php include('./includes/head.php'); ?>

<body>
  <!-- Responsive navbar-->
  <?php include('./includes/navbar.php'); ?>

  <!-- Header - set the background image for the header in the line below-->
  <header class="bg-dark py-5 hero-background hero-home-page">
    <div class="container px-5">
      <div class="row gx-5 align-items-center justify-content-center">
        <div class="col-lg-8 col-xl-7 col-xxl-6">
          <div class="my-5 text-center text-xl-start">
            <span class="lead fw-normal text-white mb-4">Descubre las maravillas de</span>
            <h1 class="display-2 fw-bolder text-white mb-2">El Salvador <img
                   src="./images/flag-heart.png" alt="" class="flah-sv"></h1>
            <p class="lead fw-normal text-white mb-4">
              Navega y descubre el Pulgarcito de América accediendo a sus
              bellos paisajes, playas, lugares historicos y mucho más
            </p>
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
              <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Explora El
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
          <a class="text-decoration-none" href="#!">
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
  <div class="container px-4 px-lg-5">
    <!-- Content Row-->

    <!-- Call to Action-->
    <div class="card text-white bg-secondary my-5 py-4 text-center">
      <div class="card-body">
        <p class="text-white m-0">
          This call to action card is a great place to showcase some important
          information or display a clever tagline!
        </p>
      </div>
    </div>
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
      <div class="col-lg-7">
        <img class="img-fluid rounded mb-4 mb-lg-0"
             src="https://dummyimage.com/900x400/dee2e6/6c757d.jpg" alt="..." />
      </div>
      <div class="col-lg-5">
        <h1 class="font-weight-light">Business Name or Tagline</h1>
        <p>
          This is a template that is great for small businesses. It doesn't
          have too much fancy flare to it, but it makes a great use of the
          standard Bootstrap core components. Feel free to use this template
          for any project you want!
        </p>
        <a class="btn btn-primary" href="#!">Call to Action!</a>
      </div>
    </div>
  </div>

  <?php include('./includes/footer.php'); ?>
