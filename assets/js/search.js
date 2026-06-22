// =====================================================
//  Smart Global Search — i18n-Aware Omnibox
//  Reads the active language from localStorage key
//  'library_lang' (set by dictionary.js)
// =====================================================

// --- Bilingual menu data (EN & ID) ---
const homeDataI18n = {
  en: [
    {
      name: "Opening Hours",
      keywords: ["open", "hour", "time", "schedule", "close"],
      target: "modalHours",
      type: "modal",
      icon: "fa-clock",
      color: "#3b82f6",
      badge: "Info",
    },
    {
      name: "Library Collection",
      keywords: ["collection", "book", "total", "catalog"],
      target: "modalCollection",
      type: "modal",
      icon: "fa-books",
      color: "#8b5cf6",
      badge: "Info",
    },
    {
      name: "Study Rooms",
      keywords: ["room", "study", "facility", "space", "discuss"],
      target: "modalRooms",
      type: "modal",
      icon: "fa-door-open",
      color: "#10b981",
      badge: "Facility",
    },
    {
      name: "Announcements",
      keywords: ["announcement", "notice", "info", "update"],
      target: "announcements",
      type: "section",
      icon: "fa-bullhorn",
      color: "#ef4444",
      badge: "Section",
    },
    {
      name: "News & Articles",
      keywords: ["news", "article", "blog", "post", "story"],
      target: "news",
      type: "section",
      icon: "fa-newspaper",
      color: "#f59e0b",
      badge: "Section",
    },
    {
      name: "Our Network",
      keywords: ["network", "partner", "affiliate", "mitra"],
      target: "networking",
      type: "section",
      icon: "fa-sitemap",
      color: "#06b6d4",
      badge: "Section",
    },
  ],
  id: [
    {
      name: "Jam Operasional",
      keywords: ["jam", "buka", "tutup", "jadwal", "waktu", "operasional"],
      target: "modalHours",
      type: "modal",
      icon: "fa-clock",
      color: "#3b82f6",
      badge: "Info",
    },
    {
      name: "Koleksi Perpustakaan",
      keywords: ["koleksi", "buku", "total", "katalog", "judul"],
      target: "modalCollection",
      type: "modal",
      icon: "fa-books",
      color: "#8b5cf6",
      badge: "Info",
    },
    {
      name: "Ruang Diskusi",
      keywords: ["ruang", "diskusi", "fasilitas", "belajar", "studi"],
      target: "modalRooms",
      type: "modal",
      icon: "fa-door-open",
      color: "#10b981",
      badge: "Fasilitas",
    },
    {
      name: "Pengumuman",
      keywords: ["pengumuman", "info", "pemberitahuan", "update", "notis"],
      target: "announcements",
      type: "section",
      icon: "fa-bullhorn",
      color: "#ef4444",
      badge: "Seksi",
    },
    {
      name: "Berita & Artikel",
      keywords: ["berita", "artikel", "blog", "tulisan", "publikasi"],
      target: "news",
      type: "section",
      icon: "fa-newspaper",
      color: "#f59e0b",
      badge: "Seksi",
    },
    {
      name: "Jaringan Kami",
      keywords: ["jaringan", "mitra", "partner", "afiliasi", "network"],
      target: "networking",
      type: "section",
      icon: "fa-sitemap",
      color: "#06b6d4",
      badge: "Seksi",
    },
  ],
};

// i18n phrases for UI strings
const searchI18n = {
  en: {
    searching: "Searching...",
    searchOpac: (q) => `Search books for "<strong>${q}</strong>" in Library Catalog`,
    opacBadge: "OPAC",
    newsBadge: "News",
    announcementBadge: "Announcement",
    menuBadge: "Menu",
    noResults: "No results found.",
    placeholder: "Search menu...",
  },
  id: {
    searching: "Mencari...",
    searchOpac: (q) => `Cari buku "<strong>${q}</strong>" di Katalog Perpustakaan`,
    opacBadge: "OPAC",
    newsBadge: "Berita",
    announcementBadge: "Pengumuman",
    menuBadge: "Menu",
    noResults: "Tidak ada hasil yang ditemukan.",
    placeholder: "Cari menu...",
  },
};

