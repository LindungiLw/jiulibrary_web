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

  // ── Auto-clone for seamless loop (replaces HTML duplicates) ───────
  // Browser downloads each image ONCE; clone just duplicates DOM nodes
  const clone = inner.cloneNode(true);
  clone.setAttribute("aria-hidden", "true");
  clone.removeAttribute("id");

  // Wrap both sets in a single flex container (one translateX = seamless)
  const wrapper = document.createElement("div");
  wrapper.style.cssText = "display:flex;flex-wrap:nowrap;will-change:transform;";
  // Move inner into wrapper, then append clone
  track.appendChild(wrapper);
  wrapper.appendChild(inner);
  wrapper.appendChild(clone);

  inner.style.animation = "none";
  clone.style.animation = "none";
  track.style.cursor = "grab";
  track.style.overflow = "hidden";

  // ── State ──────────────────────────────────────────────────────────
  let pos        = 0;
  const speed    = 0.6;        // ~36px/s at 60fps
  let extraVel   = 0;
  const friction = 0.92;
  let rafId      = null;
  let isVisible  = true;

  let isDragging = false;
  let lastDragX  = 0;

  let setWidth = 0;
  function getSetWidth() {
    setWidth = inner.scrollWidth;  // width of ONE set
  }
  window.addEventListener("load", () => {
    getSetWidth();
    startRAF();
  });
  window.addEventListener("resize", getSetWidth);

  // ── Animation loop (pauses when section off-screen → saves mobile CPU) ──
  function tick() {
    pos -= speed;
    pos += extraVel;
    extraVel *= friction;

    // Seamless: when scrolled one full set width, jump back silently
    if (pos <= -setWidth) pos += setWidth;

    wrapper.style.transform = `translateX(${pos}px)`;
    rafId = requestAnimationFrame(tick);
  }

  function startRAF() { if (!rafId && isVisible) rafId = requestAnimationFrame(tick); }
  function stopRAF()  { if (rafId) { cancelAnimationFrame(rafId); rafId = null; } }

  // Pause when section scrolled off-screen → saves battery on mobile
  const section = document.getElementById("networking");
  if (section && "IntersectionObserver" in window) {
    const io = new IntersectionObserver((entries) => {
      isVisible = entries[0].isIntersecting;
      isVisible ? startRAF() : stopRAF();
    }, { threshold: 0 });
    io.observe(section);
  }


  // ── Drag helpers ──────────────────────────────────────────────────
  function onDragStart(x) {
    isDragging = true;
    lastDragX  = x;
    extraVel   = 0;
    track.style.cursor = "grabbing";
  }
  function onDragMove(x) {
    if (!isDragging) return;
    dragDelta = x - lastDragX;
    extraVel  = dragDelta;
    lastDragX = x;
  }
  function onDragEnd() {
    isDragging = false;
    track.style.cursor = "grab";
  }

  // ── Mouse events ──────────────────────────────────────────────────
  track.addEventListener("mousedown", (e) => { e.preventDefault(); onDragStart(e.clientX); });
  window.addEventListener("mousemove", (e) => { if (isDragging) onDragMove(e.clientX); });
  window.addEventListener("mouseup",   ()  => { if (isDragging) onDragEnd(); });

  // ── Touch events ──────────────────────────────────────────────────
  track.addEventListener("touchstart", (e) => { onDragStart(e.touches[0].clientX); }, { passive: true });
  track.addEventListener("touchmove",  (e) => { onDragMove(e.touches[0].clientX);  }, { passive: true });
  track.addEventListener("touchend",   onDragEnd);
}


window.addEventListener("load", () => {
  if (typeof AOS !== "undefined") {
    AOS.init({ duration: 800, once: true });
  }

  if (typeof renderNews === "function") renderNews();
  if (typeof renderAnnouncements === "function") renderAnnouncements();

  initHeroSlider();
  initNetworkingSlider();
  initCounters();
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
function initCounters() {
  const counters = document.querySelectorAll(".counter");
  if (counters.length === 0) return;

  const animateCounter = (counter) => {
    const target = parseInt(counter.getAttribute("data-target"), 10);
    // Fix: explicit NaN check instead of falsy (target=0 would wrongly skip)
    if (isNaN(target)) return;

    // Reset to 0 first (in case it already showed a number)
    counter.innerText = "0";

    const duration = 2000; // 2 seconds
    const startTime = performance.now();

    const updateCount = (currentTime) => {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);

      // easeOutExpo — fast start, smooth slow-down
      const easeOut = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
      const currentVal = Math.ceil(easeOut * target);

      counter.innerText = currentVal.toLocaleString("id-ID");

      if (progress < 1) {
        requestAnimationFrame(updateCount);
      } else {
        counter.innerText = target.toLocaleString("id-ID");
      }
    };
    requestAnimationFrame(updateCount);
  };

  // Fix: threshold 0.1 (10% visible is enough to trigger)
  // Lower threshold prevents missing trigger when stats strip is already in viewport on page load
  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const counter = entry.target;
        obs.unobserve(counter); // Animate once only

        // Fix: wait for AOS fade-in to finish (AOS duration = 800ms + delay)
        // so the element is fully visible before we start counting
        const aosParent = counter.closest("[data-aos]");
        const aosDelay  = aosParent ? parseInt(aosParent.getAttribute("data-aos-delay") || "0", 10) : 0;
        const aosDefer  = aosParent ? 850 + aosDelay : 0; // 800ms AOS duration + buffer

        setTimeout(() => animateCounter(counter), aosDefer);
      }
    });
  }, { threshold: 0.1 });

  counters.forEach(counter => observer.observe(counter));
}

// initCounters() is called from the main window load handler above
