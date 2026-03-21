document.addEventListener("DOMContentLoaded", () => {
  // ===== FOOTER LADEN =====
  fetch("/footer.html", { cache: "no-store" })
  .then((res) => {
  if (!res.ok) throw new Error("Footer nicht gefunden");
  return res.text();
  })
  .then((html) => {
  const footer = document.getElementById("footer-placeholder");
  if (footer) footer.innerHTML = html;
  })
  .catch((err) => console.error("FEHLER Footer:", err));
 
  // ===== KONTAKTFORMULAR (AJAX, kein Seitenwechsel) =====
  const form = document.getElementById("contact-form");
  if (!form) return;
 
  const submitButton = form.querySelector("button[type='submit']");
  const messageBox = document.getElementById("form-message");
 
  const setMessage = (msg, isError = false) => {
  if (!messageBox) return;
  messageBox.textContent = msg;
  messageBox.style.color = isError ? "#b00020" : "#0b6b0b";
  };
 
  form.addEventListener("submit", async (e) => {
  e.preventDefault();
 
  setMessage("");
  if (submitButton) submitButton.disabled = true;
 
  try {
  const res = await fetch(form.action || "/sendmail.php", {
  method: "POST",
  body: new FormData(form),
  headers: { Accept: "text/plain" },
  });
 
  const text = await res.text();
 
  if (!res.ok) throw new Error(text || "Senden fehlgeschlagen.");
 
  setMessage("Danke! Nachricht wurde gesendet.");
  form.reset();
  } catch (err) {
  setMessage(err?.message || "Senden fehlgeschlagen.", true);
  } finally {
  if (submitButton) submitButton.disabled = false;
  }
  });
 });