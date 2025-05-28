<?php
session_start();

require 'vendor/autoload.php';

use Jumbojett\OpenIDConnectClient;

if (file_exists(".env")){
    $env = parse_ini_file('.env');
}

$oidc = new OpenIDConnectClient(
    isset($env) ? $env["OIDC_IDP"] : getenv("OIDC_IDP"),
    isset($env) ? $env["OIDC_CLIENT_ID"] : getenv("OIDC_CLIENT_ID"),
    isset($env) ? $env["OIDC_CLIENT_SECRET"] : getenv("OIDC_CLIENT_SECRET")
);

$testuser = isset($env) ? $env["TESTUSER"] : getenv("TESTUSER");
if ($testuser) { // Or a more specific OIDC test mode flag if preferred
    $oidc->setHttpUpgradeInsecureRequests(false);
}

$oidc->addScope(['profile','email']);
$oidc->authenticate();

$firstname = $oidc->requestUserInfo('given_name');
$surname = $oidc->requestUserInfo('family_name');
$initials = substr($firstname, 0, 1) . substr($surname, 0, 1);
$_SESSION['initials'] = $initials;
$_SESSION['username'] = $oidc->requestUserInfo('email');

header("Location: translate.php");
exit();
?>
