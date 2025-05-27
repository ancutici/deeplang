# DeepLang

DeepLang ist eine schlanke PHP-App, mit der ausgewählte Nutzer Glossare hochladen können.  
Die Glossare dienen als unterstützende Vokabellisten für Übersetzungen per DeepL API.

**Features:**
- Glossar-Upload durch berechtigte Nutzer (siehe Screenshots)
- Benutzer-Login per Test-Zugang oder LTI (z.B. aus ILIAS)
- Übersetzungen via DeepL API

![Screenshot: Glossar-Übersicht](Screenshot%202025-05-27%20171038.png)
![Screenshot: Glossar-Upload](Screenshot%202025-05-27%20171126.png)

---

## Voraussetzungen

- PHP 7.4 oder höher
- Composer
- Webserver (Apache, nginx o.ä.)
- DeepL API-Key (für Übersetzungsfunktion)

---

## Installation

1. **Projekt klonen:**
    ```bash
    git clone https://github.com/ancutici/deeplang.git
    cd deeplang
    ```

2. **Abhängigkeiten installieren:**
    ```bash
    composer install
    ```

---

## Einrichtung

1. **Konfigurationsdatei anlegen:**
    ```bash
    cp .env.example .env
    ```
2. **Parameter in `.env` setzen:**  
   - Login per Test-User **oder** per LTI (z.B. von ILIAS)
   - DeepL API-Key hinterlegen
   - Glossar-Passwort und zugelassene Editoren eintragen

**.env Beispiel:**
```ini
; Authentication methods: LTI | TEST
AUTHENTICATION="TEST"

; TEST configuration
TESTUSER="tester"
TESTPASSWORD="langespasswort123"

; LTI configuration
LTI_CONSUMER_KEY=""
LTI_CONSUMER_SECRET=""

; DeepL API Key
DEEPL_API_KEY=""

; Glossar Password
GLOSSARY_PASSWORD=""
GLOSSARY_EDITORS="user1@uni-hohenheim.de,user2@uni-hohenheim.de"
