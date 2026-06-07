<?php
$waCot = View::wa(SITE_WA_PHONE, t('wa.msg.default'));
$features = [
  ['t' => t('svc.feat.1.t'), 'd' => t('svc.feat.1.d')],
  ['t' => t('svc.feat.2.t'), 'd' => t('svc.feat.2.d')],
  ['t' => t('svc.feat.3.t'), 'd' => t('svc.feat.3.d')],
  ['t' => t('svc.feat.4.t'), 'd' => t('svc.feat.4.d')],
];
?>
<!-- ══ HERO ════════════════════════════════════ -->
<section class="oport-hero-band">
  <h1><?= View::e(t('svc.hero.title')) ?></h1>
  <p><?= View::e(t('svc.hero.sub')) ?></p>
</section>

<!-- ══ PANELES MULTIMARCA ══════════════════════ -->
<div class="svc-panels">
<?php foreach ($paneles as $s): ?>
  <div class="svc-panel">
    <img src="<?= View::e($s['img']) ?>" alt="<?= View::e($s['alt']) ?>" loading="lazy">
    <p class="svc-panel-text"><?= nl2br(View::e($s['titulo'])) ?></p>
  </div>
<?php endforeach; ?>
</div>

<!-- ══ GRILLA DE SERVICIOS ═════════════════════ -->
<section class="svc-section">
  <div class="container">
    <div class="section-head">
      <h2><?= t('home.svc.title') ?></h2>
      <p><?= View::e(t('home.svc.sub')) ?></p>
    </div>
    <div class="svc-grid">
    <?php foreach ($grid as $s): $msg = t('wa.msg.interes') . ' ' . $s['titulo']; ?>
      <a class="svc-item" href="<?= View::e(View::wa(SITE_WA_PHONE, $msg)) ?>" target="_blank" rel="noopener">
        <img src="<?= View::e($s['img']) ?>" alt="<?= View::e($s['titulo']) ?>" loading="lazy">
        <span class="svc-badge"><?= (int)$s['num'] ?></span>
        <div class="svc-overlay">
          <span class="svc-t"><?= View::e($s['titulo']) ?></span>
        </div>
      </a>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ QUÉ INCLUYE ═════════════════════════════ -->
<section class="svc-features">
  <h2><?= View::e(t('svc.features.title')) ?></h2>
  <div class="features-grid">
  <?php foreach ($features as $f): ?>
    <div class="feature-card">
      <h3><?= View::e($f['t']) ?></h3>
      <p><?= View::e($f['d']) ?></p>
    </div>
  <?php endforeach; ?>
  </div>
</section>

<!-- ══ CTA ═════════════════════════════════════ -->
<section class="svc-cta-section">
  <h2><?= View::e(t('svc.cta.title')) ?></h2>
  <div class="svc-cta-btns">
    <a class="btn btn-orange" href="<?= View::e($waCot) ?>" target="_blank" rel="noopener"><?= View::e(t('empresa.cta')) ?></a>
    <a class="btn btn-white" href="<?= BASE_URL ?>/soluciones"><?= View::e(t('home.sol.all')) ?></a>
  </div>
</section>
