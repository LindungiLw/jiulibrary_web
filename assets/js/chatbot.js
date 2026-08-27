document.addEventListener('DOMContentLoaded', () => {
    if (window.chatbotInitialized) return;
    window.chatbotInitialized = true;

    const chatbotTogglers = document.querySelectorAll('.chatbot-toggler');
    const chatbotToggler = chatbotTogglers[0];
    const chatbotWindow = document.querySelector('.chatbot-window');
    const closeBtn = document.querySelector('.close-btn');
    const chatbox = document.querySelector('.chatbox');
    const chatInput = document.querySelector('.chat-input input');
    const sendBtn = document.querySelector('.chat-input button');
    const tooltip = document.querySelector('.chatbot-tooltip');

    if (!chatbotTogglers.length || !chatbotWindow) return;

    // ── Tooltip ─────────────────────────────────────────────
    if (tooltip) {
        const getTooltipMessages = () => {
            const lang = localStorage.getItem("library_lang") || "en";
            if (lang === 'en') {
                return [
                    dict["en"]["botTooltip"],
                    "Looking for a book? Ask me! 📚",
                    "Need info on hours or fines? Here! 😊",
                    "Don't forget to check our new collections! 🌟"
                ];
            }
            return [
                dict["id"]["botTooltip"],
                "Cari buku? Yuk tanya aku! 📚",
                "Butuh info jam buka atau denda? Sini! 😊",
                "Jangan lupa cek koleksi terbaru! 🌟"
            ];
        };
        let tipIdx = 0;
        const showTooltip = (text, dur = 5500) => {
            if (chatbotWindow.classList.contains('active')) return;
            tooltip.innerText = text;
            tooltip.classList.add('show');
            setTimeout(() => tooltip.classList.remove('show'), dur);
        };
        setTimeout(() => showTooltip(getTooltipMessages()[0], 6000), 2500);
        setInterval(() => {
            const msgs = getTooltipMessages();
            tipIdx = (tipIdx + 1) % msgs.length;
            showTooltip(msgs[tipIdx], 5500);
        }, 30000);
    }

    // ── Open / Close ─────────────────────────────────────────
    const openChatbot = () => {
        chatbotWindow.classList.add('active');
        if (tooltip) tooltip.classList.remove('show');
        chatbotTogglers.forEach(t => {
            if (t.querySelector('img')) {
                t.innerHTML = '<i class="fas fa-times"></i>';
            }
        });
    };
    const closeChatbot = () => {
        chatbotWindow.classList.remove('active');
        chatbotTogglers.forEach(t => {
            if (t.querySelector('i.fa-times')) {
                t.innerHTML = '<div class="chatbot-tooltip"></div><img src="assets/images/bluebot_mascot.webp" alt="BlueBot" style="width:100%;height:100%;object-fit:contain;filter:drop-shadow(0 4px 8px rgba(0,0,0,0.25));transition:opacity .3s;">';
            }
        });
    };

    chatbotTogglers.forEach(t => {
        t.addEventListener('click', (e) => {
            e.stopPropagation();
            chatbotWindow.classList.contains('active') ? closeChatbot() : openChatbot();
        });
    });
    if (closeBtn) closeBtn.addEventListener('click', closeChatbot);

    // Click outside
    document.addEventListener('click', (e) => {
        if (chatbotWindow.classList.contains('active') &&
            !chatbotWindow.contains(e.target)) {
            let clickedToggler = false;
            chatbotTogglers.forEach(t => { if (t.contains(e.target)) clickedToggler = true; });
            if (!clickedToggler) closeChatbot();
        }
    });

    // Hover tooltip (desktop only)
    if (window.matchMedia && window.matchMedia('(hover: hover)').matches && tooltip) {
        chatbotTogglers.forEach(t => {
            t.addEventListener('mouseenter', () => {
                if (!chatbotWindow.classList.contains('active')) {
                    tooltip.classList.add('show');
                }
            });
            t.addEventListener('mouseleave', () => {
                tooltip.classList.remove('show');
            });
        });
    }

    // ── Response Database (Local) ─────────────────────────────
    const BUDDY = "Hallo, Buddy! 👋 ";
    const WA_BTN = `<br><a href='https://wa.me/6281260173697' target='_blank' style='display:inline-flex;align-items:center;gap:6px;margin-top:10px;padding:8px 16px;background:#25D366;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem;'><i class='fab fa-whatsapp'></i> Chat Pustakawan</a>`;
    const WA_BTN_EN = `<br><a href='https://wa.me/6281260173697' target='_blank' style='display:inline-flex;align-items:center;gap:6px;margin-top:10px;padding:8px 16px;background:#25D366;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem;'><i class='fab fa-whatsapp'></i> Chat with Librarian</a>`;
    const SUBMIT_BTN = `<br><a href='#' onclick='window.scrollTo({top:0, behavior:"smooth"}); return false;' style='display:inline-flex;align-items:center;gap:6px;margin-top:10px;padding:8px 16px;background:#3b82f6;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem;box-shadow:0 2px 4px rgba(59,130,246,0.3);'><i class='fas fa-arrow-up'></i> Ke Menu Submit</a>`;
    const SUBMIT_BTN_EN = `<br><a href='#' onclick='window.scrollTo({top:0, behavior:"smooth"}); return false;' style='display:inline-flex;align-items:center;gap:6px;margin-top:10px;padding:8px 16px;background:#3b82f6;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:.9rem;box-shadow:0 2px 4px rgba(59,130,246,0.3);'><i class='fas fa-arrow-up'></i> Open Submit Menu</a>`;

    const botResponses = {
        id: {
            "halo": BUDDY + "Senang kamu di sini! Mau tanya soal apa hari ini?",
            "hai": BUDDY + "Senang kamu di sini! Mau tanya soal apa hari ini?",
            "hi": BUDDY + "Hi! Ada yang bisa saya bantu?",
            "hello": BUDDY + "Welcome to Dream Blue Library! Ada yang bisa dibantu?",
            "hey": BUDDY + "Hey! Ada yang bisa dibantu hari ini?",
            "pagi": BUDDY + "Selamat pagi! Semangat ya hari ini. Ada yang bisa dibantu?",
            "siang": BUDDY + "Selamat siang! Ada pertanyaan seputar perpustakaan?",
            "sore": BUDDY + "Selamat sore! Ada yang bisa dibantu sebelum perpustakaan tutup?",
            "terima kasih": BUDDY + "Sama-sama! Senang bisa membantu. Jangan ragu balik lagi ya!",
            "makasih": BUDDY + "Sama-sama! Semoga informasinya bermanfaat.",
            "tanya": BUDDY + "Boleh banget! Mau tanya soal apa? Jam buka, denda, WiFi, atau yang lain?",
            "jam buka": BUDDY + "Ini jadwal Dream Blue Library:<br>&bull; <b>Senin–Jumat:</b> 08.00–17.00 &amp; 18.00–21.00<br>&bull; <b>Sabtu:</b> 08.00–17.00<br>&bull; <b>Hari Besar/Tanggal Merah:</b> Tutup",
            "operasional": BUDDY + "Jadwal buka perpustakaan:<br>&bull; <b>Senin–Jumat:</b> 08.00–17.00 &amp; 18.00–21.00<br>&bull; <b>Sabtu:</b> 08.00–17.00<br>&bull; <b>Hari Besar:</b> Tutup",
            "jadwal": BUDDY + "Jadwal buka perpustakaan:<br>&bull; <b>Senin–Jumat:</b> 08.00–17.00 &amp; 18.00–21.00<br>&bull; <b>Sabtu:</b> 08.00–17.00<br>&bull; <b>Hari Besar:</b> Tutup",
            "buka": BUDDY + "Jadwal buka perpustakaan:<br>&bull; <b>Senin–Jumat:</b> 08.00–17.00 &amp; 18.00–21.00<br>&bull; <b>Sabtu:</b> 08.00–17.00<br>&bull; <b>Hari Besar:</b> Tutup",
            "cara pinjam": BUDDY + "Mudah banget! Semua mahasiswa <b>otomatis jadi anggota</b>. Cukup bawa KTM ke meja sirkulasi.<br>&bull; Maks: <b>5 buku + 5 DVD + 3 e-book</b><br>&bull; Durasi: <b>2 minggu</b>",
            "pinjam": BUDDY + "Kamu bisa pinjam maks <b>5 buku fisik, 5 DVD, dan 3 e-book</b> selama <b>2 minggu</b>. Bawa KTM ke meja sirkulasi ya!",
            "maksimal": BUDDY + "Batas pinjam: <b>5 buku fisik, 5 DVD, 3 e-book</b> selama <b>2 minggu</b>.",
            "berapa buku": BUDDY + "Kamu boleh pinjam maksimal <b>5 buku fisik, 5 DVD, dan 3 e-book</b> dalam sekali peminjaman.",
            "berapa lama": BUDDY + "Durasi peminjaman adalah <b>2 minggu (14 hari)</b>. Kalau mau diperpanjang, tanyain ke meja sirkulasi ya!",
            "denda": BUDDY + "Perhatikan ya, Buddy!<br>&bull; Keterlambatan: <b>Rp 1.000/hari/buku</b><br>&bull; Rusak ringan: biaya perbaikan + <b>denda 20%</b><br>&bull; Rusak parah/hilang: <b>ganti buku yang sama</b> atau bayar <b>100% harga baru</b>",
            "terlambat": BUDDY + "Denda keterlambatan adalah <b>Rp 1.000/hari/buku</b>. Jadi jangan sampai telat mengembalikan ya!",
            "telat": BUDDY + "Denda keterlambatan adalah <b>Rp 1.000/hari/buku</b>. Jadi jangan sampai telat mengembalikan ya!",
            "hilang": BUDDY + "Kalau buku hilang, harus diganti dengan buku yang sama atau membayar <b>100% harga buku baru</b>. Jaga bukunya baik-baik ya!",
            "rusak": BUDDY + "Buku rusak ringan dikenakan biaya perbaikan + <b>denda 20%</b>. Kalau rusak parah, harus <b>ganti buku baru</b> yang sama. Hati-hati ya!",
            "tas": BUDDY + "Tas <b>tidak boleh dibawa masuk</b> ke ruang baca. Simpan di loker dulu — kunci loker bisa dipinjam gratis di meja sirkulasi.",
            "loker": BUDDY + "Tersedia <b>42 loker</b> yang bisa kamu pakai secara gratis. Kunci dipinjam di area sirkulasi.",
            "makan": BUDDY + "Makanan dan minuman berwarna/berasa <b>tidak diperbolehkan</b> masuk ke perpustakaan. Hanya <b>air mineral</b> yang boleh dibawa.",
            "minum": BUDDY + "Hanya <b>air mineral</b> yang boleh dibawa masuk. Minuman berwarna/berasa tidak diperbolehkan ya.",
            "wifi": BUDDY + "Info WiFi perpustakaan:<br>&bull; Nama: <b>M204 (Library)</b><br>&bull; Sandi: <b>HappyCampus!</b>",
            "password": BUDDY + "Password WiFi perpustakaan: <b>HappyCampus!</b> (Jaringan: M204 Library)",
            "sandi": BUDDY + "Sandi WiFi perpustakaan: <b>HappyCampus!</b> (Jaringan: M204 Library)",
            "internet": BUDDY + "Sambung ke WiFi <b>M204 (Library)</b>, sandinya: <b>HappyCampus!</b>",
            "ac": BUDDY + "Suhu AC diatur sekitar <b>20–25°C</b>. Tolong jangan diubah sendiri tanpa izin pustakawan ya.",
            "study room": BUDDY + "Study Room bisa dipesan di meja sirkulasi untuk diskusi, rapat, konseling, atau rekam Zoom.<br>Catatan: <b>dilarang makan</b> di dalam dan <b>matikan AC &amp; lampu</b> setelah selesai.",
            "ruang": BUDDY + "Study Room bisa dipesan di meja sirkulasi untuk diskusi, rapat, atau rekam Zoom.",
            "turnitin": BUDDY + "Layanan cek Turnitin <b>GRATIS</b> untuk civitas!<br>&bull; Kirim: <b>PDF/Word</b> (abstrak sampai kesimpulan)<br>&bull; Hasil: <b>1–2 hari kerja</b><br>&bull; Maks: <b>1 dokumen/hari/orang</b>",
            "cek plagiat": BUDDY + "Cek plagiat (Turnitin) <b>GRATIS</b> untuk civitas JIU. Kirim dokumen PDF/Word ke Pustakawan. Hasil dalam <b>1–2 hari kerja</b>. Maks 1 dokumen/hari.",
            "plagiat": BUDDY + "Cek plagiat (Turnitin) <b>GRATIS</b> untuk civitas JIU. Hubungi pustakawan untuk mengirimkan dokumenmu.",
            "print": BUDDY + "Layanan cetak:<br>&bull; Print/Fotokopi: <b>Rp 300/lembar (1 sisi)</b> — <b>Rp 500 (bolak-balik)</b><br>&bull; Kertas kosong: Rp 100<br>&bull; Scan: <b>GRATIS</b>",
            "fotokopi": BUDDY + "Fotokopi: <b>Rp 300/lembar (1 sisi)</b> atau <b>Rp 500 (bolak-balik)</b>. Scan dokumen <b>GRATIS</b> ya!",
            "scan": BUDDY + "Layanan Scan dokumen <b>GRATIS</b> di perpustakaan. Tinggal minta ke meja layanan.",
            "healing": BUDDY + "Healing Corner adalah tempat untuk me-refresh diri. Kamu bisa pinjam: <b>game, fun card, pensil warna, dan earphone</b>. Tanyain ke Pustakawan ya!",
            "bebas pustaka": BUDDY + "Surat <b>Bebas Pustaka</b> diperlukan saat wisuda untuk ambil ijazah. Pastikan tidak ada buku yang belum dikembalikan atau denda yang belum dibayar.",
            "wisuda": BUDDY + "Mau wisuda? Jangan lupa urus <b>Surat Bebas Pustaka</b> dulu! Pastikan tidak ada tanggungan denda/buku.",
            "skripsi": BUDDY + "Skripsi cetak bisa dikumpulkan ke perpustakaan. Untuk <b>soft file PDF</b>, silakan kumpulkan melalui menu Submit di navbar atas." + SUBMIT_BTN,
            "tugas akhir": BUDDY + "Tugas akhir cetak diserahkan ke perpustakaan. <b>Soft file</b>-nya silakan upload melalui menu Submit di navbar atas." + SUBMIT_BTN,
            "ta": BUDDY + "Tugas akhir cetak diserahkan ke perpustakaan. <b>Soft file</b>-nya silakan upload melalui menu Submit di navbar atas." + SUBMIT_BTN,
            "opac": BUDDY + "OPAC (katalog online) bisa diakses dari gadgetmu di: <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b> atau pakai komputer di perpustakaan.",
            "katalog": BUDDY + "Cari buku pakai OPAC di <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b> atau komputer perpustakaan.",
            "cari buku": BUDDY + "Cari buku lewat OPAC di <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b>. Bisa diakses dari HP atau komputer perpustakaan.",
            "koleksi": BUDDY + "Koleksi perpustakaan bisa ditelusuri lewat OPAC di <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b>. Ada buku, e-book, DVD, dan koleksi referensi.",
            "referensi": BUDDY + "Koleksi referensi (kamus, ensiklopedia, skripsi) hanya bisa <b>dibaca di tempat</b>, tidak bisa dipinjam pulang.",
            "ebook": BUDDY + "E-book bisa dipinjam maks <b>3 judul</b> sekaligus selama <b>2 minggu</b>. Tanya ke meja sirkulasi untuk akses.",
            "sejarah": BUDDY + "Dream Blue Library adalah perpustakaan <b>Universitas Internasional Jakarta (JIU)</b>, didukung oleh <b>The Nissi Group</b> dan <b>Dream Blue Foundation</b>.",
            "best member": BUDDY + "Program <b>Best Member &amp; Reading Ambassador</b> dinilai dari keaktifan, jumlah pinjaman, dan kunjungan setiap akhir semester. Hadiahnya <b>voucher buku</b>!",
            "ambassador": BUDDY + "<b>Reading Ambassador</b> adalah penghargaan untuk yang paling rajin baca dan berkunjung ke perpustakaan. Hadiah <b>voucher buku</b> menanti!",
            "our daily bread": BUDDY + "<b>Our Daily Bread</b> adalah koleksi renungan rohani yang terbit tiap 3 bulan. Tersedia <b>2 eksemplar</b> dan gratis bagi yang pertama mengambil!",
            "admin": BUDDY + "Mau ngobrol langsung sama Pustakawan? Aku sambungkan ya!" + WA_BTN,
            "wa": BUDDY + "Mau ngobrol langsung sama Pustakawan? Aku sambungkan ya!" + WA_BTN,
            "whatsapp": BUDDY + "Ini kontak Pustakawan Dream Blue Library:" + WA_BTN,
            "pustakawan": BUDDY + "Mau ngobrol langsung sama Pustakawan? Aku sambungkan ya!" + WA_BTN,
            "hubungi": BUDDY + "Mau hubungi Pustakawan? Langsung via WhatsApp:" + WA_BTN,
            "kontak": BUDDY + "Kontak Pustakawan Dream Blue Library:" + WA_BTN,
            "bantuan": BUDDY + "Aku siap membantu! Atau kalau butuh bantuan langsung, hubungi Pustakawan:" + WA_BTN,
            "help": BUDDY + "Saya di sini untuk membantu! Coba tanya soal jam buka, cara pinjam, WiFi, atau fasilitas lainnya.",
            "default": BUDDY + "Ups, kayaknya aku belum tahu jawabannya nih. Coba tanya dengan kata kunci seperti <b>'Jam Buka'</b>, <b>'Denda'</b>, <b>'WiFi'</b>, atau <b>'Cara Pinjam'</b>. Atau hubungi Pustakawan langsung:" + WA_BTN
        },
        en: {
            "hello": BUDDY + "Welcome to Dream Blue Library! How can I help you?",
            "hi": BUDDY + "Hi! How can I help you?",
            "hey": BUDDY + "Hey! How can I help you today?",
            "morning": BUDDY + "Good morning! How can I assist you?",
            "afternoon": BUDDY + "Good afternoon! Any questions about the library?",
            "thank you": BUDDY + "You're welcome! Happy to help. Come back anytime!",
            "thanks": BUDDY + "You're welcome! Hope that was helpful.",
            "ask": BUDDY + "Sure! What would you like to ask? Hours, fine, WiFi, or anything else?",
            "open": BUDDY + "Here are our hours:<br>&bull; <b>Mon–Fri:</b> 08:00–17:00 &amp; 18:00–21:00<br>&bull; <b>Sat:</b> 08:00–17:00<br>&bull; <b>Holidays:</b> Closed",
            "hours": BUDDY + "Library hours:<br>&bull; <b>Mon–Fri:</b> 08:00–17:00 &amp; 18:00–21:00<br>&bull; <b>Sat:</b> 08:00–17:00<br>&bull; <b>Holidays:</b> Closed",
            "schedule": BUDDY + "Library schedule:<br>&bull; <b>Mon–Fri:</b> 08:00–17:00 &amp; 18:00–21:00<br>&bull; <b>Sat:</b> 08:00–17:00<br>&bull; <b>Holidays:</b> Closed",
            "borrow": BUDDY + "It's easy! All students are <b>automatically members</b>. Just bring your ID to the circulation desk.<br>&bull; Max: <b>5 books + 5 DVDs + 3 e-books</b><br>&bull; Duration: <b>2 weeks</b>",
            "how to borrow": BUDDY + "It's easy! Just bring your student ID to the circulation desk.<br>&bull; Max: <b>5 books + 5 DVDs + 3 e-books</b><br>&bull; Duration: <b>2 weeks</b>",
            "maximum": BUDDY + "Borrowing limit: <b>5 physical books, 5 DVDs, 3 e-books</b> for <b>2 weeks</b>.",
            "how many": BUDDY + "You can borrow up to <b>5 physical books, 5 DVDs, and 3 e-books</b> per checkout.",
            "how long": BUDDY + "The borrowing duration is <b>2 weeks (14 days)</b>. If you need an extension, ask the circulation desk!",
            "fine": BUDDY + "Please note, Buddy!<br>&bull; Late fee: <b>Rp 1,000/day/book</b><br>&bull; Minor damage: repair cost + <b>20% fine</b><br>&bull; Lost/Severe damage: <b>replace with the same book</b> or pay <b>100% of new price</b>",
            "late": BUDDY + "Late fee is <b>Rp 1,000/day/book</b>. Make sure to return on time!",
            "penalty": BUDDY + "Late fee is <b>Rp 1,000/day/book</b>. Make sure to return on time!",
            "lost": BUDDY + "If a book is lost, you must replace it with the same book or pay <b>100% of a new book's price</b>. Take good care of them!",
            "broken": BUDDY + "Minor damage incurs repair costs + <b>20% fine</b>. Severe damage requires <b>replacing with a new book</b>. Be careful!",
            "bag": BUDDY + "Bags are <b>not allowed</b> in the reading area. Store them in lockers — you can borrow keys for free at the circulation desk.",
            "locker": BUDDY + "There are <b>42 lockers</b> available for free. Borrow the key at the circulation area.",
            "eat": BUDDY + "Food and colored/flavored drinks are <b>not allowed</b>. Only <b>mineral water</b> is permitted.",
            "drink": BUDDY + "Only <b>mineral water</b> is allowed. Colored/flavored drinks are prohibited.",
            "wifi": BUDDY + "Library WiFi info:<br>&bull; Name: <b>M204 (Library)</b><br>&bull; Password: <b>HappyCampus!</b>",
            "password": BUDDY + "Library WiFi Password: <b>HappyCampus!</b> (Network: M204 Library)",
            "internet": BUDDY + "Connect to WiFi <b>M204 (Library)</b>, password: <b>HappyCampus!</b>",
            "ac": BUDDY + "AC temperature is set around <b>20–25°C</b>. Please do not change it without permission from the librarian.",
            "study room": BUDDY + "Study Room can be booked at the circulation desk for discussions, meetings, counseling, or Zoom recordings.<br>Note: <b>no eating</b> inside and <b>turn off AC &amp; lights</b> when done.",
            "room": BUDDY + "Study Room can be booked at the circulation desk for discussions, meetings, or Zoom recordings.",
            "turnitin": BUDDY + "Turnitin check is <b>FREE</b> for JIU community!<br>&bull; Send: <b>PDF/Word</b> (abstract to conclusion)<br>&bull; Result: <b>1–2 working days</b><br>&bull; Max: <b>1 document/day/person</b>",
            "plagiarism": BUDDY + "Turnitin check is <b>FREE</b> for JIU community. Send your PDF/Word to the Librarian. Results in <b>1–2 working days</b>. Max 1 doc/day.",
            "print": BUDDY + "Printing services:<br>&bull; Print/Copy: <b>Rp 300/page (1 side)</b> — <b>Rp 500 (double-sided)</b><br>&bull; Blank paper: Rp 100<br>&bull; Scan: <b>FREE</b>",
            "copy": BUDDY + "Copy: <b>Rp 300/page (1 side)</b> or <b>Rp 500 (double-sided)</b>. Document scanning is <b>FREE</b>!",
            "scan": BUDDY + "Document scanning is <b>FREE</b> at the library. Just ask the service desk.",
            "healing": BUDDY + "Healing Corner is a place to refresh yourself. You can borrow: <b>games, fun cards, colored pencils, and earphones</b>. Just ask the Librarian!",
            "clearance": BUDDY + "A <b>Library Clearance</b> letter is required for graduation to get your diploma. Make sure you have no unreturned books or unpaid fines.",
            "graduation": BUDDY + "Graduating? Don't forget to get your <b>Library Clearance</b> letter! Ensure you have no outstanding books/fines.",
            "thesis": BUDDY + "Printed theses can be submitted to the library. For <b>PDF soft files</b>, please upload them via the Submit menu in the top navbar." + SUBMIT_BTN_EN,
            "opac": BUDDY + "OPAC (online catalog) can be accessed from your gadget at: <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b> or using computers in the library.",
            "catalog": BUDDY + "Search for books using OPAC at <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b> or library computers.",
            "search book": BUDDY + "Search for books via OPAC at <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b>. Accessible from phone or library computers.",
            "collection": BUDDY + "Library collections can be searched via OPAC at <b><a href='http://lib.jiu.ac/' target='_blank'>lib.jiu.ac</a></b>. We have books, e-books, DVDs, and reference collections.",
            "reference": BUDDY + "Reference collections (dictionaries, encyclopedias, theses) can only be <b>read in place</b>, they cannot be borrowed.",
            "ebook": BUDDY + "You can borrow up to <b>3 e-books</b> at a time for <b>2 weeks</b>. Ask the circulation desk for access.",
            "history": BUDDY + "Dream Blue Library is the library of <b>Jakarta International University (JIU)</b>, supported by <b>The Nissi Group</b> and <b>Dream Blue Foundation</b>.",
            "best member": BUDDY + "The <b>Best Member &amp; Reading Ambassador</b> program is evaluated based on activity, loans, and visits at the end of each semester. Prize: <b>book vouchers</b>!",
            "ambassador": BUDDY + "<b>Reading Ambassador</b> is an award for the most diligent readers and visitors. <b>Book vouchers</b> await!",
            "our daily bread": BUDDY + "<b>Our Daily Bread</b> is a spiritual devotional collection published every 3 months. <b>2 copies</b> are available for free for the first ones to grab!",
            "admin": BUDDY + "Want to chat directly with a Librarian? I'll connect you!" + WA_BTN_EN,
            "wa": BUDDY + "Want to chat directly with a Librarian? I'll connect you!" + WA_BTN_EN,
            "whatsapp": BUDDY + "Here is the contact for Dream Blue Library's Librarian:" + WA_BTN_EN,
            "librarian": BUDDY + "Want to chat directly with a Librarian? I'll connect you!" + WA_BTN_EN,
            "contact": BUDDY + "Contact the Dream Blue Library Librarian:" + WA_BTN_EN,
            "help": BUDDY + "I'm here to help! Try asking about hours, how to borrow, WiFi, or other facilities.",
            "default": BUDDY + "Oops, it seems I don't know the answer to that. Try keywords like <b>'Hours'</b>, <b>'Fine'</b>, <b>'WiFi'</b>, or <b>'Borrow'</b>. Or contact the Librarian directly:" + WA_BTN_EN
        }
    };

    // ── UI Helpers ────────────────────────────────────────────
    const getTime = () => new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

    // Baca data user dari PHP session (via data attributes)
    const userData = {
        name: chatbotWindow.dataset.userName || 'Buddy',
        picture: chatbotWindow.dataset.userPicture || '',
        loggedIn: chatbotWindow.dataset.loggedIn === 'true'
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
    const getSystemContext = (lang) => {
        if (lang === 'en') {
            return `You are BlueBot, the library assistant for Dream Blue Library at Jakarta International University. 
Answer in English. Be friendly and concise. Always start with "Hello, Buddy! 👋". 
Context: JIU library, hours Mon-Fri 08-17 & 18-21, Sat 08-17, late fine Rp1000/day/book, 
WiFi M204 password HappyCampus!, borrow limit 5 books for 2 weeks, free Turnitin, free scanning, OPAC at lib.jiu.ac/.
If you don't know, ask them to contact the librarian at WA +6281260173697. Max 3 short sentences.`;
        }
        return `Kamu adalah BlueBot, asisten perpustakaan Dream Blue Library Universitas Internasional Jakarta. 
Jawab dalam Bahasa Indonesia yang ramah dan singkat. Selalu mulai dengan "Hallo, Buddy! 👋". 
Konteks: perpustakaan JIU, jam buka Senin-Jumat 08-17 & 18-21, Sabtu 08-17, denda Rp1000/hari/buku, 
WiFi M204 sandi HappyCampus!, batas pinjam 5 buku 2 minggu, turnitin gratis, scan gratis, OPAC di lib.jiu.ac/.
Jika tidak tahu, minta hubungi pustakawan WA 6281260173697. Jawab maks 3 kalimat singkat.`;
    };

    const fetchAI = async (message) => {
        const lang = localStorage.getItem("preferredLang") || "en";
        const prompt = encodeURIComponent(`${getSystemContext(lang)}\n\nQuery: ${message}`);
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
            return { text: botResponses[lang]['default'], isAI: false };
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
                dp[i][j] = a[i - 1] === b[j - 1]
                    ? dp[i - 1][j - 1]
                    : 1 + Math.min(dp[i - 1][j], dp[i][j - 1], dp[i - 1][j - 1]);
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
        const keyWords = key.split(/\s+/);

        if (keyWords.length === 1) {
            // Keyword satu kata: toleransi 1 karakter untuk kata dengan panjang > 5
            const maxDist = key.length > 5 ? 1 : 0;
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
    const getResponse = (input) => {
        const lang = localStorage.getItem('library_lang') || 'en';
        const responses = botResponses[lang] || botResponses.en;

        let cleaned = input.toLowerCase()
            .replace(/[^\w\s]/g, '')
            .trim();

        // Cek exact match dulu
        if (responses[cleaned]) return responses[cleaned];

        // Cek partial match (keyword)
        for (const [key, value] of Object.entries(responses)) {
            if (key !== 'default' && cleaned.includes(key)) {
                return value;
            }
        }
        return responses['default'];
    };

    const handleChat = async (messageText) => {
        const message = typeof messageText === 'string'
            ? messageText.trim()
            : chatInput.value.trim();
        if (!message) return;

        chatInput.value = '';
        chatbox.appendChild(createMsg(message, 'user'));
        scrollBottom();

        // 1. Cari exact match (substring) terlebih dahulu
        const lang = localStorage.getItem("preferredLang") || "en";
        const currentResponses = botResponses[lang] || botResponses['en'];

        const lower = message.toLowerCase();
        let bestMatch = null;
        for (const key of Object.keys(currentResponses)) {
            if (key !== 'default' && lower.includes(key)) {
                // Pilih keyword terpanjang (misal "jam buka" menang lawan "buka")
                if (!bestMatch || key.length > bestMatch.length) {
                    bestMatch = key;
                }
            }
        }

        let localResponse = null;
        if (bestMatch) {
            localResponse = currentResponses[bestMatch];
        } else {
            // 2. Kalau tidak ada exact match, gunakan fuzzy match yang lebih strict
            for (const key of Object.keys(currentResponses)) {
                if (key !== 'default' && fuzzyMatch(lower, key)) {
                    localResponse = currentResponses[key];
                    break;
                }
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

            try { chatbox.removeChild(typingEl); } catch (_) { }
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
