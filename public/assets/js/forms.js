/**
 * NOVA PRESTIGE — Form Handling & Validation
 * ES Module
 */

export function initForms() {
  // Handle all AJAX forms
  document.querySelectorAll('form[data-ajax]').forEach(form => {
    form.addEventListener('submit', handleFormSubmit);
  });
  
  // Hide mobile action bar on input focus for better keyboard experience
  const mobileBar = document.getElementById('mobile-action-bar');
  if (mobileBar) {
    document.querySelectorAll('input, textarea, select').forEach(input => {
      input.addEventListener('focus', () => {
        mobileBar.style.transform = 'translateY(100%)';
        mobileBar.style.transition = 'transform 0.2s ease';
      });
      input.addEventListener('blur', () => {
        mobileBar.style.transform = '';
      });
    });
  }
}

async function handleFormSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const submitBtn = form.querySelector('[type="submit"]');
  const btnText = submitBtn?.querySelector('span') || submitBtn;
  
  // Client-side validation
  if (!validateForm(form)) return;
  
  // Loading state
  const originalText = btnText ? btnText.textContent : 'Envoyer';
  if (submitBtn) {
    submitBtn.disabled = true;
    if (btnText) btnText.textContent = 'Envoi en cours...';
  }
  
  try {
    const formData = new FormData(form);
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const endpoint = form.getAttribute('action') || '/api/contact-submit';
    
    const res = await fetch(endpoint, {
      method: 'POST',
      headers: {
        'X-CSRF-Token': csrfToken
      },
      body: formData,
    });
    
    const data = await res.json().catch(() => ({}));
    
    if (res.ok && (data.success || data.ok)) {
      form.reset();
      clearFormErrors(form);
      showToast(data.message || 'Votre demande a bien été envoyée. Nous vous répondrons rapidement.', 'success');
    } else if (data.errors) {
      showFormErrors(form, data.errors);
      showToast('Veuillez corriger les erreurs du formulaire.', 'error');
    } else {
      showToast(data.error || 'Une erreur est survenue. Veuillez réessayer.', 'error');
    }
  } catch (err) {
    console.error('Form submission error:', err);
    showToast('Erreur de connexion. Veuillez vérifier votre réseau.', 'error');
  } finally {
    if (submitBtn) {
      submitBtn.disabled = false;
      if (btnText) btnText.textContent = originalText;
    }
  }
}

function validateForm(form) {
  let valid = true;
  clearFormErrors(form);
  
  // Required fields check
  form.querySelectorAll('[required]').forEach(field => {
    if (field.type === 'checkbox' && !field.checked) {
      showFieldError(field, 'Ce champ est obligatoire.');
      valid = false;
    } else if (field.type !== 'checkbox' && !field.value.trim()) {
      showFieldError(field, 'Ce champ est obligatoire.');
      valid = false;
    }
  });
  
  // Email fields check
  const emailFields = form.querySelectorAll('input[type="email"]');
  emailFields.forEach(field => {
    if (field.value.trim() && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value.trim())) {
      showFieldError(field, 'Veuillez saisir une adresse e-mail valide.');
      valid = false;
    }
  });
  
  // Min length for message or description
  const descField = form.querySelector('[name="message"], [name="description"]');
  if (descField && descField.value.trim().length > 0 && descField.value.trim().length < 20) {
    showFieldError(descField, 'Veuillez saisir au moins 20 caractères.');
    valid = false;
  }
  
  // RGPD checkbox check
  const rgpd = form.querySelector('[name="rgpd"]');
  if (rgpd && !rgpd.checked) {
    showFieldError(rgpd, 'Vous devez accepter la politique de confidentialité.');
    valid = false;
  }
  
  return valid;
}

function showFieldError(field, message) {
  field.classList.add('has-error');
  
  const fieldId = field.id || (field.name ? `field-${field.name}` : `field-${Math.random().toString(36).substr(2, 6)}`);
  if (!field.id) field.id = fieldId;
  
  let error = document.getElementById(`${field.id}-error`);
  if (!error) {
    error = document.createElement('p');
    error.id = `${field.id}-error`;
    error.className = 'form-error';
    error.setAttribute('role', 'alert');
    
    // Insert after field or after field's parent if wrapped
    if (field.type === 'checkbox') {
      const parentLabel = field.closest('label');
      if (parentLabel && parentLabel.parentNode) {
        parentLabel.parentNode.insertBefore(error, parentLabel.nextSibling);
      } else {
        field.parentNode.appendChild(error);
      }
    } else {
      field.parentNode.appendChild(error);
    }
    
    field.setAttribute('aria-describedby', error.id);
  }
  error.textContent = message;
}

function clearFormErrors(form) {
  form.querySelectorAll('.has-error').forEach(f => f.classList.remove('has-error'));
  form.querySelectorAll('.form-error').forEach(e => e.remove());
}

function showFormErrors(form, errors) {
  Object.entries(errors).forEach(([name, message]) => {
    const field = form.querySelector(`[name="${name}"]`);
    if (field) {
      showFieldError(field, message);
    }
  });
}

export function showToast(message, type = 'success') {
  if (typeof Toastify === 'undefined') {
    console.log(`[Toast ${type}]`, message);
    return;
  }
  
  Toastify({
    text: message,
    duration: 4000,
    close: true,
    gravity: 'top',
    position: 'right',
    className: type === 'success' ? 'toast-success' : 'toast-error',
    style: {
      background: type === 'success' ? '#12304F' : '#dc2626',
      borderRadius: '4px',
      fontFamily: 'Inter, sans-serif',
      fontSize: '14px',
      boxShadow: '0 10px 25px -5px rgba(0, 0, 0, 0.3)',
    },
    stopOnFocus: true,
  }).showToast();
}
