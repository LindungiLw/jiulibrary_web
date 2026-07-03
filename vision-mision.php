<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vision & Mission - Dream Blue Library</title>
    
    <!-- Preload Critical Fonts -->
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Vision & Mission - Dream Blue Library" />
    <meta property="og:description" content="The foundation and future of Dream Blue Library" />
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
    <link rel="stylesheet" href="assets/css/about.css?v=2.4" />
    <link rel="stylesheet" href="assets/css/vision-mision.css?v=1.6" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
  </head>
  <body>
    <?php include 'navbar.php'; ?>

    <header class="about-header vm-header-v2">
      <!-- Curved Watermark Text via SVG -->
      <svg class="vm-watermark" viewBox="0 0 1000 200" preserveAspectRatio="xMidYMid meet">
        <path id="text-curve" d="M 50 160 Q 500 20 950 160" fill="transparent" />
        <text font-family="'Poppins', sans-serif" font-weight="900" font-size="80" fill="rgba(255,255,255,0.06)" letter-spacing="0.1em"><textPath href="#text-curve" startOffset="50%" text-anchor="middle">VISION &amp; MISSION</textPath></text>
      </svg>
      
      <div class="container">
        <h1 data-aos="fade-up" data-i18n="hdrVisionTitle">Core Values & Strategy</h1>
        <p data-aos="fade-up" data-aos-delay="100" data-i18n="hdrVisionDesc" style="margin-top: 10px; font-size: 1.1rem; opacity: 0.9">
          The foundation and future of Dream Blue Library
        </p>
      </div>
    </header>

    <section class="vm-section">
      <div class="container">
        <div class="grid-2 align-items-stretch mb-50">
          <div class="vision-box typographic" data-aos="fade-right">
            <h2>Vision</h2>
            <p>
              "A beacon of global literacy that embodies the harmony between faith,
              knowledge, and service to transform the world."
            </p>
          </div>

          <div class="core-box no-margin" data-aos="fade-left">
            <h2 class="box-title"><i class="fas fa-bullseye"></i> Mission</h2>
          <ul class="custom-list">
            <li>
              To integrate faith-based and scientific literacy resources to
              fortify the spiritual and intellectual foundations of the
              community.
            </li>
            <li>
              To provide access to relevant information and technology in
              support of global-oriented education, research, and community
              service.
            </li>
            <li>
              To develop library services rooted in love, integrity, and
              faithfulness as a reflection of excellent service standards for
              the glory of God and the well-being of others.
            </li>
            <li>
              To facilitate spaces for discussion, collaboration, and creativity
              that advance library development and generate a transformative
              impact on society.
            </li>
          </ul>
          </div>
        </div>

        <div class="grid-2">
          <div class="core-box" data-aos="fade-right">
            <h2 class="box-title">
              <i class="fas fa-flag-checkered"></i> Goals
            </h2>
            <ul class="custom-list">
              <li>
                To cultivate the character of library users through a literacy
                environment that focuses on both academic excellence and
                spiritual growth.
              </li>
              <li>
                To support the implementation of the Tri Dharma (the Three
                Pillars of Higher Education) to ensure the fulfillment of the
                university's overarching goals.
              </li>
              <li>
                To deliver superior literacy services by integrating National
                Standards for Academic Libraries with the university's core
                values.
              </li>
              <li>
                To establish the library as the primary hub for the academic
                community to express their creativity and produce works that
                benefit society at large.
              </li>
            </ul>
          </div>

          <div class="core-box target-box" data-aos="fade-left">
            <h2 class="box-title"><i class="fas fa-chart-line"></i> Targets</h2>
            <ul class="custom-list">
              <li>
                By 2026, achieve a 'B' Accreditation from the National Library
                of Indonesia (Perpusnas).
              </li>
              <li>
                By 2028, ensure a user satisfaction rate exceeding 90% through
                innovative, appreciative, and reformative library services and
                programs.
              </li>
              <li>
                By 2032, establish a dedicated and independent library building.
              </li>
            </ul>
          </div>
        </div>

        <div class="strategy-section">
          <h2 class="section-heading" data-aos="fade-up">Strategic Plan</h2>

          <div class="strategy-grid">
            <div class="strategy-card" data-aos="fade-up" data-aos-delay="100">
              <h3>Mission 1 & 2</h3>
              <ul class="custom-list small-list">
                <li>
                  To conduct consistent library collection procurement with a
                  targeted annual growth rate of 5%.
                </li>
                <li>
                  Advanced User Training: To organize advanced information
                  literacy guidance for users at least once a year.
                </li>
                <li>
                  Inventory Management: To perform regular stock-taking
                  (collection auditing) at least once every two years to ensure
                  resource accuracy.
                </li>
                <li>
                  Value-Added Services: To provide specialized services,
                  including research consultations, Turnitin plagiarism checks,
                  and a dedicated "Healing Corner" for student well-being.
                </li>
              </ul>
            </div>

            <div class="strategy-card" data-aos="fade-up" data-aos-delay="200">
              <h3>Mission 3</h3>
              <ul class="custom-list small-list">
                <li>
                  To implement the National Standards for Libraries (SNP of
                  University) as the primary framework for library management
                  and services (Quality Manuals, SOPs).
                </li>
                <li>
                  To conduct annual user satisfaction surveys and provide
                  suggestion boxes as essential benchmarks for library
                  evaluation.
                </li>
                <li>
                  To pursue and maintain official library accreditation to
                  ensure institutional excellence.
                </li>
              </ul>
            </div>

            <div class="strategy-card" data-aos="fade-up" data-aos-delay="300">
              <h3>Mission 4</h3>
              <ul class="custom-list small-list">
                <li>
                  To establish and foster professional collaborations with other
                  libraries and external institutions to expand resource sharing
                  and networking.
                </li>
                <li>
                  To appoint a 'Best Member' and 'Reading Ambassador' every
                  semester to encourage a vibrant reading culture and active
                  library participation.
                </li>
                <li>
                  To develop and host at least one annual program or workshop
                  designed to sharpen the creativity and expressive skills of
                  library users.
                </li>
                <li>
                  To conduct periodic upgrades of library facilities and
                  infrastructure to ensure a modern, comfortable, and
                  world-class learning environment.
                </li>
                <li>
                  To develop community service programs (reading corner for
                  public, visit small library, visit school).
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include 'footer.php'; ?>
    
    <!-- BlueBot & A11y Widgets -->
    <?php include 'chatbot-widget.php'; ?>
    <?php include 'a11y-widget.php'; ?>

    <!-- Scripts -->
    <script>
      window.BASE_URL = "<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>";
    </script>
    <script defer src="assets/js/dictionary.js?v=1.4"></script>
    <script defer src="assets/js/main.js?v=2.2"></script>
    <script defer src="assets/js/chatbot.js?v=1.8"></script>
  </body>
</html>
