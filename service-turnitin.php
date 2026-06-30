<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Turnitin Check - Dream Blue Library</title>
    
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Turnitin Check - Dream Blue Library" />
    <meta property="og:description" content="Originality checking services for academic integrity." />
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
      
      .turnitin-box {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
      }
      
      .similarity-limit {
        display: inline-block;
        background: #fee2e2;
        color: #ef4444;
        padding: 15px 30px;
        border-radius: 50px;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 20px 0;
      }
      
      .steps-container {
        text-align: left;
        margin-top: 30px;
      }
      .step-item {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
      }
      .step-number {
        background: #3b82f6;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
      }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="service-header">
      <div class="container">
        <h1>Turnitin Plagiarism Check</h1>
        <p>Ensure your academic work is original. We provide Turnitin checking services for all JIU students.</p>
      </div>
    </header>

    <section class="service-content">
      <div class="container">
        <div class="turnitin-box">
          <i class="fas fa-check-double" style="font-size: 3rem; color: #ef4444;"></i>
          <h2>Academic Integrity Policy</h2>
          <p style="color: #64748b; margin-top: 10px;">The maximum allowed similarity index for final projects, theses, and research papers at JIU is:</p>
          
          <div class="similarity-limit">
            Maximum 20% Similarity
          </div>
          
          <div class="steps-container">
            <h3 style="margin-bottom: 15px;">How to check your document:</h3>
            <div class="step-item">
              <div class="step-number">1</div>
              <div>Save your document in PDF or DOCX format. Make sure to remove the bibliography/references list to avoid false positives.</div>
            </div>
            <div class="step-item">
              <div class="step-number">2</div>
              <div>Email your document to <strong>admin@jiulibrary.ac</strong> with the subject: <em>Turnitin Check - [Your Student ID]</em>.</div>
            </div>
            <div class="step-item">
              <div class="step-number">3</div>
              <div>Wait 1-2 working days. The library will reply with the complete Turnitin Similarity Report PDF.</div>
            </div>
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
