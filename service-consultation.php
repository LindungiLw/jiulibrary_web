<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Research Consultation - Dream Blue Library</title>
    
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Research Consultation - Dream Blue Library" />
    <meta property="og:description" content="Get expert research assistance from our professional librarians." />
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
      
      .consultation-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
        margin-top: 30px;
      }
      .topics-section {
        flex: 1;
        min-width: 300px;
      }
      .booking-section {
        flex: 1;
        min-width: 300px;
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      }
      
      .topic-list { list-style: none; padding: 0; }
      .topic-list li {
        margin-bottom: 15px;
        padding: 15px;
        background: #f8fafc;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 15px;
      }
      .topic-list i { color: #f59e0b; font-size: 1.5rem; }
      
      .btn-book {
        display: block;
        width: 100%;
        background: #f59e0b;
        color: white;
        border: none;
        padding: 15px;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        text-align: center;
        text-decoration: none;
      }
      .btn-book:hover { background: #d97706; }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="service-header">
      <div class="container">
        <h1>Research Consultation</h1>
        <p>Stuck on your thesis or research paper? Our expert librarians are here to guide you through the process.</p>
      </div>
    </header>

    <section class="service-content">
      <div class="container">
        <div class="consultation-wrapper">
          <div class="topics-section">
            <h2 style="margin-bottom: 20px; color: #1e293b;">How We Can Help</h2>
            <ul class="topic-list">
              <li>
                <i class="fas fa-search"></i>
                <div>
                  <strong>Literature Search Strategies</strong><br>
                  <small>Learn how to effectively find relevant papers in academic databases.</small>
                </div>
              </li>
              <li>
                <i class="fas fa-quote-right"></i>
                <div>
                  <strong>Citation & Mendeley</strong><br>
                  <small>Assistance with reference management and proper citation formatting.</small>
                </div>
              </li>
              <li>
                <i class="fas fa-file-contract"></i>
                <div>
                  <strong>Academic Integrity</strong><br>
                  <small>Guidance on paraphrasing and avoiding accidental plagiarism.</small>
                </div>
              </li>
            </ul>
          </div>
          
          <div class="booking-section">
            <h2 style="margin-bottom: 20px; color: #1e293b; text-align: center;">Book a Session</h2>
            <p style="color: #64748b; margin-bottom: 25px; text-align: center;">Schedule a 30-minute 1-on-1 session with our librarians (Online via Google Meet or Offline at the library).</p>
            
            <a href="mailto:admin@jiulibrary.ac?subject=Research Consultation Request" class="btn-book">
              <i class="fas fa-calendar-check"></i> Email to Book a Schedule
            </a>
            <p style="text-align: center; margin-top: 15px; font-size: 0.85rem; color: #94a3b8;">*Please book at least 2 days in advance.</p>
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
