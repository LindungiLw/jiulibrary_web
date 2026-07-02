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
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.1" />
    
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
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
        max-width: 700px;
        margin: 0 auto;
        border: 1px solid rgba(59, 130, 246, 0.1);
      }
      .turnitin-header-summary {
        text-align: center;
        margin-bottom: 35px;
      }
      .turnitin-header-summary h2 {
        color: #0f172a;
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 10px 0;
        font-family: 'Poppins', sans-serif;
      }
      .highlight-percent {
        color: #2563eb;
      }
      .turnitin-header-summary p {
        color: #64748b;
        font-size: 1rem;
        margin: 0;
      }

      .steps-container {
        text-align: left;
        padding-top: 25px;
        border-top: 1px solid #f1f5f9;
      }
      .steps-container h3 {
        color: #1e293b;
        margin-bottom: 20px;
        font-size: 1.3rem;
        font-weight: 700;
        text-align: center;
      }
      .step-item {
        display: flex;
        gap: 18px;
        margin-bottom: 15px;
        background: white;
        padding: 15px 20px;
        border-radius: 16px;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
      }
      .step-item:hover {
        transform: translateY(-3px);
        border-color: #3b82f6;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.08);
      }
      .step-number {
        background: #f8fafc;
        color: #3b82f6;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
        flex-shrink: 0;
        border: 2px solid #eff6ff;
        transition: all 0.3s ease;
      }
      .step-item:hover .step-number {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
      }
      .step-text {
        color: #475569;
        font-size: 1rem;
        line-height: 1.5;
        align-self: center;
      }
      
      .btn-turnitin-email {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: white;
        color: #3b82f6;
        padding: 10px 20px;
        border-radius: 10px;
        border: 2px solid #3b82f6;
        font-size: 0.95rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        margin-top: 10px;
      }
      .btn-turnitin-email:hover {
        background: #3b82f6;
        color: white;
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.2);
        transform: translateY(-2px);
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
          <div class="turnitin-header-summary">
            <h2>Maximum Similarity Threshold: <span class="highlight-percent">24%</span></h2>
            <p>Applicable for all JIU final projects, theses, and research papers.</p>
          </div>
          
          <div class="steps-container">
            <h3>How to check your document</h3>
            <div class="step-item">
              <div class="step-number">1</div>
              <div class="step-text">Save your document in <strong>PDF or DOCX</strong> format. Make sure to remove the bibliography/references list to avoid false positives.</div>
            </div>
            <div class="step-item">
              <div class="step-number">2</div>
              <div class="step-text">
                Email your document with the subject: <em>Turnitin Check - [Your Student ID]</em>.<br>
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=library@jiu.ac&su=Turnitin%20Check%20-%20%5BYour%20Student%20ID%5D" target="_blank" class="btn-turnitin-email">
                  <i class="fas fa-envelope"></i> Send Email
                </a>
              </div>
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
