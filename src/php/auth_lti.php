<?php
function authLTI($LTI_CONSUMER_KEY, $LTI_CONSUMER_SECRET, $post_oauth_consumer_key)
{
    $ok = $post_oauth_consumer_key === $LTI_CONSUMER_KEY;

    $provider = new OAuthProvider();

    $provider->consumerKey = $LTI_CONSUMER_KEY;
    $provider->consumerSecret = $LTI_CONSUMER_SECRET;

    $provider->consumerHandler(function ($provider) use ($LTI_CONSUMER_SECRET) {
        $provider->consumer_secret = $LTI_CONSUMER_SECRET;
        return OAUTH_OK;
    });

    $provider->timestampNonceHandler(function ($provider) {
        return OAUTH_OK;
    });

    try {
        $provider->isRequestTokenEndpoint(true);
        $provider->checkOAuthRequest();
    } catch (OAuthException $e) {
        $ok = false;
    }

    if ($ok) {
        $firstname = $_POST['lis_person_name_given'];
        $surname = $_POST['lis_person_name_family'];
        $email = $_POST['lis_person_contact_email_primary'];

        return ['authStatus' => 'ok', 'firstname' => $firstname, 'surname' => $surname, 'email' => $email];
    } else {
        return ['authStatus' => 'Login gescheitert'];
    }
}

if (file_exists(__DIR__ . '/../../.env')) {
    $env = parse_ini_file(__DIR__ . '/../../.env');
}

$post_oauth_consumer_key = filter_var($_POST['oauth_consumer_key'], FILTER_SANITIZE_STRING);
$loginResult = authLTI($env['LTI_CONSUMER_KEY'], $env['LTI_CONSUMER_SECRET'], $post_oauth_consumer_key);

if ($loginResult['authStatus'] == 'ok') {
    session_start();
    $_SESSION['username'] = $loginResult['email'];
    header('Location: /translate');
    exit();
} else {
    echo '<p style="color:red;text-align:center;">' . $loginResult['authStatus'] . '</p>';
}
?>
