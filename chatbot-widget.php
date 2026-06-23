<!-- Floating Actions (Back to Top & BlueBot Toggler) -->
<link rel="preload" href="assets/css/chatbot.css?v=1.0" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="assets/css/chatbot.css?v=1.0"></noscript>
  <div class="floating-actions">
    <button id="backToTopBtn" onclick="scrollToTop()" title="Go to top"><i class="fas fa-arrow-up"></i></button>
    <button class="chatbot-toggler" title="Tanya BlueBot">
      <div class="chatbot-tooltip" data-i18n="botTooltip">Hi Buddy! Ada yang bisa saya bantu? 👋</div>
      <img loading="lazy" src="assets/images/bluebot_mascot.webp" width="50" height="50" alt="Mascot" style="width:100%; height:100%; object-fit:contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3)); transition: opacity 0.3s;">
    </button>
  </div>


  <!-- BlueBot Chatbot Window -->
  <?php
    $chat_user_name    = isset($_SESSION['user_name'])    ? htmlspecialchars($_SESSION['user_name'])    : 'Kamu';
    $chat_user_picture = isset($_SESSION['user_picture']) ? htmlspecialchars($_SESSION['user_picture']) : '';
    $chat_logged_in    = isset($_SESSION['user_status']) && $_SESSION['user_status'] === 'login';
  ?>
  <div class="chatbot-window"
       data-user-name="<?php echo $chat_user_name; ?>"
       data-user-picture="<?php echo $chat_user_picture; ?>"
       data-logged-in="<?php echo $chat_logged_in ? 'true' : 'false'; ?>">
    <div class="chatbot-header">
      <div class="chatbot-header-info">
        <div class="chatbot-header-avatar">
          <img loading="lazy" src="assets/images/bluebot_mascot.webp" alt="BlueBot">
        </div>
        <div class="chatbot-header-text">
          <h3>BlueBot Assistant</h3>
          <span class="bot-status" data-i18n="botStatus">Online &amp; siap bantu!</span>
        </div>
      </div>
      <span class="close-btn"><i class="fas fa-times"></i></span>
    </div>
    <div class="chatbox">
      <div class="chat-msg bot">
        <div class="msg-avatar" style="background:transparent;"><img loading="lazy" src="assets/images/bluebot_mascot.webp" alt="Bot" style="width:100%;height:100%;object-fit:contain;"></div>
        <div class="msg-wrapper">
          <div class="msg-text">Hallo, <?php echo $chat_logged_in ? $chat_user_name : 'Buddy'; ?>! 👋 <span data-i18n="botWelcome">Saya BlueBot, asisten perpustakaan Dream Blue Library. Ada yang bisa saya bantu hari ini?</span></div>
          <div class="msg-time">Sekarang</div>
        </div>
      </div>
    </div>
    <div class="quick-replies-container">
      <div class="quick-replies-label" data-i18n="botQRLabel">Pertanyaan populer</div>
      <div class="quick-replies">
        <span class="quick-reply-btn">🕗 <span data-i18n="botQRHours">Jam Buka</span></span>
        <span class="quick-reply-btn">📚 <span data-i18n="botQRBorrow">Cara Pinjam</span></span>
        <span class="quick-reply-btn">💸 <span data-i18n="botQRFine">Denda</span></span>
        <span class="quick-reply-btn">📶 <span data-i18n="botQRWiFi">WiFi</span></span>
        <span class="quick-reply-btn">🖥️ <span data-i18n="botQROPAC">OPAC</span></span>
        <span class="quick-reply-btn">💬 <span data-i18n="botQRContact">Hubungi Pustakawan</span></span>
      </div>
    </div>
    <div class="chat-input">
      <input type="text" data-i18n-ph="botInputPh" placeholder="Ketik pertanyaanmu di sini..." required />
      <button><i class="fas fa-paper-plane"></i></button>
    </div>
  </div>

