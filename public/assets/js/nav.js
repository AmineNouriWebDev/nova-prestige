/**
 * NOVA PRESTIGE — Navigation & Header Controller
 * ES Module
 */

export function initNav() {
  initScrollBehavior();
  initMegaMenu();
  initMobileMenu();
  initScrollProgress();
}

function initScrollProgress() {
  const bar = document.getElementById('scroll-progress');
  if (!bar) return;
  
  const updateProgress = () => {
    const scrolled = window.scrollY;
    const total = document.documentElement.scrollHeight - window.innerHeight;
    if (total <= 0) {
      bar.style.width = '0%';
      return;
    }
    const percent = Math.min(Math.max((scrolled / total) * 100, 0), 100);
    bar.style.width = `${percent}%`;
  };
  
  window.addEventListener('scroll', updateProgress, { passive: true });
  updateProgress();
}

function initScrollBehavior() {
  const header = document.getElementById('site-header');
  if (!header) return;
  
  let lastScroll = window.scrollY;
  let ticking = false;
  
  window.addEventListener('scroll', () => {
    if (!ticking) {
      requestAnimationFrame(() => {
        const currentScroll = window.scrollY;
        
        // Glass effect after 24px
        if (currentScroll > 24) {
          header.classList.add('header-glass');
        } else {
          header.classList.remove('header-glass');
        }
        
        const mobileMenu = document.getElementById('mobile-menu-panel');
        const isMobileOpen = mobileMenu && !mobileMenu.classList.contains('hidden');

        // Hide/show on scroll direction (never hide when mobile menu is open)
        if (!isMobileOpen && currentScroll > lastScroll && currentScroll > 100) {
          header.classList.add('header-hidden');
        } else {
          header.classList.remove('header-hidden');
        }
        
        lastScroll = currentScroll;
        ticking = false;
      });
      ticking = true;
    }
  }, { passive: true });
}

function initMegaMenu() {
  const trigger = document.getElementById('mega-menu-trigger');
  const menu = document.getElementById('mega-menu-panel');  // ID corrigé
  if (!trigger || !menu) return;

  const chevron = document.getElementById('mega-chevron');

  let hoverTimeout;

  function openMenu() {
    clearTimeout(hoverTimeout);
    menu.classList.remove('hidden');
    trigger.setAttribute('aria-expanded', 'true');
    if (chevron) chevron.style.transform = 'rotate(180deg)';
  }

  function closeMenu() {
    hoverTimeout = setTimeout(() => {
      menu.classList.add('hidden');
      trigger.setAttribute('aria-expanded', 'false');
      if (chevron) chevron.style.transform = '';
    }, 120);
  }

  trigger.addEventListener('mouseenter', openMenu);
  trigger.addEventListener('mouseleave', closeMenu);
  menu.addEventListener('mouseenter', () => clearTimeout(hoverTimeout));
  menu.addEventListener('mouseleave', closeMenu);

  trigger.addEventListener('click', (e) => {
    e.preventDefault();
    menu.classList.contains('hidden') ? openMenu() : closeMenu();
  });

  // Keyboard
  trigger.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ' || e.key === 'ArrowDown') {
      e.preventDefault();
      openMenu();
      const firstLink = menu.querySelector('a');
      if (firstLink) firstLink.focus();
    }
    if (e.key === 'Escape') closeMenu();
  });

  menu.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeMenu();
      trigger.focus();
      return;
    }
    const items = Array.from(menu.querySelectorAll('a, button'));
    const idx = items.indexOf(document.activeElement);
    if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
      e.preventDefault();
      items[(idx + 1) % items.length]?.focus();
    } else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
      e.preventDefault();
      items[(idx - 1 + items.length) % items.length]?.focus();
    }
  });

  document.addEventListener('click', (e) => {
    if (!trigger.contains(e.target) && !menu.contains(e.target)) {
      clearTimeout(hoverTimeout);
      menu.classList.add('hidden');
      trigger.setAttribute('aria-expanded', 'false');
      if (chevron) chevron.style.transform = '';
    }
  });
}

function initMobileMenu() {
  // IDs corrected to match header.php
  const btn = document.getElementById('mobile-menu-trigger');
  const menu = document.getElementById('mobile-menu-panel');
  if (!btn || !menu) return;

  // Burger lines for animation
  const line1 = document.getElementById('burger-line-1');
  const line2 = document.getElementById('burger-line-2');
  const line3 = document.getElementById('burger-line-3');

  let isOpen = false;
  let cleanupTrap = null;

  function openMenu() {
    isOpen = true;
    const header = document.getElementById('site-header');
    if (header) header.classList.remove('header-hidden');
    menu.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    btn.setAttribute('aria-expanded', 'true');
    // Animate burger → X
    if (line1) { line1.style.transform = 'translateY(6px) rotate(45deg)'; }
    if (line2) { line2.style.opacity = '0'; }
    if (line3) { line3.style.transform = 'translateY(-6px) rotate(-45deg)'; }
    cleanupTrap = trapFocus(menu);
  }

  function closeMenuMobile() {
    isOpen = false;
    menu.classList.add('hidden');
    document.body.style.overflow = '';
    btn.setAttribute('aria-expanded', 'false');
    // Reset burger
    if (line1) { line1.style.transform = ''; }
    if (line2) { line2.style.opacity = ''; }
    if (line3) { line3.style.transform = ''; }
    if (cleanupTrap) { cleanupTrap(); cleanupTrap = null; }
    btn.focus();
  }

  btn.addEventListener('click', () => {
    isOpen ? closeMenuMobile() : openMenu();
  });

  // Close on nav link click
  menu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', closeMenuMobile);
  });

  // Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && isOpen) closeMenuMobile();
  });

  // Accordion for Expertises — IDs corrected
  const accordionBtn = document.getElementById('mobile-accordion-trigger');
  const accordionContent = document.getElementById('mobile-expertises-list');
  const accordionChevron = document.getElementById('mobile-accordion-chevron');

  if (accordionBtn && accordionContent) {
    accordionBtn.addEventListener('click', () => {
      const isClosed = accordionContent.classList.contains('hidden');
      if (isClosed) {
        accordionContent.classList.remove('hidden');
        accordionBtn.setAttribute('aria-expanded', 'true');
        if (accordionChevron) accordionChevron.style.transform = 'rotate(180deg)';
      } else {
        accordionContent.classList.add('hidden');
        accordionBtn.setAttribute('aria-expanded', 'false');
        if (accordionChevron) accordionChevron.style.transform = '';
      }
    });
  }
}

function trapFocus(element) {
  const focusable = element.querySelectorAll('a[href], button:not([disabled]), input, textarea, select, [tabindex]:not([tabindex="-1"])');
  if (!focusable.length) return () => {};
  
  const first = focusable[0];
  const last = focusable[focusable.length - 1];
  
  setTimeout(() => first.focus(), 50);
  
  function handler(e) {
    if (e.key !== 'Tab') return;
    if (e.shiftKey) {
      if (document.activeElement === first) {
        e.preventDefault();
        last.focus();
      }
    } else {
      if (document.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    }
  }
  
  element.addEventListener('keydown', handler);
  return () => element.removeEventListener('keydown', handler);
}
