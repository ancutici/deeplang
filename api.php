<?php
require 'vendor/autoload.php';

use DeepL\Translator;

if (file_exists(".env")) {
    $env = parse_ini_file('.env');
}

$authKey = $env['DEEPL_API_KEY'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sourceLang = $_POST['source_lang'] ?? null;
    $targetLang = $_POST['target_lang'];
    $text = $_POST['text'];
    $glossaryId = $_POST['glossary_id'] ?? null;

    $translator = new Translator($authKey);

    try {
        $options = [];
        if ($glossaryId) {
            $options['glossary'] = $glossaryId;
        }

        $result = $translator->translateText($text, $sourceLang, $targetLang, $options);
        echo $result->text;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request method.';
}
?>
