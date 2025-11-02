const buscarInput = document.getElementById('buscar');
const generoSelect = document.getElementById('genero');
const plataformaSelect = document.getElementById('plataforma');
const resultadosDiv = document.getElementById('resultados');

function buscarJuegos() {
  const query = buscarInput.value.trim();
  const genero = generoSelect.value;
  const plataforma = plataformaSelect.value;

  const params = new URLSearchParams({
    q: query,
    genero,
    plataforma
  });

  fetch(`../../Php/buscar_juegos.php?${params.toString()}`)
    .then(res => res.json())
    .then(data => {
      resultadosDiv.innerHTML = ''; // limpia resultados
      if (data.length === 0) {
        resultadosDiv.innerHTML = '<p>No se encontraron juegos.</p>';
        return;
      }

      data.forEach(juego => {
        const card = document.createElement('div');
        card.classList.add('juego-card');
        card.innerHTML = `
          <h3>${juego.juego_nombre}</h3>
          <p>${juego.juego_descripcion}</p>
          <small>${juego.gen_nombre || ''} | ${juego.plataf_nombre || ''}</small>
        `;
        resultadosDiv.appendChild(card);
      });
    })
    .catch(err => console.error(err));
}

// Ejecutar búsqueda al escribir
buscarInput.addEventListener('input', buscarJuegos);
// Y también al cambiar filtros
generoSelect.addEventListener('change', buscarJuegos);
plataformaSelect.addEventListener('change', buscarJuegos);
