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
            <button class="btn-profile-top" onclick="toggleDropdown(event, 'userMenu')" style="height: 26px; box-sizing: border-box; display: flex; align-items: center; gap: 6px; background: transparent; border: 1px solid rgba(255, 255, 255, 0.4); border-radius: 20px; color: white; padding: 2px 10px; cursor: pointer; transition: background 0.3s;">
            <?php 
              $avatar_url = !empty($_SESSION['user_picture']) && $_SESSION['user_picture'] !== 'assets/images/default-avatar.png' ? $_SESSION['user_picture'] : 'https://ui-avatars.com/api/?name=' . urlencode($firstName) . '&background=f8fafc&color=475569&rounded=true';
            ?>
            <img loading="lazy" src="<?php echo htmlspecialchars($avatar_url); ?>" alt="Profile" style="width: 16px; height: 16px; border-radius: 50%; object-fit: cover;" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($firstName); ?>&background=f8fafc&color=475569&rounded=true';">
              <span style="font-weight: 600; font-size: 0.8rem;"><?php echo htmlspecialchars($firstName); ?></span>
              <i class="fas fa-chevron-down" style="font-size: 0.5rem; color: #64748b;"></i>
            </button>
            <div class="dropdown-content user-profile-dropdown" id="userMenu" style="right: 0; left: auto;">
              <div class="simple-vertical-menu" style="gap: 0;">
                <a href="profile.php" class="profile-menu-item" data-i18n="btnProfile">
                  <i class="fas fa-user-circle"></i> My Profile
                </a>
                <div class="profile-dropdown-divider"></div>
                <a href="<?= BASE_URL ?>/assets/auth/logout.php" class="profile-menu-item logout-item" data-i18n="btnLogout">
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
          <img loading="lazy" src="assets/images/library-logo.webp" alt="Dream Blue Library Logo" style="width: 40px; height: auto; object-fit: contain;" />
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

        <div id="mobile-menu" class="menu-toggle">
          <i class="fas fa-bars"></i>
        </div>
      </div>
    </nav>
  </header>

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
