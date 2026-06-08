<?php
// Imagen de muestra por tipo de producto (reemplazar por fotos reales)
$imgMap = [
  'oil'=>'shop/oil.jpg', 'coolant'=>'shop/oil.jpg', 'grease'=>'shop/grease.jpg',
  'filter'=>'shop/filter.jpg', 'gasket'=>'shop/filter.jpg', 'hose'=>'shop/hose.jpg',
  'kit'=>'shop/filter.jpg', 'pump'=>'shop/hose.jpg',
  'generator'=>'banner/grupo.jpg', 'excavator'=>'banner/excavadora.jpg', 'engine'=>'banner/motor.jpg',
];
$pImg = function ($icon) use ($imgMap) { return View::asset('img/' . ($imgMap[$icon] ?? 'shop/filter.jpg')); };
$catLabels = [];
foreach ($categorias as $c) { $catLabels[$c['slug']] = $c['label']; }
?>
<!-- ══ HERO ════════════════════════════════════ -->
<section class="oport-hero-band">
  <h1><?= View::e(t('shop.title')) ?></h1>
  <p><?= View::e(t('shop.sub')) ?></p>
</section>

<!-- ══ FRANJA DE CATEGORÍAS (filtros con foto) ══ -->
<div class="shop-cats">
  <div class="container shop-cats-row">
    <button class="shop-cat is-active" data-cat="all" type="button">
      <span class="shop-cat-ico shop-cat-all">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
      </span>
      <span class="shop-cat-lbl"><?= View::e(t('shop.cat.all')) ?></span>
    </button>
  <?php foreach ($categorias as $c): ?>
    <button class="shop-cat" data-cat="<?= View::e($c['slug']) ?>" type="button">
      <span class="shop-cat-ico"><img src="<?= View::e($c['img']) ?>" alt="<?= View::e($c['label']) ?>" loading="lazy"></span>
      <span class="shop-cat-lbl"><?= View::e($c['label']) ?></span>
    </button>
  <?php endforeach; ?>
  </div>
</div>

<!-- ══ CUERPO TIENDA ═══════════════════════════ -->
<div class="shop-body">
  <div class="container shop-layout">

    <!-- Sidebar -->
    <aside class="shop-side">
      <div class="shop-widget">
        <h3 class="shop-widget-title"><?= View::e(t('shop.filter.price')) ?></h3>
        <div class="range-slider" id="price-filter" data-min="0" data-max="3000">
          <div class="range-track"><span class="range-fill" id="range-fill"></span></div>
          <input type="range" id="price-min" min="0" max="3000" step="10" value="0">
          <input type="range" id="price-max" min="0" max="3000" step="10" value="3000">
        </div>
        <p class="shop-price-range">S/<span id="price-min-lbl">0</span> — S/<span id="price-max-lbl">3,000</span></p>
        <button class="btn btn-white shop-filter-btn" id="price-clear" type="button"><?= View::e(t('shop.filter.clear')) ?></button>
      </div>

      <div class="shop-widget">
        <h3 class="shop-widget-title"><?= View::e(t('shop.categories')) ?></h3>
        <ul class="shop-cat-list">
          <li><a href="#" data-cat="all" class="is-active"><?= View::e(t('shop.cat.all')) ?></a></li>
        <?php foreach ($categorias as $c): ?>
          <li><a href="#" data-cat="<?= View::e($c['slug']) ?>"><?= View::e($c['label']) ?></a></li>
        <?php endforeach; ?>
        </ul>
      </div>

      <div class="shop-widget">
        <h3 class="shop-widget-title"><?= View::e(t('shop.bestsellers')) ?></h3>
        <ul class="shop-best">
        <?php foreach (array_slice($productos, 0, 3) as $p): ?>
          <li>
            <span class="shop-best-ico"><img src="<?= $pImg($p['icon']) ?>" alt="<?= View::e($p['nombre']) ?>" loading="lazy"></span>
            <span><span class="shop-best-name"><?= View::e($p['nombre']) ?></span><span class="shop-best-price">S/<?= number_format($p['precio'], 2) ?></span></span>
          </li>
        <?php endforeach; ?>
        </ul>
      </div>
    </aside>

    <!-- Productos -->
    <div class="shop-main">
      <div class="shop-toolbar">
        <span class="shop-count" data-tpl="<?= View::e(t('shop.showing')) ?>"><?= View::e(sprintf(t('shop.showing'), count($productos))) ?></span>
      </div>

      <div class="shop-grid">
      <?php foreach ($productos as $p):
        $wa = View::wa(SITE_WA_PHONE_SOL, t('wa.msg.interes') . ' ' . $p['nombre']);
        $catNames = array_map(function ($s) use ($catLabels) { return $catLabels[$s] ?? $s; }, $p['cats']);
        $catNamesStr = implode(', ', $catNames);
      ?>
        <article class="shop-card" data-price="<?= (int)$p['precio'] ?>" data-cats="<?= View::e(implode(' ', $p['cats'])) ?>"
                 data-name="<?= View::e($p['nombre']) ?>"
                 data-img="<?= $pImg($p['icon']) ?>"
                 data-catlabels="<?= View::e($catNamesStr) ?>"
                 data-desc="<?= View::e($p['desc'] ?? '') ?>"
                 data-specs="<?= View::e(json_encode($p['specs'] ?? [])) ?>"
                 data-wa="<?= View::e($wa) ?>">
          <button class="shop-card-media" type="button" data-open-modal aria-label="<?= View::e($p['nombre']) ?>">
            <img src="<?= $pImg($p['icon']) ?>" alt="<?= View::e($p['nombre']) ?>" loading="lazy">
          </button>
          <div class="shop-card-body">
            <h3 class="shop-card-name"><?= View::e($p['nombre']) ?></h3>
            <p class="shop-card-cats"><?= View::e($catNamesStr) ?></p>
            <p class="shop-card-price">S/<?= number_format($p['precio'], 2) ?></p>
            <button class="shop-card-btn" type="button" data-open-modal><?= View::e(t('shop.detail')) ?></button>
          </div>
        </article>
      <?php endforeach; ?>
      </div>

      <p class="shop-empty" hidden><?= View::e(t('shop.empty')) ?></p>

      <div class="shop-pager">
        <span class="shop-page is-active">1</span>
        <a class="shop-page" href="<?= BASE_URL ?>/tienda">2</a>
        <a class="shop-page shop-page-next" href="<?= BASE_URL ?>/tienda" aria-label="<?= View::e(t('a11y.next')) ?>">›</a>
      </div>
    </div>

  </div>
