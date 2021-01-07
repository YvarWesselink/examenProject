$(document).ready(function () {

    // voeg een form toe aan de pagina.
    $(".add-form-1").click( function() {
        $('.submit-form').remove();
        $('.form-1').append('<div>' +
            '<input type="text" name="titel">' +
            '<select name="input-type">' +
            '<option value="txt">Tekstvlak</option>' +
            '<option value="int">Nummeriek</option>' +
            '<option value="date">Datum</option>' +
            '<option value="time">Tijd</option>' +
            '<option value="valuta">Valuta</option>' +
            '</select>' +
            '<button type="button" class="delete-form">-</button>' +
            '</div>')
        $('.form-1').append('<input class="submit-form" type="submit" name="update">');
        }
    );

    // voeg een form toe aan de pagina.
    $(".add-form-2").click( function() {
            $('.submit-form').remove();
            $('.form-2').append('<div>' +
                '<input type="text" name="titel">' +
                '<select name="input-type">' +
                '<option value="txt">Tekstvlak</option>' +
                '<option value="int">Nummeriek</option>' +
                '<option value="date">Datum</option>' +
                '<option value="time">Tijd</option>' +
                '<option value="valuta">Valuta</option>' +
                '</select>' +
                '<button type="button" class="delete-form">-</button>' +
                '</div>')
            $('.form-2').append('<input class="submit-form" type="submit" name="update">');
        }
    );

    $(document).delegate('button', 'click', function () {
        $(this).parent('div').remove();
    })

    $('.deleteRow').click(function () {
        alert("Dit verwijdert ook alle data in deze rij!")

        var id = $(this).parent('div').text().slice(0,-1);

        $.ajax({
            url: '/deleteRowOp',
            data: {'id' : id},
            type: 'GET'
        })

    })

    $('.deleteRowC').click(function () {
        alert("Dit verwijdert ook alle data in deze rij!")

        var id = $(this).parent('div').text().slice(0,-1);

        $.ajax({
            url: '/deleteRowCo',
            data: {'id' : id},
            type: 'GET'
        })

    })
});

