document.addEventListener("DOMContentLoaded", () => {
  fetch('footer.html')  // Prüfe Pfad, ggf. 'includes/footer.html'
    .then(response => {
      if (!response.ok) {
        throw new Error('Footer konnte nicht geladen werden');
      }
      return response.text();
    })
    .then(data => {
      document.getElementById('footer-placeholder').innerHTML = data;
    })
    .catch(err => console.error(err));
});