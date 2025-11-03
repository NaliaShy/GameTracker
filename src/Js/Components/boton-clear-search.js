// 🧹 Botón "Limpiar" para resetear búsqueda y filtros
document.getElementById('limpiar').addEventListener('click', () => {
document.getElementById('buscar').value = '';
  const genero = document.getElementById('genero');
  const plataforma = document.getElementById('plataforma');
  const modjuego = document.getElementById('modjuego');
  const persp = document.getElementById('persp');

  if (genero) genero.value = '0';
  if (plataforma) plataforma.value = '0';
  if (modjuego) modjuego.value = '0';
  if (persp) persp.value = '0';

  const url = window.location.pathname; // recarga el componente sin filtros

  fetch(url)
    .then(res => res.text())
    .then(html => {
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const nuevosResultados = doc.querySelector('#resultados');
      document.querySelector('#resultados').innerHTML = nuevosResultados.innerHTML;
    });
});