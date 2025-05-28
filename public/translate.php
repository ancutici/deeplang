<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
}

$deeplApiKey = $env['DEEPL_API_KEY'];

use DeepL\Translator;

require __DIR__ . '/../vendor/autoload.php';

$translator = new Translator($deeplApiKey);

// Load all glossaries
$glossaries = [];
try {
    $glossariesList = $translator->listGlossaries();
    foreach ($glossariesList as $glossary) {
        $glossaries[] = [
            'id' => $glossary->glossaryId,
            'sourceLang' => $glossary->sourceLang,
            'targetLang' => $glossary->targetLang
        ];
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}
//print_r($glossaries);exit;
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepLang - Übersetzung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="header-container">
        <div class="container">
            <header class="d-flex flex-wrap justify-content-between align-items-center py-3 mb-4">
                <div class="col-md-4 d-flex align-items-center">
                    <!--<img src="logo-deeplang.png" alt="DeepLang Logo" class="me-2 logo-app">-->
                    <!--<img src="logo-blau.svg" alt="DeepLang Logo" class="me-2 logo-app">-->
                    <img src="img/logo-deeplang.png" alt="DeepLang Logo" class="me-2 logo-app">                
                </div>

                <div>  
                    <!--
                    <a href="logout.php" class="btn btn-outline-secondary btn-sm" title="<?= $_SESSION['username'] ?>">Logout</a> 
                    -->
                    <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="navigationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Navigation
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="navigationDropdown">
                        <li><a class="dropdown-item" href="translate.php">Übersetzung</a></li>
                        <li><a class="dropdown-item" href="glossar.php">Glossare</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../docs/nutzungsbedingungen.php">Nutzungsbedingungen</a></li>
                        <li><a class="dropdown-item" href="../docs/datenschutz.php">Datenschutz</a></li>
                        <li><a class="dropdown-item" href="https://www.uni-hohenheim.de/impressum" target="_blank">Impressum</a></li>
                    </ul>
                </div>

                       
                </div>
            </header>
        </div>    
    </div>  
      
    <div class="container">
        <div class="row mb-2">
            <h1>Übersetzung</h1>
        </div>

        <div class="row">
            <div class="col col-input col-12 col-lg-6 py-3">
                <div class="form-floating col-4 mb-3">
                    <select id="sourceLanguage" name="sourceLanguage" class="form-select">
                        <option value="de">Deutsch</option>
                        <option value="en">Englisch</option>
                        <option value="es">Spanisch</option>
                        <option value="fr">Französisch</option>
                        <option value="it">Italienisch</option>
                        <option value="ru">Russisch</option>
                        <option value="zh">Chinesisch</option>
                    </select>

                    <label for="sourceLanguage">Ausgangssprache</label>
                </div>
                
                <textarea id="inputText" class="form-control form-control-plaintext mb-3" rows="10" placeholder="Text hier eingeben oder einfügen"></textarea>

                <div class="">    
                     
                    <button id="clearButton" class="btn btn-light ms-1" title="Ausgangstext löschen">
                        <i class="bi bi-x-lg"></i>
                    </button>   

                </div>                      
            </div>
            <div class="col col-output col-12 col-lg-6 py-3">
                
                <div class="row g-2 mb-3">
                    <div class="col-md-4 me-3">
                        <div class="form-floating">
                            <select class="form-select" id="targetLanguage" name="targetLanguage">
                                <option value="en-US">Englisch (US)</option>
                                <option value="de">Deutsch</option>
                                <option value="en-GB">Englisch (GB)</option>
                                <option value="es">Spanisch</option>
                                <option value="fr">Französisch</option>
                                <option value="it">Italienisch</option>
                                <option value="ru">Russisch</option>
                                <option value="zh">Chinesisch</option>
                            </select>
                            <label for="targetLanguage">Zielsprache</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-check form-switch ">
                            <input class="form-check-input" type="checkbox" id="glossarySwitch" disabled>
                            <label class="form-check-label" for="glossarySwitch">Glossar</label>
                        </div>
                    </div>
                </div>
  
                <textarea id="outputText" class="form-control form-control-plaintext mb-3" rows="10" readonly></textarea>

                <div class="">

                    <button id="copyButton" class="btn btn-light ms-1" title="In Zwischenablage kopieren">
                        <i class="bi bi-copy"></i>
                    </button>   
             
                </div>                      
            </div>
        </div>

        <div class="row mt-3">
            <div class="col text-center">
                <button id="translateButton" class="btn btn-primary">Übersetzen</button>
            </div>
        </div>
    </div>

    <script>
        const glossaries = <?php echo json_encode($glossaries); ?>;
    </script>    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/translate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
