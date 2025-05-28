$(document).ready(function () {
    $('#glossaryForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'glossar.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === 'success') {
                    //alert(response.message);
                    updateGlossaryTable(response.glossaries);
                } else {
                    alert(response.message);
                }
            },
            error: function (error) {
                console.log('Error:', error);
                alert('Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.');
            }
        });
    });

    $(document).on('click', '.delete-glossary', function () {
        if (confirm('Möchten Sie dieses Glossar wirklich löschen?')) {
            var glossaryId = $(this).data('id');

            $.ajax({
                url: 'glossar.php',
                type: 'POST',
                data: {
                    deleteGlossary: true,
                    glossaryId: glossaryId
                },
                success: function (response) {
                    if (response.status === 'success') {
                        //alert(response.message);
                        updateGlossaryTable(response.glossaries);
                    } else {
                        alert(response.message);
                    }
                },
                error: function (error) {
                    console.log('Error:', error);
                    alert('Ein Fehler ist aufgetreten. Bitte versuchen Sie es erneut.');
                }
            });
        }
    });

    function updateGlossaryTable(glossaries) {
        var tableBody = $('#glossaryTableBody');
        tableBody.empty();
        if (glossaries.length === 0) {
            tableBody.append('<tr><td colspan="3">Kein Glossar vorhanden</td></tr>');
        } else {
            glossaries.forEach(function (glossary) {
                tableBody.append(
                    '<tr><td>' + glossary.name + '</td><td>' + glossary.date + '</td><td><button class="btn btn-danger btn-sm delete-glossary" data-id="' + glossary.id + '">Löschen</button></td></tr>'
                );
            });
        }
    }
});
