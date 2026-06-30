<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Printing & Scanning - Dream Blue Library</title>
    
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Printing & Scanning - Dream Blue Library" />
    <meta property="og:description" content="Self-service printing, scanning, and copying facilities." />
    <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />

    <link rel="stylesheet" href="assets/css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.0" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
      .service-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 80px 0 60px;
        text-align: center;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
      }
      .service-header h1 { font-size: 2.5rem; margin-bottom: 15px; }
      .service-header p { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; }
      
      .service-content { padding: 60px 0; }
      
      .price-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 30px;
      }
      .price-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        text-align: center;
        border-top: 4px solid #8b5cf6;
      }
      .price-card i { font-size: 2rem; color: #8b5cf6; margin-bottom: 15px; }
      .price-card h3 { color: #1e293b; margin-bottom: 10px; font-size: 1.1rem; }
      .price-card .price { font-size: 1.5rem; font-weight: bold; color: #334155; }
      
      .guide-box {
        background: #f8fafc;
        padding: 30px;
        border-radius: 12px;
        margin-top: 40px;
      }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="service-header">
      <div class="container">
        <h1>Printing & Scanning Facilities</h1>
        <p>Self-service printing, copying, and scanning available at the Library IT Corner.</p>
      </div>
    </header>

    <section class="service-content">
      <div class="container">
        <div class="section-title text-center">
          <h2>Price List</h2>
        </div>
        
        <div class="price-grid">
          <div class="price-card">
            <i class="fas fa-print"></i>
            <h3>Black & White Print</h3>
            <div class="price">Rp 500 <span style="font-size: 0.9rem; font-weight: normal;">/ page</span></div>
          </div>
          <div class="price-card">
            <i class="fas fa-palette"></i>
            <h3>Color Print</h3>
            <div class="price">Rp 1,500 <span style="font-size: 0.9rem; font-weight: normal;">/ page</span></div>
          </div>
          <div class="price-card">
            <i class="fas fa-copy"></i>
            <h3>Photocopy</h3>
            <div class="price">Rp 200 <span style="font-size: 0.9rem; font-weight: normal;">/ page</span></div>
          </div>
          <div class="price-card">
            <i class="fas fa-file-pdf"></i>
            <h3>Scanning</h3>
            <div class="price">Free</div>
          </div>
        </div>

        <div class="guide-box">
          <h3 style="color: #1e293b; margin-bottom: 15px;">How to Print from Your Device</h3>
          <ol style="margin-left: 20px; color: #475569; line-height: 1.8;">
            <li>Connect your laptop or phone to the <strong>JIU-Library-Wifi</strong> network.</li>
            <li>Send your document to the printer email address: <strong>print@jiulibrary.ac</strong>.</li>
            <li>Wait for the confirmation email containing a PIN.</li>
            <li>Go to the printer machine, enter the PIN, and pay using Cash or QRIS.</li>
          </ol>
        </div>
      </div>
    </section>

    <?php include 'footer.php'; ?>
    
    <?php include 'chatbot-widget.php'; ?>
    <?php include 'a11y-widget.php'; ?>

    <script>
      window.BASE_URL = "<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>";
    </script>
    <script defer src="assets/js/dictionary.js?v=1.3"></script>
    <script defer src="assets/js/main.js?v=2.0"></script>
    <script defer src="assets/js/chatbot.js?v=1.8"></script>
  </body>
</html>
