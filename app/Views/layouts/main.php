<?php
$assetsUrl = ASSETS_URL;
$baseUrl   = BASE_URL;
?><!DOCTYPE html>
<html lang="<?= View::e(Lang::current()) ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= View::e(t('site.tagline')) ?>">
  <title><?= View::e($title ?? APP_NAME) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@500;600;700;800&display=swap">
  <link rel="stylesheet" href="<?= View::asset('css/main.css') ?>">
</head>
<body>
  <a class="skip-link" href="#main-content"><?= View::e(t('a11y.skip')) ?></a>

  <?php View::partial('header'); ?>
  <?php View::partial('sidebar'); ?>

  <main id="main-content">
    <?= $content ?>
  </main>

  <?php View::partial('footer'); ?>

  <script>
    window.ESAKO = {
      lang: <?= json_encode(Lang::current()) ?>,
      i18n: {
        slides: <?= json_encode(t('a11y.slides')) ?>,
        slide:  <?= json_encode(t('a11y.slide')) ?>,
        prev:   <?= json_encode(t('a11y.prev')) ?>,
        next:   <?= json_encode(t('a11y.next')) ?>
      }
    };
  </script>
  <script src="<?= View::asset('js/main.js') ?>"></script>
</body>
</html>