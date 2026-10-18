/**
 * NOVA PRESTIGE — Reveal Animations & IntersectionObservers
 * ES Module
 */

export function initReveal() {
  // Check prefers-reduced-motion
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  
  // REVEAL ANIMATIONS
  if (!prefersReduced) {
    const revealClasses = ['.reveal-up', '.reveal-fade', '.reveal-left', '.reveal-right'];
    const revealEls = document.querySelectorAll(revealClasses.join(','));
    
    if (revealEls.length > 0) {
      const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-revealed');
            revealObserver.unobserve(entry.target);
          }
        });
      }, { threshold: 0.15 });
      
      revealEls.forEach(el => revealObserver.observe(el));
    }
  } else {
    // Reduced motion: make everything visible immediately
    document.querySelectorAll('.reveal-up, .reveal-fade, .reveal-left, .reveal-right').forEach(el => {
      el.classList.add('is-revealed');
    });
  }
  
  // COUNTER ANIMATION
  const counterEls = document.querySelectorAll('[data-count]');
  if (counterEls.length > 0) {
    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });
    
    counterEls.forEach(el => counterObserver.observe(el));
  }
  
  function animateCounter(el) {
    const target = el.getAttribute('data-count');
    if (!target) return;
    const hasPlus = target.includes('+');
    const hasPercent = target.includes('%');
    const num = parseInt(target.replace(/[^0-9]/g, ''), 10);
    
    if (isNaN(num) || prefersReduced) {
      el.textContent = target;
      return;
    }
    
    const duration = 1500;
    const start = performance.now();
    
    function update(now) {
      const elapsed = now - start;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
      const current = Math.round(eased * num);
      
      let suffix = '';
      if (hasPlus) suffix = '+';
      else if (hasPercent) suffix = '%';
      
      el.textContent = current + suffix;
      if (progress < 1) requestAnimationFrame(update);
    }
    requestAnimationFrame(update);
  }
  
  // PROCESS TIMELINE FILL
  const processTracks = document.querySelectorAll('.process-track');
  if (processTracks.length > 0) {
    const processObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-filling');
        }
      });
    }, { threshold: 0.3 });
    processTracks.forEach(el => processObserver.observe(el));
  }
  
  // WORD-BY-WORD REVEAL
  if (!prefersReduced) {
    document.querySelectorAll('[data-word-reveal]').forEach(el => {
      const words = el.textContent.trim().split(/\s+/);
      el.innerHTML = words.map((w, i) => 
        `<span class="word-wrap inline-block overflow-hidden"><span class="word-inner inline-block" style="animation: slide-up 0.5s ease-out ${i * 0.06}s both">${w}</span></span>`
      ).join(' ');
    });
  }
  
  // SVG STROKE ANIMATION
  document.querySelectorAll('[data-stroke-anim]').forEach(path => {
    let length = 1000;
    try {
      if (typeof path.getTotalLength === 'function') {
        length = path.getTotalLength();
      }
    } catch {
      length = 1000;
    }
    
    path.style.strokeDasharray = `${length}`;
    path.style.strokeDashoffset = `${length}`;
    
    const strokeObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          path.style.transition = 'stroke-dashoffset 1.5s ease-out';
          path.style.strokeDashoffset = '0';
          strokeObserver.unobserve(path);
        }
      });
    }, { threshold: 0.3 });
    strokeObserver.observe(path);
  });
}
