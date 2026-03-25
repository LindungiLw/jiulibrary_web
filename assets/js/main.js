const mobileMenu = document.getElementById("mobile-menu");
const navLinks = document.getElementById("nav-links");

if (mobileMenu && navLinks) {
  mobileMenu.addEventListener("click", () => {
    navLinks.classList.toggle("active");
  });
}

function toggleDropdown(event, menuId) {
  event.preventDefault();
  const dropdowns = document.getElementsByClassName("dropdown-content");
  for (let i = 0; i < dropdowns.length; i++) {
    if (dropdowns[i].id !== menuId) {
      dropdowns[i].classList.remove("show");
    }
  }

  const menu = document.getElementById(menuId);
  if (menu) menu.classList.toggle("show");
}

window.addEventListener("click", function (event) {
  if (!event.target.closest(".dropdown")) {
    const dropdowns = document.getElementsByClassName("dropdown-content");
    for (let i = 0; i < dropdowns.length; i++) {
      let openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
});

function initHeroSlider() {
  const slides = document.querySelectorAll(".slide-bg");
  if (slides.length === 0) return;

  let currentIndex = 0;

  setInterval(() => {
    slides[currentIndex].classList.remove("active");
    currentIndex = (currentIndex + 1) % slides.length;
    slides[currentIndex].classList.add("active");
  }, 5000);
}

function openLoginModal() {
  const modal = document.getElementById("loginModal");
  if (modal) modal.style.display = "flex";
}

function closeLoginModal() {
  const modal = document.getElementById("loginModal");
  if (modal) modal.style.display = "none";
}

function handleLogin() {
  const user = document.getElementById("username").value;
  const pass = document.getElementById("password").value;

  if (user === "admin" && pass === "admin123") {
    localStorage.setItem("userRole", "Admin");
    window.location.href = "admin.html";
  } else if (user === "librarian" && pass === "lib123") {
    localStorage.setItem("userRole", "Librarian");
    window.location.href = "admin.html";
  } else {
    alert(
      typeof currentLang !== "undefined" && currentLang === "id"
        ? "Username atau Password salah!"
        : "Invalid Username or Password!",
    );
  }
}

window.addEventListener("click", function (event) {
  const modal = document.getElementById("loginModal");
  if (event.target === modal) {
    closeLoginModal();
  }
});

const backToTopBtn = document.getElementById("backToTopBtn");

if (backToTopBtn) {
  window.addEventListener("scroll", () => {
    if (
      document.body.scrollTop > 300 ||
      document.documentElement.scrollTop > 300
    ) {
      backToTopBtn.style.display = "flex";
    } else {
      backToTopBtn.style.display = "none";
    }
  });
}

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

function initNetworkingSlider() {
  if (!document.querySelector(".swiper-network-right")) return;
  var swiperNetRight = new Swiper(".swiper-network-right", {
    loop: true,
    slidesPerView: "auto",
    spaceBetween: 40,
    speed: 3500,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
      reverseDirection: true,
    },
  });

  var swiperNetLeft = new Swiper(".swiper-network-left", {
    loop: true,
    slidesPerView: "auto",
    spaceBetween: 40,
    speed: 3500,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
    },
  });

  const allNetSwipers = [swiperNetRight, swiperNetLeft];
  document
    .querySelectorAll(".swiper-network-right, .swiper-network-left")
    .forEach(function (container, index) {
      container.addEventListener("mouseenter", function () {
        if (allNetSwipers[index] && allNetSwipers[index].autoplay) {
          allNetSwipers[index].autoplay.stop();
        }
      });
      container.addEventListener("mouseleave", function () {
        if (allNetSwipers[index] && allNetSwipers[index].autoplay) {
          allNetSwipers[index].autoplay.start();
        }
      });
    });
}

window.addEventListener("load", () => {
  if (typeof AOS !== "undefined") {
    AOS.init({ duration: 800, once: true });
  }

  if (typeof renderNews === "function") renderNews();
  if (typeof renderAnnouncements === "function") renderAnnouncements();

  initHeroSlider();
  initNetworkingSlider();
});

function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.style.display = "block";
    setTimeout(() => {
      modal.classList.add("show");
    }, 10);
    document.body.style.overflow = "hidden";
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
    modal.classList.remove("show");
    setTimeout(() => {
      modal.style.display = "none";
    }, 300);
    document.body.style.overflow = "auto";
  }
}

window.addEventListener("click", function (event) {
  if (event.target.classList.contains("modal-hours")) {
    closeModal(event.target.id);
  }
});