// Helper: get current language
function getSearchLang() {
  return localStorage.getItem("library_lang") || "en";
}

// Helper: get current menu data
function getHomeData() {
  const lang = getSearchLang();
  return homeDataI18n[lang] || homeDataI18n.en;
}

// Helper: get i18n strings
function getSearchStrings() {
  const lang = getSearchLang();
  return searchI18n[lang] || searchI18n.en;
}

// =====================================================
//  Toggle the search bar open/closed
// =====================================================
function toggleNavSearch() {
  const wrapper = document.getElementById("searchWrapper");
  const input = document.getElementById("navSearchInput");
  const results = document.getElementById("navSearchSuggestions");

  wrapper.classList.toggle("active");

  if (wrapper.classList.contains("active")) {
    // Update placeholder to match current language
    const s = getSearchStrings();
    input.placeholder = s.placeholder;
    input.focus();
  } else {
    input.value = "";
    results.style.display = "none";
    results.innerHTML = "";
  }
}

// =====================================================
//  Main search function — runs on every keystroke
// =====================================================
async function liveSearchHomeNav() {
  const raw = document.getElementById("navSearchInput").value.trim();
  const input = raw.toLowerCase();
  const suggestionBox = document.getElementById("navSearchSuggestions");
  const s = getSearchStrings();
  const homeData = getHomeData();

  suggestionBox.innerHTML = "";

  if (input.length < 1) {
    suggestionBox.style.display = "none";
    return;
  }

  // Show loading state
  suggestionBox.style.display = "flex";
  suggestionBox.innerHTML = `
    <div class="search-loading">
      <i class="fas fa-circle-notch fa-spin"></i>
      <span>${s.searching}</span>
    </div>`;

  let sections = {
    opac: "",
    menu: "",
    news: "",
    announcement: "",
  };

  // ── 1. OPAC Book Search shortcut ──────────────────
  sections.opac = `
    <div class="search-result-item opac-result" onclick="window.open('http://lib.jiu.ac/index.php?keywords=${encodeURIComponent(raw)}', '_blank')">
      <div class="sri-icon-wrap" style="background: rgba(59,130,246,0.12);">
        <i class="fas fa-book" style="color:#3b82f6;"></i>
      </div>
      <div class="sri-body">
        <span class="sri-title">${s.searchOpac(raw)}</span>
        <span class="sri-sub">Library Catalog (OPAC)</span>
      </div>
      <span class="sri-badge" style="background:#dbeafe; color:#1d4ed8;">${s.opacBadge}</span>
    </div>`;

  // ── 2. Navigation / Menu Search ───────────────────
  const matchedMenus = homeData.filter((item) => {
    const nameMatch = item.name.toLowerCase().includes(input);
    const keywordMatch = item.keywords.some((kw) => kw.includes(input));
    return nameMatch || keywordMatch;
  });

  if (matchedMenus.length > 0) {
    matchedMenus.forEach((item) => {
      sections.menu += `
        <div class="search-result-item menu-result" onclick='executeNavigation(${JSON.stringify(item)})'>
          <div class="sri-icon-wrap" style="background: rgba(${hexToRgb(item.color)}, 0.12);">
            <i class="fas ${item.icon}" style="color:${item.color};"></i>
          </div>
          <div class="sri-body">
            <span class="sri-title">${item.name}</span>
            <span class="sri-sub">${item.type === "modal" ? "Quick Access" : "Page Section"}</span>
          </div>
          <span class="sri-badge" style="background:#f1f5f9; color:#475569;">${s.menuBadge}</span>
        </div>`;
    });
  }

  // ── 3. Database Search (AJAX) ─────────────────────
  try {
    const response = await fetch(`api/search_database.php?q=${encodeURIComponent(raw)}`);
    const dbData = await response.json();

    if (dbData.berita && dbData.berita.length > 0) {
      dbData.berita.forEach((b) => {
        sections.news += `
          <div class="search-result-item db-result" onclick="window.location.href='detail-news.php?id=${b.id}'">
            <div class="sri-icon-wrap" style="background: rgba(245,158,11,0.12);">
              <i class="fas fa-newspaper" style="color:#f59e0b;"></i>
            </div>
            <div class="sri-body">
              <span class="sri-title">${b.title}</span>
              <span class="sri-sub">${b.date}</span>
            </div>
            <span class="sri-badge" style="background:#fef9c3; color:#a16207;">${s.newsBadge}</span>
          </div>`;
      });
    }

    if (dbData.pengumuman && dbData.pengumuman.length > 0) {
      dbData.pengumuman.forEach((p) => {
        sections.announcement += `
          <div class="search-result-item db-result" onclick="window.location.href='detail-announcement.php?id=${p.id}'">
            <div class="sri-icon-wrap" style="background: rgba(239,68,68,0.12);">
              <i class="fas fa-bullhorn" style="color:#ef4444;"></i>
            </div>
            <div class="sri-body">
              <span class="sri-title">${p.title}</span>
              <span class="sri-sub">${p.date}</span>
            </div>
            <span class="sri-badge" style="background:#fee2e2; color:#b91c1c;">${s.announcementBadge}</span>
          </div>`;
      });
    }
  } catch (e) {
    console.error("Search DB error:", e);
  }

  // ── Assemble final HTML ───────────────────────────
  const finalHtml =
    sections.opac + sections.menu + sections.news + sections.announcement;

  if (!finalHtml.trim()) {
    suggestionBox.innerHTML = `
      <div class="search-no-result">
        <i class="fas fa-search-minus"></i>
        <span>${s.noResults}</span>
      </div>`;
  } else {
    suggestionBox.innerHTML = finalHtml;
  }
}

