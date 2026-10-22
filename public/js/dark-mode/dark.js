// 1. Initialisation immédiate (évite le flash de couleur au chargement)
(function initTheme() {
  const savedTheme = localStorage.getItem('theme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

  if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
})();

// 2. Gestion de l'événement de clic
document.addEventListener('DOMContentLoaded', () => {
  const themeToggleBtn = document.getElementById('theme-toggle');

  if (themeToggleBtn) {
    themeToggleBtn.addEventListener('click', () => {
      // Ajoute ou retire la classe 'dark' sur la balise <html>
      const isDark = document.documentElement.classList.toggle('dark');

      // Sauvegarde du choix dans le navigateur
      localStorage.setItem('theme', isDark ? 'dark' : 'light');
    });
  }
});