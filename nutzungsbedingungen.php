<?php
session_start();

if (file_exists(".env")) {
    $env = parse_ini_file('.env');
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepLang - Nutzungsbedingungen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header-container">
        <div class="container">
        <header class="d-flex flex-wrap justify-content-between align-items-center py-3 mb-4">
                <div class="col-md-4 d-flex align-items-center">
                    <!--<img src="logo-deeplang.png" alt="DeepLang Logo" class="me-2 logo-app">-->
                    <!--<img src="logo-blau.svg" alt="DeepLang Logo" class="me-2 logo-app">-->
                    <img src="logo-deeplang.png" alt="DeepLang Logo" class="me-2 logo-app">                
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
                        <li><a class="dropdown-item" href="nutzungsbedingungen.php">Nutzungsbedingungen</a></li>
                        <li><a class="dropdown-item" href="datenschutz.php">Datenschutz</a></li>
                        <li><a class="dropdown-item" href="https://www.uni-hohenheim.de/impressum" target="_blank">Impressum</a></li>
                    </ul>
                </div>

                       
                </div>
            </header>
        </div>    
    </div>  

    <div class="container">
        <div class="row mb-2">
            <h1>Nutzungsbedingungen</h1>
        </div>

        <div class="row mb-3 white-rounded-box py-3">
            <div class="col">

            <p>Willkommen zum Leitfaden für den Umgang mit DeepLang Hohenheim, das auf der DeepL API basiert. Dieser Leitfaden soll allen Hochschulangehörigen - Studierenden, Lehrenden und Mitarbeitenden - eine klare Richtlinie bieten, wie mit dieser Technologie verantwortungsbewusst umgegangen werden soll. Bitte beachten Sie, dass dieser Leitfaden die Nutzungsbedingungen von DeepL ergänzt und keinen Anspruch auf Vollständigkeit erhebt. Es liegt in der Verantwortung der Nutzerinnen und Nutzer, die Nutzungsbedingungen einzuhalten.</p>

<h3>Allgemeine Bestimmungen</h3>
<p><b>Was verboten ist:</b></p>
<ul>
    <li>Eingabe personenbezogener Daten über sich selbst oder über andere.</li>
    <li>Nutzung der Dienste für illegale, schädliche oder missbräuchliche Aktivitäten.</li>
    <li>Verletzung, Missbrauch oder Verstoß gegen die Rechte anderer.</li>
    <li>Modifikation, Kopie, Vermietung, Verkauf oder Verteilung unserer Dienste.</li>
    <li>Automatisches oder programmgesteuertes Extrahieren von Daten oder Output.</li>
    <li>Beeinträchtigung oder Störung der Dienste oder Umgehung von Schutzmaßnahmen.</li>
</ul>

<p><b>Was zu beachten ist:</b></p>
<p>Sie sind verantwortlich für den von Ihnen bereitgestellten Input und den daraus resultierenden Output. Sie müssen sicherstellen, dass Ihr Input keine Rechte verletzt und dass Sie über alle notwendigen Rechte, Lizenzen und Genehmigungen für die Bereitstellung des Inputs verfügen.</p>

<p><b>Genauigkeit:</b></p>
<p>Die Nutzung der Dienste kann zu ungenauem oder fehlerhaftem Output führen. Es ist wichtig, dass Sie den Output kritisch prüfen und nicht als alleinige Quelle der Wahrheit verwenden. Ihre Eingaben werden nicht von der Universität Hohenheim, aber von DeepL für die Dauer der Erstellung und Übertragung der Übersetzung gespeichert und danach gelöscht. Ihre Eingaben werden nicht verwendet, um das Produkt sicherer oder besser zu machen.</p>

<h3>Spezifische Bestimmungen</h3>

<p><b>Für Studierende:</b></p>
<ul>
    <li>Verwenden Sie DeepLang zur Unterstützung Ihres Lernprozesses, aber verlassen Sie sich nicht ausschließlich auf die generierten Übersetzungen.</li>
    <li>Teilen Sie keine persönlichen Daten oder Informationen über DeepLang. Auch nicht die personenbezogenen Daten anderer.</li>
    <li>Sie übernehmen die Autorenschaft. Damit bürgen Sie für die Qualität der Übersetzung und übernehmen die Verantwortung für den Inhalt.</li>
</ul>

<p><b>Für Lehrende:</b></p>
<ul>
    <li>DeepLang darf nicht verwendet werden, um studentische Arbeiten zu übersetzen, wenn diese Arbeiten persönliche Daten enthalten, die extrahierbar sind.</li>
    <li>Nutzen Sie DeepLang als ergänzendes Werkzeug zur Vorbereitung von Lehrmaterialien, aber stellen Sie sicher, dass alle Inhalte auf ihre Richtigkeit und Relevanz überprüft werden.</li>
</ul>

<p><b>Für Mitarbeitende:</b></p>
<ul>
    <li>Es ist strengstens untersagt, Geheimhaltungsverträge oder intern bestimmte Dokumente in DeepLang einzugeben. Auch keine Dokumente, die personenbezogene Daten über sich selbst oder über andere enthalten.</li>
    <li>Nutzen Sie DeepLang zur Effizienzsteigerung und Unterstützung Ihrer täglichen Aufgaben, jedoch unter Beachtung der Datenschutzrichtlinien und Sicherheitsvorschriften der Universität Hohenheim.</li>
</ul>

<p>Dieser Leitfaden dient als Orientierungshilfe für den verantwortungsbewussten Umgang mit DeepLang. Es ist wichtig, dass alle Nutzer*innen die genannten Bestimmungen verstehen und befolgen, um einen sicheren und ethischen Einsatz dieser Technologie zu gewährleisten. Die Universität kann diesen Service nur anbieten, wenn Sie keine persönlichen Daten eingeben. </p>


            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="glossar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
