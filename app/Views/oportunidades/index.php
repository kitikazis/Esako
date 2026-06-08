<?php
// Helper: genera los atributos data-* que alimentan el modal
$opAttr = function ($title, $img, $tag, $desc, $meta, $href, $label) {
  return 'data-open-op'
    . ' data-title="' . View::e($title) . '"'
    . ' data-img="' . View::e($img) . '"'
    . ' data-tag="' . View::e($tag) . '"'
    . ' data-desc="' . View::e($desc) . '"'
    . ' data-meta="' . View::e(json_encode($meta)) . '"'
    . ' data-href="' . View::e($href) . '"'
    . ' data-label="' . View::e($label) . '"';
};
?>
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

  <!-- ── PROMOCIONES ───────────────────────── -->
  <section class="oport-sec" id="boletines" aria-labelledby="h-boletines">
    <div class="oport-sec-head">
      <span class="oport-sec-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
      </span>
      <div>
        <h2 id="h-boletines"><?= View::e(t('oport.boletines')) ?></h2>
        <p><?= View::e(t('op.sec.boletines')) ?></p>
      </div>
    </div>
    <div class="boletin-grid">
      <?php foreach ($boletines as $b):
        $destacado = !empty($b['destacado']);
        $tag = $destacado ? t('op.tag.oferta') : t('op.tag.boletin');
        $wa  = View::wa(SITE_WA_PHONE, t('wa.msg.interes') . ' ' . $b['titulo']);
      ?>
      <button type="button" class="boletin-card<?= $destacado ? ' is-destacado' : '' ?>"
        aria-label="<?= View::e(t('op.detail') . ': ' . $b['titulo']) ?>"
        <?= $opAttr($b['titulo'], $b['img'], $tag, t('op.bol.desc'), [], $wa, t('op.cta.consultar')) ?>>
        <img src="<?= View::e($b['img']) ?>" alt="<?= View::e($b['titulo']) ?>" loading="lazy">
        <div class="boletin-overlay">
          <span class="boletin-tag"><?= View::e($tag) ?></span>
          <span class="boletin-title"><?= View::e($b['titulo']) ?></span>
          <span class="boletin-cta">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 5.2 18.5L22 22l-1.5-4.8A10 10 0 0 0 12 2z"/></svg>
            <?= View::e(t('op.detail')) ?>
          </span>
        </div>
      </button>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ── CURSOS ────────────────────────────── -->
  <section class="oport-sec" id="cursos" aria-labelledby="h-cursos">
    <div class="oport-sec-head">
      <span class="oport-sec-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1 2 3 6 3s6-2 6-3v-5"/></svg>
      </span>
      <div>
        <h2 id="h-cursos"><?= View::e(t('oport.cursos')) ?></h2>
        <p><?= View::e(t('op.sec.cursos')) ?></p>
      </div>
    </div>
    <div class="curso-grid">
      <?php foreach ($cursos as $c):
        $waCurso = View::wa(SITE_WA_PHONE, t('wa.msg.curso') . ' ' . $c['titulo']);
      ?>
      <article class="curso-card">
        <button type="button" class="curso-img"
          <?= $opAttr($c['titulo'], $c['img'], t('oport.cursos'), $c['desc'], [$c['dur'], $c['mod']], $waCurso, t('op.cta.inscribir')) ?>>
          <img src="<?= View::e($c['img']) ?>" alt="<?= View::e($c['titulo']) ?>" loading="lazy">
          <span class="curso-badge"><?= View::e(t('oport.cursos')) ?></span>
          <?php if (!empty($c['video'])): ?>
          <span class="curso-play"><svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg></span>
          <?php endif; ?>
        </button>
        <div class="curso-body">
          <h3><?= View::e($c['titulo']) ?></h3>
          <p><?= View::e($c['desc']) ?></p>
          <div class="curso-meta">
            <span class="curso-tag"><?= View::e($c['dur']) ?></span>
            <span class="curso-tag"><?= View::e($c['mod']) ?></span>
          </div>
          <button type="button" class="curso-cta"
            <?= $opAttr($c['titulo'], $c['img'], t('oport.cursos'), $c['desc'], [$c['dur'], $c['mod']], $waCurso, t('op.cta.inscribir')) ?>><?= View::e(t('op.detail')) ?></button>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ── EMPLEOS ───────────────────────────── -->
  <section class="oport-sec" id="empleos" aria-labelledby="h-empleos">
    <div class="oport-sec-head">
      <span class="oport-sec-icon">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
      </span>
      <div>
        <h2 id="h-empleos"><?= View::e(t('oport.empleos')) ?></h2>
        <p><?= View::e(t('op.sec.empleos')) ?></p>
      </div>
    </div>
    <div class="empleo-grid">
      <?php foreach ($empleos as $e):
        $subject = t('op.mail.subject') . ' ' . $e['titulo'];
        $mailto  = 'mailto:' . $e['email'] . '?subject=' . rawurlencode($subject);
        $tag = t('oport.empleos') . ' · ' . $e['tipo'];
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
        <button type="button" class="empleo-cta"
          <?= $opAttr($e['titulo'], '', $tag, t('op.emp.desc'), [$e['tipo'], $e['sede'], $e['mod']], $mailto, t('op.cta.postular')) ?>>
          <?= View::e(t('op.detail')) ?>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

</div>

<!-- ══ MODAL OPORTUNIDADES ═════════════════════ -->
<div class="pm-overlay" id="op-modal" hidden>
  <div class="pm-dialog">
    <button class="pm-close" id="op-close" type="button" aria-label="<?= View::e(t('shop.m.close')) ?>">&times;</button>
    <div class="pm-grid" id="op-grid">
      <div class="pm-media" id="op-media"><img id="op-img" src="" alt=""></div>
      <div class="pm-info">
        <p class="pm-cats" id="op-tag"></p>
        <h2 class="pm-name" id="op-title"></h2>
        <div class="curso-meta" id="op-meta"></div>
        <h4 class="pm-h"><?= View::e(t('shop.m.desc')) ?></h4>
        <p class="pm-desc" id="op-desc"></p>
        <a class="op-cta" id="op-cta" href="#"><span id="op-cta-label"></span></a>
      </div>
    </div>
  </div>
</div>
