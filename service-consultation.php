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
        background: linear-gradient(to bottom, rgba(30, 58, 138, 0.95) 0%, rgba(59, 130, 246, 0.2) 100%),
                    url('assets/images/services-photo/consultation.png');
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
      
      .service-content { padding: 60px 0; }
      
      .consultation-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 30px;
      }
      .booking-section {
        width: 100%;
        max-width: 600px;
        background: white;
        padding: 50px 40px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        border: 1px solid rgba(59, 130, 246, 0.1);
      }
      .booking-section h2 { margin-bottom: 15px; color: #0f172a; text-align: center; font-size: 2.2rem; font-weight: 800; }
      .booking-section p.subtitle { color: #64748b; margin-bottom: 40px; text-align: center; line-height: 1.6; font-size: 1.1rem; }
      
      .contact-buttons {
        display: flex;
        flex-direction: column;
        gap: 20px;
      }
      .btn-contact {
        display: flex;
        align-items: center;
        gap: 20px;
        width: 100%;
        background: white;
        color: #1e3a8a;
        padding: 15px 25px;
        border-radius: 16px;
        border: 2px solid #e2e8f0;
        font-size: 1.15rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
      }
      .btn-contact .icon-wrapper {
        width: 50px;
        height: 50px;
        background: #eff6ff;
        color: #3b82f6;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        transition: all 0.3s ease;
      }
      .btn-contact:hover {
        transform: translateY(-4px);
        border-color: #3b82f6;
        box-shadow: 0 15px 30px rgba(59, 130, 246, 0.12);
        color: #3b82f6;
      }
      .btn-contact:hover .icon-wrapper {
        background: #3b82f6;
        color: white;
      }
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
          <div class="booking-section">
            <h2>Book a Session</h2>
            <p class="subtitle">Schedule a 30-minute 1-on-1 session with our librarians. Reach out to us via any of the channels below:</p>
            
            <div class="contact-buttons">
              <a href="mailto:sena44@jiu.ac?subject=Research Consultation Request" class="btn-contact">
                <div class="icon-wrapper"><i class="fas fa-envelope"></i></div> 
                Email (sena44@jiu.ac)
              </a>
              <a href="https://chat.google.com/" target="_blank" class="btn-contact">
                <div class="icon-wrapper"><i class="fas fa-comments"></i></div> 
                Google Chat (sena44@jiu.ac)
              </a>
              <a href="https://wa.me/6281260173697" target="_blank" class="btn-contact">
                <div class="icon-wrapper"><i class="fab fa-whatsapp"></i></div> 
                WhatsApp (+62 812-6017-3697)
              </a>
            </div>
            
            <p style="text-align: center; margin-top: 35px; font-size: 0.95rem; color: #94a3b8;"><i class="fas fa-info-circle"></i> Please book at least 2 days in advance.</p>
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
