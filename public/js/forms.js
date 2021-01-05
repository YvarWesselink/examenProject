$(document).ready(function () {

    // voeg een form toe aan de pagina.
    $(".add-form").click( function() {
            $('.form').append('<div>' +
                '<input type="text" name="">' +
                '<select>' +
                '<option value="txt">Tekstvlak</option>' +
                '<option value="int">Nummeriek</option>' +
                '<option value="date">Datum</option>' +
                '<option value="time">Tijd</option>' +
                '<option value="valuta">Valuta</option>' +
                '</select>' +
                '<button onclick="deleteElement()">-</button>' +
                '</div>')
        }
    );



});

