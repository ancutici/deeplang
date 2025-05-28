<?php
// public/index.php — zentrale Routing-Schaltstelle
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestPath) {
    case '/':
    case '/login':
        require __DIR__ . '/login.php';
        break;
    case '/datenschutz':
        require __DIR__ . '/../docs/datenschutz.php';
        break;
    case '/nutzungsbedingungen':
        require __DIR__ . '/../docs/nutzungsbedingungen.php';
        break;
    case '/oidc':
        require __DIR__ . '/../src/php/auth_oidc.php';
        break;
    case '/logout':
        require __DIR__ . '/logout.php';
        break;
    case '/translate':
        require __DIR__ . '/translate.php';
        break;
    case '/glossar':
        require __DIR__ . '/glossar.php';
        break;
    default:
        http_response_code(404);
        echo 'Seite nicht gefunden';
}
