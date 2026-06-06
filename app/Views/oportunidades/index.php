<div class="oport-page">

  <section class="oport-section" aria-labelledby="h-boletines">
    <h2 id="h-boletines"><?= View::e(t('oport.boletines')) ?></h2>
    <div class="oport-grid">
      <?php foreach ($boletines as $b): ?>
      <div class="oport-card">
        <img class="oport-img" src="<?= View::e($b['img']) ?>" alt="<?= View::e($b['titulo']) ?>" loading="lazy">
        <span class="oport-lbl"><?= View::e($b['titulo']) ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="oport-section" aria-labelledby="h-cursos">
    <h2 id="h-cursos"><?= View::e(t('oport.cursos')) ?></h2>
    <div class="oport-grid">
      <?php foreach ($cursos as $c): ?>
      <div class="oport-card">
        <img class="oport-img" src="<?= View::e($c['img']) ?>" alt="<?= View::e($c['titulo']) ?>" loading="lazy">
        <span class="oport-lbl"><?= View::e($c['titulo']) ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="oport-section" aria-labelledby="h-empleos">
    <h2 id="h-empleos"><?= View::e(t('oport.empleos')) ?></h2>
    <div class="oport-grid">
      <?php foreach ($empleos as $e): ?>
      <div class="oport-card" style="background:#f8f9fa;border:1px solid #ecf0f1;border-radius:6px;padding:16px 18px;flex-direction:row;align-items:center;gap:14px;width:260px">
        <div>
          <p style="font-size:13px;font-weight:700;color:#1e3a5f;margin-bottom:4px"><?= View::e($e['titulo']) ?></p>
          <a href="mailto:<?= View::e($e['email']) ?>" style="font-size:11px;color:#e67e22;font-weight:600"><?= View::e($e['email']) ?></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

</div>