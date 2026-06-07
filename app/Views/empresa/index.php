<div class="empresa-page">
  <div class="empresa-inner">

    <!-- LEFT -->
    <div class="map-side">
      <div class="sector-list" aria-label="<?= View::e(t('a11y.sectors')) ?>">
        <?php foreach ($sectores as $s): ?>
        <div class="sector-circle" title="<?= View::e($s['label']) ?>">
          <img src="<?= View::e($s['img']) ?>" alt="<?= View::e($s['label']) ?>" loading="lazy">
        </div>
        <?php endforeach; ?>
      </div>
      <p class="map-title"><?= View::e(t('empresa.sucursales')) ?></p>
      <div class="map-img-wrap">
        <img src="https://esako.com.pe/wp-content/uploads/2025/10/mapadeesakofinal-1.webp"
             alt="<?= View::e(t('empresa.sucursales')) ?> Esako" loading="lazy">
        <span class="map-lbl chimbote">CHIMBOTE</span>
        <span class="map-lbl lima">LIMA</span>
      </div>
    </div>

    <!-- RIGHT -->
    <div class="content-side">
      <div class="content-block">
        <h2><?= View::e(t('empresa.nosotros.h')) ?></h2>
        <p><?= t('empresa.nosotros.p1') ?></p>
        <p style="margin-top:10px"><?= View::e(t('empresa.nosotros.p2')) ?></p>
      </div>
      <div class="content-block">
        <h2><?= View::e(t('empresa.vm.h')) ?></h2>
        <p><?= View::e(t('empresa.vm.p')) ?></p>
      </div>
      <div class="content-block">
        <h2><?= View::e(t('empresa.valores.h')) ?></h2>
        <p><?= t('empresa.valores.p') ?></p>
      </div>
      <div class="content-block">
        <h2><?= View::e(t('empresa.contacto.h')) ?></h2>
        <a class="email-link" href="mailto:<?= SITE_EMAIL ?>"><?= SITE_EMAIL ?></a>
      </div>
    </div>

  </div>
</div>