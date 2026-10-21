/**
 * NOVA PRESTIGE — Admin Inline Editing System
 * ES Module
 * Active when document.body[data-admin="1"]
 */

import { showToast } from './forms.js';

// Global variables declared at the very top (avoids Temporal Dead Zone ReferenceError)
let textModal = null;
let imageFileInput = null;
let seoModal = null;

export function initAdminEdit() {
  if (document.body.getAttribute('data-admin') !== '1') return;
  if (window.__adminEditInitialized) return;
  window.__adminEditInitialized = true;

  injectAdminBar();
  setupModals();
  setupEditableElements();
}

// Auto-run if DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initAdminEdit);
} else {
  initAdminEdit();
}

function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

function getPageKey() {
  return document.body.getAttribute('data-page') ||
         window.location.pathname.replace(/^\/|\/$/g, '') ||
         'home';
}

/**
 * Injects the floating bottom-left admin status bar
 */
function injectAdminBar() {
  if (document.getElementById('admin-floating-bar')) return;

  const bar = document.createElement('div');
  bar.id = 'admin-floating-bar';
  bar.className = 'admin-bar';
  bar.innerHTML = `
    <span class="inline-flex items-center gap-2">
      <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
      <span class="font-mono text-xs uppercase tracking-wider font-semibold">Mode Édition</span>
    </span>
    <span class="text-white/40">|</span>
    <button id="admin-seo-btn" type="button" class="text-xs hover:underline flex items-center gap-1 text-white/90 hover:text-white" title="Modifier le référencement (SEO)">
      <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      SEO
    </button>
    <span class="text-white/40">|</span>
    <button id="admin-bar-logout" type="button" class="text-xs hover:underline flex items-center gap-1 text-white/90 hover:text-white">
      <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      Quitter
    </button>
  `;

  document.body.appendChild(bar);

  document.getElementById('admin-bar-logout')?.addEventListener('click', async () => {
    try {
      await fetch('/api/logout', {
        method: 'POST',
        headers: { 'X-CSRF-Token': getCsrfToken() }
      });
    } catch (e) {
      console.warn('Logout request failed:', e);
    }
    window.location.reload();
  });

  document.getElementById('admin-seo-btn')?.addEventListener('click', openSeoModal);
}

/**
 * Modals container and templates
 */
