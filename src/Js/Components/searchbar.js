document.getElementById('buscar').addEventListener('input', function() {
  const q = this.value.trim();
  const genero = document.getElementById('genero')?.value || '';
  const plataforma = document.getElementById('plataforma')?.value || '';

  const url = `?q=${encodeURIComponent(q)}&genero=${genero}&plataforma=${plataforma}`;

  // Usamos fetch para recargar solo el componente
  fetch(url)
    .then(res => res.text())
    .then(html => {
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const nuevosResultados = doc.querySelector('#resultados');
      document.querySelector('#resultados').innerHTML = nuevosResultados.innerHTML;
    })
    .catch(err => console.error('Error al buscar juegos:', err));
});