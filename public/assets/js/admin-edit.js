/**
 * NOVA PRESTIGE — Admin Inline Editing System
 * ES Module
 * Active when document.body[data-admin="1"]
 */

import { showToast } from './forms.js';

export function initAdminEdit() {
  if (document.body.getAttribute('data-admin') !== '1') return;
  if (window.__adminEditInitialized) return;
  window.__adminEditInitialized = true;

  injectAdminBar();
  setupEditableElements();
  setupModals();
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
 * Attaches pencil edit buttons to all [data-edit] elements
 */
function setupEditableElements() {
  const editables = document.querySelectorAll('[data-edit]');

  editables.forEach(el => {
    // Avoid double attaching
    if (el.querySelector(':scope > .edit-btn')) return;

    const fieldKey = el.getAttribute('data-edit');
    const isImage = el.tagName.toLowerCase() === 'img' ||
                    el.getAttribute('data-edit-type') === 'image' ||
                    (el.children.length === 1 && el.firstElementChild.tagName.toLowerCase() === 'img');

    // Create pencil button
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'edit-btn';
    btn.title = `Modifier : ${fieldKey}`;
    btn.setAttribute('aria-label', `Modifier : ${fieldKey}`);
    btn.innerHTML = `
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
      </svg>
    `;

    // Ensure parent has position relative
    const style = window.getComputedStyle(el);
    if (style.position === 'static') {
      el.style.position = 'relative';
    }

    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();

      if (isImage) {
        openImageEditModal(el, fieldKey);
      } else {
        openTextEditModal(el, fieldKey);
      }
    });

    el.appendChild(btn);
  });
}

/**
 * Modals container and templates
 */
let textModal, imageModal, seoModal;