function setupModals() {
  if (document.getElementById('admin-text-modal')) {
    textModal = document.getElementById('admin-text-modal');
  } else {
    // Create Text Edit Modal
    textModal = document.createElement('div');
    textModal.id = 'admin-text-modal';
    textModal.className = 'modal-overlay';
    textModal.setAttribute('role', 'dialog');
    textModal.setAttribute('aria-modal', 'true');
    textModal.innerHTML = `
      <div class="modal-content max-w-xl">
        <button type="button" class="modal-close absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-np-text-muted hover:text-np-text transition-colors">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
        <div class="flex items-center gap-2 mb-1">
          <span class="label-tech" id="modal-field-tag">ÉDITION DE CONTENU</span>
        </div>
        <h3 class="font-grotesk font-bold text-xl mb-4 text-np-text" id="modal-field-title">Modifier le texte</h3>
        <form id="admin-text-form">
          <div class="mb-2">
            <textarea id="modal-text-input" rows="6" class="form-textarea w-full font-inter text-sm" placeholder="Saisir le contenu..."></textarea>
          </div>
          <div class="flex justify-between items-center text-xs font-mono text-np-text-muted mb-6">
            <span id="modal-char-count">0 caractères</span>
            <span id="modal-word-count">0 mots</span>
          </div>
          <div class="flex justify-end gap-3">
            <button type="button" class="btn-secondary px-4 py-2 text-xs modal-cancel">Annuler</button>
            <button type="submit" class="btn-primary px-5 py-2 text-xs" id="modal-text-save">Enregistrer</button>
          </div>
        </form>
      </div>
    `;
    document.body.appendChild(textModal);
  }

  if (document.getElementById('admin-seo-modal')) {
    seoModal = document.getElementById('admin-seo-modal');
  } else {
    // Create SEO Panel Modal
    seoModal = document.createElement('div');
    seoModal.id = 'admin-seo-modal';
    seoModal.className = 'modal-overlay';
    seoModal.setAttribute('role', 'dialog');
    seoModal.setAttribute('aria-modal', 'true');
    seoModal.innerHTML = `
      <div class="modal-content max-w-xl">
        <button type="button" class="modal-close absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-np-text-muted hover:text-np-text transition-colors">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
        <div class="flex items-center gap-2 mb-1">
          <span class="label-tech">RÉFÉRENCEMENT NATUREL</span>
        </div>
        <h3 class="font-grotesk font-bold text-xl mb-4 text-np-text">Balises SEO de la page</h3>
        <form id="admin-seo-form">
          <div class="mb-4">
            <div class="flex justify-between items-center mb-1">
              <label class="form-label text-xs mb-0" for="modal-seo-title">Titre de la page (title)</label>
              <span class="text-xs font-mono text-np-text-muted" id="modal-seo-title-count">0/60</span>
            </div>
            <input type="text" id="modal-seo-title" class="form-input text-sm" placeholder="ex: NOVA PRESTIGE — Bureau d'études techniques">
          </div>
          <div class="mb-6">
            <div class="flex justify-between items-center mb-1">
              <label class="form-label text-xs mb-0" for="modal-seo-desc">Description (meta description)</label>
              <span class="text-xs font-mono text-np-text-muted" id="modal-seo-desc-count">0/160</span>
            </div>
            <textarea id="modal-seo-desc" rows="4" class="form-textarea w-full font-inter text-sm" placeholder="ex: Expertise technique, calculs de structures et enveloppe de bâtiment..."></textarea>
          </div>
          <div class="flex justify-end gap-3">
            <button type="button" class="btn-secondary px-4 py-2 text-xs modal-cancel">Annuler</button>
            <button type="submit" class="btn-primary px-5 py-2 text-xs" id="modal-seo-save">Sauvegarder le SEO</button>
          </div>
        </form>
      </div>
    `;
    document.body.appendChild(seoModal);
  }

  // Pre-create hidden image file picker
  if (!imageFileInput) {
    imageFileInput = document.createElement('input');
    imageFileInput.id = 'admin-image-file-input';
    imageFileInput.type = 'file';
    imageFileInput.accept = 'image/jpeg,image/png,image/webp,image/jpg';
    imageFileInput.style.cssText = 'position:fixed;top:-9999px;left:-9999px;opacity:0;pointer-events:none;';
    document.body.appendChild(imageFileInput);
  }

  // Setup modal close handlers
  [textModal, seoModal].forEach(modal => {
    if (!modal) return;
    modal.querySelectorAll('.modal-close, .modal-cancel').forEach(btn => {
      btn.onclick = () => modal.classList.remove('is-open');
    });
    modal.onclick = (e) => {
      if (e.target === modal) modal.classList.remove('is-open');
    };
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      textModal?.classList.remove('is-open');
      seoModal?.classList.remove('is-open');
    }
  });
}

/**
 * Attaches pencil edit buttons to all [data-edit] elements
 * Also enables direct click on any editable text/image
 */
function setupEditableElements() {
  const editables = document.querySelectorAll('[data-edit]');

  editables.forEach(el => {
    try {
      if (el.dataset.adminBound === '1') return;
      el.dataset.adminBound = '1';

      const fieldKey = el.getAttribute('data-edit');
      if (!fieldKey) return;

      const isImage = el.tagName.toLowerCase() === 'img' ||
                      el.getAttribute('data-edit-type') === 'image' ||
                      el.getAttribute('data-type') === 'image' ||
                      (el.children.length === 1 && el.firstElementChild.tagName.toLowerCase() === 'img');

      // Add visual title
      el.title = isImage ? `Cliquer pour choisir une nouvelle image : ${fieldKey}` : `Cliquer pour modifier : ${fieldKey}`;

      // Handler to trigger the edit action
      const handleEditAction = (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (isImage) {
          triggerImageFilePicker(el, fieldKey);
        } else {
          openTextEditModal(el, fieldKey);
        }
      };

      // Clicking directly on the editable element
      el.addEventListener('click', (e) => {
        if (e.target.closest('.edit-btn')) return;
        handleEditAction(e);
      });

      // Avoid double attaching button
      if (el.querySelector(':scope > .edit-btn')) return;

      // Create pencil button
      const btn = document.createElement('button');
      btn.type = 'button';
      btn.className = 'edit-btn';
      btn.title = isImage ? `Changer l'image : ${fieldKey}` : `Modifier : ${fieldKey}`;
      btn.setAttribute('aria-label', btn.title);
      btn.innerHTML = isImage ? `
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
          <circle cx="8.5" cy="8.5" r="1.5"/>
          <polyline points="21 15 16 10 5 21"/>
        </svg>
      ` : `
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
        </svg>
      `;

      btn.addEventListener('click', (e) => {
        handleEditAction(e);
      });

      // Void elements like <img> cannot have children!
      if (el.tagName.toLowerCase() === 'img') {
        const parent = el.parentElement;
        if (parent) {
          const parentStyle = window.getComputedStyle(parent);
          if (parentStyle.position === 'static') {
            parent.style.position = 'relative';
          }
          btn.style.zIndex = '50';
          btn.style.top = '16px';
          btn.style.right = '16px';
          parent.appendChild(btn);
        }
      } else {
        const style = window.getComputedStyle(el);
        if (style.position === 'static') {
          el.style.position = 'relative';
        }
        el.appendChild(btn);
      }
    } catch (err) {
      console.warn('Error setting up editable element:', el, err);
    }
  });
}

