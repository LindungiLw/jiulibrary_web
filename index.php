<?php
session_start();
require_once 'config.php';
require_once 'koneksi.php';

$koneksi = getKoneksi();

$query_pengumuman = $koneksi->query("SELECT * FROM pengumuman ORDER BY id DESC LIMIT 5");
$query_berita = $koneksi->query("SELECT * FROM berita ORDER BY id DESC LIMIT 5");

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dream Blue Library - Jakarta International University</title>
  <link rel="icon" type="image/webp" href="assets/images/library-logo.webp" />
  
  <!-- Preload Critical Images for LCP Optimization -->
  <link rel="preload" as="image" href="assets/images/image.webp" fetchpriority="high">
  <link rel="preload" as="image" href="assets/images/library-logo.webp" fetchpriority="high">

  <!-- Preload Critical Fonts -->
  <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>
  
  <link rel="stylesheet" href="assets/css/fonts.css" />
  <link rel="stylesheet" href="assets/css/style/swiper-bundle.min.css" />
  
  <!-- Load FontAwesome Asynchronously (Local) -->
  <link rel="preload" href="assets/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="assets/css/all.min.css"></noscript>
  
  <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"></noscript>

  <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/base.css?v=1.1" />

  <link rel="stylesheet" href="assets/css/navbar.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/hero.css?v=1.1" />

  <link rel="stylesheet" href="assets/css/style/announcements-slider.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/style/news-slider.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/sections.css?v=1.1" />

  <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/responsive.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/chatbot.css?v=1.1" />
  
  <!-- Script Google Identity Services untuk SSO -->
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>

  <?php include 'assets/css/style/background-grafis.php'; ?>

  <header class="site-header">
    <div class="top-bar">
      <div class="top-bar-left">
        <a href="https://drive.google.com/drive/folders/1MHFJwTNO02nxGyUWP_8EJuEr5PfJuPGN" data-i18n="topGuide">Guidelines</a>
      </div>

      <div class="top-bar-right">
        <div class="dropdown">
          <button class="btn-lang-top" onclick="toggleDropdown(event, 'langMenu')">
            <img loading="lazy" src="<?php echo BASE_URL; ?>/assets/images/flags/gb.png" alt="EN" class="real-flag-icon current-flag-img" style="width: 18px; height: 13px; object-fit: cover; border-radius: 2px; box-shadow: 0 1px 2px rgba(0,0,0,0.2);">
            <span class="current-lang-text" style="font-size: 0.8rem; font-weight: 700;">EN</span>
            <i class="fas fa-chevron-down" style="font-size: 0.5rem; margin-left: 2px;"></i>
          </button>

          <div class="dropdown-content compact-dropdown" id="langMenu" style="min-width: 140px; right: 0; left: auto; transform: translateY(10px);">
            <div class="services-grid" style="grid-template-columns: 1fr; gap: 0.2rem;">
              <a href="javascript:void(0)" class="service-item lang-option" onclick="changeLanguage('en', event)">
                <img loading="lazy" src="<?php echo BASE_URL; ?>/assets/images/flags/gb.png" alt="EN" class="real-flag-icon" style="width: 20px; height: 15px; border-radius: 2px;">
                <span class="lang-name">English</span>
              </a>
              <a href="javascript:void(0)" class="service-item lang-option" onclick="changeLanguage('id', event)">
                <img loading="lazy" src="<?php echo BASE_URL; ?>/assets/images/flags/id.png" alt="ID" class="real-flag-icon" style="width: 20px; height: 15px; border-radius: 2px;">
                <span class="lang-name">Indonesia</span>
              </a>
            </div>
          </div>
        </div>

        <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == "login"): 
          $firstName = explode(' ', trim($_SESSION['user_name']))[0];
        ?>
          <div class="dropdown">
            <button class="btn-login-top" onclick="toggleDropdown(event, 'userMenu')" style="height: 24px; box-sizing: border-box; display: flex; align-items: center; gap: 6px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.4); border-radius: 4px; color: white; padding: 2px 8px; cursor: pointer; transition: background 0.3s;">
            <?php 
              $avatar_url = isset($_SESSION['user_picture']) && $_SESSION['user_picture'] !== 'assets/images/default-avatar.png' ? $_SESSION['user_picture'] : 'https://ui-avatars.com/api/?name=' . urlencode($firstName) . '&background=f8fafc&color=475569&rounded=true';
            ?>
            <img loading="lazy" src="<?php echo $avatar_url; ?>" alt="Profile" style="width: 16px; height: 16px; border-radius: 50%; object-fit: cover;">
              <span style="font-weight: 600; font-size: 0.8rem;"><?php echo htmlspecialchars($firstName); ?></span>
              <i class="fas fa-chevron-down" style="font-size: 0.5rem; color: #64748b;"></i>
            </button>
            <div class="dropdown-content compact-dropdown" id="userMenu" style="min-width: 140px; right: 0; left: auto; transform: translateY(10px);">
              <div class="simple-vertical-menu">
                <a href="profile.php" class="service-item" style="font-weight: 500;" data-i18n="btnProfile">
                  <i class="far fa-id-badge"></i> My Profile
                </a>
                <div class="dropdown-divider" style="height: 1px; background: #f1f5f9; margin: 5px 15px;"></div>
                <a href="<?= BASE_URL ?>/assets/auth/logout.php" class="service-item" style="color: #ef4444; font-weight: 600;" data-i18n="btnLogout">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </div>
            </div>
          </div>
        <?php else: ?>
          <button class="btn-login-top" onclick="openModal('modalLogin')" style="background-color: white; color: #475569; border: 1px solid #e2e8f0; padding: 2px 10px; border-radius: 20px; font-weight: 600; display: flex; align-items: center; gap: 6px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); transition: 0.3s; font-size: 0.8rem; height: 24px; box-sizing: border-box;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="12px" height="12px">
              <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
              <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
              <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
              <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
            </svg>
            <span data-i18n="btnLogin" style="color: #1e293b;">Sign In</span>
          </button>
        <?php endif; ?>
      </div>
    </div>

    <nav class="main-nav">
      <div class="nav-logo">
        <a href="index.php" class="logo">
          <img loading="lazy" src="assets/images/library-logo.webp" alt="JIU Library Logo" style="width: 40px; height: auto; object-fit: contain;" />
          <div class="logo-text">
            Dream Blue Library 
            <span>NPP 3216202D0000001</span>
          </div>
        </a>
      </div>

      <div class="nav-menu-center" id="nav-links">
        <ul class="nav-links-list">
          <li><a href="index.php" data-i18n="navHome">Home</a></li>

          <li>
            <div class="dropdown">
              <button class="dropbtn" onclick="toggleDropdown(event, 'collectionMenu')">
                <span data-i18n="navCollection">Collection</span> <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px"></i>
              </button>
              <div class="dropdown-content auto-width-dropdown" id="collectionMenu">
                <div class="simple-vertical-menu">
                  <a href="http://lib.jiu.ac/" class="service-item" data-i18n="colOpac">OPAC (Catalog)</a>
                  <a href="https://uijakarta.perpustakaan.co.id/home.ks" class="service-item" data-i18n="colDigital">Digital Library</a>

                  <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == "login"): ?>
                    <?php if ($_SESSION['user_role'] == 'JIU Member'): ?>
                      <a href="https://drive.google.com/drive/folders/1KMCkxdgPSOMMBdWr_BnM8475t3VP6OG4" class="service-item" data-i18n="colJournal">Journal Reference</a>
                      <a href="https://drive.google.com/drive/folders/1Mgq_euWpGEavBQ5dxE6cH8CKX74NfV61" class="service-item" data-i18n="colRepo">Repository</a>
                      <a href="https://docs.google.com/spreadsheets/d/1PppbqbFnpDUUjIkUJUPPEaHwfisXSx-4Ei3fe4j8IUk/edit?gid=427307104#gid=427307104" class="service-item" data-i18n="colDvd">DVD's Collection</a>
                    <?php else: ?>
                      <a href="javascript:alert('Access Denied: Only JIU Members can access this collection.')" class="service-item" data-i18n="colJournal">Journal Reference</a>
                      <a href="javascript:alert('Access Denied: Only JIU Members can access this collection.')" class="service-item" data-i18n="colRepo">Repository</a>
                      <a href="javascript:alert('Access Denied: Only JIU Members can access this collection.')" class="service-item" data-i18n="colDvd">DVD's Collection</a>
                    <?php endif; ?>
                  <?php else: ?>
                    <a href="javascript:void(0)" onclick="openModal('modalLogin')" class="service-item" data-i18n="colJournal">Journal Reference</a>
                    <a href="javascript:void(0)" onclick="openModal('modalLogin')" class="service-item" data-i18n="colRepo">Repository</a>
                    <a href="javascript:void(0)" onclick="openModal('modalLogin')" class="service-item" data-i18n="colDvd">DVD's Collection</a>
                  <?php endif; ?>

                  <a href="healingcorner.html" class="service-item" data-i18n="colHealing">Healing Corner</a>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="dropdown">
              <button class="dropbtn" onclick="toggleDropdown(event, 'servicesMenu')">
                <span data-i18n="navServices">Services</span> <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px"></i>
              </button>

              <div class="dropdown-content auto-width-dropdown" id="servicesMenu">
                <div class="simple-vertical-menu">
                  <div class="nested-dropdown">
                    <div class="service-item nested-trigger" style="cursor: default;">
                      <span data-i18n="srvType">Type of Services</span>
                      <i class="fas fa-chevron-right" style="font-size: 0.7rem; color: #94a3b8;"></i>
                    </div>

                    <div class="nested-content">
                      <div class="service-item-complex">
                        <i class="fas fa-laptop-code" style="color: #3b82f6;"></i>
                        <div>
                          <strong data-i18n="srvDigital">Digital Collection</strong>
                          <span data-i18n="srvDigitalDesc">Online access to e-books and digital resources</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-leaf" style="color: #10b981;"></i>
                        <div>
                          <strong data-i18n="srvHealing">Healing Corner</strong>
                          <span data-i18n="srvHealingDesc">A fun space to relax and refresh your mind</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-book-reader" style="color: #6366f1;"></i>
                        <div>
                          <strong data-i18n="srvCirculation">Circulation</strong>
                          <span data-i18n="srvCirculationDesc">Borrow, renew, and return physical library materials</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-user-tie" style="color: #f59e0b;"></i>
                        <div>
                          <strong data-i18n="srvConsultation">Consultation</strong>
                          <span data-i18n="srvConsultationDesc">Get expert research assistance from librarians</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-check-double" style="color: #ef4444;"></i>
                        <div>
                          <strong data-i18n="srvTurnitin">Turnitin</strong>
                          <span data-i18n="srvTurnitinDesc">Check your work for originality and prevent plagiarism</span>
                        </div>
                      </div>
                      <div class="service-item-complex">
                        <i class="fas fa-print" style="color: #8b5cf6;"></i>
                        <div>
                          <strong data-i18n="srvPrinter">Printer and Scan</strong>
                          <span data-i18n="srvPrinterDesc">Self-service printing, scanning, and copying facilities</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="dropdown-divider" style="height: 1px; background: #f1f5f9; margin: 5px 15px;"></div>

                  <a href="fqa.html" class="service-item">
                    <span data-i18n="srvFAQ">F&Q</span>
                  </a>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="dropdown">
              <button class="dropbtn" onclick="toggleDropdown(event, 'submitMenu')">
                <span data-i18n="navSubmit">Submit</span> <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px"></i>
              </button>
              <div class="dropdown-content auto-width-dropdown" id="submitMenu">
                <div class="simple-vertical-menu">
                  <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == "login"): ?>
                    <?php if ($_SESSION['user_role'] == 'JIU Member'): ?>
                      <a href="https://docs.google.com/forms/d/e/1FAIpQLSequLLEem6oikEgpUQxwsZSQjbN9wMpn-K96_ExIxjjV9mMFg/viewform?usp=sharing&ouid=111410603355060184073" class="service-item" data-i18n="subPaper">Research Paper</a>
                      <a href="https://docs.google.com/forms/d/e/1FAIpQLSfz138cLSHqkzgde63u_6HxphErBC-vvKiaFY5JMkQeQfFLzw/viewform?usp=sharing&ouid=111410603355060184073" class="service-item" data-i18n="subThesis">Thesis</a>
                      <a href="https://docs.google.com/forms/d/e/1FAIpQLSe3blcJpmcKfrIzAv6FzvAQFfeAugnh1Gj79nqQYDH56eHa1g/viewform?usp=sharing&ouid=111410603355060184073" class="service-item" data-i18n="subProject">Final Project</a>
                      <a href="https://docs.google.com/forms/d/e/1FAIpQLSd5YMD97SgI2wSRKuBJ9X6fwxTRuzfm4E7SOa92aCmIql7WVQ/viewform?usp=sharing&ouid=111410603355060184073" class="service-item" data-i18n="subIntern">Internship Report</a>
                      <a href="https://docs.google.com/forms/d/e/1FAIpQLSdijIME3IRl3eK7bGUIwJiSVRisf6zGXSIQR1rSMqhCY4DF0w/viewform" class="service-item" data-i18n="subPortfolio">Portfolio</a>
                    <?php else: ?>
                      <a href="javascript:alert('Access Denied: Only JIU Members can submit documents.')" class="service-item" data-i18n="subPaper">Research Paper</a>
                      <a href="javascript:alert('Access Denied: Only JIU Members can submit documents.')" class="service-item" data-i18n="subThesis">Thesis</a>
                      <a href="javascript:alert('Access Denied: Only JIU Members can submit documents.')" class="service-item" data-i18n="subProject">Final Project</a>
                      <a href="javascript:alert('Access Denied: Only JIU Members can submit documents.')" class="service-item" data-i18n="subIntern">Internship Report</a>
                      <a href="javascript:alert('Access Denied: Only JIU Members can submit documents.')" class="service-item" data-i18n="subPortfolio">Portfolio</a>
                    <?php endif; ?>
                  <?php else: ?>
                    <a href="javascript:void(0)" onclick="openModal('modalLogin')" class="service-item" data-i18n="subPaper">Research Paper</a>
                    <a href="javascript:void(0)" onclick="openModal('modalLogin')" class="service-item" data-i18n="subThesis">Thesis</a>
                    <a href="javascript:void(0)" onclick="openModal('modalLogin')" class="service-item" data-i18n="subProject">Final Project</a>
                    <a href="javascript:void(0)" onclick="openModal('modalLogin')" class="service-item" data-i18n="subIntern">Internship Report</a>
                    <a href="javascript:void(0)" onclick="openModal('modalLogin')" class="service-item" data-i18n="subPortfolio">Portfolio</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </li>

          <li>
            <div class="dropdown">
              <button class="dropbtn" onclick="toggleDropdown(event, 'aboutMenu')">
                <span data-i18n="navAbout">About Us</span> <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px"></i>
              </button>
              <div class="dropdown-content auto-width-dropdown" id="aboutMenu">
                <div class="simple-vertical-menu">
                  <a href="about.html" class="service-item" data-i18n="abtHistory">Brief History</a>
                  <a href="vision-mision.html" class="service-item" data-i18n="abtVision">Vision & Mission</a>
                  <a href="organizational-structure.html" class="service-item" data-i18n="abtStructure">Library Staff</a>
                  <a href="library-map.html" class="service-item" data-i18n="abtMap">Library Map</a>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>

      <div class="nav-actions-right">
        <div class="search-wrapper" id="searchWrapper">
          <input type="text"
            id="navSearchInput"
            placeholder="Search menu..."
            onkeyup="liveSearchHomeNav()">
          <button class="btn-search-icon-only" onclick="toggleNavSearch()">
            <i class="fas fa-search"></i>
          </button>
          <div id="navSearchSuggestions" class="nav-search-results"></div>
        </div>

        <div id="mobile-menu" class="menu-toggle" style="display: none">
          <i class="fas fa-bars"></i>
        </div>
      </div>
    </nav>
  </header>

  <section id="hero-modern" class="hero-full-bg">
    <div class="hero-slider-bg">
      <div class="slide-bg active" style="background-image: url('assets/images/image.webp'); background-size: 100% auto; background-position: center 45%;"></div>
      <div class="slide-bg" style="background-image: url('assets/images/picture1.webp')"></div>
      <div class="slide-bg" style="background-image: url('assets/images/picture2.webp')"></div>
    </div>

    <div class="hero-overlay"></div>

    <div class="hero-content" style="position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%); width: 100%; text-align: center; z-index: 10;">
      <h1 data-aos="fade-up" style="text-align: center; width: 100%;">Dream Blue <span class="highlight-text-yellow">Library</span></h1>
      <p data-aos="fade-up" data-aos-delay="100" style="text-align: center; width: 100%;" data-i18n="heroTagline">Literacy Freely, Legacy Fully</p>
    </div>



    <div id="modalHours" class="modal-hours">
      <div class="modal-content-hours">
        <span class="close-modal" onclick="closeModal('modalHours')">&times;</span>
        <div class="modal-header">
          <i class="fas fa-clock"></i>
          <h3 data-i18n="modHourTitle">Opening Hours</h3>
        </div>
        <div class="schedule-list">
          <div class="day-row">
            <span class="day-name">Mon - Fri</span>
            <span class="day-time">08:00 - 17:00 <br> <small class="mod-hour-break">Break</small> <br> 18:00 - 21:00</span>
          </div>
          <div class="day-row">
            <span class="day-name">Saturday</span>
            <span class="day-time">08:00 - 17:00</span>
          </div>
          <div class="day-row closed">
            <span class="day-name">Sunday</span>
            <span class="day-time" data-i18n="modHourClosed">Closed</span>
          </div>
        </div>
      </div>
    </div>

    <div id="modalCollection" class="modal-hours">
      <div class="modal-content-hours">
        <span class="close-modal" onclick="closeModal('modalCollection')">&times;</span>
        <div class="modal-header">
          <i class="fas fa-book-open"></i>
          <h3 data-i18n="modColTitle">Library Collections</h3>
        </div>
        <div class="collection-stats">
          <p><span id="modColTitlesText">Total Titles:</span> <strong>5642</strong></p>
          <p><span id="modColCopiesText">Total Copies:</span> <strong>6499</strong></p>
        </div>
      </div>
    </div>

    <div id="modalRooms" class="modal-hours">
      <div class="modal-content-hours">
        <span class="close-modal" onclick="closeModal('modalRooms')">&times;</span>
        <div class="modal-header">
          <i class="fas fa-chalkboard-teacher"></i>
          <h3 data-i18n="modRmTitle">Study Rooms Facilities</h3>
          <p style="font-size: 0.8rem; color: #64748b;" data-i18n="modRmSub">Available for JIU Members</p>
        </div>
        <hr>
        <div class="room-list">
          <div class="room-item">
            <div class="room-flex">
              <i class="fas fa-users room-icon"></i>
              <div class="room-info">
                <h4>Study Room 1</h4>
                <p data-i18n="modRmCap1">Capacity: 4-6 People</p>
                <small data-i18n="modRmFac1">Facilities: AC, WiFi, Whiteboard</small>
                <span class="room-tag" data-i18n="modRmTag">On-Site Only</span>
              </div>
            </div>
          </div>
          <div class="room-item">
            <div class="room-flex">
              <i class="fas fa-users room-icon"></i>
              <div class="room-info">
                <h4>Study Room 2</h4>
                <p data-i18n="modRmCap2">Capacity: 4 People</p>
                <small data-i18n="modRmFac2">Facilities: AC, WiFi, Whiteboard</small>
                <span class="room-tag" data-i18n="modRmTag">On-Site Only</span>
              </div>
            </div>
          </div>
          <div class="room-item">
            <div class="room-flex">
              <i class="fas fa-users room-icon"></i>
              <div class="room-info">
                <h4>Study Room 3</h4>
                <p data-i18n="modRmCap2">Capacity: 4 People</p>
                <small data-i18n="modRmFac2">Facilities: AC, WiFi, Whiteboard</small>
                <span class="room-tag" data-i18n="modRmTag">On-Site Only</span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer-note">
          <p><i class="fas fa-info-circle"></i> <strong data-i18n="modRmNoteInfo">Information:</strong> <span data-i18n="modRmNoteText">Room usage is based on a "First Come, First Served" system.</span></p>
        </div>
      </div>
    </div>

    <!-- Modal Login SSO -->
    <div id="modalLogin" class="modal-hours">
      <div class="modal-content-hours modal-login-premium">
        <div class="login-decoration-top"></div>
        <span class="close-modal" onclick="closeModal('modalLogin')">&times;</span>
        
        <div class="modal-login-header">
          <div class="login-logo-wrapper">
            <img src="assets/images/library-logo.webp" alt="Logo">
          </div>
          <h3 data-i18n="modLoginTitle">Welcome Back!</h3>
          <p data-i18n="modLoginDesc">Please log in using your Google account to access digital collections and library services.</p>
        </div>
        
        <?php if (isset($_SESSION['error_msg'])): ?>
          <div class="login-error-box">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo $_SESSION['error_msg']; unset($_SESSION['error_msg']); ?></span>
          </div>
          <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(function() { openModal('modalLogin'); }, 500);
            });
          </script>
        <?php endif; ?>

        <?php 
          $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
          $domain = $_SERVER['HTTP_HOST'];
          $absolute_login_uri = $protocol . $domain . BASE_URL . "/assets/auth/google_auth.php";
        ?>
        <div id="g_id_onload"
           data-client_id="<?php echo GOOGLE_CLIENT_ID; ?>"
           data-context="signin"
           data-ux_mode="popup"
           data-login_uri="<?php echo $absolute_login_uri; ?>"
           data-auto_prompt="true">
        </div>

        <div class="google-btn-wrapper">
          <div class="g_id_signin"
               data-type="standard"
               data-shape="pill"
               data-theme="outline"
               data-text="signin_with"
               data-size="large"
               data-logo_alignment="left"
               data-width="280">
          </div>
        </div>

        <div class="login-footer-info" style="text-align: center; justify-content: center;">
          <span data-i18n="modLoginFooterDesc">Please log in using your institutional Google account. Public email addresses are not permitted.</span>
        </div>
      </div>
    </div>

    <div class="hero-curve">
      <svg class="animated-wave" viewBox="0 0 1440 320" preserveAspectRatio="none">
        <path fill="#f8fafc" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,197.3C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
      </svg>
    </div>
  </section>

  <section id="announcements" class="announcement-section">
    <div class="ann-container">
      <!-- PERTAMINA STYLE STATS SECTION -->
      <div class="pertamina-stats-container" data-aos="fade-up" data-aos-delay="100">
        <div class="p-stat-card" onclick="openModal('modalCollection')" tabindex="0" role="button">
          <p class="p-stat-label">TOTAL COLLECTION</p>
          <h3 class="p-stat-number counter" data-target="5642">0</h3>
          <p class="p-stat-desc">Total books & media collection</p>
        </div>

        <div class="p-stat-card" tabindex="0" role="region">
          <p class="p-stat-label">ACTIVE MEMBERS</p>
          <h3 class="p-stat-number counter" data-target="200">0</h3>
          <p class="p-stat-desc">Registered and active users</p>
        </div>

        <div class="p-stat-card" onclick="openModal('modalRooms')" tabindex="0" role="button">
          <p class="p-stat-label">STUDY ROOMS</p>
          <h3 class="p-stat-number counter" data-target="4">0</h3>
          <p class="p-stat-desc">Available for booking</p>
        </div>
      </div>

      <div class="ann-header-flex">
        <div class="ann-header-left">
          <h2 class="section-title" style="text-align: left;">
            <span data-i18n="annTitlePrefix">Library</span> <span class="highlight-text-yellow" data-i18n="annTitleSuffix">Announcements</span>
          </h2>
        </div>
        <div class="ann-header-right">
          <a href="all-announcements.php" class="btn-view-ann" data-i18n="annBtnViewAll">
            View All Announcements <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="swiper swiper-announcements" style="padding-bottom: 50px;">
        <div class="swiper-wrapper">
          <?php
          if (isset($query_pengumuman) && $query_pengumuman->rowCount() > 0) {
            while ($row = $query_pengumuman->fetch()) {
              $isi_pendek = substr(strip_tags($row['isi']), 0, 50) . '...';
              $tgl = date('d M Y', strtotime($row['tanggal']));
          ?>
              <div class="swiper-slide">
                <a href="detail-announcement.php?id=<?= $row['id'] ?>" class="jiu-ann-card">
                  <img loading="lazy" src="<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>" class="jiu-ann-img" />
                  <div class="jiu-ann-content">
                    <?php if (!empty($row['kategori'])) { ?>
                      <span class="jiu-ann-badge"><?= htmlspecialchars($row['kategori']) ?></span>
                    <?php } ?>
                    <h3 class="jiu-ann-title"><?= htmlspecialchars($row['judul']) ?></h3>
                    <div class="jiu-ann-hidden">
                      <div class="jiu-ann-date"><i class="far fa-calendar-alt"></i> <?= $tgl ?></div>
                      <p class="jiu-ann-desc"><?= $isi_pendek ?></p>
                      <div class="jiu-ann-btn" data-i18n="annBtnDetail">View Detail <i class="fas fa-arrow-right"></i></div>
                    </div>
                  </div>
                </a>
              </div>
          <?php
            }
          } else {
            echo "<div style='width: 100%; text-align: center; color: #cbd5e1; padding: 40px;' data-i18n='annEmpty'>No recent announcements at this time.</div>";
          }
          ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <section id="news" class="bg-blue-section">
    <div class="news-container">
      <div class="news-header-flex">
        <div class="news-header-left">
          <h2 class="section-title" style="color: white; margin-bottom: 0;">
            <span data-i18n="newsTitlePrefix">Library</span> <span class="highlight-text-yellow" style="color: #facc15;" data-i18n="newsTitleSuffix">News & Articles</span>
          </h2>
        </div>
        <div class="news-header-right">
          <a href="all-news.php" class="btn-view-all" style="display: inline-flex; align-items: center; gap: 0.5rem; color: #facc15; border: 2px solid #facc15; padding: 8px 20px; border-radius: 50px; text-decoration: none; font-weight: 600; transition: 0.3s;" data-i18n="newsBtnViewAll">
            View All News <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="swiper swiper-news" style="padding-bottom: 50px; padding-top: 10px;">
        <div class="swiper-wrapper">
          <?php
          if (isset($query_berita) && $query_berita->rowCount() > 0) {
            while ($row = $query_berita->fetch()) {
              $tgl = date('d F Y', strtotime($row['tanggal']));
              $gambar_db = $row['gambar'];
              if (empty($gambar_db) || !file_exists($gambar_db)) {
                $gambar_fix = "https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=600&q=80";
              } else {
                $gambar_fix = $gambar_db;
              }
          ?>
              <div class="swiper-slide">
                <a href="detail-news.php?id=<?= $row['id'] ?>" class="jiu-news-card">
                  <div class="jiu-news-img-box">
                    <img loading="lazy" src="<?= $gambar_fix ?>" alt="<?= htmlspecialchars($row['judul']) ?>" />
                  </div>
                  <div class="jiu-news-content">
                    <h3 class="jiu-news-title"><?= htmlspecialchars($row['judul']) ?></h3>
                    <div class="jiu-news-meta">
                      <span><i class="far fa-calendar-alt"></i> <?= $tgl ?></span>
                      <?php if (!empty($row['kategori'])) { ?>
                        <span><i class="fas fa-file-alt"></i> <?= htmlspecialchars($row['kategori']) ?></span>
                      <?php } else { ?>
                        <span><i class="fas fa-newspaper"></i> <span data-i18n="newsLibNews">Library News</span></span>
                      <?php } ?>
                    </div>
                    <div class="jiu-news-btn" data-i18n="newsBtnRead">
                      <i class="fas fa-arrow-circle-right"></i> Read More
                    </div>
                  </div>
                </a>
              </div>
          <?php
            }
          } else {
            echo "<div style='width: 100%; text-align: center; color: white;'><p data-i18n='newsEmpty'>No news published yet.</p></div>";
          }
          ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <section id="networking" class="networking-section">
    <div class="section-header">
      <h2 class="section-title"><span data-i18n="netTitlePrefix">Our</span> <span class="highlight-text-yellow" data-i18n="netTitleSuffix">Network</span></h2>
    </div>
    <div class="networking-canvas">
      <div class="swiper swiper-network-right">
        <div class="swiper-wrapper">
          <div class="swiper-slide partner-logo"><img loading="lazy" src="assets/images/partnership/HGU.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img loading="lazy" src="assets/images/partnership/Digido.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img loading="lazy" src="assets/images/partnership/FKIP.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img loading="lazy" src="assets/images/partnership/FPPTI.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img loading="lazy" src="assets/images/partnership/Grammedia.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img loading="lazy" src="assets/images/partnership/USK.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img loading="lazy" src="assets/images/partnership/ITSB.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img loading="lazy" src="assets/images/partnership/UBP.png" alt="Partner" /></div>
          <div class="swiper-slide partner-logo"><img loading="lazy" src="assets/images/partnership/UINSSC.png" alt="Partner" /></div>
        </div>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <div class="floating-actions">
    <button id="backToTopBtn" onclick="scrollToTop()" title="Go to top"><i class="fas fa-arrow-up"></i></button>
    <button class="chatbot-toggler" title="Tanya BlueBot">
      <div class="chatbot-tooltip">Hi Buddy! Ada yang bisa saya bantu? 👋</div>
      <img loading="lazy" src="assets/images/bluebot_mascot.webp" width="50" height="50" alt="Mascot" style="width:100%; height:100%; object-fit:contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3)); transition: opacity 0.3s;">
    </button>
  </div>

  <script defer src="assets/js/style/swiper-bundle.min.js?v=1.1"></script>
  <script defer src="https://unpkg.com/aos@2.3.1/dist/aos.js?v=1.1"></script>
  <script>
    window.BASE_URL = "<?php echo defined('BASE_URL') ? BASE_URL : ''; ?>";
  </script>
  <script defer src="assets/js/dictionary.js?v=1.1"></script>
  <script defer src="assets/js/news.js?v=1.1"></script>
  <script defer src="assets/js/announcements.js?v=1.1"></script>
  <script defer src="assets/js/search.js?v=1.1"></script>
  <script defer src="assets/js/main.js?v=1.1"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var swiperAnnouncements = new Swiper(".swiper-announcements", {
        slidesPerView: 1,
        spaceBetween: 20,
        grabCursor: true,
        autoplay: {
          delay: 4000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-announcements .swiper-pagination",
          clickable: true,
          dynamicBullets: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          992: {
            slidesPerView: 3,
            spaceBetween: 30
          },
          1200: {
            slidesPerView: 4,
            spaceBetween: 30
          },
        },
      });

      var swiperNews = new Swiper(".swiper-news", {
        slidesPerView: 1,
        spaceBetween: 20,
        grabCursor: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        pagination: {
          el: ".swiper-news .swiper-pagination",
          clickable: true,
          dynamicBullets: true,
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20
          },
          992: {
            slidesPerView: 3,
            spaceBetween: 30
          },
        },
      });
    });
  </script>

  <!-- Script for Animated Counters (Data Visualization) -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const counters = document.querySelectorAll('.counter');
      const speed = 200; // Semakin kecil semakin cepat

      const animateCounters = () => {
        counters.forEach(counter => {
          const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const inc = target / speed;

            if (count < target) {
              counter.innerText = Math.ceil(count + inc);
              setTimeout(updateCount, 20);
            } else {
              counter.innerText = target.toLocaleString('id-ID'); // Format angka ribuan
            }
          };
          updateCount();
        });
      };

      // Trigger animasi saat hero section terlihat
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            animateCounters();
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.5 });

      const heroCards = document.querySelector('.pertamina-stats-container');
      if (heroCards) observer.observe(heroCards);
    });
  </script>

  <!-- BlueBot Chatbot Window -->
  <div class="chatbot-window">
    <div class="chatbot-header">
      <div class="chatbot-status">
        <h3><img loading="lazy" src="assets/images/bluebot_mascot.webp" width="28" height="28" alt="BlueBot" style="width:28px; height:28px; object-fit:contain;"> BlueBot Assistant</h3>
        <span>Online</span>
      </div>
      <span class="close-btn"><i class="fas fa-times"></i></span>
    </div>
    <div class="chatbox">
      <div class="chat-msg bot">
        <div class="msg-avatar" style="background:transparent;"><img loading="lazy" src="assets/images/bluebot_mascot.webp" width="30" height="30" alt="Bot" style="width:100%; height:100%; object-fit:contain;"></div>
        <div class="msg-wrapper">
          <div class="msg-text">Halo! Saya BlueBot. Ada yang bisa saya bantu hari ini?</div>
          <div class="msg-time">Online</div>
        </div>
      </div>
    </div>
    <div class="quick-replies-container">
      <div class="quick-replies">
        <span class="quick-reply-btn">Jam Buka</span>
        <span class="quick-reply-btn">Cara Pinjam</span>
        <span class="quick-reply-btn">OPAC</span>
        <span class="quick-reply-btn">Hubungi Admin</span>
      </div>
    </div>
    <div class="chat-input">
      <input type="text" placeholder="Tulis pesan..." required />
      <button><i class="fas fa-paper-plane"></i></button>
    </div>
  </div>

  <!-- Accessibility Widget -->
  <?php include 'a11y-widget.php'; ?>

  <script defer src="assets/js/chatbot.js?v=1.1"></script>
</body>

</html>