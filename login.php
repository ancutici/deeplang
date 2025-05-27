<?php
session_start();

if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    header('Location: translate.php');
    exit();
}

require 'vendor/autoload.php';

if (file_exists(".env")) {
    $env = parse_ini_file('.env');
}

$authenticationMethod = $env['AUTHENTICATION'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($authenticationMethod === 'TEST') {
        require 'auth_test.php';
    }
    // Weitere Authentifizierungsarten können hier hinzugefügt werden
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesX.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }
        .login-container img {
            max-width: 100px;
            margin-bottom: 50px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="logo-deeplang.png" alt="App Logo">
        <form method="POST" action="index.php">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Benutzername" required>
                <label for="username">Benutzername</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Passwort" required>
                <label for="password">Passwort</label>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Login</button>
        </form>
    </div>
</body>
</html>