</div>

<!-- ══ MODAL DE PRODUCTO ═══════════════════════ -->
<div class="pm-overlay" id="product-modal" hidden>
  <div class="pm-dialog" role="dialog" aria-modal="true" aria-labelledby="pm-name">
    <button class="pm-close" id="pm-close" type="button" aria-label="<?= View::e(t('shop.m.close')) ?>">&times;</button>
    <div class="pm-grid">
      <div class="pm-media"><img id="pm-img" src="" alt=""></div>
      <div class="pm-info">
        <p class="pm-cats" id="pm-cats"></p>
        <h2 class="pm-name" id="pm-name"></h2>
        <p class="pm-price" id="pm-price"></p>
        <p class="pm-avail"><span class="pm-dot"></span><?= View::e(t('shop.m.availVal')) ?></p>
        <h4 class="pm-h"><?= View::e(t('shop.m.desc')) ?></h4>
        <p class="pm-desc" id="pm-desc"></p>
        <h4 class="pm-h"><?= View::e(t('shop.m.features')) ?></h4>
        <ul class="pm-specs" id="pm-specs"></ul>
        <a class="pm-buy" id="pm-buy" href="#" target="_blank" rel="noopener">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
          <?= View::e(t('shop.add')) ?>
        </a>
      </div>
    </div>

    <div class="pm-extra">
      <div class="pm-block">
        <h4 class="pm-h"><?= View::e(t('shop.m.payment')) ?></h4>
        <div class="pm-pays">
          <span class="pm-pay pm-pay-logo"><img src="<?= View::asset('img/pay/visa.svg') ?>" alt="Visa"></span>
          <span class="pm-pay pm-pay-logo"><img src="<?= View::asset('img/pay/mastercard.svg') ?>" alt="Mastercard"></span>
          <span class="pm-pay pm-pay-logo"><img src="<?= View::asset('img/pay/yape.svg') ?>" alt="Yape"></span>
          <span class="pm-pay pm-pay-plin">plin</span>
          <span class="pm-pay"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg><?= View::e(t('shop.pay.transfer')) ?></span>
          <span class="pm-pay"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="6" width="20" height="12" rx="2"/><circle cx="12" cy="12" r="2.5"/></svg><?= View::e(t('shop.pay.cash')) ?></span>
        </div>
      </div>
      <div class="pm-block">
        <h4 class="pm-h"><?= View::e(t('shop.m.info')) ?></h4>
        <ul class="pm-meta">
          <li><span><?= View::e(t('shop.m.category')) ?></span><b id="pm-cats2"></b></li>
          <li><span><?= View::e(t('shop.m.warranty')) ?></span><b><?= View::e(t('shop.m.warrantyVal')) ?></b></li>
          <li><span><?= View::e(t('shop.m.ship')) ?></span><b><?= View::e(t('shop.m.shipVal')) ?></b></li>
        </ul>
      </div>
    </div>

    <div class="pm-trust">
      <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg><?= View::e(t('shop.m.trust.secure')) ?></span>
      <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg><?= View::e(t('shop.m.trust.advice')) ?></span>
      <span><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg><?= View::e(t('shop.m.trust.delivery')) ?></span>
    </div>
  </div>
</div>
