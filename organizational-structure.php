<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Organization - Dream Blue Library</title>
    
    <!-- Preload Critical Fonts -->
    <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

    <meta property="og:title" content="Organization - Dream Blue Library" />
    <meta property="og:description" content="Our Professional Management Team" />
    <meta property="og:image" content="assets/images/library-logo.webp" />
    <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />

    <link rel="stylesheet" href="assets/css/fonts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
    <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
    <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
    <link rel="stylesheet" href="assets/css/responsive.css?v=3.0" />
    <link rel="stylesheet" href="assets/css/about.css?v=2.4" />
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
  </head>

  <body>
    <?php include 'navbar.php'; ?>

    <header class="about-header">
      <div class="container">
        <h1>Library Organization</h1>
        <p style="margin-top: 10px; font-size: 1.1rem; opacity: 0.9">Our Professional Management Team</p>
      </div>
    </header>

    <section class="org-section">
      <div class="container" style="overflow-x: auto">
        <div class="custom-tree-layout">
          <div class="ct-row">
            <div class="org-box box-rector">
              <span class="role">Rector</span>
              <span class="name">Dr. Agus Hartadi, S.E., M.A.</span>
            </div>
          </div>

          <div class="ct-line-v"></div>

          <div class="ct-row ct-middle-row">
            <div class="org-box box-builder">
              <span class="role">Library Builder I</span>
              <span class="name">Oh Jin Park</span>
            </div>

            <div class="ct-arrow-right"></div>

            <div class="ct-col">
              <div class="org-box box-head">
                <span class="role">Head of Library</span>
                <span class="name">Sena Afrina Simbolon, S.S.I.</span>
              </div>
              <div class="ct-line-v"></div>
            </div>

            <div class="ct-arrow-left"></div>

            <div class="org-box box-builder">
              <span class="role">Library Builder II</span>
              <span class="name">Dr. Yustinus Yuniarto, S.S., M.M.</span>
            </div>
          </div>

          <div class="ct-line-h" style="width: 282px"></div>
          <div class="ct-row" style="width: 282px; justify-content: space-between">
            <div class="ct-arrow-down"></div>
            <div class="ct-arrow-down"></div>
          </div>

          <div class="ct-row" style="gap: 40px">
            <div class="org-box box-librarian">
              <span class="role">Librarian I</span>
              <span class="name">Yemima Atania Surbakti, S.S.I.</span>
            </div>
            <div class="org-box box-librarian">
              <span class="role">Librarian II</span>
              <span class="name">Natalia Cristauli Br. Lubis, S.S.I.</span>
            </div>
          </div>

          <div class="ct-row" style="width: 282px; justify-content: space-between">
            <div class="ct-line-v"></div>
            <div class="ct-line-v"></div>
          </div>

          <div class="ct-line-h" style="width: 282px"></div>
          <div class="ct-line-v"></div>
          <div class="ct-line-h" style="width: 522px"></div>

          <div class="ct-row" style="width: 522px; justify-content: space-between">
            <div class="ct-arrow-down"></div>
            <div class="ct-arrow-down"></div>
            <div class="ct-arrow-down"></div>
          </div>

          <div class="ct-row" style="gap: 20px">
            <div class="org-box box-service">
              <span class="role" style="color: white; line-height: 1.4">
                Student Service 1<br />
                <span style="font-size: 0.85em; font-weight: 400">(Teknis dan Administratif)</span>
              </span>
            </div>
            <div class="org-box box-service">
              <span class="role" style="color: white; line-height: 1.4">
                Student Service 2<br />
                <span style="font-size: 0.85em; font-weight: 400">(Teknis dan Web)</span>
              </span>
            </div>
            <div class="org-box box-service">
              <span class="role" style="color: white; line-height: 1.4">
                Student Service 3<br />
                <span style="font-size: 0.85em; font-weight: 400">(Promosi dan Sosmed)</span>
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="team-profile-section">
      <div class="container">
        <div class="section-title">
          <h2>Librarian Profiles</h2>
          <p style="color: #64748b; font-size: 1.1rem">Get in touch with our professional library staff</p>
        </div>

        <div class="librarian-grid">
          <div class="librarian-card">
            <div class="lib-img-box">
              <img src="https://ui-avatars.com/api/?name=Sena+Afrina&background=60a5fa&color=fff&size=200" alt="Sena Afrina" class="lib-img" />
            </div>
            <div class="lib-details">
              <div class="lib-row">
                <span class="lib-label">Name</span>
                <span class="lib-value">Sena Afrina Simbolon, S.S.I.</span>
              </div>
              <div class="lib-row">
                <span class="lib-label">Position</span>
                <span class="lib-value">Head of Library</span>
              </div>
              <div class="lib-row">
                <span class="lib-label">Email</span>
                <span class="lib-value">sena44@k-eduplex.net</span>
              </div>
            </div>
          </div>

          <div class="librarian-card">
            <div class="lib-img-box">
              <img src="https://ui-avatars.com/api/?name=Yemima+Atania&background=4ade80&color=fff&size=200" alt="Yemima Atania" class="lib-img" />
            </div>
            <div class="lib-details">
              <div class="lib-row">
                <span class="lib-label">Name</span>
                <span class="lib-value">Yemima Atania Surbakti, S.S.I.</span>
              </div>
              <div class="lib-row">
                <span class="lib-label">Position</span>
                <span class="lib-value">Librarian I</span>
              </div>
              <div class="lib-row">
                <span class="lib-label">Email</span>
                <span class="lib-value">yemimasurbakti@jiu.ac</span>
              </div>
            </div>
          </div>

          <div class="librarian-card">
            <div class="lib-img-box">
              <img src="https://ui-avatars.com/api/?name=Natalia+Cristauli&background=4ade80&color=fff&size=200" alt="Natalia Cristauli" class="lib-img" />
            </div>
            <div class="lib-details">
              <div class="lib-row">
                <span class="lib-label">Name</span>
                <span class="lib-value">Natalia Cristauli Br. Lubis, S.S.I.</span>
              </div>
              <div class="lib-row">
                <span class="lib-label">Position</span>
                <span class="lib-value">Librarian II</span>
              </div>
              <div class="lib-row">
                <span class="lib-label">Email</span>
                <span class="lib-value">natalialubis@jiu.ac</span>
              </div>
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
    <script defer src="assets/js/dictionary.js?v=1.3"></script>
    <script defer src="assets/js/main.js?v=2.0"></script>
    <script defer src="assets/js/chatbot.js?v=1.8"></script>
  </body>
</html>
