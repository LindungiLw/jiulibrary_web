<!-- Accessibility Widget -->
<div class="a11y-widget">
  <button class="a11y-toggler" onclick="document.querySelector('.a11y-menu').classList.toggle('show')" aria-label="Accessibility Menu" title="Fitur Aksesibilitas">
    <i class="fas fa-universal-access"></i>
  </button>
  <div class="a11y-menu">
    <h4 data-i18n="a11yTitle">Aksesibilitas Web</h4>
    <button onclick="document.body.classList.toggle('a11y-high-contrast')"><i class="fas fa-adjust"></i> <span data-i18n="a11yHighContrast">Kontras Tinggi</span></button>
    <button onclick="document.body.classList.toggle('a11y-large-text')"><i class="fas fa-search-plus"></i> <span data-i18n="a11yLargeText">Perbesar Teks</span></button>
    <button onclick="document.body.classList.toggle('a11y-dyslexia')"><i class="fas fa-font"></i> <span data-i18n="a11yDyslexia">Mode Disleksia</span></button>
    <button onclick="document.body.classList.toggle('a11y-highlight-links')"><i class="fas fa-link"></i> <span data-i18n="a11yHighlight">Sorot Tautan</span></button>
    <button onclick="toggleTTS()" id="btn-tts"><i class="fas fa-volume-up"></i> <span data-i18n="a11yTTS">Pembaca Suara (TTS)</span></button>
  </div>
</div>

<script>
  let ttsEnabled = false;
  function toggleTTS() {
    ttsEnabled = !ttsEnabled;
    const btn = document.getElementById('btn-tts');
    let currentLang = localStorage.getItem("preferredLang") || "en";
    
    if(ttsEnabled) {
      btn.style.background = '#1e3a8a';
      btn.style.color = '#ffffff';
      document.body.style.cursor = 'help';
      
      if (currentLang === 'id') {
          alert('Fitur Pembaca Suara (Text-to-Speech) Aktif!\nKlik pada teks apa saja di layar untuk mendengarkannya.');
      } else {
          alert('Text-to-Speech Feature Active!\nClick on any text on the screen to hear it.');
      }
    } else {
      btn.style.background = '';
      btn.style.color = '';
      document.body.style.cursor = 'default';
      window.speechSynthesis.cancel();
    }
  }

  document.addEventListener('click', function(e) {
    // 1. Close a11y menu if clicked outside
    const a11yWidget = document.querySelector('.a11y-widget');
    const a11yMenu = document.querySelector('.a11y-menu');
    if (a11yWidget && !a11yWidget.contains(e.target)) {
      a11yMenu.classList.remove('show');
    }

    // 2. TTS Logic
    if(!ttsEnabled) return;
    
    // Jangan bacakan klik pada widget aksesibilitas
    if (e.target.closest('.a11y-widget')) return;
    
    // Hentikan suara sebelumnya
    window.speechSynthesis.cancel();
    
    let text = e.target.innerText || e.target.textContent || e.target.alt || e.target.title;
    if(text && text.trim().length > 0) {
      text = text.trim().substring(0, 500); 
      let utterance = new SpeechSynthesisUtterance(text);
      let currentLang = localStorage.getItem("preferredLang") || "en";
      utterance.lang = currentLang === 'id' ? 'id-ID' : 'en-US';
      
      // Efek visual menyorot teks yang dibaca
      let originalBg = e.target.style.backgroundColor;
      let originalColor = e.target.style.color;
      
      e.target.style.backgroundColor = '#fef08a';
      e.target.style.color = '#000';
      
      utterance.onend = () => { 
          e.target.style.backgroundColor = originalBg; 
          e.target.style.color = originalColor;
      };
      
      window.speechSynthesis.speak(utterance);
      
      e.preventDefault();
      e.stopPropagation();
    }
  }, true); // Use capture phase to intercept clicks before other handlers
</script>
