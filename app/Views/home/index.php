<?php
// CTA del hero -> WhatsApp con mensaje predeterminado
$waHero = View::wa(SITE_WA_PHONE, t('wa.msg.default'));

// Cifras de confianza (edítalas con datos reales)
$stats = [
  ['num' => '+15',  'label' => t('stat.years')],
  ['num' => '+500', 'label' => t('stat.equipos')],
  ['num' => '6',    'label' => t('stat.sectores')],
  ['num' => '2',    'label' => t('stat.sedes')],
];

// Marcas que se atienden (logos en public/img/brands). Edítalas con las reales.
$marcas = [
  ['slug' => 'caterpillar', 'name' => 'Caterpillar'],
  ['slug' => 'volvo',       'name' => 'Volvo'],
  ['slug' => 'scania',      'name' => 'Scania'],
  ['slug' => 'man',         'name' => 'MAN'],
  ['slug' => 'iveco',       'name' => 'Iveco'],
  ['slug' => 'daf',         'name' => 'DAF'],
  ['slug' => 'renault',     'name' => 'Renault'],
  ['slug' => 'johndeere',   'name' => 'John Deere'],
  ['slug' => 'jcb',         'name' => 'JCB'],
  ['slug' => 'hyundai',     'name' => 'Hyundai'],
  ['slug' => 'bosch',       'name' => 'Bosch'],
  ['slug' => 'shell',       'name' => 'Shell'],
];
?>
<!-- ══ HERO SLIDER ═══════════════════════════ -->
<div class="hero" id="hero" aria-label="<?= View::e(t('a11y.carousel')) ?>">
<?php foreach ($slides as $i => $img): ?>
  <div class="slide<?= $i === 0 ? ' is-active' : '' ?>" style="background-image:url('<?= View::e($img) ?>')"></div>
<?php endforeach; ?>
  <div class="slide-text">
    <h1><?= View::e(t('home.hero.h1')) ?></h1>
    <p><?= t('home.hero.p') ?></p>
    <div class="slide-cta">
      <a class="btn btn-orange" href="<?= View::e($waHero) ?>" target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
        <?= View::e(t('home.cta.primary')) ?>
      </a>
      <a class="btn btn-white" href="<?= BASE_URL ?>/servicio"><?= View::e(t('home.cta.secondary')) ?></a>
    </div>
  </div>

  <a class="scroll-cue" href="#destacados" aria-label="<?= View::e(t('a11y.scroll')) ?>">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
  </a>
</div>

<!-- ══ DESTACADOS (después del banner) ═════════ -->
<div class="cred-band" id="destacados">
  <div class="cred-inner">
    <div class="cred-item">
      <span class="cred-icon">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
      </span>
      <div>
        <h3><?= View::e(t('home.cred.1.t')) ?></h3>
        <p><?= View::e(t('home.cred.1.d')) ?></p>
      </div>
    </div>
    <div class="cred-item">
      <span class="cred-icon">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
      </span>
      <div>
        <h3><?= View::e(t('home.cred.2.t')) ?></h3>
        <p><?= View::e(t('home.cred.2.d')) ?></p>
      </div>
    </div>
    <div class="cred-item">
      <span class="cred-icon">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      </span>
      <div>
        <h3><?= View::e(t('home.cred.3.t')) ?></h3>
        <p><?= View::e(t('home.cred.3.d')) ?></p>
      </div>
    </div>
  </div>
</div>

