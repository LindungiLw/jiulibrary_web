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
        background: linear-gradient(to bottom, rgba(30, 58, 138, 0.95) 0%, rgba(59, 130, 246, 0.2) 100%),
                    url('assets/images/services-photo/turnitin.png');
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
      
      .turnitin-box {
        background: white;
        padding: 50px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        max-width: 800px;
        margin: 0 auto;
        border: 1px solid rgba(59, 130, 246, 0.1);
      }
      .turnitin-box h2 {
        color: #0f172a;
        font-size: 2.2rem;
        font-weight: 800;
        text-align: center;
      }
      .icon-header {
        width: 80px;
        height: 80px;
        background: #eff6ff;
        color: #3b82f6;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 20px;
      }
      
      .similarity-limit {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 15px 35px;
        border-radius: 50px;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 25px auto 40px;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
      }
      
      .steps-container {
        text-align: left;
        margin-top: 20px;
        padding-top: 35px;
        border-top: 1px solid #e2e8f0;
      }
      .steps-container h3 {
        color: #1e293b;
        margin-bottom: 25px;
        font-size: 1.4rem;
        font-weight: 700;
      }
      .step-item {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        background: #f8fafc;
        padding: 20px 25px;
        border-radius: 16px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
      }
      .step-item:hover {
        transform: translateX(5px);
        background: white;
        border-color: #3b82f6;
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.08);
      }
      .step-number {
        background: #eff6ff;
        color: #3b82f6;
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.25rem;
        flex-shrink: 0;
      }
      .step-text {
        color: #475569;
        font-size: 1.05rem;
        line-height: 1.6;
        align-self: center;
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
          <div class="icon-header"><i class="fas fa-file-shield"></i></div>
          <h2>Academic Integrity Policy</h2>
          <p style="color: #64748b; margin-top: 15px; text-align: center; font-size: 1.1rem;">The maximum allowed similarity index for final projects, theses, and research papers at JIU is:</p>
          
          <div style="text-align: center;">
            <div class="similarity-limit">
              <i class="fas fa-percentage"></i> Maximum 24% Similarity
            </div>
          </div>
          
          <div class="steps-container">
            <h3>How to check your document:</h3>
            <div class="step-item">
              <div class="step-number">1</div>
              <div class="step-text">Save your document in <strong>PDF or DOCX</strong> format. Make sure to remove the bibliography/references list to avoid false positives.</div>
            </div>
            <div class="step-item">
              <div class="step-number">2</div>
              <div class="step-text">Email your document to <strong style="color:#3b82f6;">sena44@jiu.ac</strong> with the subject: <br><em>Turnitin Check - [Your Student ID]</em>.</div>
            </div>
            <div class="step-item">
              <div class="step-number">3</div>
              <div class="step-text">Wait <strong>1-2 working days</strong>. The library will reply with the complete Turnitin Similarity Report PDF.</div>
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