function setupModals() {
  // Create Text Edit Modal
  textModal = document.createElement('div');
  textModal.id = 'admin-text-modal';
  textModal.className = 'modal-overlay';
  textModal.setAttribute('role', 'dialog');
  textModal.setAttribute('aria-modal', 'true');
  textModal.innerHTML = `
    <div class="modal-content max-w-xl">
      <button type="button" class="modal-close absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-np-text-muted hover:text-np-text">
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

  // Create Image Edit Modal
  imageModal = document.createElement('div');
  imageModal.id = 'admin-image-modal';
  imageModal.className = 'modal-overlay';
  imageModal.setAttribute('role', 'dialog');
  imageModal.setAttribute('aria-modal', 'true');
  imageModal.innerHTML = `
    <div class="modal-content max-w-lg">
      <button type="button" class="modal-close absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-np-text-muted hover:text-np-text">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
      <div class="flex items-center gap-2 mb-1">
        <span class="label-tech" id="modal-image-tag">GESTION D'IMAGE</span>
      </div>
      <h3 class="font-grotesk font-bold text-xl mb-4 text-np-text">Remplacer l'image</h3>
      <form id="admin-image-form">
        <div class="mb-4">
          <label class="form-label text-xs">Aperçu actuel</label>
          <div class="w-full h-40 bg-np-bg rounded border border-np-border overflow-hidden flex items-center justify-center">
            <img id="modal-img-preview" src="" alt="Preview" class="max-w-full max-h-full object-contain">
          </div>
        </div>
        <div class="mb-4">
          <label class="form-label text-xs" for="modal-image-file">Nouveau fichier (JPG, PNG, WEBP, SVG)</label>
          <input type="file" id="modal-image-file" accept="image/*" class="form-input text-xs cursor-pointer">
        </div>
        <div class="mb-4">
          <label class="form-label text-xs" for="modal-image-alt">Texte alternatif (Accessibilité & SEO)</label>
          <input type="text" id="modal-image-alt" class="form-input text-xs" placeholder="Description de l'image">
        </div>
        <div id="modal-image-progress-bar" class="w-full bg-np-border h-1.5 rounded-full overflow-hidden mb-4 hidden">
          <div id="modal-image-progress-fill" class="bg-np-accent h-full w-0 transition-all duration-200"></div>
        </div>
        <div class="flex justify-end gap-3">
          <button type="button" class="btn-secondary px-4 py-2 text-xs modal-cancel">Annuler</button>
          <button type="submit" class="btn-primary px-5 py-2 text-xs" id="modal-image-save">Uploader et enregistrer</button>
        </div>
      </form>
    </div>
  `;
  document.body.appendChild(imageModal);

  // Create SEO Panel Modal
  seoModal = document.createElement('div');
  seoModal.id = 'admin-seo-modal';
  seoModal.className = 'modal-overlay';
  seoModal.setAttribute('role', 'dialog');
  seoModal.setAttribute('aria-modal', 'true');
  seoModal.innerHTML = `
    <div class="modal-content max-w-xl">
      <button type="button" class="modal-close absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-np-text-muted hover:text-np-text">
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

  // Close handlers
  [textModal, imageModal, seoModal].forEach(modal => {
    modal.querySelectorAll('.modal-close, .modal-cancel').forEach(btn => {
      btn.addEventListener('click', () => modal.classList.remove('is-open'));
    });
    modal.addEventListener('click', (e) => {
      if (e.target === modal) modal.classList.remove('is-open');
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      textModal.classList.remove('is-open');
      imageModal.classList.remove('is-open');
      seoModal.classList.remove('is-open');
    }
  });
}

/**
 * Text editing flow
 */
function openTextEditModal(element, fieldKey) {
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
  setTimeout(() => textarea.focus(), 100);

  const form = textModal.querySelector('#admin-text-form');
  form.onsubmit = async (e) => {
    e.preventDefault();
    const newValue = textarea.value;
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
          field_key: fieldKey,
          value: newValue,
          _csrf: getCsrfToken()
        })
      });

      const data = await res.json().catch(() => ({}));

      if (res.ok && (data.success || data.ok)) {
        // Update DOM element preserving pencil button
        const btn = element.querySelector('.edit-btn');
        element.textContent = newValue;
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
 * Image editing flow
 */
function openImageEditModal(element, fieldKey) {
  const pageKey = getPageKey();
  const imgTarget = element.tagName.toLowerCase() === 'img' ? element : element.querySelector('img');
  const preview = imageModal.querySelector('#modal-img-preview');
  const fileInput = imageModal.querySelector('#modal-image-file');
  const altInput = imageModal.querySelector('#modal-image-alt');
  const tagEl = imageModal.querySelector('#modal-image-tag');
  const saveBtn = imageModal.querySelector('#modal-image-save');
  const progressBox = imageModal.querySelector('#modal-image-progress-bar');
  const progressFill = imageModal.querySelector('#modal-image-progress-fill');

  tagEl.textContent = `${pageKey} · ${fieldKey}`.toUpperCase();
  fileInput.value = '';
  progressBox.classList.add('hidden');
  progressFill.style.width = '0%';

  if (imgTarget) {
    preview.src = imgTarget.src;
    altInput.value = imgTarget.getAttribute('alt') || '';
  }

  fileInput.onchange = () => {
    const file = fileInput.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  };

  imageModal.classList.add('is-open');

  const form = imageModal.querySelector('#admin-image-form');
  form.onsubmit = async (e) => {
    e.preventDefault();
    const file = fileInput.files[0];
    const newAlt = altInput.value;

    if (!file && !newAlt) {
      showToast('Aucune modification détectée.', 'error');
      return;
    }

    saveBtn.disabled = true;
    saveBtn.textContent = 'Téléversement...';
    progressBox.classList.remove('hidden');
    progressFill.style.width = '30%';

    try {
      const formData = new FormData();
      formData.append('page_key', pageKey);
      formData.append('field_key', fieldKey);
      formData.append('alt', newAlt);
      formData.append('_csrf', getCsrfToken());

      if (file) {
        formData.append('image', file);
      }

      progressFill.style.width = '60%';

      const res = await fetch('/api/image-upload', {
        method: 'POST',
        headers: {
          'X-CSRF-Token': getCsrfToken()
        },
        body: formData
      });

      progressFill.style.width = '90%';
      const data = await res.json().catch(() => ({}));

      if (res.ok && (data.success || data.ok)) {
        progressFill.style.width = '100%';
        if (imgTarget) {
          if (data.url || data.image_url) {
            imgTarget.src = data.url || data.image_url;
          }
          imgTarget.setAttribute('alt', newAlt);
        }
        imageModal.classList.remove('is-open');
        showToast('Image remplacée avec succès', 'success');
      } else {
        showToast(data.error || 'Erreur lors du téléversement.', 'error');
      }
    } catch (err) {
      console.error(err);
      showToast('Erreur réseau lors du téléversement.', 'error');
    } finally {
      saveBtn.disabled = false;
      saveBtn.textContent = 'Uploader et enregistrer';
    }
  };
}

/**
 * SEO metadata modal
 */
function openSeoModal() {
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
  setTimeout(() => titleInput.focus(), 100);

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
