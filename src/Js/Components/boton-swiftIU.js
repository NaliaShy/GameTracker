document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.getElementById('darkSwitch');
  if (!toggle) return;

  // Si estaba activado antes (persistencia opcional)
  if (localStorage.getItem('dark-mode') === 'true') {
    toggle.checked = true;
    document.body.classList.add('dark-mode');
  }

  toggle.addEventListener('change', () => {
    document.body.classList.toggle('dark-mode', toggle.checked);
    localStorage.setItem('dark-mode', toggle.checked); // Guarda el estado
  });
});
