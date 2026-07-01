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
        background: linear-gradient(to bottom, rgba(30, 58, 138, 0.95) 0%, rgba(59, 130, 246, 0.2) 100%),
                    url('assets/images/services-photo/printed.jpg');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 140px 0 60px;
        text-align: center;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
      }
      .service-header h1 { font-size: 2.5rem; margin-bottom: 15px; }
      .service-header p { font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto; }
      
      .service-content { padding: 60px 0; background-color: #f8fafc; }
      
      .pricelist-container {
        background: white;
        padding: 50px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        max-width: 900px;
        margin: 0 auto;
        border: 1px solid rgba(59, 130, 246, 0.1);
        position: relative;
        overflow: hidden;
      }
      .paylater-tag {
        position: absolute;
        top: 50px;
        right: -65px;
        background: #ef4444;
        color: white;
        padding: 12px 60px;
        transform: rotate(45deg);
        font-weight: 800;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        letter-spacing: 1px;
      }
      
      .price-sections {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 40px;
        margin-top: 20px;
      }
      
      .price-group {
        background: #f8fafc;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid #e2e8f0;
        position: relative;
        margin-top: 20px;
      }
      .group-title {
        background: #3b82f6;
        color: white;
        display: inline-block;
        padding: 8px 25px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 1.1rem;
        position: absolute;
        top: -20px;
        left: 20px;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
      }
      
      .price-list { list-style: none; padding: 0; margin: 20px 0 0 0; }
      .price-list li {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed #cbd5e1;
        color: #334155;
        font-size: 1.05rem;
      }
      .price-list li:last-child { border-bottom: none; }
      .price-val { font-weight: 700; color: #0f172a; }
      
      .other-group {
        background: #eff6ff;
        border-radius: 16px;
        padding: 35px 30px 25px;
        border-left: 5px solid #1e3a8a;
        position: relative;
        margin-top: 30px;
      }
      .other-group .group-title {
        background: #1e3a8a;
        box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
      }
      .other-list { list-style: none; padding: 0; margin: 0; }
      .other-list li {
        padding: 10px 0;
        font-size: 1.1rem;
        color: #334155;
      }
      .warning-text { color: #ef4444 !important; font-weight: 600; }
      .warning-text i { margin-right: 8px; }

      @media (max-width: 768px) {
        .price-sections { grid-template-columns: 1fr; }
        .paylater-tag { 
          position: static; 
          transform: none; 
          text-align: center; 
          border-radius: 12px; 
          margin-bottom: 30px; 
          display: block; 
          padding: 15px;
        }
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
        <div class="pricelist-container">
          <div class="paylater-tag">
             Paylater is not accepted
          </div>

          <h2 style="font-size: 2.2rem; color: #1e3a8a; font-weight: 800; margin-bottom: 40px; text-align: center;">PRICELIST AT JIU LIBRARY</h2>

          <div class="price-sections">
            <!-- Using Library Paper -->
            <div class="price-group">
              <div class="group-title">Using Library Paper</div>
              <ul class="price-list">
                <li><span><i class="fas fa-file-alt" style="color: #64748b; margin-right: 8px;"></i> Print/Photo Copy (one side)</span> <span class="price-val">: Rp300/paper</span></li>
                <li><span><i class="fas fa-copy" style="color: #64748b; margin-right: 8px;"></i> Print/Photo Copy (both sides)</span> <span class="price-val">: Rp500/paper</span></li>
                <li><span><i class="fas fa-file" style="color: #64748b; margin-right: 8px;"></i> Buy blank paper</span> <span class="price-val">: Rp100/paper</span></li>
              </ul>
            </div>
            
            <!-- If you bring your paper -->
            <div class="price-group">
              <div class="group-title">If you bring your paper</div>
              <ul class="price-list">
                <li><span><i class="fas fa-file-alt" style="color: #64748b; margin-right: 8px;"></i> Print/Photo Copy (one side)</span> <span class="price-val">: Rp200/paper</span></li>
                <li><span><i class="fas fa-copy" style="color: #64748b; margin-right: 8px;"></i> Print/Photo Copy (both sides)</span> <span class="price-val">: Rp400/paper</span></li>
                <li><span><i class="fas fa-file" style="color: #64748b; margin-right: 8px;"></i> Buy blank paper</span> <span class="price-val">: Rp100/paper</span></li>
              </ul>
            </div>
          </div>
          
          <!-- Other -->
          <div class="other-group">
            <div class="group-title">Other</div>
            <ul class="other-list">
              <li style="display: flex; gap: 15px;">
                <strong style="width: 100px;">Late Fee</strong> 
                <span class="price-val">: Rp1,000/day/book</span>
              </li>
              <li class="warning-text"><i class="fas fa-exclamation-circle"></i> If you lose the library book, you have to pay 100% of the original price of the book!</li>
              <li class="warning-text"><i class="fas fa-exclamation-circle"></i> If you damage a library book, you have to repair it and pay if badly damaged!</li>
            </ul>
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
