(() => {
  const consentKey = 'np-analytics-consent-v1';
  const consentBanner = document.getElementById('analytics-consent');

  if (!consentBanner) {
    return;
  }

  const status = consentBanner.querySelector('[data-consent-status]');
  const acceptButton = consentBanner.querySelector('[data-consent-accept]');
  const rejectButton = consentBanner.querySelector('[data-consent-reject]');
  let currentConsent = null;
  let tagManagerLoaded = false;

  const hideBanner = () => consentBanner.classList.add('hidden');
  const showBanner = () => consentBanner.classList.remove('hidden');

  const saveConsent = (choice) => {
    try {
      localStorage.setItem(consentKey, choice);
      return true;
    } catch (error) {
      console.error('Unable to save analytics consent preference.', error);
      status.textContent = 'Votre choix s’applique à cette visite, mais n’a pas pu être mémorisé dans ce navigateur.';
      return false;
    }
  };

  const updateTagManagerConsent = (choice) => {
    if (!tagManagerLoaded || typeof window.gtag !== 'function') {
      return;
    }

    const granted = choice === 'accepted' ? 'granted' : 'denied';
    window.gtag('consent', 'update', {
      analytics_storage: granted,
      ad_storage: granted,
      ad_user_data: granted,
      ad_personalization: granted,
    });
  };

  const loadTagManager = () => {
    window.dataLayer = window.dataLayer || [];
    window.gtag = window.gtag || function gtag() {
      window.dataLayer.push(arguments);
    };

    window.gtag('consent', 'update', {
      analytics_storage: 'granted',
      ad_storage: 'granted',
      ad_user_data: 'granted',
      ad_personalization: 'granted',
    });
    window.dataLayer.push({ 'gtm.start': Date.now(), event: 'gtm.js' });

    if (tagManagerLoaded || document.querySelector('script[src*="gtm.js?id=GTM-WKRK9KWH"]')) {
      tagManagerLoaded = true;
      return;
    }

    const script = document.createElement('script');
    script.async = true;
    script.src = 'https://www.googletagmanager.com/gtm.js?id=GTM-WKRK9KWH';
    script.onerror = () => {
      console.error('Google Tag Manager could not be loaded.');
      tagManagerLoaded = false;
    };
    document.head.appendChild(script);
    tagManagerLoaded = true;
  };

  const chooseConsent = (choice) => {
    currentConsent = choice;
    const saved = saveConsent(choice);

    if (choice === 'accepted') {
      loadTagManager();
    } else {
      updateTagManagerConsent(choice);
    }

    if (saved) {
      status.textContent = '';
      hideBanner();
    }
  };

  acceptButton.addEventListener('click', () => chooseConsent('accepted'));
  rejectButton.addEventListener('click', () => chooseConsent('rejected'));

  document.querySelectorAll('[data-consent-open]').forEach((button) => {
    button.addEventListener('click', () => {
      status.textContent = '';
      showBanner();
      acceptButton.focus();
    });
  });

  try {
    currentConsent = localStorage.getItem(consentKey);
  } catch (error) {
    console.error('Unable to read analytics consent preference.', error);
    status.textContent = 'Votre préférence ne peut pas être lue dans ce navigateur. Choisissez une option pour cette visite.';
  }

  if (currentConsent === 'accepted') {
    loadTagManager();
    hideBanner();
  } else if (currentConsent === 'rejected') {
    hideBanner();
  } else {
    showBanner();
  }
})();
