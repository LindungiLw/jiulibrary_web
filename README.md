<div align="center">

<img src="assets/images/library-logo.webp" alt="Dream Blue Library logo" width="120">

# Dream Blue Library

**Literacy Freely, Legacy Fully**

Official website of Dream Blue Library — the academic library of
**Jakarta International University (JIU)**, Deltamas, Cikarang, West Java, Indonesia.

![PHP](https://img.shields.io/badge/PHP-vanilla-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-PDO-4479A1?logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-no%20framework-F7DF1E?logo=javascript&logoColor=black)
![License](https://img.shields.io/badge/License-MIT-green)

</div>

---

A bilingual (English/Indonesian) library website built with plain PHP, MySQL, and
vanilla JavaScript — no framework, no build step. It features the **BlueBot** AI
chatbot, Google SSO for institutional members, OPAC and digital-library
integration, a full accessibility toolkit, and a custom responsive design system.

## ✨ Features

### For visitors
- **News & Announcements** — homepage sliders and bento grid fed from MySQL, with listing pages, detail pages, and a reading-progress bar
- **Global live search** — one omnibox that searches the site menu (bilingual index), news/announcements in the database (AJAX + JSON API), and shortcuts to the OPAC catalog
- **Service pages** — circulation rules, research consultation booking, digital collection guide, print/scan pricelist, Turnitin check workflow, and opening hours rendered from the database
- **About pages** — library history with milestone timeline, vision & mission, interactive organizational chart with profile modals, and a downloadable floor plan
- **Healing Corner** — embedded PDF presenting the student well-being space
- **FAQ** — accordion with live client-side search

### BlueBot chatbot 🤖
- Floating widget with a bilingual (EN/ID) FAQ knowledge base
- Typo-tolerant matching (longest-keyword + Levenshtein distance)
- AI fallback for unmatched questions, quick-reply chips, typing indicator, and a WhatsApp deep link to a librarian

### For JIU members
- **Google SSO login** (Google Identity Services) restricted to institutional accounts
- Role-based access — the *JIU Member* role unlocks Journal Reference, Repository, DVD collection, and academic-work submission (thesis, research paper, final project, internship report, portfolio)
- Profile page with Google-synced avatar and CSRF-protected name editing

### Accessibility & i18n ♿
- Accessibility widget: high contrast, large text, dyslexia-friendly font, link highlighting, and click-to-listen **text-to-speech** (Web Speech API, EN/ID voices)
- Full EN/ID language switcher via a custom `data-i18n` dictionary ([assets/js/dictionary.js](assets/js/dictionary.js)), persisted in `localStorage`

### Performance
- WebP images, self-hosted preloaded fonts (Poppins & Pretendard), deferred CSS, lazy YouTube facade, `IntersectionObserver`-driven counters and marquees

## 🛠️ Tech stack

| Layer     | Technology |
|-----------|------------|
| Backend   | PHP (vanilla, server-rendered) + PDO prepared statements |
| Database  | MySQL / MariaDB |
| Frontend  | Vanilla JavaScript, custom CSS design system (tokens + 6 responsive breakpoints) |
| Libraries | Swiper.js, AOS, Font Awesome |
| Auth      | Google Identity Services (institutional SSO) |
| AI        | BlueBot chatbot with free text-generation API fallback |

## 🚀 Getting started

The repository contains the **public-facing site only**. Credentials, the admin
panel (`admin/`), the login/register flow (`assets/auth/`), and the AI proxy are
excluded via `.gitignore`, so a fresh clone needs a few files created by hand.

### 1. Requirements
- [XAMPP](https://www.apachefriends.org/) (Apache + PHP + MySQL) or any equivalent LAMP stack

### 2. Clone into your web root
```bash
cd /path/to/xampp/htdocs
git clone https://github.com/<your-username>/dream-blue-library-website.git
```

### 3. Create the database
Create a MySQL database and the tables below (no `.sql` dump is shipped —
column names are inferred from the queries in the code):

| Table                | Key columns |
|----------------------|-------------|
| `berita` (news)      | `id`, `judul`, `kategori`, `tanggal`, `isi`, `gambar` |
| `pengumuman` (announcements) | `id`, `judul`, `kategori`, `tanggal`, `isi`, `gambar` |
| `opening_hours`      | `id`, `day_name_en`, `day_name_id`, `is_closed`, `time_pagi`, `time_siang`, `time_malam` |
| `organization_staff` | `name`, `role`, `email`, `photo`, `position_code`, `position_name` |
| `users`              | `id`, `name`, … (populated by the Google login flow) |

### 4. Create the untracked config files
**`koneksi.php`** — must expose a `getKoneksi()` function returning a PDO connection:

```php
<?php
function getKoneksi(): PDO {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=YOUR_DATABASE;charset=utf8mb4',
        'YOUR_DB_USER',
        'YOUR_DB_PASSWORD'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
```

**`config.php`** — must define at least:

```php
<?php
define('BASE_URL', 'http://localhost/dream-blue-library-website');
define('GOOGLE_CLIENT_ID', 'your-client-id.apps.googleusercontent.com');
```

### 5. Run
Start Apache + MySQL in XAMPP and open:

```
http://localhost/dream-blue-library-website/index.php
```

> **Note:** Google sign-in requires a valid OAuth Client ID from the
> [Google Cloud Console](https://console.cloud.google.com/) and the login
> callback handled in the untracked `assets/auth/` folder — visitor-facing pages
> work without it.

## 📁 Project structure

```
├── index.php                  # Homepage (hero, stats, news, announcements, partners)
├── navbar.php / footer.php    # Shared layout includes
├── about.php, vision-mision.php, organizational-structure.php, library-map.php
├── all-news.php, all-announcements.php, detail-news.php, detail-announcement.php
├── service-*.php              # Circulation, consultation, digital, print/scan, Turnitin, hours
├── fqa.php                    # FAQ with live search
├── healingcorner.html         # Healing Corner (embedded PDF)
├── profile.php, update_profile.php
├── chatbot-widget.php         # BlueBot chatbot UI
├── a11y-widget.php            # Accessibility widget
├── api/
│   └── search_database.php    # JSON search endpoint (news + announcements)
└── assets/
    ├── css/                   # Design tokens, per-component styles, responsive master
    ├── js/                    # main, chatbot, search, dictionary (i18n), news, announcements
    ├── fonts/  images/  webfonts/  documents/
```

## 🙏 Credits

- [Swiper](https://swiperjs.com/) · [AOS](https://michalsnik.github.io/aos/) · [Font Awesome](https://fontawesome.com/)
- [Poppins](https://fonts.google.com/specimen/Poppins) & [Pretendard](https://github.com/orioncactus/pretendard) typefaces (SIL OFL)
- Built for Dream Blue Library, Jakarta International University — [jiu.ac](https://jiu.ac) · [@jiulibrary](https://instagram.com/jiulibrary)

## 📄 License

Code is released under the [MIT License](LICENSE). Third-party libraries, fonts,
and icons remain under their own licenses. The Dream Blue Library and JIU names,
logos, photos, and written content belong to their respective owners and are not
covered by the MIT license.
