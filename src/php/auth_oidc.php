<?php
require __DIR__ . '/../../vendor/autoload.php';

if (file_exists(__DIR__ . '/../../.env')) {
    $env = parse_ini_file(__DIR__ . '/../../.env');
}

// Die wichtigsten ENV-Variablen
$oidc_idp = $env['OIDC_IDP'];
$oidc_client_id = $env['OIDC_CLIENT_ID'];
$oidc_client_secret = $env['OIDC_CLIENT_SECRET'];
$oidc_redirect_uri = $env['OIDC_REDIRECT_URI'] ?? null; // optional

use Jumbojett\OpenIDConnectClient;

$oidc = new OpenIDConnectClient($oidc_idp, $oidc_client_id, $oidc_client_secret);

if ($oidc_redirect_uri) {
    $oidc->setRedirectURL($oidc_redirect_uri);
}

// Optional, je nach IdP ggf. noch Scopes hinzufügen:
$oidc->addScope(['openid', 'profile', 'email']); // 'openid' ist meist Pflicht!

// --- Dies leitet automatisch um, falls noch kein Token da ist ---
$oidc->authenticate();

// Hole Infos aus dem Token:
$email = $oidc->requestUserInfo('email');
$username = $oidc->requestUserInfo('preferred_username') ?: $email;

// Setze Session, leite weiter:
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
header('Location: /translate');
exit();
?>
