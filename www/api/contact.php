<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Méthode non autorisée');
}

header('Content-Type: text/plain; charset=utf-8');

// Charger la clé secrète depuis la racine du projet.
$env = parse_ini_file(__DIR__ . '/../../.env');

if (!$env || empty($env['TURNSTILE_SECRET_KEY'])) {
    error_log('Configuration Turnstile manquante');
    http_response_code(500);
    exit('Erreur de configuration');
}

// Récupérer le jeton transmis par le formulaire.
$token = $_POST['cf-turnstile-response'] ?? '';

if (!is_string($token) || $token === '' || strlen($token) > 2048) {
    http_response_code(400);
    exit('Veuillez valider le CAPTCHA.');
}

// Vérifier le jeton auprès de Cloudflare.
$ch = curl_init(
    'https://challenges.cloudflare.com/turnstile/v0/siteverify'
);

curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query([
        'secret' => $env['TURNSTILE_SECRET_KEY'],
        'response' => $token,
    ]),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 5,
    CURLOPT_TIMEOUT => 10,
]);

$response = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);

curl_close($ch);

// En cas d'erreur réseau, refuser l'envoi.
if ($response === false || $error !== '' || $statusCode !== 200) {
    error_log('Échec de la vérification Turnstile');
    http_response_code(502);
    exit('Vérification indisponible. Réessayez plus tard.');
}

$result = json_decode($response, true);

if (!is_array($result) || ($result['success'] ?? false) !== true) {
    http_response_code(400);
    exit('CAPTCHA invalide ou expiré. Veuillez réessayer.');
}

// CAPTCHA valide : exécuter le traitement existant.
require_once __DIR__ . '/../../requests/post/mail_post.php';

?>