/**
 * Text editing flow
 */
function openTextEditModal(element, fieldKey) {
  if (!textModal) {
    setupModals();
  }
  if (!textModal) return;

  const pageKey = getPageKey();
  const textarea = textModal.querySelector('#modal-text-input');
  const tagEl = textModal.querySelector('#modal-field-tag');
  const titleEl = textModal.querySelector('#modal-field-title');
  const charCount = textModal.querySelector('#modal-char-count');
  const wordCount = textModal.querySelector('#modal-word-count');
  const saveBtn = textModal.querySelector('#modal-text-save');

  tagEl.textContent = `${pageKey} · ${fieldKey}`.toUpperCase();
  titleEl.textContent = `Modifier ${fieldKey}`;

  // Extract raw text excluding edit button
  let currentText = '';
  const clone = element.cloneNode(true);
  const existingBtn = clone.querySelector('.edit-btn');
  if (existingBtn) existingBtn.remove();
  currentText = clone.textContent.trim();

  textarea.value = currentText;

  const updateCounts = () => {
    const val = textarea.value;
    charCount.textContent = `${val.length} caractères`;
    const words = val.trim() ? val.trim().split(/\s+/).length : 0;
    wordCount.textContent = `${words} mots`;
  };

  textarea.oninput = updateCounts;
  updateCounts();

  textModal.classList.add('is-open');
  setTimeout(() => textarea.focus(), 80);

  const form = textModal.querySelector('#admin-text-form');
  form.onsubmit = async (e) => {
    e.preventDefault();
    const newValue = textarea.value;
    saveBtn.disabled = true;
    saveBtn.textContent = 'Enregistrement...';

    const dataType = element.getAttribute('data-type') || 'text';

    try {
      const res = await fetch('/api/content-save', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': getCsrfToken()
        },
        body: JSON.stringify({
          page_key: pageKey,
          field_key: fieldKey,
          type: dataType,
          value: newValue,
          _csrf: getCsrfToken()
        })
      });

      const data = await res.json().catch(() => ({}));

      if (res.ok && (data.success || data.ok)) {
        // Update DOM element preserving pencil button
        const btn = element.querySelector('.edit-btn');
        if (element.hasAttribute('data-count')) {
          element.setAttribute('data-count', newValue);
        }
        if (dataType === 'richtext') {
          element.innerHTML = newValue;
        } else {
          element.textContent = newValue;
        }
        if (btn) element.appendChild(btn);

        textModal.classList.remove('is-open');
        showToast('Texte enregistré avec succès', 'success');
      } else {
        showToast(data.error || 'Erreur lors de la sauvegarde.', 'error');
      }
    } catch (err) {
      console.error(err);
      showToast('Erreur réseau lors de la sauvegarde.', 'error');
    } finally {
      saveBtn.disabled = false;
      saveBtn.textContent = 'Enregistrer';
    }
  };
}

/**
 * Image file picker flow:
 * Directly opens OS file explorer when user clicks to change an image,
 * then uploads and updates the image automatically.
 */
