window.onload = () => {
  const role = localStorage.getItem("userRole");
  if (!role) {
    window.location.href = "index.html";
  } else {
    document.getElementById("adminName").innerText = role;
    initAdminData();
    setupSidebarNavigation();
  }
};

function logout() {
  localStorage.removeItem("userRole");
  window.location.href = "index.html";
}

function setupSidebarNavigation() {
  const navLinks = document.querySelectorAll(".nav-link");
  const sections = document.querySelectorAll(".view-section");
  const pageTitle = document.getElementById("pageTitle");

  navLinks.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();

      navLinks.forEach((l) => l.classList.remove("active"));
      sections.forEach((s) => s.classList.remove("active"));

      link.classList.add("active");

      const targetId = link.getAttribute("data-target");
      document.getElementById(targetId).classList.add("active");

      pageTitle.innerText = link.innerText.trim();
    });
  });
}

function initAdminData() {
  const books = JSON.parse(localStorage.getItem("books")) || [];

  const announcements = JSON.parse(localStorage.getItem("announcements")) || [
    1, 2,
  ];

  const available = books.filter((b) => b.status === "Available").length;
  const borrowed = books.filter((b) => b.status === "Borrowed").length;

  document.getElementById("statTotalBooks").innerText = books.length;
  document.getElementById("statAvailable").innerText = available;
  document.getElementById("statBorrowed").innerText = borrowed;
  document.getElementById("statAnnounce").innerText = announcements.length;

  renderCharts(books, available, borrowed);
}

function renderCharts(books, available, borrowed) {
  const ctxStatus = document.getElementById("statusChart").getContext("2d");
  new Chart(ctxStatus, {
    type: "doughnut",
    data: {
      labels: ["Available", "Borrowed"],
      datasets: [
        {
          data: [available, borrowed],
          backgroundColor: ["#10b981", "#f59e0b"],
          borderWidth: 0,
        },
      ],
    },
    options: {
      cutout: "70%",
      responsive: true,
      plugins: { legend: { position: "bottom" } },
    },
  });

  const categoryCounts = {};
  books.forEach((b) => {
    categoryCounts[b.category] = (categoryCounts[b.category] || 0) + 1;
  });

  const ctxCategory = document.getElementById("categoryChart").getContext("2d");
  new Chart(ctxCategory, {
    type: "bar",
    data: {
      labels: Object.keys(categoryCounts),
      datasets: [
        {
          label: "Jumlah Buku",
          data: Object.values(categoryCounts),
          backgroundColor: "#3a4384",
          borderRadius: 5,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } },
    },
  });
}
