$(document).ready(function () {

    // voeg een form toe aan de pagina.
    $(".add-form-1").click( function() {
        $('.submit-form-1').remove();
        $('.form-1').append('<div class="add-forms">' +
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
        $('.form-1').append('<input class="submit-form-1" type="submit" name="update">');
        }
    );

    // voeg een form toe aan de pagina.
    $(".add-form-2").click( function() {
            $('.submit-form-2').remove();
            $('.form-2').append('<div class="add-forms">' +
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
            $('.form-2').append('<input class="submit-form-2" type="submit" name="update">');
        }
    );

    $(document).delegate('.delete-form', 'click', function () {
        $(this).parent('div').remove();
        $(this).parent('.br').remove();
    })

    $('.deleteRow').click(function () {
        if (confirm("Weet je zeker dat je deze rij wilt verwijderen, dit verwijdert ook alle data in de rij!")) {
            var id = $(this).parent('div').text().slice(0,-1);

            $.ajax({
                url: '/deleteRowOp',
                data: {'id' : id},
                type: 'GET'
            })

            $(document).delegate('button', 'click', function () {
                $(this).parent('div').remove();
            })
        } else {
            console.log("niet verwijderd");
        }
    })

    $('.deleteRowC').click(function () {
        if (confirm("Weet je zeker dat je deze rij wilt verwijderen, dit verwijdert ook alle data in de rij!")) {
            var id = $(this).parent('div').text().slice(0,-1);

            $.ajax({
                url: '/deleteRowCo',
                data: {'id' : id},
                type: 'GET'
            })

            $(document).delegate('button', 'click', function () {
                $(this).parent('div').remove();
            })

        } else {
            console.log("niet verwijderd")
        }
    })
});

