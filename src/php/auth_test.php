<?php
if ($username === $env['TESTUSER'] && $password === $env['TESTPASSWORD']) {
    $_SESSION['username'] = $username;
    header('Location: ../../public/translate.php');
    exit();
} else {
    echo '<p style="color:red;text-align:center;">Ungültiger Benutzername oder Passwort</p>';
}
?>
