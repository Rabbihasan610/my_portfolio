"use strict";

// Header Scroll Active State
const header = document.querySelector(".site-header");
if (header) {
  const updateHeader = () => header.classList.toggle("scrolled", window.scrollY > 20);
  updateHeader();
  window.addEventListener("scroll", updateHeader, { passive: true });
}

// Mobile Navigation Toggle
const navToggle = document.querySelector(".nav-toggle");
const navLinks = document.querySelector(".nav-links");
const navAnchors = document.querySelectorAll(".nav-links a");

if (navToggle && navLinks) {
  navToggle.addEventListener("click", () => {
    const isOpen = navLinks.classList.toggle("open");
    navToggle.classList.toggle("active", isOpen);
    navToggle.setAttribute("aria-expanded", String(isOpen));
    document.body.style.overflow = isOpen ? "hidden" : "";
  });

  navAnchors.forEach((link) => {
    link.addEventListener("click", () => {
      navLinks.classList.remove("open");
      navToggle.classList.remove("active");
      navToggle.setAttribute("aria-expanded", "false");
      document.body.style.overflow = "";
    });
  });
}

// Scroll Reveal Animations with Staggered Delays
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("visible");
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.1 });

const observeReveals = (root = document) => {
  root.querySelectorAll(".reveal:not([data-observed])").forEach((element, index) => {
    element.dataset.observed = "true";
    element.style.transitionDelay = `${Math.min(index % 4, 3) * 80}ms`;
    revealObserver.observe(element);
  });
};
observeReveals();

// Metric Animated Count-up Numbers
const countUp = (element) => {
  const target = parseFloat(element.dataset.count);
  if (isNaN(target)) return;
  const suffix = element.dataset.suffix || "";
  const decimals = Number.isInteger(target) ? 0 : 1;
  const duration = 1600;
  const start = performance.now();

  const tick = (now) => {
    const progress = Math.min((now - start) / duration, 1);
    const eased = 1 - Math.pow(1 - progress, 3);
    element.textContent = `${(target * eased).toFixed(decimals)}${suffix}`;
    if (progress < 1) requestAnimationFrame(tick);
  };
  requestAnimationFrame(tick);
};

const metricObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.querySelectorAll("[data-count]").forEach(countUp);
      metricObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.3 });

const metrics = document.querySelector(".metrics");
if (metrics) metricObserver.observe(metrics);

// Cursor Glow Tracker (Disabled on touch devices)
const glow = document.querySelector(".cursor-glow");
if (glow) {
  if (window.matchMedia("(pointer: fine)").matches) {
    window.addEventListener("pointermove", (event) => {
      glow.style.left = `${event.clientX}px`;
      glow.style.top = `${event.clientY}px`;
    }, { passive: true });
  } else {
    glow.remove();
  }
}

// Client-Side Search Filter for Projects Grid
const caseSearchInput = document.querySelector("#case-search");
const caseGrid = document.querySelector("#case-grid");

if (caseSearchInput && caseGrid) {
  caseSearchInput.addEventListener("input", (e) => {
    const query = e.target.value.toLowerCase().trim();
    const cards = caseGrid.querySelectorAll(".case-card");
    let matchCount = 0;

    cards.forEach((card) => {
      const text = card.textContent.toLowerCase();
      const isMatch = text.includes(query);
      card.style.display = isMatch ? "" : "none";
      if (isMatch) matchCount++;
    });

    let emptyNotice = caseGrid.querySelector(".search-empty-notice");
    if (matchCount === 0) {
      if (!emptyNotice) {
        emptyNotice = document.createElement("div");
        emptyNotice.className = "search-empty-notice";
        emptyNotice.style.gridColumn = "1 / -1";
        emptyNotice.style.textAlign = "center";
        emptyNotice.style.padding = "3rem 1rem";
        emptyNotice.innerHTML = `
          <i class="fa-solid fa-magnifying-glass" style="font-size: 2.5rem; color: var(--muted); margin-bottom: 1rem;"></i>
          <h3>No matching projects found</h3>
          <p style="color: var(--muted);">Try typing another keyword or reset the search.</p>
        `;
        caseGrid.appendChild(emptyNotice);
      }
    } else if (emptyNotice) {
      emptyNotice.remove();
    }
  });
}

// Dynamic Footer Year
const yearElem = document.querySelector("#year");
if (yearElem) {
  yearElem.textContent = new Date().getFullYear();
}

// Reading Progress Indicator for Blog Posts
const progressBar = document.querySelector(".reading-progress-bar");
if (progressBar) {
  window.addEventListener("scroll", () => {
    const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
    const progress = totalHeight > 0 ? (window.scrollY / totalHeight) * 100 : 0;
    progressBar.style.width = `${Math.min(100, Math.max(0, progress))}%`;
  }, { passive: true });
}

// Copy Link Handler with Visual Feedback
window.copyArticleLink = (btn) => {
  if (!navigator.clipboard) return;
  navigator.clipboard.writeText(window.location.href).then(() => {
    const originalContent = btn.innerHTML;
    btn.innerHTML = `<i class="fa-solid fa-check" style="color: #34d399;"></i> Copied!`;
    btn.style.borderColor = "#34d399";
    setTimeout(() => {
      btn.innerHTML = originalContent;
      btn.style.borderColor = "";
    }, 2500);
  });
};
