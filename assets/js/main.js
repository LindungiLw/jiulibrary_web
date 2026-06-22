const mobileMenu = document.getElementById("mobile-menu");
const navLinks = document.getElementById("nav-links");

if (mobileMenu && navLinks) {
  mobileMenu.addEventListener("click", () => {
    navLinks.classList.toggle("active");
  });
}

function toggleDropdown(event, menuId) {
  event.preventDefault();
  
  // Desktop mengandalkan CSS :hover murni, klik JS hanya untuk versi mobile
  if (window.innerWidth >= 992) return;

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

// Add scrolled class to header
window.addEventListener("scroll", () => {
  const header = document.querySelector(".site-header");
  if (header) {
    if (window.scrollY > 150) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  }
});

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}


function initNetworkingSlider() {
  const inner = document.querySelector(".marquee-inner");
  const track = document.querySelector(".marquee-track");
  if (!inner || !track) return;

  // Remove CSS animation — JS takes over
  inner.style.animation = "none";
  inner.style.willChange = "transform";
  track.style.cursor = "grab";

  // Hide scrollbar (track stays overflow:hidden so no scrollLeft needed)
  track.style.overflow = "hidden";

  // ── State ──────────────────────────────────────────────────────────
  let pos        = 0;          // current translateX in px (always negative → moves left)
  const speed    = 0.6;        // base px per frame  (~36px/s at 60fps)
  let extraVel   = 0;          // drag-added velocity (positive = dragged right, negative = dragged left)
  const friction = 0.92;       // how quickly drag momentum decays each frame

  let isDragging = false;
  let dragStartX = 0;
  let lastDragX  = 0;
  let dragDelta  = 0;

  // Total width of ONE set of logos (half of inner, since inner = 2× duplicated)
  // We calculate it dynamically once layout is ready
  let halfWidth  = 0;

  function getHalfWidth() {
    halfWidth = inner.scrollWidth / 2;
  }
  getHalfWidth();
  // Recalculate on resize
  window.addEventListener("resize", getHalfWidth);

  // ── Animation loop ────────────────────────────────────────────────
  function tick() {
    // Base auto-scroll (always runs, never stops)
    pos -= speed;

    // Apply drag momentum (decays each frame via friction)
    pos += extraVel;
    extraVel *= friction;

    // Seamless loop: when we've scrolled one full set width, jump back silently
    if (Math.abs(pos) >= halfWidth) {
      pos += halfWidth;  // snap back to equivalent position
    }

    inner.style.transform = `translateX(${pos}px)`;
    requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);

  // ── Drag helpers ──────────────────────────────────────────────────
  function onDragStart(x) {
    isDragging = true;
    dragStartX = x;
    lastDragX  = x;
    dragDelta  = 0;
    track.style.cursor = "grabbing";
  }

  function onDragMove(x) {
    if (!isDragging) return;
    dragDelta  = x - lastDragX;   // movement this frame
    extraVel   = dragDelta;        // feed directly into velocity each frame
    lastDragX  = x;
  }

  function onDragEnd() {
    isDragging = false;
    track.style.cursor = "grab";
    // extraVel keeps the momentum going then decays naturally via friction
  }

  // ── Mouse events ──────────────────────────────────────────────────
  track.addEventListener("mousedown", (e) => {
    e.preventDefault();
    onDragStart(e.clientX);
  });
  window.addEventListener("mousemove", (e) => {
    if (isDragging) onDragMove(e.clientX);
  });
  window.addEventListener("mouseup", () => {
    if (isDragging) onDragEnd();
  });

  // ── Touch events ──────────────────────────────────────────────────
  track.addEventListener("touchstart", (e) => {
    onDragStart(e.touches[0].clientX);
  }, { passive: true });
  track.addEventListener("touchmove", (e) => {
    onDragMove(e.touches[0].clientX);
  }, { passive: true });
  track.addEventListener("touchend", onDragEnd);
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
    modal.style.display = "flex";
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

// ── Number Counter Animation ──
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll(".counter");
  if (counters.length === 0) return;

  const animateCounter = (counter) => {
    const target = +counter.getAttribute("data-target");
    let count = 0;
    // Animation duration ~6s. Frame interval ~16ms. Total frames ~360
    const increment = target / 360;

    const updateCount = () => {
      count += increment;
      if (count < target) {
        // Use Indonesian locale to get dot separators (e.g. 5.642)
        counter.innerText = Math.ceil(count).toLocaleString('id-ID'); 
        requestAnimationFrame(updateCount);
      } else {
        counter.innerText = target.toLocaleString('id-ID');
      }
    };
    updateCount();
  };

  const observerOptions = {
    threshold: 0.5 // Trigger when 50% of the element is visible
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target); // Only animate once
      }
    });
  }, observerOptions);

  counters.forEach(counter => {
    observer.observe(counter);
  });
});
