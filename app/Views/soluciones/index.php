<!-- ══ HERO ════════════════════════════════════ -->
<section class="oport-hero-band">
  <h1><?= View::e(t('sol.hero.title')) ?></h1>
  <p><?= View::e(t('sol.hero.sub')) ?></p>
</section>

<!-- ══ TARJETAS DE SOLUCIONES ══════════════════ -->
<section class="svc-section sol-section">
  <div class="container">
    <div class="curso-grid">
    <?php foreach ($soluciones as $sol):
      $nombre = str_replace("\n", ' ', $sol['titulo']);
      $wa = View::wa(SITE_WA_PHONE_SOL, t('wa.msg.interes') . ' ' . $nombre);
    ?>
      <article class="curso-card">
        <div class="curso-img">
          <img src="<?= View::e($sol['img']) ?>" alt="<?= View::e($nombre) ?>" loading="lazy">
        </div>
        <div class="curso-body">
          <h3><?= View::e($nombre) ?></h3>
          <p><?= View::e($sol['desc']) ?></p>
          <div class="sol-card-ctas">
            <a class="curso-cta" href="<?= View::e($wa) ?>" target="_blank" rel="noopener"><?= View::e(t('btn.wa')) ?></a>
            <?php if (!empty($sol['cta_tienda'])): ?>
            <a class="curso-cta cta-alt" href="<?= View::e($sol['cta_tienda']) ?>" target="_blank" rel="noopener"><?= View::e(t('btn.online')) ?></a>
            <?php endif; ?>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ CTA FINAL ═══════════════════════════════ -->
<section class="svc-cta-section">
  <h2><?= View::e(t('sol.cta.title')) ?></h2>
  <div class="svc-cta-btns">
    <a class="btn btn-orange" href="<?= View::e(View::wa(SITE_WA_PHONE_SOL, t('wa.msg.sol'))) ?>" target="_blank" rel="noopener"><?= View::e(t('empresa.cta')) ?></a>
    <a class="btn btn-white" href="<?= BASE_URL ?>/servicio"><?= View::e(t('home.svc.all')) ?></a>
  </div>
</section>
