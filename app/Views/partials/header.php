<?php
$p    = $page ?? '';
// URL actual (sin querystring) para construir el cambio de idioma sin perder la página
$curr = strtok($_SERVER['REQUEST_URI'] ?? (BASE_URL . '/'), '?');
$lang = Lang::current();
?>
<header class="site-header" role="banner">
  <div class="header-inner">
    <a href="<?= BASE_URL ?>/" class="site-logo" aria-label="<?= APP_NAME ?> — <?= View::e(t('nav.inicio')) ?>">
      <img src="https://esako.com.pe/wp-content/uploads/2025/10/logo-alta-calidad-1.gif"
           alt="<?= APP_NAME ?>" height="46"
           onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
      <span class="logo-fallback" style="display:none;">ESAKO</span>
    </a>

    <nav class="site-nav" id="site-nav" aria-label="<?= View::e(t('a11y.nav')) ?>">
      <ul class="nav-list">
        <li><a href="<?= BASE_URL ?>/" <?= $p==='inicio'   ?'class="active" aria-current="page"':'' ?>><?= View::e(t('nav.inicio')) ?></a></li>
        <li><a href="<?= BASE_URL ?>/empresa" <?= $p==='empresa'  ?'class="active" aria-current="page"':'' ?>><?= View::e(t('nav.empresa')) ?></a></li>
        <li class="has-dropdown">
          <a href="<?= BASE_URL ?>/servicio" <?= $p==='servicio' ?'class="active" aria-current="page"':'' ?>><?= View::e(t('nav.servicio')) ?></a>
          <ul class="dropdown" aria-label="<?= View::e(t('nav.servicio')) ?>">
            <li><a><?= View::e(t('dd.svc.title')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.svc.motores')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.svc.hidraulicos')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.svc.toma')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.svc.transmisiones')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.svc.grupos')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.svc.tableros')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.svc.luminarias')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.svc.tierra')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.svc.camaras')) ?></a></li>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="<?= BASE_URL ?>/soluciones" <?= $p==='soluciones'?'class="active" aria-current="page"':'' ?>><?= View::e(t('nav.soluciones')) ?></a>
          <ul class="dropdown" aria-label="<?= View::e(t('nav.soluciones')) ?>">
            <li><a><?= View::e(t('dd.sol.title')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.motores')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.transmisiones')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.toma')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.grupos')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.tableros')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.excavadoras')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.repuestos')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.filtros')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.aceites')) ?></a></li>
            <li><a href="#"><?= View::e(t('dd.sol.refrigerantes')) ?></a></li>
          </ul>
        </li>
        <li><a href="<?= BASE_URL ?>/oportunidades" <?= $p==='oportunidades'?'class="active" aria-current="page"':'' ?>><?= View::e(t('nav.oportunidades')) ?></a></li>
        <li><a href="<?= BASE_URL ?>/tienda" <?= $p==='tienda'?'class="active" aria-current="page"':'' ?>><?= View::e(t('nav.tienda')) ?></a></li>
        <li><a href="<?= BASE_URL ?>/clientes" <?= $p==='clientes'?'class="active" aria-current="page"':'' ?>><?= View::e(t('nav.clientes')) ?></a></li>
        <li><a href="#"><?= View::e(t('nav.usuarios')) ?></a></li>

        <!-- Selector de idioma -->
        <li class="nav-lang" aria-label="Idioma / Language">
          <a href="<?= View::e($curr) ?>?lang=es" hreflang="es" title="Español"
             class="lang-opt <?= $lang==='es'?'active':'' ?>" <?= $lang==='es'?'aria-current="true"':'' ?>>
            <svg class="flag" viewBox="0 0 3 2" aria-hidden="true"><rect width="3" height="2" fill="#c60b1e"/><rect width="3" height="1" y="0.5" fill="#ffc400"/></svg>
            <span>ES</span>
          </a>
          <a href="<?= View::e($curr) ?>?lang=en" hreflang="en" title="English"
             class="lang-opt <?= $lang==='en'?'active':'' ?>" <?= $lang==='en'?'aria-current="true"':'' ?>>
            <svg class="flag" viewBox="0 0 60 30" aria-hidden="true">
              <clipPath id="ukclip"><path d="M0,0 v30 h60 v-30 z"/></clipPath>
              <g clip-path="url(#ukclip)">
                <path d="M0,0 v30 h60 v-30 z" fill="#012169"/>
                <path d="M0,0 L60,30 M60,0 L0,30" stroke="#fff" stroke-width="6"/>
                <path d="M30,0 v30 M0,15 h60" stroke="#fff" stroke-width="10"/>
                <path d="M30,0 v30 M0,15 h60" stroke="#C8102E" stroke-width="6"/>
              </g>
            </svg>
            <span>EN</span>
          </a>
        </li>
      </ul>
    </nav>

    <button class="nav-toggle" id="nav-toggle"
            aria-label="<?= View::e(t('a11y.menu_open')) ?>" aria-expanded="false"
            aria-controls="site-nav">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>
