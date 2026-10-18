/**
 * NOVA PRESTIGE — Theme Manager (Dark / Light Mode)
 * ES Module
 */

const STORAGE_KEY = 'np-theme';

export function toggleTheme() {
  const root = document.documentElement;
  const isDark = root.classList.contains('dark');
  
  if (isDark) {
    root.classList.remove('dark');
    localStorage.setItem(STORAGE_KEY, 'light');
  } else {
    root.classList.add('dark');
    localStorage.setItem(STORAGE_KEY, 'dark');
  }
}

export function initTheme() {
  const root = document.documentElement;
  
  // Verify or apply initial theme from localStorage or system preference
  const saved = localStorage.getItem(STORAGE_KEY);
  if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    root.classList.add('dark');
  } else if (saved === 'light') {
    root.classList.remove('dark');
  }

  // Bind all theme toggle buttons — desktop (#theme-toggle) + mobile (#mobile-theme-toggle)
  const toggles = document.querySelectorAll('#theme-toggle, #mobile-theme-toggle, .theme-toggle-btn');
  toggles.forEach(toggle => {
    toggle.addEventListener('click', (e) => {
      e.preventDefault();
      toggleTheme();
    });
  });

  // Listen to OS preference change if user hasn't explicitly set a preference
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem(STORAGE_KEY)) {
      if (e.matches) {
        root.classList.add('dark');
      } else {
        root.classList.remove('dark');
      }
    }
  });
}
