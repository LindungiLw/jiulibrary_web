document.addEventListener('DOMContentLoaded', () => {
    const chatbotToggler = document.querySelector('.chatbot-toggler');
    const chatbotWindow = document.querySelector('.chatbot-window');
    const closeBtn = document.querySelector('.close-btn');
    const chatbox = document.querySelector('.chatbox');
    const chatInput = document.querySelector('.chat-input input');
    const sendBtn = document.querySelector('.chat-input button');
    const tooltip = document.querySelector('.chatbot-tooltip');

    if (!chatbotToggler || !chatbotWindow) return;

    // Tooltip logic
    if (tooltip) {
        const tooltipMessages = [
            "Hi Buddy 👋! Ada yang bisa saya bantu?",
            "Sedang cari buku apa hari ini? ",
            "Butuh bantuan mencari koleksi? ",
            "Jangan lupa cek koleksi terbaru kami!"
        ];
        let tooltipIndex = 1;

        const showTooltip = (text, duration = 5000) => {
            if (chatbotWindow.classList.contains('active')) return;
            tooltip.innerText = text;
            tooltip.classList.add('show');
            setTimeout(() => {
                tooltip.classList.remove('show');
            }, duration);
        };

        // Tampil pertama kali setelah 2 detik
        setTimeout(() => {
            showTooltip(tooltipMessages[0], 6000);
        }, 2000);

        // Ulangi setiap 30 detik dengan teks berbeda
        setInterval(() => {
            if (!chatbotWindow.classList.contains('active')) {
                showTooltip(tooltipMessages[tooltipIndex], 6000);
                tooltipIndex = (tooltipIndex + 1) % tooltipMessages.length;
            }
        }, 30000);
    }

    // Toggle Chatbot
    chatbotToggler.addEventListener('click', () => {
        chatbotWindow.classList.toggle('active');
        if (tooltip) tooltip.classList.remove('show'); // Hide tooltip if opened

        if (chatbotToggler.querySelector('i')) { // It's currently an X icon
            chatbotToggler.innerHTML = '<div class="chatbot-tooltip"></div><img src="assets/images/bluebot_mascot.webp" alt="Mascot" style="width:100%; height:100%; object-fit:contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3)); transition: opacity 0.3s;">';
        } else {
            chatbotToggler.innerHTML = '<i class="fas fa-times"></i>';
        }
    });

    closeBtn.addEventListener('click', () => {
        chatbotWindow.classList.remove('active');
        chatbotToggler.innerHTML = '<div class="chatbot-tooltip"></div><img src="assets/images/bluebot_mascot.webp" alt="Mascot" style="width:100%; height:100%; object-fit:contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3)); transition: opacity 0.3s;">';
    });

    // Responses Database
    const botResponses = {
        "jam buka": "Perpustakaan Dream Blue buka hari Senin-Jumat pukul 08.00 - 16.00 WIB. Sabtu & Minggu libur ya!",
        "cara pinjam": "Untuk meminjam buku, pastikan Anda sudah terdaftar sebagai Member. Silakan Login, cari buku di menu OPAC (Catalog), lalu bawa Kartu Mahasiswa ke meja sirkulasi.",
        "opac": "OPAC (Online Public Access Catalog) bisa diakses melalui menu Collection > OPAC (Catalog).",
        "admin": "Tentu, Anda bisa mengobrol langsung dengan Pustakawan kami via WhatsApp. Silakan klik tombol ini:<br><a href='https://wa.me/6281260173697' target='_blank' style='display:inline-block; margin-top:10px; padding:8px 15px; background:#25D366; color:#fff; border-radius:5px; text-decoration:none;'><i class='fab fa-whatsapp'></i> Chat via WhatsApp</a>",
        "wa": "Tentu, Anda bisa mengobrol langsung dengan Pustakawan kami via WhatsApp. Silakan klik tombol ini:<br><a href='https://wa.me/6281260173697' target='_blank' style='display:inline-block; margin-top:10px; padding:8px 15px; background:#25D366; color:#fff; border-radius:5px; text-decoration:none;'><i class='fab fa-whatsapp'></i> Chat via WhatsApp</a>",
        "default": "Maaf, BlueBot masih belajar! Silakan hubungi Pustakawan di meja layanan atau gunakan form kontak untuk bantuan lebih lanjut."
    };

    const createChatLi = (message, className, isTyping = false) => {
        const li = document.createElement('div');
        li.classList.add('chat-msg', className);
        
        // Buat timestamp real-time
        const now = new Date();
        const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        
        let content = className === 'user' ?
            `<div class="msg-wrapper">
               <div class="msg-text">${message}</div>
               <div class="msg-time">${timeString}</div>
             </div>
             <div class="msg-avatar"><i class="fas fa-user"></i></div>` :
            `<div class="msg-avatar" style="background:transparent;">
               <img src="assets/images/bluebot_mascot.webp" alt="Bot" style="width:100%; height:100%; object-fit:contain;">
             </div>
             <div class="msg-wrapper">
               <div class="msg-text ${isTyping ? 'typing-bg' : ''}">${message}</div>
               ${!isTyping ? `<div class="msg-time">${timeString}</div>` : ''}
             </div>`;
        li.innerHTML = content;
        return li;
    };

    const handleChat = (messageText) => {
        let message = messageText;
        if (typeof message !== 'string') {
            message = chatInput.value.trim();
        }

        if (!message) return;

        chatInput.value = '';

        // Append user msg
        chatbox.appendChild(createChatLi(message, 'user'));
        chatbox.scrollTo(0, chatbox.scrollHeight);

        // Append bot "thinking" then response
        setTimeout(() => {
            let response = botResponses["default"];
            const lowerMsg = message.toLowerCase();

            for (const key in botResponses) {
                if (lowerMsg.includes(key)) {
                    response = botResponses[key];
                    break;
                }
            }
            
            // Tampilkan animasi mengetik terlebih dahulu
            const typingMsg = createChatLi('<div class="typing-indicator"><span></span><span></span><span></span></div>', 'bot', true);
            chatbox.appendChild(typingMsg);
            chatbox.scrollTo(0, chatbox.scrollHeight);

            // Simulasikan delay API
            setTimeout(() => {
                chatbox.removeChild(typingMsg);
                chatbox.appendChild(createChatLi(response, 'bot'));
                chatbox.scrollTo(0, chatbox.scrollHeight);
            }, 1000);

        }, 500);
    };

    sendBtn.addEventListener('click', handleChat);
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleChat();
    });

    // Quick replies
    document.querySelectorAll('.quick-reply-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            handleChat(e.target.innerText);
        });
    });
});
