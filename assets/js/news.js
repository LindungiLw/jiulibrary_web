const dummyNews = [
  {
    title: "Perpustakaan Raih Akreditasi A",
    titleEn: "Library Achieves 'A' Accreditation",
    date: "Oct 12, 2023",
    img: "https://images.unsplash.com/photo-1568667256549-094345857637?auto=format&fit=crop&q=80",
  },
  {
    title: "Kunjungan Studi Banding Universitas Tetangga",
    titleEn: "Benchmarking Visit from Neighboring University",
    date: "Oct 10, 2023",
    img: "https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&q=80",
  },
  {
    title: "Workshop Literasi Informasi",
    titleEn: "Information Literacy Workshop",
    date: "Oct 05, 2023",
    img: "https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80",
  },
];

function renderNews() {
  const container = document.getElementById("newsContainer");
  if (!container) return;
  container.innerHTML = "";

  dummyNews.forEach((news) => {
    const displayTitle = currentLang === "id" ? news.title : news.titleEn;
    const readMoreText =
      currentLang === "id" ? dict.id.readMore : dict.en.readMore;

    container.innerHTML += `
      <div class="news-card">
        <img src="${news.img}" alt="News" class="news-img">
        <div class="news-content">
          <span class="news-date"><i class="far fa-calendar-alt"></i> ${news.date}</span>
          <h3 class="news-title">${displayTitle}</h3>
          <a href="#" class="read-more">${readMoreText}</a>
        </div>
      </div>
    `;
  });
}
