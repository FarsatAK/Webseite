<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $to = "info@lian-gebaeudereinigung.de"; // DEINE E-Mail
    $to = "farsatak942@gmail.com";
    $subject = "Neue Anfrage über Kontaktformular";
    
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    $body = "Name: $name\n";
    $body .= "E-Mail: $email\n\n";
    $body .= "Nachricht:\n$message\n";
    
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    if (mail($to, $subject, $body, $headers)) {
        echo "Danke, Ihre Nachricht wurde gesendet!";
    } else {
        echo "Fehler beim Versenden. Bitte versuchen Sie es später.";
    }
} else {
    echo "Ungültige Anfrage.";
}
?>