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
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.7" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.2" />
    <link rel="stylesheet" href="assets/css/about.css?v=2.4" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
      .modern-map-section {
        padding: 60px 20px 100px;
        background-color: #f8fafc;
      }
      
      .map-card {
        background: white;
        border-radius: 24px;
        padding: 25px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.06);
        border: 1px solid rgba(59, 130, 246, 0.08);
        max-width: 1100px;
        margin: 0 auto;
        position: relative;
        z-index: 10;
      }
      
      .map-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 15px 25px;
        border-bottom: 2px dashed #e2e8f0;
        margin-bottom: 25px;
      }
      
      .map-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 12px;
      }
      .map-title i {
        color: #3b82f6;
        background: #eff6ff;
        padding: 10px;
        border-radius: 12px;
      }
      
      .btn-download-map {
        background: #eff6ff;
        color: #3b82f6;
        padding: 12px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
      }
      .btn-download-map:hover {
        background: #3b82f6;
        color: white;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        transform: translateY(-2px);
      }
      
      .map-image-wrapper {
        overflow: hidden;
        border-radius: 16px;
        background: #f1f5f9;
        position: relative;
      }
      
      .modern-map-image {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
      }
      


      @media (max-width: 768px) {
        .map-toolbar {
          flex-direction: column;
          gap: 15px;
          align-items: flex-start;
        }

      }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="about-header">
      <div class="container">
        <h1 data-aos="fade-up" data-i18n="hdrMapTitle">Library Floor Plan</h1>
        <p data-aos="fade-up" data-aos-delay="100" data-i18n="hdrMapDesc" style="margin-top: 10px; font-size: 1.1rem; opacity: 0.9">
          Explore the layout of Dream Blue Library
        </p>
      </div>
    </header>

    <section class="modern-map-section">
      <div class="container">
        <div class="map-card" data-aos="fade-up" data-aos-delay="200">
          <div class="map-toolbar">
            <div class="map-title">
              <i class="fas fa-map-marked-alt"></i> Overview
            </div>
            <a href="assets/images/map-library.webp" download="Dream_Blue_Library_Map.webp" class="btn-download-map">
              <i class="fas fa-download"></i> Download Map
            </a>
          </div>
          <div class="map-image-wrapper">
            <img
              src="assets/images/map-library.webp"
              alt="Denah Dream Blue Library"
              class="modern-map-image"
            />
          </div>
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
    <script defer src="assets/js/dictionary.js?v=1.4"></script>
    <script defer src="assets/js/main.js?v=2.2"></script>
  </body>
</html>
