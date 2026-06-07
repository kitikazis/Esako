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
        <?php View::partial('mapa-peru'); ?>
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
        <p class="contacto-phone">
          <?= View::e(t('empresa.phone')) ?>:
          <a href="<?= View::e(View::wa(SITE_WA_PHONE, t('wa.msg.default'))) ?>" target="_blank" rel="noopener">+51 989 011 140</a>
        </p>
        <a class="btn btn-orange contacto-cta" href="<?= View::e(View::wa(SITE_WA_PHONE, t('wa.msg.default'))) ?>" target="_blank" rel="noopener">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/></svg>
          <?= View::e(t('empresa.cta')) ?>
        </a>
      </div>
    </div>

  </div>
</div>