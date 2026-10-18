/**
 * NOVA PRESTIGE — Main Application Entry Point
 * ES Module
 */

import { initTheme } from './theme.js';
import { initNav } from './nav.js';
import { initReveal } from './reveal.js';
import { initForms } from './forms.js';

// Add js class to html root
document.documentElement.classList.add('js');

// Initialize core modules
initTheme();
initNav();
initReveal();
initForms();

// Initialize Triple-click logo admin access
initLogoTripleClick();

// Initialize Magnetic buttons for desktop
initMagneticButtons();

// Initialize marquee infinite tracks
initMarquee();

// Auto-load admin edit module if page is in admin mode
if (document.body.getAttribute('data-admin') === '1') {
  import('./admin-edit.js').then((module) => {
    if (typeof module.initAdminEdit === 'function') {
      module.initAdminEdit();
    }
  }).catch((err) => {
    console.error('Failed to load admin module:', err);
  });
}

function initLogoTripleClick() {
  const logo = document.getElementById('site-logo');
  if (!logo) return;
  
  let clickCount = 0;
  let clickTimer;
  
  logo.addEventListener('click', (e) => {
    clickCount++;
    clearTimeout(clickTimer);
    
    if (clickCount === 3) {
      e.preventDefault();
      clickCount = 0;
      const isAdmin = document.body.getAttribute('data-admin') === '1';
      if (isAdmin) {
        showAdminQuickMenu();
      } else {
        showLoginModal();
      }
      return;
    }
    
    clickTimer = setTimeout(() => {
      const count = clickCount;
      clickCount = 0;
      if (count === 1) {
        // If clicking on a link that goes to /, default behavior handles it,
        // but if intercepted or button, navigate to /
        if (logo.tagName.toLowerCase() !== 'a') {
          window.location.href = '/';
        }
      }
    }, 450);
  });
}

function showLoginModal() {
  // Check if modal already exists
  let modal = document.getElementById('login-modal');
  if (modal) {
    modal.classList.add('is-open');
    const userField = modal.querySelector('#login-username');
    if (userField) setTimeout(() => userField.focus(), 100);
    return;
  }
  
  // Inject modal dynamically
  modal = document.createElement('div');
  modal.id = 'login-modal';
  modal.className = 'modal-overlay is-open';
  modal.setAttribute('role', 'dialog');
  modal.setAttribute('aria-modal', 'true');
  modal.setAttribute('aria-labelledby', 'login-modal-title');
  
  modal.innerHTML = `
    <div class="modal-content">
      <button id="login-modal-close" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-np-text-muted hover:text-np-text transition-colors" aria-label="Fermer">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
      <div class="flex items-center gap-2 mb-2">
        <span class="label-tech">ACCÈS RESTREINT</span>
      </div>
      <h2 id="login-modal-title" class="font-grotesk font-bold text-2xl mb-6 text-np-text">Connexion administration</h2>
      <form id="login-form" novalidate>
        <div class="mb-4">
          <label class="form-label" for="login-username">Identifiant</label>
          <input type="text" id="login-username" name="username" class="form-input" autocomplete="username" required placeholder="nom d'utilisateur">
        </div>
        <div class="mb-6">
          <label class="form-label" for="login-password">Mot de passe</label>
          <input type="password" id="login-password" name="password" class="form-input" autocomplete="current-password" required placeholder="••••••••••••">
        </div>
        <p id="login-error" class="text-red-500 text-sm mb-4 hidden" role="alert"></p>
        <button type="submit" class="btn-primary w-full justify-center" id="login-submit">
          <span id="login-btn-text">Se connecter</span>
        </button>
      </form>
    </div>
  `;
  
  document.body.appendChild(modal);
  
  // Prime CSRF token if needed
  fetch('/api/login', { method: 'GET' }).catch(() => {});
  
  const closeBtn = modal.querySelector('#login-modal-close');
  const form = modal.querySelector('#login-form');
  const errorEl = modal.querySelector('#login-error');
  const submitBtn = modal.querySelector('#login-submit');
  const btnText = modal.querySelector('#login-btn-text');
  
  const closeModal = () => modal.classList.remove('is-open');
  
  closeBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });
  
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
  });
  
  // Focus username input
  setTimeout(() => modal.querySelector('#login-username')?.focus(), 100);
  
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const username = form.querySelector('#login-username').value.trim();
    const password = form.querySelector('#login-password').value;
    
    if (!username || !password) {
      errorEl.textContent = 'Veuillez remplir tous les champs.';
      errorEl.classList.remove('hidden');
      return;
    }
    
    submitBtn.disabled = true;
    btnText.textContent = 'Connexion...';
    errorEl.classList.add('hidden');
    
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
      
      const res = await fetch('/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': csrfToken
        },
        body: JSON.stringify({ username, password }),
      });
      
      const data = await res.json().catch(() => ({}));
      
      if (res.ok && data.success) {
        window.location.reload();
      } else {
        errorEl.textContent = data.error || 'Identifiants invalides';
        errorEl.classList.remove('hidden');
        form.querySelector('#login-password').value = '';
        submitBtn.disabled = false;
        btnText.textContent = 'Se connecter';
      }
    } catch {
      errorEl.textContent = 'Erreur de communication avec le serveur. Veuillez réessayer.';
      errorEl.classList.remove('hidden');
      submitBtn.disabled = false;
      btnText.textContent = 'Se connecter';
    }
  });
}

