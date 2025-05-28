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
    <title>DeepLang - Datenschutz</title>
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
            <h1>Datenschutz</h1>
        </div>

        <div class="row mb-3 white-rounded-box py-3">
            <div class="col">

            <p>Wenn Sie diesen Service nutzen, werden personenbezogene Daten verarbeitet. Personenbezogene Daten sind alle Informationen, die verwendet werden können, um Sie persönlich zu identifizieren. Wir nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Ihre personenbezogenen Daten werden vertraulich behandelt entsprechend dieser Datenschutzerklärung sowie der gesetzlichen Datenschutzvorschriften. Diese Datenschutzerklärung klärt Sie über die Art, den Umfang und Zweck der Verarbeitung von personenbezogenen Daten innerhalb unseres Onlineangebotes auf. Im Hinblick auf die verwendeten Begrifflichkeiten, wie z.B. „Verarbeitung“ oder „Verantwortlicher“ verweisen wir auf die Definitionen im Art. 4 der Datenschutzgrundverordnung (DSGVO).</p>

<h2>Verantwortlich im datenschutzrechtlichen Sinne:</h2>
<p>Universität Hohenheim<br>70593 Stuttgart<br>Telefon: +49 711 459 0<br>E-Mail: <a href="mailto:post@uni-hohenheim.de">post@uni-hohenheim.de</a><br>Internet: <a href="https://www.uni-hohenheim.de/">www.uni-hohenheim.de</a><br>Die Universität Hohenheim ist eine Körperschaft des öffentlichen Rechts. Sie wird gesetzlich vertreten durch den <a href="https://www.uni-hohenheim.de/organisation/person/prof-dr-sc-agr-stephan-dabbert" data-ss1697700223="1">Rektor Prof. Dr. Stephan Dabbert</a>.</p>

<h2>Datenschutzbeauftragter der Universität Hohenheim:</h2>
<p>UIMC Dr. Voßbein GmbH &amp; Co. KG<br>Dr. Heiko Haaz<br>Otto-Hausmann-Ring 113<br>42115 Wuppertal<br>E-Mail: <a href="mailto:datenschutz.uni-hohenheim@uimc.de">datenschutz.uni-hohenheim@uimc.de</a><br></p>

<h2>Zugriffsdaten/Server-Log-Files</h2>
<p>Wenn Sie unsere Seiten aufrufen, verarbeitet unser Webserver auf Grundlage von Art. 32 Abs. 1 lit. b) EU-DSGVO i.V.m. Art. 6 Abs. 1 lit. c) EU-DSGVO automatisch die Informationen, die Ihr Browser an uns übermittelt:</p>
<ul>
    <li>Browsertyp und -sprache</li>
    <li>verwendetes Betriebssystem</li>
    <li>die von Ihnen zuletzt besuchte Seite (Referrer URL)</li>
    <li>Datum und Uhrzeit der Serveranfrage</li>
    <li>die übertragene Datenmenge und der Zugriffsstatus (Datei übertragen, Datei nicht gefunden etc.)</li>
    <li>IP-Adresse</li>
</ul>
<p>Diese Daten erheben und verwenden wir ausschließlich in nicht-personenbezogener Form, d.h. eine personenbezogene Auswertung findet nicht statt. Sie dienen vorrangig der Sicherheit und der Gewährleistung einer fehlerfreien Bereitstellung der Website und ferner zu statistischen Zwecken. Eine Zusammenführung dieser Daten mit anderen Datenquellen findet nicht statt. Diese Daten werden nach 8 Tagen automatisch gelöscht.</p>

<h2>Zugangsdaten/Login</h2>
<p>Die von Ihnen eingegebenen Zugangsdaten dienen lediglich der Überprüfung, ob Sie zugangsberechtigt sind. Ihre Daten werden nicht gespeichert, sondern direkt an das Identitätsmanagement weitergeleitet, das eine Prüfung vornimmt.</p>

<h2>DeepL API Pro</h2>
<p>Die "DeepLang Hohenheim"-App nutzt die API von DeepL, um einen Übersetzungsdienst für die Angehörigen der Universität Hohenheim zur Verfügung zu stellen. Es ist uns wichtig, darauf hinzuweisen, dass bei der Nutzung dieser API keine personenbezogenen Daten wie IP-Adressen oder Benutzerkennungen an DeepL übermittelt werden. Lediglich der reine Textinhalt wird an DeepL übermittelt.</p>
<p>Die von Ihnen eingereichten Texte oder Dokumente werden nicht dauerhaft gespeichert und nur vorübergehend vorgehalten, soweit dies für die Erstellung und Übertragung der Übersetzung notwendig ist. Nach vollständiger Erbringung der Leistung seitens DeepL werden sowohl die eingereichten Texte oder Dokumente als auch deren Übersetzungen bei DeepL gelöscht. Ihre Texte werden nicht zum Training oder zur Verbesserung der Dienstleistungsqualitär von DeepL verwendet.</p>

<h2>Session Cookies</h2>
<p>Die Webseite verwendet ein sogenanntes Session Cookie. Session-Cookies sind kleine Informationseinheiten, die ein Webserver im Arbeitsspeicher des Computers des Besuchers speichert. In einem Session-Cookie wird eine zufällig erzeugte eindeutige Identifikationsnummer abgelegt, eine sogenannte Session-ID. Außerdem enthält ein Cookie die Angabe über seine Herkunft und die Speicherfrist. Diese Cookies können keine anderen Daten speichern. Das von uns eingesetzte Session-Cookie ist für die Funktion unserer Webseite notwendig, damit Ihr Browser auch nach einem Seitenwechsel wiedererkannt wird. Es wird automatisch gelöscht, wenn Sie sich von der Anwendung abmelden oder den Browser schließen. Session Cookies werden nicht zur Erstellung von Nutzerprofilen verwendet.</p>

<h2>Ihre Rechte</h2>
<p>In Artikel 15 ff der DSGVO sind Ihre Rechte aufgeführt.<br>Sie haben das Recht, auf Antrag eine kostenlose Auskunft darüber zu erhalten, welche personenbezogenen Daten über Sie gespeichert wurden und das Recht auf Berichtigung falscher Daten und auf die Verarbeitungseinschränkung oder Löschung Ihrer personenbezogenen Daten.<br>Wie aber oben dargestellt erheben wir außer den beschriebenen keine personenbezogenen Daten.</p>


            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="glossar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
