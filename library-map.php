<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Floor Plan - Dream Blue Library</title>
    
    <!-- Preload Critical Fonts -->
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Floor Plan - Dream Blue Library" />
    <meta property="og:description" content="Explore the layout of Dream Blue Library" />
    <meta property="og:image" content="assets/images/map-library.webp" />
    <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />

    <link rel="stylesheet" href="assets/css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.0" />
    <link rel="stylesheet" href="assets/css/about.css?v=2.4" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="about-header">
      <div class="container">
        <h1 data-aos="fade-up">Library Floor Plan</h1>
        <p data-aos="fade-up" data-aos-delay="100" style="margin-top: 10px; font-size: 1.1rem; opacity: 0.9">
          Explore the layout of Dream Blue Library
        </p>
      </div>
    </header>

    <section class="map-section">
      <div class="container">
        <div class="map-container" data-aos="zoom-in">
          <img
            src="assets/images/map-library.webp"
            alt="Denah Dream Blue Library"
            class="map-image"
          />
        </div>
      </div>
    </section>

    <?php include 'footer.php'; ?>
    
    <!-- BlueBot & A11y Widgets -->
    <?php include 'chatbot-widget.php'; ?>
    <?php include 'a11y-widget.php'; ?>

    <!-- Scripts -->
    <script>
      window.BASE_URL = "<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>";
    </script>
    <script defer src="assets/js/dictionary.js?v=1.3"></script>
    <script defer src="assets/js/main.js?v=2.0"></script>
    <script defer src="assets/js/chatbot.js?v=1.8"></script>
  </body>
</html>
