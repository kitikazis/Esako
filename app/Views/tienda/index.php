<?php
// Íconos por tipo de producto (placeholder hasta tener fotos reales)
$icons = [
  'oil'     => '<path d="M7 2h6v3h2a2 2 0 0 1 2 2v2l3 2v9a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h1V2z"/>',
  'filter'  => '<path d="M4 4h16l-6 8v6l-4 2v-8L4 4z"/>',
  'coolant' => '<path d="M9 2h6v4l3 4v10a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V10l3-4V2z"/>',
  'gasket'  => '<path d="M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18zm0 5a4 4 0 1 1 0 8 4 4 0 0 1 0-8z"/>',
  'hose'    => '<path d="M4 6a4 4 0 0 1 8 0v8a4 4 0 0 0 8 0v-2"/>',
  'grease'  => '<path d="M5 8h10v8a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8zm10 2h3l2 3v3h-5"/>',
  'kit'     => '<path d="M3 7h18v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7zm6 0V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"/>',
  'pump'    => '<path d="M5 21V8l7-4 7 4v13M9 21v-6h6v6"/>',
];
$shopWa = View::wa(SITE_WA_PHONE_SOL, t('wa.msg.sol'));
// Imagen de muestra por tipo de producto (reemplazar por fotos reales)
$imgMap = [
  'oil'=>'oil.jpg', 'coolant'=>'oil.jpg', 'grease'=>'grease.jpg',
  'filter'=>'filter.jpg', 'gasket'=>'filter.jpg', 'hose'=>'hose.jpg',
  'kit'=>'filter.jpg', 'pump'=>'filter.jpg',
];
$pImg = function($icon) use ($imgMap) { return View::asset('img/shop/' . ($imgMap[$icon] ?? 'filter.jpg')); };
?>
<!-- ══ HERO ════════════════════════════════════ -->
<section class="oport-hero-band">
  <h1><?= View::e(t('shop.title')) ?></h1>
  <p><?= View::e(t('shop.sub')) ?></p>
</section>

<!-- ══ FRANJA DE CATEGORÍAS ════════════════════ -->
<div class="shop-cats">
  <div class="container shop-cats-row">
  <?php foreach ($categorias as $c): ?>
    <a class="shop-cat" href="<?= BASE_URL ?>/tienda#<?= View::e($c['slug']) ?>">
      <span class="shop-cat-ico">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><path d="M3 9h18M9 21V9"/></svg>
      </span>
      <span class="shop-cat-lbl"><?= View::e($c['label']) ?></span>
    </a>
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
        <div class="range-slider" id="price-filter" data-min="0" data-max="600">
          <div class="range-track"><span class="range-fill" id="range-fill"></span></div>
          <input type="range" id="price-min" min="0" max="600" step="10" value="0">
          <input type="range" id="price-max" min="0" max="600" step="10" value="600">
        </div>
        <p class="shop-price-range">S/<span id="price-min-lbl">0</span> — S/<span id="price-max-lbl">600</span></p>
        <button class="btn btn-white shop-filter-btn" id="price-clear" type="button"><?= View::e(t('shop.filter.clear')) ?></button>
      </div>

      <div class="shop-widget">
        <h3 class="shop-widget-title"><?= View::e(t('shop.categories')) ?></h3>
        <ul class="shop-cat-list">
        <?php foreach ($categorias as $c): ?>
          <li><a href="<?= BASE_URL ?>/tienda#<?= View::e($c['slug']) ?>"><?= View::e($c['label']) ?></a></li>
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
      ?>
        <article class="shop-card" data-price="<?= (int)$p['precio'] ?>">
          <div class="shop-card-media">
            <img src="<?= $pImg($p['icon']) ?>" alt="<?= View::e($p['nombre']) ?>" loading="lazy">
          </div>
          <div class="shop-card-body">
            <h3 class="shop-card-name"><?= View::e($p['nombre']) ?></h3>
            <p class="shop-card-cats"><?= View::e(implode(', ', $p['cats'])) ?></p>
            <p class="shop-card-price">S/<?= number_format($p['precio'], 2) ?></p>
            <a class="shop-card-btn" href="<?= View::e($wa) ?>" target="_blank" rel="noopener"><?= View::e(t('shop.add')) ?></a>
          </div>
        </article>
      <?php endforeach; ?>
      </div>

      <div class="shop-pager">
        <span class="shop-page is-active">1</span>
        <a class="shop-page" href="<?= BASE_URL ?>/tienda">2</a>
        <a class="shop-page shop-page-next" href="<?= BASE_URL ?>/tienda" aria-label="<?= View::e(t('a11y.next')) ?>">›</a>
      </div>
    </div>

  </div>
</div>