function triggerImageFilePicker(element, fieldKey) {
  const pageKey = getPageKey();
  let imgTarget = element.tagName.toLowerCase() === 'img' ? element : element.querySelector('img');

  if (!imageFileInput) {
    imageFileInput = document.getElementById('admin-image-file-input');
  }
  if (!imageFileInput) {
    imageFileInput = document.createElement('input');
    imageFileInput.id = 'admin-image-file-input';
    imageFileInput.type = 'file';
    imageFileInput.accept = 'image/jpeg,image/png,image/webp,image/jpg';
    imageFileInput.style.cssText = 'position:fixed;top:-9999px;left:-9999px;opacity:0;pointer-events:none;';
    document.body.appendChild(imageFileInput);
  }

  imageFileInput.value = '';
  imageFileInput.onchange = async () => {
    const file = imageFileInput.files?.[0];
    if (!file) return;

    showToast("Téléversement et optimisation de l'image en cours...", 'success');

    // Immediate local preview for responsive UX
    const tempUrl = URL.createObjectURL(file);
    if (!imgTarget && element) {
      imgTarget = element.querySelector('img');
      if (!imgTarget) {
        imgTarget = document.createElement('img');
        imgTarget.className = 'w-full h-full object-cover';
        element.appendChild(imgTarget);
      }
    }
    if (imgTarget) {
      imgTarget.src = tempUrl;
    }

    try {
      const formData = new FormData();
      formData.append('image', file);
      formData.append('page_key', pageKey);
      formData.append('field_key', fieldKey);
      formData.append('alt', imgTarget?.getAttribute('alt') || '');
      formData.append('_csrf', getCsrfToken());

      const res = await fetch('/api/image-upload', {
        method: 'POST',
        headers: {
          'X-CSRF-Token': getCsrfToken()
        },
        body: formData
      });

      const data = await res.json().catch(() => ({}));

      if (res.ok && (data.success || data.ok)) {
        const finalUrl = data.src || data.url || data.image_url;
        if (!imgTarget && element) {
          imgTarget = element.querySelector('img');
        }
        if (imgTarget && finalUrl) {
          imgTarget.src = finalUrl;
          if (data.srcset) {
            imgTarget.srcset = data.srcset;
          } else {
            imgTarget.removeAttribute('srcset');
          }
        }
        showToast('Image remplacée et enregistrée avec succès !', 'success');
      } else {
        showToast(data.error || "Erreur lors du téléversement de l'image.", 'error');
      }
    } catch (err) {
      console.error(err);
      showToast('Erreur réseau lors du téléversement.', 'error');
    }
  };

  // Open the file dialog
  imageFileInput.click();
}

/**
 * SEO metadata modal
 */
function openSeoModal() {
  if (!seoModal) {
    setupModals();
  }
  if (!seoModal) return;

  const pageKey = getPageKey();
  const titleInput = seoModal.querySelector('#modal-seo-title');
  const descInput = seoModal.querySelector('#modal-seo-desc');
  const titleCount = seoModal.querySelector('#modal-seo-title-count');
  const descCount = seoModal.querySelector('#modal-seo-desc-count');
  const saveBtn = seoModal.querySelector('#modal-seo-save');

  // Load current page SEO values
  titleInput.value = document.title || '';
  const currentDesc = document.querySelector('meta[name="description"]')?.content || '';
  descInput.value = currentDesc;

  const updateSeoCounts = () => {
    titleCount.textContent = `${titleInput.value.length}/60`;
    titleCount.style.color = titleInput.value.length > 60 ? '#ef4444' : '';

    descCount.textContent = `${descInput.value.length}/160`;
    descCount.style.color = descInput.value.length > 160 ? '#ef4444' : '';
  };

  titleInput.oninput = updateSeoCounts;
  descInput.oninput = updateSeoCounts;
  updateSeoCounts();

  seoModal.classList.add('is-open');
  setTimeout(() => titleInput.focus(), 80);

  const form = seoModal.querySelector('#admin-seo-form');
  form.onsubmit = async (e) => {
    e.preventDefault();
    saveBtn.disabled = true;
    saveBtn.textContent = 'Enregistrement...';

    try {
      const res = await fetch('/api/content-save', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-Token': getCsrfToken()
        },
        body: JSON.stringify({
          page_key: pageKey,
          seo: {
            title: titleInput.value,
            description: descInput.value
          },
          _csrf: getCsrfToken()
        })
      });

      const data = await res.json().catch(() => ({}));

      if (res.ok && (data.success || data.ok)) {
        document.title = titleInput.value;
        const metaDesc = document.querySelector('meta[name="description"]');
        if (metaDesc) {
          metaDesc.content = descInput.value;
        }
        seoModal.classList.remove('is-open');
        showToast('Métadonnées SEO enregistrées', 'success');
      } else {
        showToast(data.error || 'Erreur lors de la mise à jour SEO.', 'error');
      }
    } catch (err) {
      console.error(err);
      showToast('Erreur réseau lors de la mise à jour SEO.', 'error');
    } finally {
      saveBtn.disabled = false;
      saveBtn.textContent = 'Sauvegarder le SEO';
    }
  };
}
