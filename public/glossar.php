<?php
session_start();

if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
}

$glossaryEditors = explode(',', $env['GLOSSARY_EDITORS']); // E-Mail-Adressen der Personen, die das Glossar bearbeiten dürfen
$deeplApiKey = $env['DEEPL_API_KEY'];

use DeepL\Translator;
use DeepL\GlossaryEntries;

require __DIR__ . '/../vendor/autoload.php';

$translator = new Translator($deeplApiKey);

function getGlossaries($translator) {
    $glossariesList = [];
    try {
        $glossaries = $translator->listGlossaries();
        foreach ($glossaries as $glossary) {
            $glossaryDate = $glossary->creationTime->format('d.m.Y');
            $glossariesList[] = ['id' => $glossary->glossaryId, 'name' => $glossary->name, 'date' => $glossaryDate];
        }
    } catch (Exception $e) {
        // handle exception if needed
    }
    return $glossariesList;
}

$glossariesList = getGlossaries($translator);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
    $password = $_POST['password'] ?? null;
    $direction = $_POST['direction'] ?? null;

    $allowedDirections = ['de-en', 'en-de'];
    if (!in_array($_SESSION['username'], $glossaryEditors)) {
        $error = 'Sie haben keine Berechtigung, das Glossar zu bearbeiten.';
    } elseif (!in_array($direction, $allowedDirections)) {
        $error = 'Invalid translation direction';
    } elseif ($_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['csv_file']['tmp_name'];
        $csvData = file_get_contents($fileTmpPath);
        $sourceLang = explode('-', $direction)[0];
        $targetLang = explode('-', $direction)[1];

        try {
            $glossaries = $translator->listGlossaries();
            foreach ($glossaries as $glossary) {
                if ($glossary->name === "Hohenheim $direction") {
                    $translator->deleteGlossary($glossary->glossaryId);
                }
            }

            $translator->createGlossaryFromCsv("Hohenheim $direction", $sourceLang, $targetLang, $csvData);
            $success = 'Glossar erfolgreich aktualisiert';
        } catch (Exception $e) {
            $error = 'Error: ' . $e->getMessage();
        }
    } else {
        $error = 'Please upload a valid CSV file';
    }
    header('Content-Type: application/json');
    if (isset($error)) {
        echo json_encode(['status' => 'error', 'message' => $error]);
    } else {
        echo json_encode(['status' => 'success', 'message' => $success, 'glossaries' => getGlossaries($translator)]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteGlossary'])) {
    $glossaryId = $_POST['glossaryId'] ?? null;

    if (!in_array($_SESSION['username'], $glossaryEditors)) {
        $error = 'Sie haben keine Berechtigung, das Glossar zu löschen.';
    } elseif ($glossaryId) {
        try {
            $translator->deleteGlossary($glossaryId);
            $success = 'Glossar erfolgreich gelöscht';
        } catch (Exception $e) {
            $error = 'Error: ' . $e->getMessage();
        }
    } else {
        $error = 'Invalid Glossary ID';
    }
    header('Content-Type: application/json');
    if (isset($error)) {
        echo json_encode(['status' => 'error', 'message' => $error]);
    } else {
        echo json_encode(['status' => 'success', 'message' => $success, 'glossaries' => getGlossaries($translator)]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepLang - Glossar-Verwaltung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
                        <li><a class="dropdown-item" href="/translate">Übersetzung</a></li>
                        <li><a class="dropdown-item" href="/glossar">Glossare</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/nutzungsbedingungen">Nutzungsbedingungen</a></li>
                        <li><a class="dropdown-item" href="/datenschutz">Datenschutz</a></li>
                        <li><a class="dropdown-item" href="https://www.uni-hohenheim.de/impressum" target="_blank">Impressum</a></li>
                    </ul>
                </div>

                       
                </div>
            </header>
        </div>    
    </div>  

    <div class="container">
        <div class="row mb-2">
            <h1>Glossare</h1>
        </div>

        <div class="row mb-3">
            <div class="col glossar-list py-3 white-rounded-box">
                <h2>Verfügbare Glossare</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Datum</th>
                            <?php if (in_array($_SESSION['username'], $glossaryEditors)): ?> 
                            <th>Aktionen</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody id="glossaryTableBody">
                        <?php if (empty($glossariesList)): ?>
                            <tr>
                                <td colspan="3">Kein Glossar vorhanden</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($glossariesList as $glossary): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($glossary['name']); ?></td>
                                    <td><?php echo htmlspecialchars($glossary['date']); ?></td>
                                    <?php if (in_array($_SESSION['username'], $glossaryEditors)): ?>        
                                        <td>
                                        <button class="btn btn-danger btn-sm delete-glossary" data-id="<?php echo $glossary['id']; ?>">Löschen</button>
                                    </td>
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if (in_array($_SESSION['username'], $glossaryEditors)): ?>
            <div class="row">
            <div class="col glossar-update py-3 white-rounded-box">
                <h2>Glossar hinzufügen oder aktualisieren</h2>
                <form id="glossaryForm" method="POST" action="glossar.php" enctype="multipart/form-data">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select id="direction" name="direction" class="form-select" required>
                                    <option value="de-en">Deutsch nach Englisch</option>
                                    <option value="en-de">Englisch nach Deutsch</option>
                                </select>
                                <label for="direction">Übersetzungsrichtung</label>
                            </div>
                        </div>
                        <div class="col-md-7">
                        <div class="">
                            <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv" required>
                        </div>

                        </div>
                        <div class="col-md">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/glossar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
