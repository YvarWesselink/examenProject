$(document).ready(function () {

    // voeg een form toe aan de pagina.
    $(".add-form-1").click( function() {
        $('.submit-form-1').remove();
        $('.form-1').append('<div class="add-forms">' +
            '<input type="text" min="0" name="titel">' +
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
                '<input type="text" min="0" name="titel">' +
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

    // voeg een form toe aan de pagina.
    $(".add-form-4").click( function() {
            $('.submit-form-3').remove();
            $('.form-3').append('<div class="add-forms">' +
                '<input type="text" min="0" name="titel">' +
                '<select name="input-type">' +
                '<option value="txt">Tekstvlak</option>' +
                '<option value="int">Nummeriek</option>' +
                '<option value="date">Datum</option>' +
                '<option value="time">Tijd</option>' +
                '<option value="valuta">Valuta</option>' +
                '</select>' +
                '<button type="button" class="delete-form">-</button>' +
                '</div>')
            $('.form-3').append('<input class="submit-form-3" type="submit" name="update">');
        }
    );

    $(document).delegate('.delete-form', 'click', function () {
        $(this).parent('div').remove();
        $(this).parent('.br').remove();
    })

    $('.deleteRow').click(function () {
        if (confirm("Weet je zeker dat je deze rij wilt verwijderen, dit verwijdert ook alle data in de rij!")) {
            var id = $(this).attr('id');

            $.ajax({
                url: '/deleteRowOp',
                data: {'id' : id},
                type: 'GET'
            })

            $(document).delegate('button', 'click', function () {
                $(this).parent('div').remove();
            })

            location.reload();
        } else {
            console.log("niet verwijderd");
        }
    })

    $('.deleteRowC').click(function () {
        if (confirm("Weet je zeker dat je deze rij wilt verwijderen, dit verwijdert ook alle data in de rij!")) {
            var id = $(this).attr('id');

            $.ajax({
                url: '/deleteRowCo',
                data: {'id' : id},
                type: 'GET'
            })

            $(document).delegate('button', 'click', function () {
                $(this).parent('div').remove();
            })

            location.reload();

        } else {
            console.log("niet verwijderd")
        }
    })

    $('.deleteRowV').click(function () {
        if (confirm("Weet je zeker dat je deze rij wilt verwijderen, dit verwijdert ook alle data in de rij!")) {
            var id = $(this).parent('div').text().slice(0,-1);

            $.ajax({
                url: '/deleteRowVe',
                data: {'id' : id},
                type: 'GET'
            })

            $(document).delegate('button', 'click', function () {
                $(this).parent('div').remove();
            })

            location.reload();

        } else {
            console.log("niet verwijderd")
        }
    })

    $('.up').click(function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '/moveup',
            data: {'id' : id},
            type: 'GET',
        })

        // location.reload();
    });

    $('.down').click(function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '/movedown',
            data: {'id' : id},
            type: 'GET',
        })

        location.reload();
    });

    $('.upCon').click(function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '/moveupCon',
            data: {'id' : id},
            type: 'GET',
        })
    });

    $('.downCon').click(function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '/movedownCon',
            data: {'id' : id},
            type: 'GET',
        })

        location.reload();
    });

    $('.sendExcersiseBtn').click(function () {
        if (!this.form.checkbox.checked)
        {
            alert('Je moet eerst de algemene voorwaarden accepteren.');
            return false;
        }
    })
});