function showAdminQuickMenu() {
  const existing = document.getElementById('admin-quick-menu');
  if (existing) {
    existing.remove();
    return;
  }
  
  const menu = document.createElement('div');
  menu.id = 'admin-quick-menu';
  menu.className = 'fixed top-20 right-4 z-50 bg-np-surface border border-np-border rounded shadow-2xl p-2 min-w-48';
  menu.innerHTML = `
    <div class="px-3 py-1.5 text-xs font-mono text-np-accent border-b border-np-border mb-1 uppercase tracking-wider">
      Session active
    </div>
    <button id="admin-logout-btn" class="w-full text-left px-3 py-2 text-sm font-inter hover:bg-np-bg rounded text-np-text transition-colors flex items-center gap-2">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      Quitter le mode édition
    </button>
  `;
  document.body.appendChild(menu);
  
  const logoutBtn = document.getElementById('admin-logout-btn');
  logoutBtn.addEventListener('click', async () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
    try {
      await fetch('/api/logout', {
        method: 'POST',
        headers: { 'X-CSRF-Token': csrfToken }
      });
    } catch (e) {
      console.warn('Logout request failed:', e);
    }
    window.location.reload();
  });
  
  setTimeout(() => {
    const clickHandler = (e) => {
      if (!menu.contains(e.target)) {
        menu.remove();
        document.removeEventListener('click', clickHandler);
      }
    };
    document.addEventListener('click', clickHandler);
  }, 10);
}

function initMagneticButtons() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  if (window.innerWidth < 1024) return;
  
  const magneticEls = document.querySelectorAll('.btn-magnetic');
  magneticEls.forEach(btn => {
    btn.addEventListener('mousemove', (e) => {
      const rect = btn.getBoundingClientRect();
      const x = e.clientX - rect.left - rect.width / 2;
      const y = e.clientY - rect.top - rect.height / 2;
      btn.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
    });
    btn.addEventListener('mouseleave', () => {
      btn.style.transform = '';
    });
  });
}

function initMarquee() {
  const tracks = document.querySelectorAll('.marquee-track');
  tracks.forEach(track => {
    // Only duplicate once
    if (!track.dataset.duplicated) {
      const content = track.innerHTML;
      track.innerHTML = content + content;
      track.dataset.duplicated = 'true';
    }
  });
}
