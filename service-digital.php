<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Digital Collection  Dream Blue Library</title>
    
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
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.4" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.2" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <style>
      .service-hero {
        position: relative;
        background: linear-gradient(to bottom, rgba(30, 58, 138, 0.95) 0%, rgba(59, 130, 246, 0.2) 100%),
                    url('assets/images/services-photo/digital_collections.png');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 140px 0 80px;
        text-align: center;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
        overflow: hidden;
      }
      .service-hero::before {
        content: '';
        position: absolute;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.15) 0%, transparent 50%);
        animation: rotateBg 20s linear infinite;
      }
      @keyframes rotateBg {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }
      .service-hero-content {
        position: relative;
        z-index: 2;
      }
      .service-hero h1 { 
        font-size: 3rem; 
        font-weight: 800;
        margin-bottom: 20px; 
        background: linear-gradient(to right, #ffffff, #93c5fd);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      .service-hero p { 
        font-size: 1.15rem; 
        opacity: 0.9; 
        max-width: 650px; 
        margin: 0 auto; 
        line-height: 1.7;
      }
      
      .service-content {
        padding: 30px 0 80px;
        background-color: #f8fafc;
        position: relative;
        overflow: hidden;
      }
      .section-title {
        text-align: center;
        width: 100%;
      }
      .section-title h2 {
        font-size: 2.2rem;
        color: #1e293b;
        font-weight: 700;
        margin-bottom: 40px;
        position: relative;
        display: inline-block;
      }
      .section-title h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: #3b82f6;
        border-radius: 2px;
      }

      .premium-guide-wrapper {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: 0 auto;
        padding: 10px 20px 40px;
      }
      .guide-intro { margin-bottom: 60px; text-align: center; }
      .guide-intro h3 { font-size: 2.2rem; color: #0f172a; font-weight: 800; margin-bottom: 15px; }
      .guide-intro p { color: #475569; font-size: 1.15rem; max-width: 700px; margin: 0 auto; line-height: 1.7; }
      
      .guide-steps-zigzag {
        position: relative;
        max-width: 700px;
        margin: 40px auto 60px;
        padding: 0 20px;
      }
      .step-zz {
        display: flex;
        align-items: center;
        position: relative;
        margin-bottom: 60px;
        z-index: 2;
      }
      .step-zz:last-child {
        margin-bottom: 0;
      }
      
      .step-number-zz {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        position: relative;
        z-index: 3;
      }
      
      .step-content-zz {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        padding: 25px 30px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.6);
        width: calc(100% - 90px); 
        transition: transform 0.3s ease;
      }
      .step-content-zz:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(59, 130, 246, 0.1);
      }
      
      .step-left {
        flex-direction: row;
      }
      .step-left .step-number-zz {
        margin-right: 30px;
      }
      
      .step-right {
        flex-direction: row-reverse;
      }
      .step-right .step-number-zz {
        margin-left: 30px;
      }
      
      /* Connecting Lines */
      .step-left:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 30px; 
        left: 30px; 
        width: calc(100% - 30px);
        height: calc(100% + 60px);
        border-top: 3px dashed #93c5fd;
        border-right: 3px dashed #93c5fd;
        border-top-right-radius: 40px;
        border-bottom-right-radius: 40px;
        z-index: 1;
      }
      .step-right:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 30px; 
        right: 30px; 
        width: calc(100% - 30px);
        height: calc(100% + 60px);
        border-top: 3px dashed #93c5fd;
        border-left: 3px dashed #93c5fd;
        border-top-left-radius: 40px;
        border-bottom-left-radius: 40px;
        z-index: 1;
      }
      
      @media (max-width: 768px) {
        .step-right { flex-direction: row; }
        .step-right .step-number-zz { margin-left: 0; margin-right: 20px; }
        .step-left .step-number-zz { margin-right: 20px; }
        
        .step-content-zz { width: calc(100% - 80px); padding: 20px; }
        
        .step-left:not(:last-child)::after,
        .step-right:not(:last-child)::after {
          left: 30px;
          right: auto;
          width: 0;
          border-right: none;
          border-top: none;
          border-left: 3px dashed #93c5fd;
          border-radius: 0;
        }
      }
      
      .step-content-zz h4 {
        font-size: 1.2rem;
        color: #1e293b;
        margin-bottom: 10px;
        font-weight: 700;
      }
      .step-content-zz p {
        color: #475569;
        font-size: 1.05rem;
        line-height: 1.6;
        margin: 0;
      }
      
      .highlight-link {
        color: #3b82f6;
        font-weight: 600;
        text-decoration: none;
        word-break: break-all;
      }
      .highlight-link:hover { text-decoration: underline; }
      
      .btn-access-large {
        padding: 15px 30px;
        font-size: 1.1rem;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
      }
      .btn-access-large:hover {
        background: #2563eb;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        color: white;
      }
      
      /* Decorative Elements */
      .blob {
        position: absolute;
        filter: blur(60px);
        z-index: 0;
        opacity: 0.4;
        border-radius: 50%;
        animation: floatBlob 10s infinite alternate ease-in-out;
      }
      .blob-1 {
        top: -100px;
        left: -100px;
        width: 400px;
        height: 400px;
        background: #93c5fd;
      }
      .blob-2 {
        bottom: -150px;
        right: -100px;
        width: 500px;
        height: 500px;
        background: #c4b5fd;
        animation-delay: -5s;
      }
      @keyframes floatBlob {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(50px, 50px) scale(1.1); }
      }
    </style>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="service-hero">
      <div class="container service-hero-content">
        <h1>Digital Collection</h1>
        <p>Explore thousands of e-books, e-journals, and digital resources available 24/7 for the JIU academic community.</p>
      </div>
    </header>

    <section class="service-content">
      <div class="blob blob-1"></div>
      <div class="blob blob-2"></div>
      
      <div class="container premium-guide-wrapper">
        <div class="section-title text-center" style="position: relative; z-index: 2;">
          <h2>Digital Library Access Guide</h2>
        </div>
        
        
        <div class="guide-steps-zigzag">
          <!-- Step 1 -->
          <div class="step-zz step-left">
            <div class="step-number-zz">1</div>
            <div class="step-content-zz">
              <h4>Visit the Digital Library Portal</h4>
              <p>Go to the official JIU Digital Library website at <br><a href="https://uijakarta.perpustakaan.co.id/home.ks" target="_blank" class="highlight-link">uijakarta.perpustakaan.co.id/home.ks</a>.</p>
            </div>
          </div>
          
          <!-- Step 2 -->
          <div class="step-zz step-right">
            <div class="step-number-zz">2</div>
            <div class="step-content-zz">
              <h4>Login with JIU Account</h4>
              <p>For your <strong>Username</strong>, you must use your official institutional Google JIU account (e.g. your student or staff email).</p>
            </div>
          </div>
          
          <!-- Step 3 -->
          <div class="step-zz step-left">
            <div class="step-number-zz">3</div>
            <div class="step-content-zz">
              <h4>Obtain Your Password</h4>
              <p>For your <strong>Password</strong>, please ask and confirm directly with the librarian or library staff in charge at the campus circulation desk.</p>
            </div>
          </div>
        </div>
        
        <div class="guide-action text-center" style="margin-top: 50px;">
          <a href="https://uijakarta.perpustakaan.co.id/home.ks" target="_blank" class="btn-access-large">
            Access Digital Library <i class="fas fa-external-link-alt"></i>
          </a>
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
