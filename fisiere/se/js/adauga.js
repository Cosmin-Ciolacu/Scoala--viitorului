function deschidere() {
    document.getElementById("mySidenav").style.marginLeft = "0px";
}

function inchidere() {
    document.getElementById("mySidenav").style.marginLeft = "-500px";
}
$(document).ready(function () {

    var count = 0;

    $('#user_dialog').dialog({
        autoOpen: false,
        width: 400
    });
    
    function afis_clase(){
        $.ajax({
            url:"php/afisclase.php",
            success:function(data){
                $('#clase').html(data);
            }
        });
    }
    afis_clase();

    $('#add').click(function () {
        $('#user_dialog').dialog('option', 'title', 'Add Data');
        $('#first_name').val('');
        $('#last_name').val('');
        $('#error_first_name').text('');
        $('#error_last_name').text('');
        $('#first_name').css('border-color', '');
        $('#last_name').css('border-color', '');
        $('#save').text('Save');
        $('#user_dialog').dialog('open');
    });

    $('#save').click(function () {
        var error_first_name = '';
        var error_last_name = '';
        var first_name = '';
        var last_name = '';
        if ($('#first_name').val() == '') {
            error_first_name = 'trebuie introdus numele elevului';
            $('#error_first_name').text(error_first_name);
            $('#first_name').css('border-color', '#cc0000');
            first_name = '';
        }
        else {
            error_first_name = '';
            $('#error_first_name').text(error_first_name);
            $('#first_name').css('border-color', '');
            first_name = $('#first_name').val();
        }
        if ($('#last_name').val() == '') {
            error_last_name = 'trebuie introdus e-maiul elevului';
            $('#error_last_name').text(error_last_name);
            $('#last_name').css('border-color', '#cc0000');
            last_name = '';
        }
        else {
            error_last_name = '';
            $('#error_last_name').text(error_last_name);
            $('#last_name').css('border-color', '');
            last_name = $('#last_name').val();
        }
        if (error_first_name != '' || error_last_name != '') {
            return false;
        }
        else {
            if ($('#save').text() == 'Save') {
                count = count + 1;
                output = '<tr id="row_' + count + '">';
                output += '<td>' + first_name + ' <input type="hidden" name="hidden_first_name[]" id="first_name' + count + '" class="first_name" value="' + first_name + '" /></td>';
                output += '<td>' + last_name + ' <input type="hidden" name="hidden_last_name[]" id="last_name' + count + '" value="' + last_name + '" /></td>';
                output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' + count + '">Editare</button></td>';
                output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + count + '">Stergere</button></td>';
                output += '</tr>';
                $('#user_data').append(output);
            }
            else {
                var row_id = $('#hidden_row_id').val();
                output = '<td>' + first_name + ' <input type="hidden" name="hidden_first_name[]" id="first_name' + row_id + '" class="first_name" value="' + first_name + '" /></td>';
                output += '<td>' + last_name + ' <input type="hidden" name="hidden_last_name[]" id="last_name' + row_id + '" value="' + last_name + '" /></td>';
                output += '<td><button type="button" name="view_details" class="btn btn-warning btn-xs view_details" id="' + row_id + '">Editare</button></td>';
                output += '<td><button type="button" name="remove_details" class="btn btn-danger btn-xs remove_details" id="' + row_id + '">Stergere</button></td>';
                $('#row_' + row_id + '').html(output);
            }

            $('#user_dialog').dialog('close');
        }
    });

    $(document).on('click', '.view_details', function () {
        var row_id = $(this).attr("id");
        var first_name = $('#first_name' + row_id + '').val();
        var last_name = $('#last_name' + row_id + '').val();
        $('#first_name').val(first_name);
        $('#last_name').val(last_name);
        $('#save').text('Editare');
        $('#hidden_row_id').val(row_id);
        $('#user_dialog').dialog('option', 'title', 'Editare date');
        $('#user_dialog').dialog('open');
    });

    $(document).on('click', '.remove_details', function () {
        var row_id = $(this).attr("id");
        if (confirm('Sigur vrei sa stergi acest elev ?')) {
            $('#row_' + row_id + '').remove();
        }
        else {
            return false;
        }
    });

    $('#action_alert').dialog({
        autoOpen: false
    });

    $('#user_form').on('submit', function (event) {
        event.preventDefault();
        var count_data = 0;
        $('.first_name').each(function () {
            count_data = count_data + 1;
        });
        if (count_data > 0) {
            var form_data = $(this).serialize();
            $.ajax({
                url: "php/adauga.php",
                method: "POST",
                data: form_data,
                success: function (data) {
                    $('#user_data').find("tr:gt(0)").remove();
                    $('#action_alert').html('<p>Clasa si elevii au fost adougati cu succes</p>');
                    $('#action_alert').dialog('open');
                }
            })
        }
        else {
            $('#action_alert').html('<p>trebuie sa introduci mai mult de un elev</p>');
            $('#action_alert').dialog('open');
        }
    });
    $('#cautare').keyup(function(){
        $.ajax({
            url:'php/cautare.php',
            method:"POST",
            data:{cautare:$('#cautare').val()},
            success:function(data){
                $('#rezultat').html(data);
            },
            error:function(){
                alert("nu");
            }
        });
    });
    $('#item').click(function(){
        if($('#searchbox').css('margin-top') == '-60px') {
            $('#searchbox').css('margin-top','100px');
            $('#item').html('');
            $('#item').html('<i class="material-icons">close</i>');
        } else {
            $('#searchbox').css('margin-top','-60px');
            $('#item').html('');
            $('#item').html('<i class="material-icons">search</i>');
            $('#rezultat').html('');
        }
    });

});