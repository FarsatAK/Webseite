<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/phpmailer/src/Exception.php';
require __DIR__ . '/phpmailer/src/PHPMailer.php';
require __DIR__ . '/phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
 http_response_code(405);
 exit('Method not allowed');
}

$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
 http_response_code(400);
 exit('Bitte alle Felder korrekt ausfüllen.');
}

$mail = new PHPMailer(true);

try {
 // SMTP (Hostinger)
 $mail->isSMTP();
 $mail->Host = 'smtp.hostinger.com';
 $mail->SMTPAuth = true;
 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 $mail->Port = 587;

 $mail->Username = 'info@lian-gebaeudereinigung.de'; // volle Mailbox-Adresse
 $mail->Password = ''; // Mailbox-Passwort (Webmail)

 $mail->CharSet = 'UTF-8';

 // Absender/Empfänger
 $mail->setFrom($mail->Username, 'Kontaktformular');
 $mail->addAddress('info@lian-gebaeudereinigung.de'); // wohin du es erhalten willst
 $mail->addReplyTo($email, $name);

 $mail->Subject = 'Kontaktformular: ' . $name;
 $mail->Body = "Name: $name\nE-Mail: $email\n\nNachricht:\n$message";

 $mail->send();
 header('Location: /kontakt/?sent=1');
 exit;
 
 http_response_code(200);
 exit('OK');
} catch (Exception $e) {
 http_response_code(500);
 exit('Mailer-Fehler: ' . $mail->ErrorInfo);
}