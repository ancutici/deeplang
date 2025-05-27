$(document).ready(function () {
    function normalizeLanguageCode(lang) {
        return lang.split('-')[0]; // Splits the language code at '-' and returns the first part
    }

    function checkGlossaryAvailability() {
        var sourceLang = normalizeLanguageCode($('#sourceLanguage').val());
        var targetLang = normalizeLanguageCode($('#targetLanguage').val());

        console.log('Checking glossary for:', sourceLang, targetLang);

        var glossaryExists = glossaries.some(function (glossary) {
            return glossary.sourceLang === sourceLang && glossary.targetLang === targetLang;
        });

        console.log('Glossary exists:', glossaryExists);

        $('#glossarySwitch').prop('disabled', !glossaryExists);
        $('#glossarySwitch').prop('checked', glossaryExists);
    }

    function getGlossaryId(sourceLang, targetLang) {
        var glossary = glossaries.find(function (glossary) {
            return glossary.sourceLang === sourceLang && glossary.targetLang === targetLang;
        });

        return glossary ? glossary.id : null;
    }

    $('#sourceLanguage, #targetLanguage').on('change', function () {
        checkGlossaryAvailability();
    });

    $('#translateButton').on('click', function () {
        var sourceLang = $('#sourceLanguage').val();
        var targetLang = $('#targetLanguage').val();
        var text = $('#inputText').val();
        var useGlossary = $('#glossarySwitch').is(':checked') && !$('#glossarySwitch').is(':disabled');
        var glossaryId = null;

        if (useGlossary) {
            glossaryId = getGlossaryId(normalizeLanguageCode(sourceLang), normalizeLanguageCode(targetLang));
        }

        $.ajax({
            url: 'api.php',
            type: 'POST',
            data: {
                source_lang: sourceLang,
                target_lang: targetLang,
                text: text,
                glossary_id: glossaryId
            },
            success: function (data) {
                $('#outputText').val(data);
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    });

    $('#copyButton').on('click', function () {
        var outputText = $('#outputText').val();
        navigator.clipboard.writeText(outputText).then(function () {
            console.log('Text erfolgreich in die Zwischenablage kopiert');
        }, function (err) {
            console.error('Fehler beim Kopieren in die Zwischenablage: ', err);
        });
    });

    $('#clearButton').on('click', function () {
        $('#inputText').val('');
    });

    // Initial check on page load
    checkGlossaryAvailability();
});