// =====================================================
//  Execute navigation action when result is clicked
// =====================================================
function executeNavigation(item) {
  const wrapper = document.getElementById("searchWrapper");
  const input = document.getElementById("navSearchInput");
  const suggestionBox = document.getElementById("navSearchSuggestions");

  wrapper.classList.remove("active");
  input.value = "";
  suggestionBox.style.display = "none";

  if (item.type === "modal") {
    openModal(item.target);
  } else {
    const targetEl = document.getElementById(item.target);
    if (targetEl) {
      const headerOffset = 100;
      const elementPosition = targetEl.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
      window.scrollTo({ top: offsetPosition, behavior: "smooth" });
    }
  }
}

// =====================================================
//  Utility: hex color to rgb string for CSS rgba()
// =====================================================
function hexToRgb(hex) {
  const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  if (!result) return "0,0,0";
  return `${parseInt(result[1], 16)},${parseInt(result[2], 16)},${parseInt(result[3], 16)}`;
}

// =====================================================
//  Enter key: navigate to first menu result
// =====================================================
document.getElementById("navSearchInput")?.addEventListener("keydown", function (e) {
  if (e.key === "Enter") {
    const input = this.value.trim().toLowerCase();
    const homeData = getHomeData();
    const firstMatch = homeData.find(
      (item) =>
        item.name.toLowerCase().includes(input) ||
        item.keywords.some((kw) => kw.includes(input))
    );
    if (firstMatch) {
      executeNavigation(firstMatch);
    } else {
      // Fallback: open OPAC search
      window.open(`http://lib.jiu.ac/index.php?keywords=${encodeURIComponent(this.value.trim())}`, "_blank");
    }
  }
});

// =====================================================
//  Click outside to close search
// =====================================================
document.addEventListener("click", function (event) {
  const wrapper = document.getElementById("searchWrapper");
  if (wrapper && !wrapper.contains(event.target)) {
    wrapper.classList.remove("active");
    const sb = document.getElementById("navSearchSuggestions");
    if (sb) sb.style.display = "none";
  }
});
