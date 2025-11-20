

<div class="sidebar" id="sidebar">
  <ul>
    <li><a href="#" id="navNavegar" onclick="mostrarSeccion('contenidoNavegar')">Navegar</a></li>
    <li><a href="#" id="navDescubre" onclick="mostrarSeccion('contenidoDescubre')">Descubre juegos</a></li>
    <?php if (isset($_SESSION['usuario_id'])): ?>
      <li><a href="#" id="navMisJuegos" onclick="mostrarSeccion('contenidoMisJuegos')">Mis juegos</a></li>
    <?php endif; ?>
  </ul>
</div>