<!-- ══ HERO BAND ═══════════════════════════ -->
<section class="oport-hero-band">
  <h1><?= View::e(t('op.hero.title')) ?></h1>
  <p><?= View::e(t('op.hero.sub')) ?></p>
</section>

<!-- ══ TABS (navegación rápida) ════════════ -->
<nav class="oport-tabs-bar" aria-label="<?= View::e(t('op.hero.title')) ?>">
  <a class="oport-tab-link active" href="#boletines"><?= View::e(t('oport.boletines')) ?></a>
  <a class="oport-tab-link" href="#cursos"><?= View::e(t('oport.cursos')) ?></a>
  <a class="oport-tab-link" href="#empleos"><?= View::e(t('oport.empleos')) ?></a>
</nav>

<div class="oport-body">

  <!-- ── BOLETINES ─────────────────────────── -->
  <section class="oport-sec" id="boletines" aria-labelledby="h-boletines">
    <div class="oport-sec-head">
      <h2 id="h-boletines"><?= View::e(t('oport.boletines')) ?></h2>
      <p><?= View::e(t('op.sec.boletines')) ?></p>
    </div>
    <div class="boletin-grid">
      <?php foreach ($boletines as $b):
        $msg = t('wa.msg.interes') . ' ' . $b['titulo'];
        $destacado = !empty($b['destacado']);
      ?>
      <a class="boletin-card<?= $destacado ? ' is-destacado' : '' ?>"
         href="<?= View::e(View::wa(SITE_WA_PHONE, $msg)) ?>" target="_blank" rel="noopener"
         aria-label="<?= View::e(t('op.cta.consultar') . ': ' . $b['titulo']) ?>">
        <img src="<?= View::e($b['img']) ?>" alt="<?= View::e($b['titulo']) ?>" loading="lazy">
        <div class="boletin-overlay">
          <span class="boletin-tag"><?= View::e($destacado ? t('op.tag.oferta') : t('op.tag.boletin')) ?></span>
          <span class="boletin-title"><?= View::e($b['titulo']) ?></span>
          <span class="boletin-cta">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
            <?= View::e(t('op.cta.consultar')) ?>
          </span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ── CURSOS ────────────────────────────── -->
  <section class="oport-sec" id="cursos" aria-labelledby="h-cursos">
    <div class="oport-sec-head">
      <h2 id="h-cursos"><?= View::e(t('oport.cursos')) ?></h2>
      <p><?= View::e(t('op.sec.cursos')) ?></p>
    </div>
    <div class="curso-grid">
      <?php foreach ($cursos as $c):
        $msg = t('wa.msg.curso') . ' ' . $c['titulo'];
      ?>
      <article class="curso-card">
        <div class="curso-img">
          <img src="<?= View::e($c['img']) ?>" alt="<?= View::e($c['titulo']) ?>" loading="lazy">
          <span class="curso-badge"><?= View::e(t('oport.cursos')) ?></span>
          <?php if (!empty($c['video'])): ?>
          <a class="curso-play" href="<?= View::e($c['video']) ?>" target="_blank" rel="noopener" aria-label="<?= View::e(t('a11y.video')) ?>">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>
          </a>
          <?php endif; ?>
        </div>
        <div class="curso-body">
          <h3><?= View::e($c['titulo']) ?></h3>
          <p><?= View::e($c['desc']) ?></p>
          <div class="curso-meta">
            <span class="curso-tag"><?= View::e($c['dur']) ?></span>
            <span class="curso-tag"><?= View::e($c['mod']) ?></span>
          </div>
          <a class="curso-cta" href="<?= View::e(View::wa(SITE_WA_PHONE, $msg)) ?>" target="_blank" rel="noopener"><?= View::e(t('op.cta.inscribir')) ?></a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ── EMPLEOS ───────────────────────────── -->
  <section class="oport-sec" id="empleos" aria-labelledby="h-empleos">
    <div class="oport-sec-head">
      <h2 id="h-empleos"><?= View::e(t('oport.empleos')) ?></h2>
      <p><?= View::e(t('op.sec.empleos')) ?></p>
    </div>
    <div class="empleo-grid">
      <?php foreach ($empleos as $e):
        $subject = t('op.mail.subject') . ' ' . $e['titulo'];
        $mailto  = 'mailto:' . $e['email'] . '?subject=' . rawurlencode($subject);
      ?>
      <article class="empleo-card">
        <div class="empleo-head">
          <h3 class="empleo-title"><?= View::e($e['titulo']) ?></h3>
          <span class="empleo-tipo"><?= View::e($e['tipo']) ?></span>
        </div>
        <div class="empleo-details">
          <span class="empleo-detail">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>
            <?= View::e($e['sede']) ?>
          </span>
          <span class="empleo-detail">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
            <?= View::e($e['mod']) ?>
          </span>
        </div>
        <a class="empleo-cta" href="<?= View::e($mailto) ?>">
          <?= View::e(t('op.cta.postular')) ?>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

</div>
