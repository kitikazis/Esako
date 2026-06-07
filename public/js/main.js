/**
 * ESAKO GLOBAL SAC — main.js
 * Nav · Slider · Lazy images · Swipe · Scroll shadow
 */
(function () {
  'use strict';

  // Traducciones expuestas por el servidor (ver layout main.php)
  var I18N = (window.ESAKO && window.ESAKO.i18n) || {};
  function tr(key, fallback) { return I18N[key] || fallback; }

  /* ══════════════════════════════════════════════════════
     NAV — hamburger + outside click + active link
  ══════════════════════════════════════════════════════ */
  function initNav() {
    var btn = document.getElementById('nav-toggle');
    var nav = document.getElementById('site-nav');
    if (!btn || !nav) return;

    btn.addEventListener('click', function () {
      var open = nav.classList.toggle('is-open');
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
      document.body.style.overflow = open ? 'hidden' : '';
    });

    document.addEventListener('click', function (e) {
      if (!e.target.closest('.site-header') && nav.classList.contains('is-open')) {
        nav.classList.remove('is-open');
        btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && nav.classList.contains('is-open')) {
        nav.classList.remove('is-open');
        btn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        btn.focus();
      }
    });

    // Mark active link by filename
    var page = window.location.pathname.split('/').pop().replace('.html', '').replace('.php', '');
    document.querySelectorAll('.nav-list > li > a').forEach(function (a) {
      var href = (a.getAttribute('href') || '').split('/').pop().replace('.html', '').replace('.php', '');
      if (href === page || (page === '' && (href === 'index' || href === ''))) {
        a.classList.add('active');
      }
    });
  }

  /* ══════════════════════════════════════════════════════
     SCROLL SHADOW — header shadow on scroll
  ══════════════════════════════════════════════════════ */
  function initScrollShadow() {
    var header = document.querySelector('.site-header');
    if (!header) return;
    window.addEventListener('scroll', function () {
      header.classList.toggle('scrolled', window.scrollY > 8);
    }, { passive: true });
  }

  /* ══════════════════════════════════════════════════════
     HERO SLIDER
  ══════════════════════════════════════════════════════ */
  function initSlider() {
    var hero = document.getElementById('hero');
    if (!hero) return;

    var slides  = Array.from(hero.querySelectorAll('.slide'));
    if (slides.length < 2) return;

    var current = 0;
    var paused  = false;
    var timer   = null;

    /* ── Build dots ──────────────────────────── */
    var dotsWrap = document.createElement('div');
    dotsWrap.className = 'slider-dots';
    dotsWrap.setAttribute('role', 'tablist');
    dotsWrap.setAttribute('aria-label', tr('slides', 'Diapositivas'));
    slides.forEach(function (_, i) {
      var d = document.createElement('button');
      d.className = 'dot' + (i === 0 ? ' is-active' : '');
      d.setAttribute('role', 'tab');
      d.setAttribute('aria-label', tr('slide', 'Diapositiva') + ' ' + (i + 1));
      d.addEventListener('click', function () { goTo(i); });
      dotsWrap.appendChild(d);
    });
    hero.appendChild(dotsWrap);

    /* ── Build arrows ────────────────────────── */
    function makeArrow(cls, label, dir) {
      var b = document.createElement('button');
      b.className = 'slider-arrow ' + cls;
      b.setAttribute('aria-label', label);
      b.innerHTML = dir === 'prev'
        ? '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>'
        : '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>';
      b.addEventListener('click', function () {
        goTo(dir === 'prev' ? current - 1 : current + 1);
      });
      return b;
    }
    hero.appendChild(makeArrow('slider-prev', tr('prev', 'Anterior'), 'prev'));
    hero.appendChild(makeArrow('slider-next', tr('next', 'Siguiente'), 'next'));

    /* ── Build progress bar ──────────────────── */
    var progressWrap = document.createElement('div');
    progressWrap.className = 'slider-progress';
    var progressBar = document.createElement('div');
    progressBar.className = 'slider-progress-bar';
    progressWrap.appendChild(progressBar);
    hero.appendChild(progressWrap);

    /* ── Pause on hover ──────────────────────── */
    hero.addEventListener('mouseenter', function () { paused = true; });
    hero.addEventListener('mouseleave', function () { paused = false; });

    /* ── Touch swipe ─────────────────────────── */
    var touchX = 0;
    hero.addEventListener('touchstart', function (e) {
      touchX = e.touches[0].clientX;
    }, { passive: true });
    hero.addEventListener('touchend', function (e) {
      var diff = touchX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 48) goTo(diff > 0 ? current + 1 : current - 1);
    }, { passive: true });

    /* ── Keyboard ────────────────────────────── */
    hero.setAttribute('tabindex', '0');
    hero.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft')  { goTo(current - 1); e.preventDefault(); }
      if (e.key === 'ArrowRight') { goTo(current + 1); e.preventDefault(); }
    });

    /* ── Core goTo ───────────────────────────── */
    function goTo(n) {
      slides[current].classList.remove('is-active');
      dotsWrap.children[current].classList.remove('is-active');
      current = ((n % slides.length) + slides.length) % slides.length;
      slides[current].classList.add('is-active');
      dotsWrap.children[current].classList.add('is-active');
      dotsWrap.children[current].setAttribute('aria-selected', 'true');
      resetProgress();
    }

    /* ── Progress bar reset ──────────────────── */
    function resetProgress() {
      clearInterval(timer);
      progressBar.style.transition = 'none';
      progressBar.style.width = '0%';
      requestAnimationFrame(function () {
        requestAnimationFrame(function () {
          progressBar.style.transition = 'width 5s linear';
          progressBar.style.width = '100%';
        });
      });
      timer = setInterval(function () {
        if (!paused) goTo(current + 1);
      }, 5000);
    }

    resetProgress();
  }

  /* ══════════════════════════════════════════════════════
     LAZY IMAGES — fade in on viewport entry
  ══════════════════════════════════════════════════════ */
  function initLazyImages() {
    if (!('IntersectionObserver' in window)) {
      document.querySelectorAll('img').forEach(function (img) {
        img.classList.add('loaded');
      });
      return;
    }

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var img = entry.target;
        if (img.complete) {
          img.classList.add('loaded');
        } else {
          img.addEventListener('load', function () { img.classList.add('loaded'); }, { once: true });
          img.addEventListener('error', function () { img.classList.add('loaded'); }, { once: true });
        }
        observer.unobserve(img);
      });
    }, { rootMargin: '80px' });

    document.querySelectorAll('.svc-item img, .oport-img').forEach(function (img) {
      observer.observe(img);
    });
  }

  /* ══════════════════════════════════════════════════════
     OPORTUNIDADES TABS — scrollspy de la sección visible
  ══════════════════════════════════════════════════════ */
  function initOportTabs() {
    var links = Array.from(document.querySelectorAll('.oport-tab-link'));
    if (!links.length || !('IntersectionObserver' in window)) return;

    var map = {};
    links.forEach(function (a) {
      var id = (a.getAttribute('href') || '').replace('#', '');
      if (id) map[id] = a;
    });

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        links.forEach(function (l) { l.classList.remove('active'); });
        var active = map[entry.target.id];
        if (active) active.classList.add('active');
      });
    }, { rootMargin: '-45% 0px -50% 0px' });

    Object.keys(map).forEach(function (id) {
      var sec = document.getElementById(id);
      if (sec) observer.observe(sec);
    });
  }

  /* ══════════════════════════════════════════════════════
     TIENDA — filtro de precio en tiempo real (doble rango)
  ══════════════════════════════════════════════════════ */
  function initShopFilter() {
    var box = document.getElementById('price-filter');
    if (!box) return;
    var minI = document.getElementById('price-min');
    var maxI = document.getElementById('price-max');
    var fill = document.getElementById('range-fill');
    var minLbl = document.getElementById('price-min-lbl');
    var maxLbl = document.getElementById('price-max-lbl');
    var clearBtn = document.getElementById('price-clear');
    var cards = Array.prototype.slice.call(document.querySelectorAll('.shop-card[data-price]'));
    var countEl = document.querySelector('.shop-count');
    var tpl = countEl ? countEl.getAttribute('data-tpl') : '';
    var lo0 = +minI.min, hi0 = +maxI.max;
    function fmt(n) { return n.toLocaleString('es-PE'); }
    function apply() {
      var lo = +minI.value, hi = +maxI.value;
      if (lo > hi) { var t = lo; lo = hi; hi = t; }
      minLbl.textContent = fmt(lo);
      maxLbl.textContent = fmt(hi);
      var span = hi0 - lo0 || 1;
      fill.style.left = ((lo - lo0) / span * 100) + '%';
      fill.style.right = ((hi0 - hi) / span * 100) + '%';
      var shown = 0;
      cards.forEach(function (c) {
        var ok = +c.getAttribute('data-price') >= lo && +c.getAttribute('data-price') <= hi;
        c.style.display = ok ? '' : 'none';
        if (ok) shown++;
      });
      if (countEl && tpl) countEl.textContent = tpl.replace('%d', shown);
    }
    minI.addEventListener('input', apply);
    maxI.addEventListener('input', apply);
    if (clearBtn) clearBtn.addEventListener('click', function () {
      minI.value = lo0; maxI.value = hi0; apply();
    });
    apply();
  }

  /* ══════════════════════════════════════════════════════
     INIT
  ══════════════════════════════════════════════════════ */
  document.addEventListener('DOMContentLoaded', function () {
    initNav();
    initScrollShadow();
    initSlider();
    initLazyImages();
    initOportTabs();
    initShopFilter();
  });

})();
