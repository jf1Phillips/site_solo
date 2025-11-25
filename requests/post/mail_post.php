<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

$root = "../..";
$env = parse_ini_file(__DIR__."/$root/.env");

// Récupération et validation des champs
$userName = trim($_POST['name'] ?? '');
$userEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$content = trim($_POST['content'] ?? '');

if (!$userEmail) {
    die("Email invalide");
}

if (strlen($userName) > 200 || strlen($content) > 10000) {
    die("Champs trop longs.");
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'ssl0.ovh.net';
    $mail->SMTPAuth = true;
    $mail->Username = $env["MAIL_MAIL"];
    $mail->Password = $env["MAIL_MDP"];
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->isHTML(true);

    // Expéditeur
    $mail->setFrom($env["MAIL_MAIL"], 'no-reply');

    // Destinataire
    $mail->addAddress($env["CONTACT_MAIL"]);

    // Contenu
    $mail->Subject = "Message de " . $userName;
    $mail->Body = "
    <html>
    <head>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        h2 { color: #2c3e50; }
        p { line-height: 1.5; }
        .label { font-weight: bold; }
        .content { margin-bottom: 15px; }
    </style>
    </head>
    <body>
    <h2>Nouveau message depuis le formulaire de contact</h2>
    <div class='content'><span class='label'>Nom :</span> {$userName}</div>
    <div class='content'><span class='label'>E-mail :</span> {$userEmail}</div>
    <div class='content'><span class='label'>Message :</span><br/>" . nl2br(htmlspecialchars($content)) . "</div>
    </body>
    </html>
    ";

    // Version texte pour les clients mail qui ne lisent pas le HTML
    $mail->AltBody = "Nouveau message depuis le formulaire de contact\n
    Nom: $userName\n
    E-mail: $userEmail\n
    Message:\n$content";

    $mail->send();
    echo "OK";
} catch (Exception $e) {
    echo "Erreur : " . $mail->ErrorInfo;
}
?>
