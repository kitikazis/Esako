<div class="svc-panels">
<?php foreach ($servicios as $s): ?>
  <div class="svc-panel">
    <img src="<?= View::e($s['img']) ?>" alt="<?= View::e($s['alt']) ?>" loading="lazy">
    <p class="svc-panel-text"><?= nl2br(View::e($s['titulo'])) ?></p>
  </div>
<?php endforeach; ?>
</div>