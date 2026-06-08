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
    var grid = document.querySelector('.shop-grid');
    if (!grid) return;
    var minI = document.getElementById('price-min');
    var maxI = document.getElementById('price-max');
    var fill = document.getElementById('range-fill');
    var minLbl = document.getElementById('price-min-lbl');
    var maxLbl = document.getElementById('price-max-lbl');
    var clearBtn = document.getElementById('price-clear');
    var cards = Array.prototype.slice.call(document.querySelectorAll('.shop-card[data-price]'));
    var countEl = document.querySelector('.shop-count');
    var tpl = countEl ? countEl.getAttribute('data-tpl') : '';
    var empty = document.querySelector('.shop-empty');
    var triggers = Array.prototype.slice.call(document.querySelectorAll('[data-cat]'));
    var activeCat = 'all';
    function fmt(n) { return n.toLocaleString('es-PE'); }

    // Rango de precios [min, max] de los productos de una categoría
    function boundsFor(cat) {
      var prices = cards.filter(function (c) {
        var cats = (c.getAttribute('data-cats') || '').split(' ');
        return cat === 'all' || cats.indexOf(cat) !== -1;
      }).map(function (c) { return +c.getAttribute('data-price'); });
      if (!prices.length) return [0, 0];
      return [Math.floor(Math.min.apply(null, prices) / 10) * 10, Math.ceil(Math.max.apply(null, prices) / 10) * 10];
    }

    function apply() {
      var lo = 0, hi = Infinity;
      if (minI && maxI) {
        var smin = +minI.min, smax = +maxI.max;
        lo = +minI.value; hi = +maxI.value;
        if (lo > hi) { var t = lo; lo = hi; hi = t; }
        if (minLbl) minLbl.textContent = fmt(lo);
        if (maxLbl) maxLbl.textContent = fmt(hi);
        var span = smax - smin || 1;
        if (fill) { fill.style.left = ((lo - smin) / span * 100) + '%'; fill.style.right = ((smax - hi) / span * 100) + '%'; }
      }
      var shown = 0;
      cards.forEach(function (c) {
        var price = +c.getAttribute('data-price');
        var cats = (c.getAttribute('data-cats') || '').split(' ');
        var ok = (activeCat === 'all' || cats.indexOf(activeCat) !== -1) && price >= lo && price <= hi;
        c.style.display = ok ? '' : 'none';
        if (ok) shown++;
      });
      if (countEl && tpl) countEl.textContent = tpl.replace('%d', shown);
      if (empty) empty.hidden = shown !== 0;
    }

    // Ajusta el slider de precio al rango de la categoría seleccionada
    function syncPriceRange(cat) {
      if (!minI || !maxI) return;
      var b = boundsFor(cat);
      minI.min = b[0]; minI.max = b[1]; minI.value = b[0];
      maxI.min = b[0]; maxI.max = b[1]; maxI.value = b[1];
    }

    function setCat(cat) {
      activeCat = cat;
      triggers.forEach(function (tr) { tr.classList.toggle('is-active', tr.getAttribute('data-cat') === cat); });
      syncPriceRange(cat);
      apply();
    }

    triggers.forEach(function (tr) {
      tr.addEventListener('click', function (e) { e.preventDefault(); setCat(tr.getAttribute('data-cat')); });
    });
    if (minI) minI.addEventListener('input', apply);
    if (maxI) maxI.addEventListener('input', apply);
    if (clearBtn) clearBtn.addEventListener('click', function () {
      if (minI) minI.value = +minI.min;
      if (maxI) maxI.value = +maxI.max;
      apply();
    });

    setCat('all');
  }

  /* ══════════════════════════════════════════════════════
     TIENDA — modal de producto (vista rápida)
  ══════════════════════════════════════════════════════ */
  function initProductModal() {
    var modal = document.getElementById('product-modal');
    if (!modal) return;
    var img = document.getElementById('pm-img');
    var cats = document.getElementById('pm-cats');
    var cats2 = document.getElementById('pm-cats2');
    var name = document.getElementById('pm-name');
    var price = document.getElementById('pm-price');
    var desc = document.getElementById('pm-desc');
    var specs = document.getElementById('pm-specs');
    var buy = document.getElementById('pm-buy');
    var closeBtn = document.getElementById('pm-close');

    function open(card) {
      img.src = card.getAttribute('data-img');
      img.alt = card.getAttribute('data-name') || '';
      name.textContent = card.getAttribute('data-name') || '';
      var cl = card.getAttribute('data-catlabels') || '';
      cats.textContent = cl;
      if (cats2) cats2.textContent = cl;
      var p = +card.getAttribute('data-price') || 0;
      price.textContent = 'S/' + p.toLocaleString('es-PE', { minimumFractionDigits: 2 });
      desc.textContent = card.getAttribute('data-desc') || '';
      specs.innerHTML = '';
      var arr = [];
      try { arr = JSON.parse(card.getAttribute('data-specs') || '[]'); } catch (e) {}
      arr.forEach(function (s) { var li = document.createElement('li'); li.textContent = s; specs.appendChild(li); });
      buy.href = card.getAttribute('data-wa') || '#';
      modal.hidden = false;
      document.body.classList.add('pm-open');
    }
    function close() { modal.hidden = true; document.body.classList.remove('pm-open'); }

    document.querySelectorAll('[data-open-modal]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var card = btn.closest('.shop-card');
        if (card) open(card);
      });
    });
    closeBtn.addEventListener('click', close);
    modal.addEventListener('click', function (e) { if (e.target === modal) close(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !modal.hidden) close(); });
  }

  /* ══════════════════════════════════════════════════════
     OPORTUNIDADES — modal de detalle (promos/cursos/empleos)
  ══════════════════════════════════════════════════════ */
  function initOportModal() {
    var modal = document.getElementById('op-modal');
    if (!modal) return;
    var grid = document.getElementById('op-grid');
    var img = document.getElementById('op-img');
    var tag = document.getElementById('op-tag');
    var title = document.getElementById('op-title');
    var meta = document.getElementById('op-meta');
    var desc = document.getElementById('op-desc');
    var cta = document.getElementById('op-cta');
    var ctaLabel = document.getElementById('op-cta-label');
    var closeBtn = document.getElementById('op-close');

    function open(el) {
      var im = el.getAttribute('data-img') || '';
      if (im) { img.src = im; img.alt = el.getAttribute('data-title') || ''; grid.classList.remove('pm-noimg'); }
      else { grid.classList.add('pm-noimg'); }
      tag.textContent = el.getAttribute('data-tag') || '';
      title.textContent = el.getAttribute('data-title') || '';
      desc.textContent = el.getAttribute('data-desc') || '';
      meta.innerHTML = '';
      var arr = [];
      try { arr = JSON.parse(el.getAttribute('data-meta') || '[]'); } catch (e) {}
      arr.forEach(function (m) { if (!m) return; var s = document.createElement('span'); s.className = 'curso-tag'; s.textContent = m; meta.appendChild(s); });
      meta.style.display = arr.length ? '' : 'none';
      var href = el.getAttribute('data-href') || '#';
      cta.href = href;
      if (/^https?:/i.test(href)) { cta.target = '_blank'; cta.rel = 'noopener'; }
      else { cta.removeAttribute('target'); cta.removeAttribute('rel'); }
      ctaLabel.textContent = el.getAttribute('data-label') || '';
      modal.hidden = false;
      document.body.classList.add('pm-open');
    }
    function close() { modal.hidden = true; document.body.classList.remove('pm-open'); }

    document.querySelectorAll('[data-open-op]').forEach(function (el) {
      el.addEventListener('click', function () { open(el); });
    });
    closeBtn.addEventListener('click', close);
    modal.addEventListener('click', function (e) { if (e.target === modal) close(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape' && !modal.hidden) close(); });
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
    initProductModal();
    initOportModal();
  });

})();
