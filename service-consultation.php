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
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.5" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.2" />
    
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
        padding: 30px 25px;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.05);
        border: 1px solid rgba(59, 130, 246, 0.1);
      }
      .booking-section h2 { margin-bottom: 10px; color: #0f172a; text-align: center; font-size: 1.8rem; font-weight: 800; }
      .booking-section p.subtitle { color: #64748b; margin-bottom: 25px; text-align: center; line-height: 1.5; font-size: 1rem; }
      
      .contact-buttons {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
      }
      .btn-contact {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 250px;
        background: white;
        padding: 10px 15px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
      }
      .btn-contact span {
        color: #1e3a8a;
        transition: all 0.3s ease;
      }
      .btn-contact .icon-wrapper {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: all 0.3s ease;
      }
      .btn-contact:hover {
        transform: translateY(-4px);
      }
      
      /* Email Button Colors */
      .btn-email .icon-wrapper { background: #fce8e6; color: #ea4335; }
      .btn-email:hover { border-color: #ea4335; box-shadow: 0 15px 30px rgba(234, 67, 53, 0.12); }
      .btn-email:hover .icon-wrapper { background: #ea4335; color: white; }
      .btn-email:hover span { color: #ea4335; }

      /* Google Chat Button Colors */
      .btn-gchat .icon-wrapper { background: #e6f4ea; color: #0f9d58; }
      .btn-gchat:hover { border-color: #0f9d58; box-shadow: 0 15px 30px rgba(15, 157, 88, 0.12); }
      .btn-gchat:hover .icon-wrapper { background: #0f9d58; color: white; }
      .btn-gchat:hover span { color: #0f9d58; }

      /* WhatsApp Button Colors */
      .btn-wa .icon-wrapper { background: #eafbf0; color: #25d366; }
      .btn-wa:hover { border-color: #25d366; box-shadow: 0 15px 30px rgba(37, 211, 102, 0.12); }
      .btn-wa:hover .icon-wrapper { background: #25d366; color: white; }
      .btn-wa:hover span { color: #25d366; }
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
            <p class="subtitle">Reach out to us via any of the channels below:</p>
            
            <div class="contact-buttons">
              <a href="https://mail.google.com/mail/?view=cm&fs=1&to=sena44@jiu.ac&su=Research%20Consultation%20Request" target="_blank" class="btn-contact btn-email">
                <div class="icon-wrapper"><i class="fas fa-envelope"></i></div> 
                <span>Email</span>
              </a>
              <a href="https://chat.google.com/" target="_blank" class="btn-contact btn-gchat">
                <div class="icon-wrapper"><i class="fas fa-comments"></i></div> 
                <span>Google Chat</span>
              </a>
              <a href="https://wa.me/6281260173697" target="_blank" class="btn-contact btn-wa">
                <div class="icon-wrapper"><i class="fab fa-whatsapp"></i></div> 
                <span>WhatsApp</span>
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
    <script defer src="assets/js/dictionary.js?v=1.4"></script>
    <script defer src="assets/js/main.js?v=2.2"></script>
    <script defer src="assets/js/chatbot.js?v=1.8"></script>
  </body>
</html>
