<?php /* Mapa del Perú por departamentos. Sedes resaltadas: Áncash (Chimbote) y Lima. */ ?>
<svg class="peru-map" viewBox="0 0 615 900" role="img"
     aria-label="<?= View::e(t('a11y.map')) ?>" xmlns="http://www.w3.org/2000/svg">
  <g class="map-deps">
<?php readfile(__DIR__ . '/_peru_paths.svgfrag'); ?>
  </g>

  <!-- Sede Chimbote (departamento de Áncash) -->
  <g class="map-marker" transform="translate(177.9,464.9)">
    <circle class="pulse" r="5"></circle>
    <circle class="pin" r="4.5"></circle>
    <text class="map-pin-label" x="12" y="4">CHIMBOTE</text>
  </g>
  <!-- Sede Lima (departamento de Lima) -->
  <g class="map-marker" transform="translate(222.7,566.5)">
    <circle class="pulse" r="5"></circle>
    <circle class="pin" r="4.5"></circle>
    <text class="map-pin-label" x="12" y="4">LIMA</text>
  </g>
</svg>
<script>
(function () {
  // Tooltip nativo con el nombre de cada departamento
  var ns = 'http://www.w3.org/2000/svg';
  document.querySelectorAll('.peru-map .dep').forEach(function (p) {
    var n = p.getAttribute('data-name');
    if (!n) return;
    var t = document.createElementNS(ns, 'title');
    t.textContent = n.charAt(0) + n.slice(1).toLowerCase();
    p.appendChild(t);
  });
})();
</script>
