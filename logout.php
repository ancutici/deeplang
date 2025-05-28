<?php
session_start();
session_unset();
session_destroy();

if (file_exists(".env")) {
    $env = parse_ini_file('.env');
    $auth_method = isset($env['AUTHENTICATION']) ? $env['AUTHENTICATION'] : null;
    $oidc_logout_url = isset($env['OIDC_LOGOUT_URI']) ? $env['OIDC_LOGOUT_URI'] : 'index.php';
} else {
    $auth_method = null;
    $oidc_logout_url = 'index.php';
}

if ($auth_method === 'OIDC') {
    header('Location: ' . $oidc_logout_url);
    exit();
} else {
    header('Location: index.php');
    exit();
}
?>
