const dummyAnnouncements = [
  {
    title: "Batas Akhir Pengembalian Buku Semester Ganjil",
    titleEn: "Deadline for Odd Semester Book Returns",
    date: "Nov 01, 2023",
    desc: "Harap mengembalikan semua buku pinjaman sebelum tanggal 15 November untuk menghindari denda.",
    descEn:
      "Please return all borrowed books before November 15 to avoid fines.",
  },
  {
    title: "Pemeliharaan Server E-Journal",
    titleEn: "E-Journal Server Maintenance",
    date: "Oct 28, 2023",
    desc: "Akses ke database E-Journal akan dihentikan sementara pada hari Minggu pukul 00:00 - 04:00 WIB.",
    descEn:
      "Access to the E-Journal database will be temporarily suspended on Sunday from 00:00 - 04:00 WIB.",
  },
];

function renderAnnouncements() {
  const container = document.getElementById("announceContainer");
  if (!container) return;
  container.innerHTML = "";

  dummyAnnouncements.forEach((ann) => {
    const displayTitle = currentLang === "id" ? ann.title : ann.titleEn;
    const displayDesc = currentLang === "id" ? ann.desc : ann.descEn;
    const readMoreText =
      currentLang === "id" ? dict.id.readMore : dict.en.readMore;

    container.innerHTML += `
      <div class="announce-card">
        <span class="announce-date"><i class="fas fa-bullhorn"></i> ${ann.date}</span>
        <h3 class="announce-title">${displayTitle}</h3>
        <p class="announce-desc">${displayDesc}</p>
        <a href="#" class="read-more">${readMoreText}</a>
      </div>
    `;
  });
}
