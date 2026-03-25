const homeData = [
  {
    name: "Opening Hours (Jam Operasional)",
    target: "modalHours",
    type: "modal",
    icon: "fa-clock",
  },
  {
    name: "Total Collection (Koleksi Buku)",
    target: "modalCollection",
    type: "modal",
    icon: "fa-book",
  },
  {
    name: "Study Rooms (Fasilitas Ruangan)",
    target: "modalRooms",
    type: "modal",
    icon: "fa-chalkboard-teacher",
  },
  {
    name: "Library Announcements (Pengumuman)",
    target: "announcements",
    type: "section",
    icon: "fa-bullhorn",
  },
  {
    name: "Library News & Articles (Berita)",
    target: "news",
    type: "section",
    icon: "fa-newspaper",
  },
  {
    name: "Our Network (Mitra JIU)",
    target: "networking",
    type: "section",
    icon: "fa-network-wired",
  },
  {
    name: "Tahun Terbit / Kategori",
    target: "announcements",
    type: "section",
    icon: "fa-calendar-alt",
  },
];

function toggleNavSearch() {
  const wrapper = document.getElementById("searchWrapper");
  const input = document.getElementById("navSearchInput");
  const results = document.getElementById("navSearchSuggestions");

  wrapper.classList.toggle("active");

  if (wrapper.classList.contains("active")) {
    input.focus();
  } else {
    input.value = "";
    results.style.display = "none";
    results.innerHTML = "";
  }
}

function liveSearchHomeNav() {
  const input = document.getElementById("navSearchInput").value.toLowerCase();
  const suggestionBox = document.getElementById("navSearchSuggestions");
  const wrapper = document.getElementById("searchWrapper");

  suggestionBox.innerHTML = "";

  if (input.length > 0) {
    const results = homeData.filter((item) =>
      item.name.toLowerCase().includes(input),
    );

    if (results.length > 0) {
      suggestionBox.style.display = "flex";
      results.forEach((item, index) => {
        const div = document.createElement("div");
        div.className = "suggestion-item";
        div.innerHTML = `<i class="fas ${item.icon}"></i> <span>${item.name}</span>`;

        div.onclick = function () {
          executeNavigation(item);
        };

        suggestionBox.appendChild(div);
      });
    } else {
      suggestionBox.style.display = "none";
    }
  } else {
    suggestionBox.style.display = "none";
  }
}

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
      const offsetPosition =
        elementPosition + window.pageYOffset - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth",
      });
    }
  }
}

document
  .getElementById("navSearchInput")
  ?.addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
      const input = this.value.toLowerCase();
      const firstMatch = homeData.find((item) =>
        item.name.toLowerCase().includes(input),
      );
      if (firstMatch) {
        executeNavigation(firstMatch);
      }
    }
  });

document.addEventListener("click", function (event) {
  const wrapper = document.getElementById("searchWrapper");
  if (wrapper && !wrapper.contains(event.target)) {
    wrapper.classList.remove("active");
    document.getElementById("navSearchSuggestions").style.display = "none";
  }
});
