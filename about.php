<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>History - Dream Blue Library</title>
    
    <!-- Preload Critical Fonts -->
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="History - Dream Blue Library" />
    <meta property="og:description" content="Discover the milestones and journey of Dream Blue Library." />
    <meta property="og:image" content="assets/images/library-logo.webp" />
    <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />

    <link rel="stylesheet" href="assets/css/fonts.css" />
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
    
    <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.1" />
    <link rel="stylesheet" href="assets/css/about.css?v=2.4" />
    
    <!-- Google Identity Services untuk SSO -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="about-header">
      <div class="container">
        <h1>History of the Library</h1>
        <div class="npp-badge">NPP: 3216202D0000001</div>
      </div>
    </header>

    <section class="narrative-section">
      <div class="container">
        <div class="about-grid">
          
          <div class="about-image-wrapper" data-aos="fade-right">
             <img src="assets/images/milestone.webp" alt="Dream Blue Library Milestone" class="about-featured-img">
             <div class="about-experience-badge">
               <span class="years">2006</span>
               <span class="text">The Journey<br>Begins</span>
             </div>
          </div>
          
          <div class="narrative-content" data-aos="fade-left">
            <h2 class="narrative-title">Our Beginnings</h2>
            
            <p class="lead-text">
              The history of the establishment of the Jakarta International University library is certainly inseparable from the background of the establishment of the parent institution. 
            </p>
            
            <p>
              The year 2006 marked the beginning of the planning and preparation for the establishment of Jakarta International University in conjunction with the Duranno Indonesia Foundation. Land measuring 50,000 m2 was purchased in 2008 in the Deltamas area.
            </p>
            
            <p>
              Through collaboration between architects from Korea and the United States, the design of the future campus was completed in 2014 and the main JIU building was finished in March 2017. The first batch of students began registering in 2018 with complete supporting learning facilities already in place.
            </p>
            
            <div class="highlight-box">
              <p>In June 2022, the struggle of all parties resulted in the official merger into Jakarta International University in Bekasi Regency, West Java Province.</p>
            </div>
            
            <p>
              Starting from the Rector's Decrees in August 2022, the registration process resulted in a library registration number (NPP) assigned by the National Library of the Republic of Indonesia with <strong>NPP: 3216202D0000001</strong>. Supported by The Nissi Group and the Dream Blue Foundation, it is now proudly known as the <strong>"Dream Blue Library"</strong>.
            </p>
          </div>
          
        </div>
      </div>
    </section>

    <section class="timeline-section">
      <div class="container">
        <div class="section-title" data-aos="fade-up"><h2>Milestone Journey</h2></div>
        
        <div class="horizontal-timeline">
          <div class="timeline-node" data-aos="zoom-in" data-aos-delay="100">
            <div class="node-desc node-up">
              <h4>Planning</h4>
              2006: Preparation with Duranno.
            </div>
            <div class="node-circle">2006</div>
          </div>
          <div class="timeline-node" data-aos="zoom-in" data-aos-delay="200">
            <div class="node-circle">2014</div>
            <div class="node-desc node-down">
              <h4>Design</h4>
              Campus design finalized.
            </div>
          </div>
          <div class="timeline-node" data-aos="zoom-in" data-aos-delay="300">
            <div class="node-desc node-up">
              <h4>Building</h4>
              2017: Main JIU building finished.
            </div>
            <div class="node-circle">2017</div>
          </div>
          <div class="timeline-node" data-aos="zoom-in" data-aos-delay="400">
            <div class="node-circle">2022</div>
            <div class="node-desc node-down">
              <h4>Status</h4>
              Official University status.
            </div>
          </div>
          <div class="timeline-node" data-aos="zoom-in" data-aos-delay="500">
            <div class="node-desc node-up">
              <h4>NPP</h4>
              Registered NPP: 3216202D0000001.
            </div>
            <div class="node-circle">2022</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Hapus back button custom lama agar tidak berantakan dengan footer utama -->

    <?php include 'footer.php'; ?>
    
    <!-- BlueBot & A11y Widgets -->
    <?php include 'chatbot-widget.php'; ?>
    <?php include 'a11y-widget.php'; ?>

    <!-- Scripts -->
    <script>
      window.BASE_URL = "<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>";
    </script>
    <script defer src="assets/js/dictionary.js?v=1.3"></script>
    <script defer src="assets/js/main.js?v=2.2"></script>
    <script defer src="assets/js/chatbot.js?v=1.8"></script>
  </body>
</html>
