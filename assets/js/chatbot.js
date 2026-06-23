document.addEventListener('DOMContentLoaded', () => {
    const chatbotToggler = document.querySelector('.chatbot-toggler');
    const chatbotWindow  = document.querySelector('.chatbot-window');
    const closeBtn       = document.querySelector('.close-btn');
    const chatbox        = document.querySelector('.chatbox');
    const chatInput      = document.querySelector('.chat-input input');
    const sendBtn        = document.querySelector('.chat-input button');
    const tooltip        = document.querySelector('.chatbot-tooltip');

    if (!chatbotToggler || !chatbotWindow) return;

    // ── Tooltip ─────────────────────────────────────────────
    if (tooltip) {
        const tooltipMessages = [
            "Hallo, Buddy! 👋 Ada yang bisa dibantu?",
            "Cari buku? Yuk tanya aku! 📚",
            "Butuh info jam buka atau denda? Sini! 😊",
            "Jangan lupa cek koleksi terbaru! 🌟"
        ];
        let tipIdx = 0;
        const showTooltip = (text, dur = 5500) => {
            if (chatbotWindow.classList.contains('active')) return;
            tooltip.innerText = text;
            tooltip.classList.add('show');
            setTimeout(() => tooltip.classList.remove('show'), dur);
        };
        setTimeout(() => showTooltip(tooltipMessages[0], 6000), 2500);
        setInterval(() => {
            tipIdx = (tipIdx + 1) % tooltipMessages.length;
            showTooltip(tooltipMessages[tipIdx], 5500);
        }, 30000);
    }

    // ── Open / Close ─────────────────────────────────────────
    const openChatbot = () => {
        chatbotWindow.classList.add('active');
        if (tooltip) tooltip.classList.remove('show');
        if (chatbotToggler.querySelector('img')) {
            chatbotToggler.innerHTML = '<i class="fas fa-times"></i>';
        }
    };
    const closeChatbot = () => {
        chatbotWindow.classList.remove('active');
        if (chatbotToggler.querySelector('i.fa-times')) {
            chatbotToggler.innerHTML = '<div class="chatbot-tooltip"></div><img src="assets/images/bluebot_mascot.webp" alt="BlueBot" style="width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 4px 8px rgba(0,0,0,0.25));transition:opacity .3s;">';
        }
    };

    chatbotToggler.addEventListener('click', () =>
        chatbotWindow.classList.contains('active') ? closeChatbot() : openChatbot()
    );
    closeBtn.addEventListener('click', closeChatbot);

    // Click outside
    document.addEventListener('click', (e) => {
        if (chatbotWindow.classList.contains('active') &&
            !chatbotWindow.contains(e.target) &&
            !chatbotToggler.contains(e.target)) {
            closeChatbot();
        }
    });

    // Hover (desktop only)
    let hoverTimer;
    if (window.matchMedia && window.matchMedia('(hover: hover)').matches) {
        chatbotToggler.addEventListener('mouseenter', () => { clearTimeout(hoverTimer); openChatbot(); });
        chatbotToggler.addEventListener('mouseleave', () => { hoverTimer = setTimeout(closeChatbot, 350); });
        chatbotWindow.addEventListener('mouseenter',  () => clearTimeout(hoverTimer));
        chatbotWindow.addEventListener('mouseleave',  () => { hoverTimer = setTimeout(closeChatbot, 350); });
    }

    // ── Response Database (Local) ─────────────────────────────
    const BUDDY = "Hallo, Buddy! 👋 ";
    const WA_BTN = `<br><a href='https://wa.me/6281260173697' target='_blank' style='display:inline-flex;align-items:center;gap:6px;margin-top:10px;padding:8px 16px;background:#25D366;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem;'><i class='fab fa-whatsapp'></i> Chat Pustakawan</a>`;

    const botResponses = {
        // Sapaan
        "halo":          BUDDY + "Senang kamu di sini! Mau tanya soal apa hari ini?",
        "hai":           BUDDY + "Senang kamu di sini! Mau tanya soal apa hari ini?",
        "hi":            BUDDY + "Hi! Ada yang bisa saya bantu?",
        "hello":         BUDDY + "Welcome to Dream Blue Library! Ada yang bisa dibantu?",
        "hey":           BUDDY + "Hey! Ada yang bisa dibantu hari ini?",
        "pagi":          BUDDY + "Selamat pagi! Semangat ya hari ini. Ada yang bisa dibantu?",
        "siang":         BUDDY + "Selamat siang! Ada pertanyaan seputar perpustakaan?",
        "sore":          BUDDY + "Selamat sore! Ada yang bisa dibantu sebelum perpustakaan tutup?",
        "terima kasih":  BUDDY + "Sama-sama! Senang bisa membantu. Jangan ragu balik lagi ya!",
        "makasih":       BUDDY + "Sama-sama! Semoga informasinya bermanfaat.",
        "tanya":         BUDDY + "Boleh banget! Mau tanya soal apa? Jam buka, denda, WiFi, atau yang lain?",

        // Jam Operasional
        "jam buka":      BUDDY + "Ini jadwal Dream Blue Library:<br>&bull; <b>Senin–Jumat:</b> 08.00–17.00 &amp; 18.00–21.00<br>&bull; <b>Sabtu:</b> 08.00–17.00<br>&bull; <b>Hari Besar/Tanggal Merah:</b> Tutup",
        "operasional":   BUDDY + "Jadwal buka perpustakaan:<br>&bull; <b>Senin–Jumat:</b> 08.00–17.00 &amp; 18.00–21.00<br>&bull; <b>Sabtu:</b> 08.00–17.00<br>&bull; <b>Hari Besar:</b> Tutup",
        "jadwal":        BUDDY + "Jadwal buka perpustakaan:<br>&bull; <b>Senin–Jumat:</b> 08.00–17.00 &amp; 18.00–21.00<br>&bull; <b>Sabtu:</b> 08.00–17.00<br>&bull; <b>Hari Besar:</b> Tutup",
        "buka":          BUDDY + "Jadwal buka perpustakaan:<br>&bull; <b>Senin–Jumat:</b> 08.00–17.00 &amp; 18.00–21.00<br>&bull; <b>Sabtu:</b> 08.00–17.00<br>&bull; <b>Hari Besar:</b> Tutup",

        // Peminjaman
        "cara pinjam":   BUDDY + "Mudah banget! Semua mahasiswa <b>otomatis jadi anggota</b>. Cukup bawa KTM ke meja sirkulasi.<br>&bull; Maks: <b>5 buku + 5 DVD + 3 e-book</b><br>&bull; Durasi: <b>2 minggu</b>",
        "pinjam":        BUDDY + "Kamu bisa pinjam maks <b>5 buku fisik, 5 DVD, dan 3 e-book</b> selama <b>2 minggu</b>. Bawa KTM ke meja sirkulasi ya!",
        "maksimal":      BUDDY + "Batas pinjam: <b>5 buku fisik, 5 DVD, 3 e-book</b> selama <b>2 minggu</b>.",
        "berapa buku":   BUDDY + "Kamu boleh pinjam maksimal <b>5 buku fisik, 5 DVD, dan 3 e-book</b> dalam sekali peminjaman.",
        "berapa lama":   BUDDY + "Durasi peminjaman adalah <b>2 minggu (14 hari)</b>. Kalau mau diperpanjang, tanyain ke meja sirkulasi ya!",

        // Denda
        "denda":         BUDDY + "Perhatikan ya, Buddy!<br>&bull; Keterlambatan: <b>Rp 1.000/hari/buku</b><br>&bull; Rusak ringan: biaya perbaikan + <b>denda 20%</b><br>&bull; Rusak parah/hilang: <b>ganti buku yang sama</b> atau bayar <b>100% harga baru</b>",
        "terlambat":     BUDDY + "Denda keterlambatan adalah <b>Rp 1.000/hari/buku</b>. Jadi jangan sampai telat mengembalikan ya!",
        "telat":         BUDDY + "Denda keterlambatan adalah <b>Rp 1.000/hari/buku</b>. Jadi jangan sampai telat mengembalikan ya!",
        "hilang":        BUDDY + "Kalau buku hilang, harus diganti dengan buku yang sama atau membayar <b>100% harga buku baru</b>. Jaga bukunya baik-baik ya!",
        "rusak":         BUDDY + "Buku rusak ringan dikenakan biaya perbaikan + <b>denda 20%</b>. Kalau rusak parah, harus <b>ganti buku baru</b> yang sama. Hati-hati ya!",

        // Fasilitas
        "tas":           BUDDY + "Tas <b>tidak boleh dibawa masuk</b> ke ruang baca. Simpan di loker dulu — kunci loker bisa dipinjam gratis di meja sirkulasi.",
        "loker":         BUDDY + "Tersedia <b>42 loker</b> yang bisa kamu pakai secara gratis. Kunci dipinjam di area sirkulasi.",
        "makan":         BUDDY + "Makanan dan minuman berwarna/berasa <b>tidak diperbolehkan</b> masuk ke perpustakaan. Hanya <b>air mineral</b> yang boleh dibawa.",
        "minum":         BUDDY + "Hanya <b>air mineral</b> yang boleh dibawa masuk. Minuman berwarna/berasa tidak diperbolehkan ya.",
        "wifi":          BUDDY + "Info WiFi perpustakaan:<br>&bull; Nama: <b>M204 (Library)</b><br>&bull; Sandi: <b>HappyCampus!</b>",
        "password":      BUDDY + "Password WiFi perpustakaan: <b>HappyCampus!</b> (Jaringan: M204 Library)",
        "sandi":         BUDDY + "Sandi WiFi perpustakaan: <b>HappyCampus!</b> (Jaringan: M204 Library)",
        "internet":      BUDDY + "Sambung ke WiFi <b>M204 (Library)</b>, sandinya: <b>HappyCampus!</b>",
        "ac":            BUDDY + "Suhu AC diatur sekitar <b>20–25°C</b>. Tolong jangan diubah sendiri tanpa izin pustakawan ya.",

        // Layanan Khusus
        "study room":    BUDDY + "Study Room bisa dipesan di meja sirkulasi untuk diskusi, rapat, konseling, atau rekam Zoom.<br>Catatan: <b>dilarang makan</b> di dalam dan <b>matikan AC &amp; lampu</b> setelah selesai.",
        "ruang":         BUDDY + "Study Room bisa dipesan di meja sirkulasi untuk diskusi, rapat, atau rekam Zoom.",
        "turnitin":      BUDDY + "Layanan cek Turnitin <b>GRATIS</b> untuk civitas!<br>&bull; Kirim: <b>PDF/Word</b> (abstrak sampai kesimpulan)<br>&bull; Hasil: <b>1–2 hari kerja</b><br>&bull; Maks: <b>1 dokumen/hari/orang</b>",
        "cek plagiat":   BUDDY + "Cek plagiat (Turnitin) <b>GRATIS</b> untuk civitas JIU. Kirim dokumen PDF/Word ke Pustakawan. Hasil dalam <b>1–2 hari kerja</b>. Maks 1 dokumen/hari.",
        "plagiat":       BUDDY + "Cek plagiat (Turnitin) <b>GRATIS</b> untuk civitas JIU. Hubungi pustakawan untuk mengirimkan dokumenmu.",
        "print":         BUDDY + "Layanan cetak:<br>&bull; Print/Fotokopi: <b>Rp 300/lembar (1 sisi)</b> — <b>Rp 500 (bolak-balik)</b><br>&bull; Kertas kosong: Rp 100<br>&bull; Scan: <b>GRATIS</b>",
        "fotokopi":      BUDDY + "Fotokopi: <b>Rp 300/lembar (1 sisi)</b> atau <b>Rp 500 (bolak-balik)</b>. Scan dokumen <b>GRATIS</b> ya!",
        "scan":          BUDDY + "Layanan Scan dokumen <b>GRATIS</b> di perpustakaan. Tinggal minta ke meja layanan.",
        "healing":       BUDDY + "Healing Corner adalah tempat untuk me-refresh diri. Kamu bisa pinjam: <b>game, fun card, pensil warna, dan earphone</b>. Tanyain ke Pustakawan ya!",

        // Akademik
        "bebas pustaka": BUDDY + "Surat <b>Bebas Pustaka</b> diperlukan saat wisuda untuk ambil ijazah. Pastikan tidak ada buku yang belum dikembalikan atau denda yang belum dibayar.",
        "wisuda":        BUDDY + "Mau wisuda? Jangan lupa urus <b>Surat Bebas Pustaka</b> dulu! Pastikan tidak ada tanggungan denda/buku.",
        "skripsi":       BUDDY + "Skripsi cetak bisa dikumpulkan ke perpustakaan. Untuk <b>soft file PDF</b>, upload sesuai format panduan via link di bio Instagram perpustakaan.",
        "tugas akhir":   BUDDY + "Tugas akhir cetak diserahkan ke perpustakaan. <b>Soft file</b>-nya upload mandiri via link di bio Instagram perpustakaan.",
        "ta":            BUDDY + "Tugas akhir cetak diserahkan ke perpustakaan. <b>Soft file</b>-nya upload mandiri via link di bio Instagram perpustakaan.",

        // OPAC & Referensi
        "opac":          BUDDY + "OPAC (katalog online) bisa diakses dari gadgetmu di: <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b> atau pakai komputer di perpustakaan.",
        "katalog":       BUDDY + "Cari buku pakai OPAC di <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b> atau komputer perpustakaan.",
        "cari buku":     BUDDY + "Cari buku lewat OPAC di <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b>. Bisa diakses dari HP atau komputer perpustakaan.",
        "koleksi":       BUDDY + "Koleksi perpustakaan bisa ditelusuri lewat OPAC di <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b>. Ada buku, e-book, DVD, dan koleksi referensi.",
        "referensi":     BUDDY + "Koleksi referensi (kamus, ensiklopedia, skripsi) hanya bisa <b>dibaca di tempat</b>, tidak bisa dipinjam pulang.",
        "ebook":         BUDDY + "E-book bisa dipinjam maks <b>3 judul</b> sekaligus selama <b>2 minggu</b>. Tanya ke meja sirkulasi untuk akses.",

        // Program
        "sejarah":       BUDDY + "Dream Blue Library adalah perpustakaan <b>Universitas Internasional Jakarta (JIU)</b>, didukung oleh <b>The Nissi Group</b> dan <b>Dream Blue Foundation</b>.",
        "best member":   BUDDY + "Program <b>Best Member &amp; Reading Ambassador</b> dinilai dari keaktifan, jumlah pinjaman, dan kunjungan setiap akhir semester. Hadiahnya <b>voucher buku</b>!",
        "ambassador":    BUDDY + "<b>Reading Ambassador</b> adalah penghargaan untuk yang paling rajin baca dan berkunjung ke perpustakaan. Hadiah <b>voucher buku</b> menanti!",
        "our daily bread": BUDDY + "<b>Our Daily Bread</b> adalah koleksi renungan rohani yang terbit tiap 3 bulan. Tersedia <b>2 eksemplar</b> dan gratis bagi yang pertama mengambil!",

        // Admin/Pustakawan
        "admin":         BUDDY + "Mau ngobrol langsung sama Pustakawan? Aku sambungkan ya!" + WA_BTN,
        "wa":            BUDDY + "Mau ngobrol langsung sama Pustakawan? Aku sambungkan ya!" + WA_BTN,
        "whatsapp":      BUDDY + "Ini kontak Pustakawan Dream Blue Library:" + WA_BTN,
        "pustakawan":    BUDDY + "Mau ngobrol langsung sama Pustakawan? Aku sambungkan ya!" + WA_BTN,
        "hubungi":       BUDDY + "Mau hubungi Pustakawan? Langsung via WhatsApp:" + WA_BTN,
        "kontak":        BUDDY + "Kontak Pustakawan Dream Blue Library:" + WA_BTN,
        "bantuan":       BUDDY + "Aku siap membantu! Atau kalau butuh bantuan langsung, hubungi Pustakawan:" + WA_BTN,
        "help":          BUDDY + "Saya di sini untuk membantu! Coba tanya soal jam buka, cara pinjam, WiFi, atau fasilitas lainnya.",

        // Default
        "default":       BUDDY + "Ups, kayaknya aku belum tahu jawabannya nih. Coba tanya dengan kata kunci seperti <b>'Jam Buka'</b>, <b>'Denda'</b>, <b>'WiFi'</b>, atau <b>'Cara Pinjam'</b>. Atau hubungi Pustakawan langsung:" + WA_BTN
    };


    // ── UI Helpers ────────────────────────────────────────────
    const getTime = () => new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    // Baca data user dari PHP session (via data attributes)
    const userData = {
        name:       chatbotWindow.dataset.userName    || 'Buddy',
        picture:    chatbotWindow.dataset.userPicture || '',
        loggedIn:   chatbotWindow.dataset.loggedIn    === 'true'
    };

    // Buat avatar HTML untuk user
    const buildUserAvatar = () => {
        if (userData.loggedIn && userData.picture) {
            // Foto profil Google
            return `<div class="msg-avatar msg-avatar-photo">
                      <img src="${userData.picture}" alt="${userData.name}" 
                           style="width:100%;height:100%;object-fit:cover;border-radius:50%;"
                           onerror="this.parentNode.innerHTML='<i class=\'fas fa-user\'></i>'">
                    </div>`;
        }
        // Fallback: initial huruf pertama nama
        const initial = userData.name.charAt(0).toUpperCase();
        return `<div class="msg-avatar" style="background:linear-gradient(135deg,#fbbf24,#f59e0b);color:#fff;font-weight:700;font-size:0.9rem;">${initial}</div>`;
    };

    const createMsg = (message, cls, isTyping = false, isAI = false) => {
        const li = document.createElement('div');
        li.classList.add('chat-msg', cls);

        const time = getTime();

        let content = cls === 'user'
            ? `<div class="msg-wrapper">
                 <div class="msg-text">${message}</div>
                 <div class="msg-time">${time}</div>
               </div>
               ${buildUserAvatar()}`
            : `<div class="msg-avatar" style="background:transparent;">
                 <img src="assets/images/bluebot_mascot.webp" alt="Bot" style="width:100%;height:100%;object-fit:contain;">
               </div>
               <div class="msg-wrapper">
                 <div class="msg-text ${isTyping ? 'typing-bg' : ''}">${message}</div>
                 ${!isTyping ? `<div class="msg-time">${time}</div>` : ''}
               </div>`;

        li.innerHTML = content;
        return li;
    };

    const scrollBottom = () => chatbox.scrollTo({ top: chatbox.scrollHeight, behavior: 'smooth' });

    // ── Pollinations.ai Fallback (100% Gratis, No API Key, No Billing) ─────
    const SYSTEM_CONTEXT = `Kamu adalah BlueBot, asisten perpustakaan Dream Blue Library Universitas Internasional Jakarta. 
Jawab dalam Bahasa Indonesia yang ramah dan singkat. Selalu mulai dengan "Hallo, Buddy! 👋". 
Konteks: perpustakaan JIU, jam buka Senin-Jumat 08-17 & 18-21, Sabtu 08-17, denda Rp1000/hari/buku, 
WiFi M204 sandi HappyCampus!, batas pinjam 5 buku 2 minggu, turnitin gratis, scan gratis, OPAC di lib.jiu.ac/.
Jika tidak tahu, minta hubungi pustakawan WA 6281260173697. Jawab maks 3 kalimat singkat.`;

    const fetchAI = async (message) => {
        const prompt = encodeURIComponent(`${SYSTEM_CONTEXT}\n\nPertanyaan: ${message}`);
        const controller = new AbortController();
        const timeout = setTimeout(() => controller.abort(), 8000); // 8 detik timeout

        try {
            const res = await fetch(`https://text.pollinations.ai/${prompt}`, {
                method: 'GET',
                signal: controller.signal
            });
            clearTimeout(timeout);
            if (!res.ok) throw new Error('Failed');
            const text = await res.text();
            const clean = text.trim();
            if (!clean || clean.length < 5) throw new Error('Empty response');
            return { text: clean, isAI: true };
        } catch {
            clearTimeout(timeout);
            // Selalu fallback ke static — TIDAK ADA biaya apapun
            return { text: botResponses['default'], isAI: false };
        }
    };

    // ── Fuzzy Matching (Levenshtein) — Toleransi Typo ─────────────────
    // Menghitung jumlah perubahan karakter antara dua string
    const levenshtein = (a, b) => {
        if (a === b) return 0;
        if (a.length === 0) return b.length;
        if (b.length === 0) return a.length;
        const dp = Array.from({ length: a.length + 1 }, (_, i) => [
            i, ...Array(b.length).fill(0)
        ]);
        for (let j = 0; j <= b.length; j++) dp[0][j] = j;
        for (let i = 1; i <= a.length; i++) {
            for (let j = 1; j <= b.length; j++) {
                dp[i][j] = a[i-1] === b[j-1]
                    ? dp[i-1][j-1]
                    : 1 + Math.min(dp[i-1][j], dp[i][j-1], dp[i-1][j-1]);
            }
        }
        return dp[a.length][b.length];
    };

    // Cek apakah input "dekat" dengan keyword (toleransi typo)
    const fuzzyMatch = (input, key) => {
        // 1. Exact match dulu (paling cepat)
        if (input.includes(key)) return true;

        // 2. Split input jadi kata-kata, cek tiap kata terhadap keyword
        const inputWords = input.split(/\s+/);
        const keyWords   = key.split(/\s+/);

        if (keyWords.length === 1) {
            // Keyword satu kata: toleransi 1 karakter untuk kata pendek, 2 untuk panjang
            const maxDist = key.length <= 4 ? 1 : 2;
            return inputWords.some(w => levenshtein(w, key) <= maxDist);
        }

        // 3. Keyword multi-kata: cek substring fuzzy pada input
        // Contoh: "cara pnjam" → "cara pinjam"
        const keyJoined = keyWords.join(' ');
        for (let i = 0; i <= inputWords.length - keyWords.length; i++) {
            const slice = inputWords.slice(i, i + keyWords.length).join(' ');
            const maxDist = Math.ceil(keyJoined.length * 0.25); // toleransi 25%
            if (levenshtein(slice, keyJoined) <= maxDist) return true;
        }
        return false;
    };

    // ── Handle Chat ──────────────────────────────────────────
    const handleChat = async (messageText) => {
        const message = typeof messageText === 'string'
            ? messageText.trim()
            : chatInput.value.trim();
        if (!message) return;

        chatInput.value = '';
        chatbox.appendChild(createMsg(message, 'user'));
        scrollBottom();

        // Find local response (exact + fuzzy)
        const lower = message.toLowerCase();
        let localResponse = null;
        for (const key of Object.keys(botResponses)) {
            if (key !== 'default' && fuzzyMatch(lower, key)) {
                localResponse = botResponses[key];
                break;
            }
        }

        // Show typing indicator
        const typingEl = createMsg(
            '<div class="typing-indicator"><span></span><span></span><span></span></div>',
            'bot', true
        );
        setTimeout(() => {
            chatbox.appendChild(typingEl);
            scrollBottom();
        }, 400);

        if (localResponse) {
            // Local answer — fast
            setTimeout(() => {
                chatbox.removeChild(typingEl);
                chatbox.appendChild(createMsg(localResponse, 'bot'));
                scrollBottom();
            }, 900);
        } else {
            // AI fallback
            sendBtn.classList.add('loading');
            const aiResult = await fetchAI(message);
            sendBtn.classList.remove('loading');

            try { chatbox.removeChild(typingEl); } catch (_) {}
            chatbox.appendChild(createMsg(aiResult.text, 'bot', false, aiResult.isAI));
            scrollBottom();
        }
    };

    sendBtn.addEventListener('click', () => handleChat());
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') handleChat();
    });

    // Quick replies
    document.querySelectorAll('.quick-reply-btn').forEach(btn => {
        btn.addEventListener('click', (e) => handleChat(e.target.innerText.replace(/^[^\s]+\s/, '').trim()));
    });
});
