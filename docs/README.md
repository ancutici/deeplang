# DeepLang

DeepLang ist eine schlanke PHP-App zur komfortablen Übersetzung von Texten über die DeepL API – mit optionalem Einsatz von Glossaren für definierte Fachbegriffe.

**Features:**
- Übersetzung von Texten per DeepL API (mit oder ohne Glossar)
- Glossar-Upload & Verwaltung für berechtigte Nutzer (Editoren)
- Benutzer-Login per Test-Account oder LTI (z.B. aus ILIAS)
- Einfache Oberfläche (siehe Screenshots)

**Screenshots:**

_Hauptansicht Übersetzung:_  
![Screenshot: Übersetzungsansicht](/img/sceen01.png)

_Glossarverwaltung:_  
![Screenshot: Glossar-Übersicht](/img/sceen02.png)  

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
    composer require jumbojett/openid-connect-php
    ```

---

## Einrichtung

1. **Konfigurationsdatei anlegen:**
    ```bash
    cp .env.example .env
    ```
2. **Parameter in `.env` setzen:**  
   - Login per Test-User, LTI (z.B. aus ILIAS) **oder OIDC**
   - DeepL API-Key hinterlegen
   - Glossar-Passwort und zugelassene Editoren eintragen

**.env Beispiel:**
```ini
; Authentication methods: LTI | TEST | OIDC
AUTHENTICATION="TEST"

; TEST configuration
TESTUSER="tester"
TESTPASSWORD="langespasswort123"

; LTI configuration
LTI_CONSUMER_KEY=""
LTI_CONSUMER_SECRET=""

; OIDC configuration
; =========================
OIDC_IDP="<your_oidc_provider_url>"
OIDC_CLIENT_ID="<your_oidc_client_id>"
OIDC_CLIENT_SECRET="<your_oidc_client_secret>"
OIDC_LOGOUT_URI="<your_oidc_logout_uri>"

; DeepL API Key
DEEPL_API_KEY=""

; Glossar Password
GLOSSARY_PASSWORD=""
GLOSSARY_EDITORS="user1@uni-hohenheim.de,user2@uni-hohenheim.de"
