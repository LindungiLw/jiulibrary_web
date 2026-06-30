<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Digital Collection - Dream Blue Library</title>
    
    <!-- Preload Critical Fonts -->
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Digital Collection - Dream Blue Library" />
    <meta property="og:description" content="Explore online access to e-books, e-journals, and digital resources." />
    <meta property="og:image" content="assets/images/library-logo.webp" />
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
      
      .service-content {
        padding: 60px 0;
      }
      .service-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 40px;
      }
      .service-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
      }
      .service-card:hover { transform: translateY(-5px); }
      .service-card i { font-size: 2.5rem; color: #3b82f6; margin-bottom: 20px; }
      .service-card h3 { font-size: 1.25rem; color: #1e293b; margin-bottom: 10px; }
      .service-card p { color: #64748b; font-size: 0.95rem; line-height: 1.6; }
      .service-card .btn-access {
        display: inline-block;
        margin-top: 20px;
        padding: 8px 16px;
        background: #f1f5f9;
        color: #3b82f6;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: 0.3s;
      }
      .service-card .btn-access:hover { background: #3b82f6; color: white; }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="service-header">
      <div class="container">
        <h1>Digital Collection</h1>
        <p>Explore thousands of e-books, e-journals, and digital resources available 24/7 for the JIU academic community.</p>
      </div>
    </header>

    <section class="service-content">
      <div class="container">
        <div class="section-title text-center">
          <h2>Our E-Resources</h2>
        </div>
        
        <div class="service-grid">
          <div class="service-card">
            <i class="fas fa-book-open"></i>
            <h3>Digital Library</h3>
            <p>Access our localized digital repository of theses, final projects, and university publications online securely.</p>
            <a href="https://uijakarta.perpustakaan.co.id/home.ks" class="btn-access">Access Repository</a>
          </div>
          
          <div class="service-card">
            <i class="fas fa-globe"></i>
            <h3>International Journals</h3>
            <p>We provide exclusive access to premium academic databases such as ProQuest, EBSCO, and JSTOR.</p>
            <a href="https://drive.google.com/drive/folders/1KMCkxdgPSOMMBdWr_BnM8475t3VP6OG4" class="btn-access">View Journals</a>
          </div>

          <div class="service-card">
            <i class="fas fa-laptop-house"></i>
            <h3>Off-Campus Access</h3>
            <p>Learn how to access our digital collections from home using the university SSO and Proxy services.</p>
            <a href="#" class="btn-access">Read Guidelines</a>
          </div>
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
