<!-- ══ HERO SLIDER ═══════════════════════════ -->
<div class="hero" id="hero" aria-label="<?= View::e(t('a11y.carousel')) ?>">
<?php foreach ($slides as $img): ?>
  <div class="slide" style="background-image:url('<?= View::e($img) ?>')"></div>
<?php endforeach; ?>
  <div class="slide-text">
    <h1><?= View::e(t('home.hero.h1')) ?></h1>
    <p><?= t('home.hero.p') ?></p>
  </div>
</div>

<!-- ══ SERVICES eGRID ══════════════════════════ -->
<div class="svc-grid" aria-label="<?= View::e(t('a11y.svcgrid')) ?>">
<?php foreach ($servicios as $s): ?>
  <div class="svc-item">
    <img src="<?= View::e($s['img']) ?>" alt="<?= View::e($s['titulo']) ?>" loading="lazy">
    <span class="svc-badge"><?= (int)$s['num'] ?></span>
    <div class="svc-overlay">
      <div class="svc-label">
        <span class="svc-t"><?= View::e($s['titulo']) ?></span>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>