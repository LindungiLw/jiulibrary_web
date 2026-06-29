<?php
session_start();
require_once 'config.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FAQ - Dream Blue Library</title>
  <meta name="description" content="Find quick answers to common questions about Dream Blue Library services at Jakarta International University." />
  <link rel="icon" type="image/png" href="assets/images/library-logo.webp" />

  <!-- Preload Critical Fonts -->
  <link rel="preload" href="assets/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="assets/fonts/Poppins-Regular.woff2" as="font" type="font/woff2" crossorigin>

  <link rel="stylesheet" href="assets/css/fonts.css" />

  <!-- Load FontAwesome (Local) -->
  <link rel="preload" href="assets/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="assets/css/all.min.css"></noscript>

  <link rel="stylesheet" href="assets/css/style/variable.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/base.css?v=1.2" />
  <link rel="stylesheet" href="assets/css/navbar.css?v=2.3" />
  <link rel="stylesheet" href="assets/css/style/modal.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/footer.css?v=1.1" />
  <link rel="stylesheet" href="assets/css/responsive.css?v=3.0" />

  <!-- Google Identity Services untuk SSO -->
  <script src="https://accounts.google.com/gsi/client" async defer></script>

  <style>
    body {
      background-color: #f8fafc;
      font-family: var(--font-primary, 'Poppins', sans-serif);
    }

    /* ===== PAGE HEADER ===== */
    .faq-page-header {
      background: linear-gradient(135deg, var(--clr-blue-2, #1e285d) 0%, var(--clr-blue-1, #273374) 60%, #3b4fa8 100%);
      padding: 120px 0 70px;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .faq-page-header::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='rgba(255,255,255,0.05)' stroke-width='1'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3Ccircle cx='30' cy='30' r='10'/%3E%3C/g%3E%3C/svg%3E") repeat;
    }

    .faq-page-header::after {
      content: '';
      position: absolute;
      bottom: -1px;
      left: 0;
      width: 100%;
      height: 60px;
      background-color: #f8fafc;
      border-radius: 50% 50% 0 0 / 100% 100% 0 0;
    }

    .faq-header-inner {
      max-width: 700px;
      margin: 0 auto;
      padding: 0 5%;
      position: relative;
      z-index: 1;
    }



    .faq-page-header h1 {
      font-size: 2.8rem;
      font-weight: 800;
      margin: 0 0 12px;
      text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      line-height: 1.2;
    }

    .faq-page-header h1 span {
      color: #facc15;
    }

    .faq-page-header p {
      font-size: 1.05rem;
      opacity: 0.85;
      font-weight: 300;
      margin: 0;
    }

    /* ===== MAIN CONTENT AREA ===== */
    .faq-main {
      max-width: 1100px;
      margin: 0 auto 80px;
      padding: 50px 5% 0;
      display: grid;
      grid-template-columns: 1fr 1.6fr;
      gap: 60px;
      align-items: start;
    }

    /* ===== IMAGE SIDE ===== */
    .faq-image-col {
      position: sticky;
      top: 100px;
    }

    .faq-image-wrapper {
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(39, 51, 116, 0.18);
      position: relative;
    }

    .faq-image-wrapper img {
      width: 100%;
      height: 420px;
      object-fit: cover;
      display: block;
      transition: transform 0.6s ease;
    }

    .faq-image-wrapper:hover img {
      transform: scale(1.04);
    }

    .faq-badge {
      position: absolute;
      bottom: 20px;
      left: 20px;
      background: rgba(39, 51, 116, 0.92);
      backdrop-filter: blur(10px);
      color: white;
      padding: 10px 18px;
      border-radius: 12px;
      font-size: 0.9rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 8px;
      border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .faq-badge i {
      color: #facc15;
    }

    /* ===== ACCORDION SIDE ===== */
    .faq-accordion {
      display: flex;
      flex-direction: column;
      gap: 14px;
    }

    .faq-item {
      background: white;
      border-radius: 16px;
      border: 1px solid #e2e8f0;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      transition: box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .faq-item:hover {
      box-shadow: 0 8px 24px rgba(39, 51, 116, 0.1);
      border-color: #c7d2fe;
    }

    .faq-item.active {
      border-color: var(--clr-blue-1, #273374);
      box-shadow: 0 8px 30px rgba(39, 51, 116, 0.15);
    }

    .faq-question {
      width: 100%;
      background: none;
      border: none;
      padding: 20px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
      cursor: pointer;
      text-align: left;
      font-family: var(--font-primary, 'Poppins', sans-serif);
      font-size: 0.98rem;
      font-weight: 600;
      color: #1e293b;
      transition: color 0.3s ease;
    }

    .faq-item.active .faq-question {
      color: var(--clr-blue-1, #273374);
    }

    .faq-question i {
      font-size: 0.75rem;
      color: #94a3b8;
      flex-shrink: 0;
      transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), color 0.3s;
    }

    .faq-item.active .faq-question i {
      transform: rotate(180deg);
      color: var(--clr-blue-1, #273374);
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .faq-answer p {
      margin: 0;
      padding: 0 24px 22px;
      font-size: 0.95rem;
      color: #475569;
      line-height: 1.75;
      border-top: 1px solid #f1f5f9;
      padding-top: 16px;
    }

    /* ===== SEARCH BAR ===== */
    .faq-search-wrapper {
      margin-bottom: 24px;
      position: relative;
    }

    .faq-search-input {
      width: 100%;
      padding: 16px 20px 16px 50px;
      border-radius: 12px;
      border: 1px solid #e2e8f0;
      font-size: 1rem;
      font-family: var(--font-primary, 'Poppins', sans-serif);
      color: #1e293b;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
      transition: all 0.3s ease;
      box-sizing: border-box;
    }

    .faq-search-input:focus {
      outline: none;
      border-color: var(--clr-blue-1, #273374);
      box-shadow: 0 4px 12px rgba(39, 51, 116, 0.1);
    }

    .faq-search-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 1.1rem;
    }

    .faq-no-results {
      text-align: center;
      padding: 30px;
      color: #64748b;
      font-size: 1.1rem;
      display: none;
      background: white;
      border-radius: 16px;
      border: 1px dashed #cbd5e1;
      margin-top: 20px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
      .faq-page-header {
        padding: 110px 0 60px;
      }
      .faq-page-header h1 {
        font-size: 2rem;
      }
      .faq-main {
        grid-template-columns: 1fr;
        gap: 30px;
        padding-top: 30px;
      }
      .faq-image-col {
        position: static;
      }
      .faq-image-wrapper img {
        height: 260px;
      }
    }
  </style>
</head>

<body>

  <?php include 'navbar.php'; ?>

  <!-- PAGE HEADER -->
  <header class="faq-page-header">
    <div class="faq-header-inner">
      <h1>Frequently Asked <span>Questions</span></h1>
      <p>Find quick answers to common questions about our library services.</p>
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <main class="faq-main">

    <!-- Left: Image -->
    <div class="faq-image-col">
      <div class="faq-image-wrapper">
        <img src="assets/images/sofia.webp" alt="Student searching for answers" />
        <div class="faq-badge">
          <i class="fas fa-lightbulb"></i> We're here to help!
        </div>
      </div>
    </div>

    <!-- Right: Accordion & Search -->
    <div class="faq-content-col">
      <div class="faq-search-wrapper">
        <i class="fas fa-search faq-search-icon"></i>
        <input type="text" id="faqSearchInput" class="faq-search-input" placeholder="Search for answers (e.g., borrow, submit)...">
      </div>

      <div class="faq-accordion" id="faqAccordion">

      <div class="faq-item">
        <button class="faq-question">
          <span>Who can use the Dream Blue Library facilities?</span>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="faq-answer">
          <p>Our library facilities are primarily available to all active students, faculty, and staff of Jakarta International University. We also welcome external researchers and guests, provided they have prior approval from the library administration.</p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          <span>How do I borrow a book?</span>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="faq-answer">
          <p>To borrow a book, you must be registered in our system. Simply bring your physical or digital Student/Staff ID card to the circulation desk along with the items you wish to borrow. You can also use our self-service kiosks available on the first floor.</p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          <span>What is the "Healing Corner"?</span>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="faq-answer">
          <p>The Healing Corner is a specialized, quiet space designed specifically for student well-being and mental health. It provides a comfortable environment to relax, read non-academic materials, and recharge your energy between classes.</p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          <span>Can I access online journals from home?</span>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="faq-answer">
          <p>Yes, absolutely! All active students and faculty can access our extensive digital databases and e-journals off-campus. Simply log in to the library portal using your official JIU email credentials.</p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          <span>What happens if I lose or damage a borrowed book?</span>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="faq-answer">
          <p>If an item is lost or severely damaged, please report it to the library staff immediately. According to our regulations, you will be required to replace the item with the exact same edition or pay a standard replacement fee.</p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          <span>How long can I borrow a book?</span>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="faq-answer">
          <p>Standard loan period is 7 days for regular collections. Final-year students working on thesis may be eligible for extended loans. Renewals can be requested at the circulation desk or via the OPAC system, subject to availability.</p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          <span>Is there a printing or scanning service available?</span>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="faq-answer">
          <p>Yes! The library provides self-service printing, scanning, and photocopying facilities on the ground floor. Charges apply per page, and you can pay using your student card balance or cash at the service counter.</p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          <span>How do I submit a Research Paper, Thesis, or other academic work?</span>
          <i class="fas fa-chevron-down"></i>
        </button>
        <div class="faq-answer">
          <div style="padding: 0 24px 24px;">
            <p style="margin: 16px 0; border: none; padding: 0;">
              Submitting your academic work to the library is quick and easy! Here's how:
            </p>
            
            <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 20px;">
              <div style="display: flex; gap: 16px; align-items: flex-start;">
                <div style="background: #e0f2fe; color: #0284c7; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; margin-top: 2px;">1</div>
                <div>
                  <h4 style="margin: 0 0 4px 0; color: #0f172a; font-size: 1rem;">Sign in</h4>
                  <p style="margin: 0; padding: 0; border: none; color: #475569; font-size: 0.95rem; line-height: 1.6;">Click the <strong>Sign In</strong> button on the top-right of the website and log in using your official <strong>JIU Google account</strong> (@student.jiu.ac.id or @jiu.ac.id).</p>
                </div>
              </div>
              
              <div style="display: flex; gap: 16px; align-items: flex-start;">
                <div style="background: #e0f2fe; color: #0284c7; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; margin-top: 2px;">2</div>
                <div>
                  <h4 style="margin: 0 0 4px 0; color: #0f172a; font-size: 1rem;">Go to Submit menu</h4>
                  <p style="margin: 0; padding: 0; border: none; color: #475569; font-size: 0.95rem; line-height: 1.6;">On the navigation bar, click <strong>Submit</strong> and choose the type of document you want to submit: <em>Research Paper, Thesis, Final Project, Internship Report,</em> or <em>Portfolio</em>.</p>
                </div>
              </div>
              
              <div style="display: flex; gap: 16px; align-items: flex-start;">
                <div style="background: #e0f2fe; color: #0284c7; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0; margin-top: 2px;">3</div>
                <div>
                  <h4 style="margin: 0 0 4px 0; color: #0f172a; font-size: 1rem;">Fill in the form</h4>
                  <p style="margin: 0; padding: 0; border: none; color: #475569; font-size: 0.95rem; line-height: 1.6;">Complete the submission form with your document details (title, abstract, file, etc.) and click <strong>Submit</strong>.</p>
                </div>
              </div>
            </div>

            <div style="background: #fffbeb; border-left: 4px solid #f59e0b; padding: 12px 16px; border-radius: 0 8px 8px 0;">
              <p style="margin: 0; padding: 0; border: none; color: #92400e; font-size: 0.9rem; line-height: 1.5;">
                <i class="fas fa-info-circle" style="color: #f59e0b; margin-right: 6px;"></i>
                <strong>Note:</strong> The Submit menu is only accessible to active <strong>JIU Members</strong>. Make sure you are logged in with your institutional account before accessing this feature.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="faq-no-results" id="faqNoResults">
        <i class="fas fa-search" style="font-size: 2rem; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
        No frequently asked questions matched your search.
      </div>

    </div>
  </div>
  </main>

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

  <script>
    const faqQuestions = document.querySelectorAll(".faq-question");
    faqQuestions.forEach((question) => {
      question.addEventListener("click", () => {
        const item = question.parentElement;
        const activeItem = document.querySelector(".faq-item.active");
        if (activeItem && activeItem !== item) {
          activeItem.classList.remove("active");
          activeItem.querySelector(".faq-answer").style.maxHeight = null;
        }
        item.classList.toggle("active");
        const answer = item.querySelector(".faq-answer");
        if (item.classList.contains("active")) {
          answer.style.maxHeight = answer.scrollHeight + "px";
        } else {
          answer.style.maxHeight = null;
        }
      });
    });

    // Live Search Functionality
    const searchInput = document.getElementById('faqSearchInput');
    const faqItemsArray = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('faqNoResults');

    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase().trim();
      let hasVisibleItems = false;

      faqItemsArray.forEach(item => {
        const questionText = item.querySelector('.faq-question span').textContent.toLowerCase();
        const answerText = item.querySelector('.faq-answer').textContent.toLowerCase();
        
        if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
          item.style.display = 'block';
          hasVisibleItems = true;
        } else {
          item.style.display = 'none';
          // Close accordion if it's open but doesn't match search
          if (item.classList.contains('active')) {
            item.classList.remove('active');
            item.querySelector('.faq-answer').style.maxHeight = null;
          }
        }
      });

      if (hasVisibleItems || searchTerm === '') {
        noResults.style.display = 'none';
      } else {
        noResults.style.display = 'block';
      }
    });
  </script>

</body>
</html>
