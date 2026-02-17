// Footer dynamisch einfügen
const footerHTML = `
  <footer>
    <p>© 2026 FacilityPro Services. Alle Rechte vorbehalten.</p>
    <div>
      <a href="impressum.html">Impressum</a> |
      <a href="datenschutz.html">Datenschutz</a> |
      <a href="agb.html">AGB</a>
    </div>
  </footer>
`;

document.getElementById("footer-placeholder").innerHTML = footerHTML;