<!-- ══ EMPRESA (presentación) ══════════════════ -->
<?php
$aboutCards = [
  ['t' => t('home.card.motores'),     'img' => CDN.'/2025/10/1-4.jpg', 'url' => BASE_URL.'/servicio'],
  ['t' => t('home.card.grupos'),      'img' => CDN.'/2025/10/7.jpg',   'url' => BASE_URL.'/servicio'],
  ['t' => t('home.card.hidraulicos'), 'img' => CDN.'/2025/10/4-2.jpg', 'url' => BASE_URL.'/servicio'],
  ['t' => t('home.card.maquinaria'),  'img' => CDN.'/2025/10/9.jpg',   'url' => BASE_URL.'/soluciones'],
];
?>
<section class="home-about">
  <div class="container about-grid">
    <div class="about-text">
      <span class="section-eyebrow"><?= View::e(t('home.about.eyebrow')) ?></span>
      <h2><?= View::e(t('home.about.title')) ?></h2>
      <p><?= View::e(t('home.about.text')) ?></p>
      <a class="btn btn-orange" href="<?= BASE_URL ?>/empresa"><?= View::e(t('home.about.more')) ?></a>
    </div>
    <div class="about-cards">
    <?php foreach ($aboutCards as $c): ?>
      <a class="about-card" href="<?= View::e($c['url']) ?>">
        <img src="<?= View::e($c['img']) ?>" alt="<?= View::e($c['t']) ?>" loading="lazy">
        <span><?= View::e($c['t']) ?></span>
      </a>
    <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══ MARCAS — prueba social (después de Empresa) ══ -->
<div class="brands-strip">
  <h3><?= View::e(t('brands.title')) ?></h3>
  <div class="brands-list">
  <?php foreach ($marcas as $m): ?>
    <img class="brand-logo" src="<?= View::asset('img/brands/' . $m['slug'] . '.svg') ?>" alt="<?= View::e($m['name']) ?>" loading="lazy" height="32">
  <?php endforeach; ?>
  </div>
</div>

<!-- ══ SERVICIOS (sección con aire) ════════════ -->
<section class="svc-section">
  <div class="container">
    <div class="section-head">
      <h2><?= t('home.svc.title') ?></h2>
      <p><?= View::e(t('home.svc.sub')) ?></p>
    </div>
    <div class="svc-grid" aria-label="<?= View::e(t('a11y.svcgrid')) ?>">
    <?php foreach (array_slice($servicios, 0, 8) as $s): ?>
      <a class="svc-item" href="<?= BASE_URL ?>/servicio">
        <img src="<?= View::e($s['img']) ?>" alt="<?= View::e($s['titulo']) ?>" loading="lazy">
        <span class="svc-badge"><?= (int)$s['num'] ?></span>
        <div class="svc-overlay">
          <span class="svc-t"><?= View::e($s['titulo']) ?></span>
        </div>
      </a>
    <?php endforeach; ?>
    </div>
    <div class="svc-all">
      <a class="btn btn-orange" href="<?= BASE_URL ?>/servicio"><?= View::e(t('home.svc.all')) ?></a>
    </div>
  </div>
</section>

<!-- ══ CIFRAS (después de Servicios) ═══════════ -->
<div class="stats-strip" id="confianza">
<?php foreach ($stats as $st): ?>
  <div class="stat-item">
    <span class="stat-icon">
      <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
    </span>
    <span>
      <span class="stat-number"><?= View::e($st['num']) ?></span>
      <span class="stat-label"><?= View::e($st['label']) ?></span>
    </span>
  </div>
<?php endforeach; ?>
</div>

<!-- ══ SOLUCIONES (después de Cifras) ══════════ -->
<section class="svc-section sol-section">
  <div class="container">
    <div class="section-head">
      <h2><?= t('home.sol.title') ?></h2>
      <p><?= View::e(t('home.sol.sub')) ?></p>
    </div>
    <div class="svc-grid">
    <?php foreach (Solucion::getAll() as $sol): ?>
      <a class="svc-item" href="<?= BASE_URL ?>/soluciones">
        <img src="<?= View::e($sol['img']) ?>" alt="<?= View::e($sol['alt']) ?>" loading="lazy">
        <div class="svc-overlay">
          <span class="svc-t"><?= View::e(str_replace("\n", ' ', $sol['titulo'])) ?></span>
        </div>
      </a>
    <?php endforeach; ?>
    </div>
    <div class="svc-all">
      <a class="btn btn-orange" href="<?= BASE_URL ?>/soluciones"><?= View::e(t('home.sol.all')) ?></a>
    </div>
  </div>
</section>
