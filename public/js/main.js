/**
 * ESAKO GLOBAL SAC — main.js
 * Nav · Slider · Lazy images · Swipe · Scroll shadow
 */
(function () {
  'use strict';

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
    dotsWrap.setAttribute('aria-label', 'Diapositivas');
    slides.forEach(function (_, i) {
      var d = document.createElement('button');
      d.className = 'dot' + (i === 0 ? ' is-active' : '');
      d.setAttribute('role', 'tab');
      d.setAttribute('aria-label', 'Diapositiva ' + (i + 1));
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
    hero.appendChild(makeArrow('slider-prev', 'Anterior', 'prev'));
    hero.appendChild(makeArrow('slider-next', 'Siguiente', 'next'));

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
     FOOTER + WHATSAPP FLOAT INJECTION
  ══════════════════════════════════════════════════════ */
  function injectExtras() {
    var depth = /\/(servicios|soluciones)\//.test(window.location.pathname) ? '../' : '';

    /* Footer */
    var ft = document.createElement('footer');
    ft.className = 'site-footer';
    ft.setAttribute('role', 'contentinfo');
    ft.innerHTML =
      '<div class="footer-grid">' +
        '<div>' +
          '<img src="https://esako.com.pe/wp-content/uploads/2025/10/logo-alta-calidad-1.gif" alt="Esako Global SAC" class="footer-logo">' +
          '<p class="footer-tagline">\u201cMejor Relaci\u00f3n Costo Beneficio\u201d</p>' +
          '<p class="footer-desc">Especialistas en soluciones industriales para los sectores de miner\u00eda, pesca, construcci\u00f3n, automotriz y energ\u00eda.</p>' +
        '</div>' +
        '<div>' +
          '<p class="footer-col-title">P\u00e1ginas</p>' +
          '<div class="footer-links">' +
            '<a href="' + depth + 'Inicio.html">Inicio</a>' +
            '<a href="' + depth + 'Nosotros.html">Empresa</a>' +
            '<a href="' + depth + 'Servicios.html">Servicios</a>' +
            '<a href="' + depth + 'Soluciones.html">Soluciones</a>' +
            '<a href="' + depth + 'Oportunidades.html">Oportunidades</a>' +
          '</div>' +
        '</div>' +
        '<div>' +
          '<p class="footer-col-title">Contacto</p>' +
          '<div class="footer-links">' +
            '<a href="mailto:esako@esako.com.pe">esako@esako.com.pe</a>' +
            '<a href="https://wa.link/cvk0tg" target="_blank" rel="noopener">WhatsApp</a>' +
            '<a href="https://esako.com.pe/tienda/" target="_blank" rel="noopener">Tienda Online</a>' +
            '<a href="https://esako.com.pe/wp-content/uploads/2025/10/BROCHURE-ESAKO-1-1.pdf" target="_blank" rel="noopener">Brochure PDF</a>' +
          '</div>' +
        '</div>' +
        '<div>' +
          '<p class="footer-col-title">Sucursales</p>' +
          '<div class="footer-location">' +
            '<svg class="footer-loc-pin" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>' +
            '<div><span class="footer-loc-city">Lima</span><span class="footer-loc-label">Sede principal</span></div>' +
          '</div>' +
          '<div class="footer-location">' +
            '<svg class="footer-loc-pin" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>' +
            '<div><span class="footer-loc-city">Chimbote</span><span class="footer-loc-label">Sucursal norte</span></div>' +
          '</div>' +
          '<div class="footer-social-row">' +
            '<a href="https://www.youtube.com/@esakoglobal" class="footer-soc-btn" target="_blank" rel="noopener" title="YouTube"><svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>' +
            '<a href="https://www.instagram.com/esako.global" class="footer-soc-btn" target="_blank" rel="noopener" title="Instagram"><svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg></a>' +
            '<a href="http://www.linkedin.com/in/esako-global-5b2090395" class="footer-soc-btn" target="_blank" rel="noopener" title="LinkedIn"><svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a>' +
            '<a href="https://www.tiktok.com/@esako71" class="footer-soc-btn" target="_blank" rel="noopener" title="TikTok"><svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg></a>' +
          '</div>' +
        '</div>' +
      '</div>' +
      '<div class="footer-bottom">' +
        '<p>\u00a9 2025 Esako Global SAC \u2014 Todos los derechos reservados</p>' +
        '<div class="footer-bottom-links">' +
          '<a href="https://esako.com.pe/libro-de-reclamaciones/" target="_blank" rel="noopener">Libro de Reclamaciones</a>' +
        '</div>' +
      '</div>';
    document.body.appendChild(ft);

    /* Floating WhatsApp */
    var wa = document.createElement('a');
    wa.href = 'https://wa.link/cvk0tg';
    wa.className = 'wa-float';
    wa.target = '_blank';
    wa.rel = 'noopener';
    wa.setAttribute('aria-label', 'Contactar por WhatsApp');
    wa.innerHTML =
      '<span class="wa-pulse"></span>' +
      '<svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">' +
        '<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>' +
      '</svg>';
    document.body.appendChild(wa);
  }

  /* ══════════════════════════════════════════════════════
     INIT
  ══════════════════════════════════════════════════════ */
  document.addEventListener('DOMContentLoaded', function () {
    initNav();
    initScrollShadow();
    initSlider();
    initLazyImages();
    injectExtras();
  });

})();
